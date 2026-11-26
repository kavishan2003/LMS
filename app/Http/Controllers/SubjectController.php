<?php

namespace App\Http\Controllers;

use App\Models\ALSubjects;
use App\Models\OLSubjects;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $subjects = collect();
        $level = null;

        if ($user->role === 'teacher' && $user->teacher) {

            $subjects = $user->teacher->getTeacherSubjects();
            $level = strtolower($user->teacher->section); // 'ol' or 'al'
        } elseif ($user->olsubjects) {
            $subjects = $user->olsubjects->getAllSubjects();
            $level = 'ol';
        } elseif ($user->alsubjects) {
            $subjects = $user->alsubjects->getAllSubjects();
            $level = 'al';
        }

        return view('pages.subjects', [
            'subjects' => $subjects,
            'level' => $level,
        ]);
    }

    public function show($subject_code)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->role === 'teacher' && $user->teacher) {
            $subject = $user->teacher->section === 'AL'
                ? ALSubjects::where('subject_code', $subject_code)->firstOrFail()
                : OLSubjects::where('subject_code', $subject_code)->firstOrFail();

            $studentGrade = null;
        } elseif ($user->olsubjects) {
            $subject = OLSubjects::where('subject_code', $subject_code)->firstOrFail();
            $studentGrade = $user->olsubjects->grade;
        } elseif ($user->alsubjects) {
            $subject = ALSubjects::where('subject_code', $subject_code)->firstOrFail();
            $studentGrade = $user->alsubjects->grade;
        } else {
            abort(404);
        }

        return view('pages.subject-content', compact('subject', 'studentGrade'));
    }
}
