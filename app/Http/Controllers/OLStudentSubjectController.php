<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OLSubjects;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OLStudentSubjectController extends Controller
{
    public function index() //
    {
        $olsubjects = OLSubjects::all();

        return view('auth.OLform', compact('olsubjects'));
    }

    public function create(Request $request) //  --- IGNORE ---
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

        
        $mainSubjectIds = OLSubjects::where('medium', $medium)
            ->where('category', 'Main')
            ->pluck('id')
            ->toArray();

        // 3. Main Subjects + Religion Subject ID 
        $allSubjectIds = array_merge($mainSubjectIds, [$request->religion_id]);

        // 4. Grade 10/11 add Basket Subjects 
        if (in_array($grade, [10, 11]) && $request->has('basket_subjects')) {
            $allSubjectIds = array_merge($allSubjectIds, $request->basket_subjects);
        }

        // 5. student_ol_subject table  columns (user_id, olsubject_id, grade, medium)
        $syncData = [];
        foreach (array_unique($allSubjectIds) as $subjectId) {
            $syncData[$subjectId] = [
                'grade' => $grade,
                'medium' => $medium,
            ];
        }

        /** @var User $user */
        $user = Auth::user();
        $user->olsubjects()->sync($syncData);

        return redirect()->route('dashboard')->with('success', 'Subjects successfully saved!');
    }
}
