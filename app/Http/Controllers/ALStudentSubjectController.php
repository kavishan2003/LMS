<?php

namespace App\Http\Controllers;

use App\Models\ALSubjects;
use Illuminate\Http\Request;
use App\Models\StudentAlSubject;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ALStudentSubjectController extends Controller
{
    public function index()
    {
        $alsubjects = ALSubjects::all();
        return view('auth.ALform', compact('alsubjects'));
    }

    public function create(Request $request)
    {
        // 1. Validation Rules
        $request->validate([
            'grade' => 'required|in:12,13',
            'medium' => 'required|in:Sinhala,Tamil,English',
            'stream' => 'required|string',
            'al_subjects' => 'required|array|size:3',
            'al_subjects.*' => 'required|distinct|exists:alsubjects,id',
        ], [
            'al_subjects.*.distinct' => 'Please select 3 different subjects from your stream.',
        ]);

        $grade = (int) $request->grade;
        $medium = $request->medium;
        $stream = $request->stream;

        // 2. Getting Backend Compulsory Subjects 2 (General English & Common General Test) filter 
        $compulsorySubjectIds = ALSubjects::where('medium', $medium)
            ->where('category', 'Common')
            ->pluck('id')
            ->toArray();

        // 3. Get selected 3 subjects
        $selectedSubjects = array_values($request->al_subjects);

        // 4. DB row save/update 
        StudentAlSubject::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'grade' => $grade,
                'medium' => $medium,
                'stream' => $stream,
                'compulsory_subjects' => $compulsorySubjectIds,
                'subject_1_id' => $selectedSubjects[0],
                'subject_2_id' => $selectedSubjects[1],
                'subject_3_id' => $selectedSubjects[2],
            ]
        );

        return redirect()->route('dashboard')->with('success', 'A/L Subjects successfully saved!');
    }
}