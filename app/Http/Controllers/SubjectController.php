<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ALSubjects;
use App\Models\Assignment;
use App\Models\OLSubjects;
use App\Models\StudentMark;
use App\Models\SubjectMaterial;
use App\Models\StudentAlSubject;
use App\Models\StudentOlSubject;
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

        // 1. ඔයාගේ දැනට තියෙන Logic එක (කිසිම වෙනසක් නැත)
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

        // 2. අලුතින් එකතු වෙන Course Materials & Past Papers
        $lessons = SubjectMaterial::where('subject_code', $subject_code)
            ->where('category', 'lesson')
            ->latest()
            ->get();

        $papers = SubjectMaterial::where('subject_code', $subject_code)
            ->where('category', 'paper')
            ->latest()
            ->get();

        // 3. Assignments & Student Submissions
        $assignments = Assignment::with('submissions.student')
            ->where('subject_code', $subject_code)
            ->latest()
            ->get();

        // 4. Enrolled Students & Marks (Role එක අනුව)
        $enrolledStudents = collect();
        $marksByStudent = collect();

        if ($user->role === 'teacher') {
            if ($user->teacher->section === 'OL') {
                $studentUserIds = StudentOlSubject::whereJsonContains('compulsory_subjects', $subject->id)
                    ->orWhereJsonContains('main_subjects', $subject->id)
                    ->orWhere('basket_1_id', $subject->id)
                    ->orWhere('basket_2_id', $subject->id)
                    ->orWhere('basket_3_id', $subject->id)
                    ->pluck('user_id');
            } else {
                $studentUserIds = StudentAlSubject::whereJsonContains('compulsory_subjects', $subject->id)
                    ->orWhere('subject_1_id', $subject->id)
                    ->orWhere('subject_2_id', $subject->id)
                    ->orWhere('subject_3_id', $subject->id)
                    ->pluck('user_id');
            }

            $enrolledStudents = User::whereIn('id', $studentUserIds)->get();
            $marksByStudent = StudentMark::where('subject_code', $subject_code)
                ->get()
                ->keyBy('user_id');
        } else {
            $marksByStudent = StudentMark::where('subject_code', $subject_code)
                ->where('user_id', $user->id)
                ->get();
        }

        return view('pages.subject-content', compact(
            'subject',
            'studentGrade',
            'lessons',
            'papers',
            'assignments',
            'enrolledStudents',
            'marksByStudent'
        ));
    }
}
