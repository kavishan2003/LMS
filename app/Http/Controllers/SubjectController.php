<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ALSubjects;
use App\Models\OLSubjects;
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

        if ($user->olsubjects) {
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

        if ($user->olsubjects) {
            // O/L ළමයෙක් නම් OLSubjects table එකෙන් හොයනවා
            $subject = OLSubjects::where('subject_code', $subject_code)->firstOrFail();
            $studentGrade = $user->olsubjects->grade;
        } elseif ($user->alsubjects) {
            // A/L ළමයෙක් නම් ALSubjects table එකෙන් හොයනවා
            $subject = ALSubjects::where('subject_code', $subject_code)->firstOrFail();
            $studentGrade = $user->alsubjects->grade;
        } else {
            abort(404, 'No subjects registered for this student.');
        }

        return view('pages.subject-content', compact('subject', 'studentGrade'));
    }
}
