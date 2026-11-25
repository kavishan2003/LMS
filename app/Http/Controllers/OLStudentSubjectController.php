<?php

namespace App\Http\Controllers;

use App\Models\OLSubjects;
use App\Models\StudentOlSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OLStudentSubjectController extends Controller
{
    public function index()
    {
        $olsubjects = OLSubjects::all();

        return view('auth.OLform', compact('olsubjects'));
    }

    public function create(Request $request)
    {
        // 1. Validation Rules
        $rules = [
            'grade' => 'required|integer|between:6,11',
            'medium' => 'required|in:Sinhala,Tamil,English',
            'religion_id' => 'required|exists:olsubjects,id',
        ];

        if (in_array((int) $request->grade, [10, 11])) {
            $rules['basket_subjects'] = 'required|array|size:3';
            $rules['basket_subjects.*'] = 'required|distinct|exists:olsubjects,id';
        }

        $request->validate($rules);

        $grade = (int) $request->grade;
        $medium = $request->medium;

        // 2. getting the main subjects IDs based on the selected medium and category
        $mainSubjectIds = OLSubjects::where('medium', $medium)
            ->where('category', 'Main')
            ->pluck('id')
            ->toArray();

        // 3. separating basket subjects if the grade is 10 or 11, otherwise set it to an empty array
        $baskets = in_array($grade, [10, 11]) ? array_values($request->basket_subjects) : [];

        // 4. update or create a new row in the student_ol_subject table for the authenticated user
        StudentOlSubject::updateOrCreate(
            ['user_id' => Auth::id()], // if the user has already saved their subjects, it will update; otherwise, it will create a new entry
            [
                'grade' => $grade,
                'medium' => $medium,
                'main_subjects' => $mainSubjectIds,
                'religion_id' => $request->religion_id,
                'basket_1_id' => $baskets[0] ?? null,
                'basket_2_id' => $baskets[1] ?? null,
                'basket_3_id' => $baskets[2] ?? null,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Subjects successfully saved!');
    }

    public function show(OLSubjects $subject)
    {

        $studentGrade = Auth::user()->olsubjects->grade ?? null;

        return view('pages.subject-content', compact('subject', 'studentGrade'));
    }
}
