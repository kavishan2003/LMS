<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ALSubjects;
use App\Models\OLSubjects;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->get();

        return view('pages.ContactTeachers', compact('teachers'));
    }

    public function create()
    {
        $olsubjects = OLSubjects::all();
        $alsubjects = ALSubjects::all();
        $teacher = Auth::user()->teacher; // edit if saved before

        return view('auth.Teacherform', compact('olsubjects', 'alsubjects', 'teacher'));
    }

public function store(Request $request)
{
    $request->validate([
        'qualification' => 'required|string|max:255',
        'section' => 'required|in:OL,AL',
        'subject_ids' => 'required|array|min:1|max:3',
        'subject_ids.*' => 'required|integer|distinct',
    ], [
        'subject_ids.required' => 'Please select at least 1 subject.',
        'subject_ids.max' => 'You can select a maximum of 3 subjects.',
    ]);

    $userId = Auth::id();
    $subjectIds = array_values($request->subject_ids);

    // 1. Selected IDs Subject Names (teachers table if needed)
    $subjectNames = $request->section === 'AL'
        ? ALSubjects::whereIn('id', $subjectIds)->pluck('name')->toArray()
        : OLSubjects::whereIn('id', $subjectIds)->pluck('name')->toArray();

    // 2. Teachers table save/update 
    $teacher = Teacher::updateOrCreate(
        ['user_id' => $userId],
        [
            'teacher_code' => 'TCH-' . str_pad($userId, 3, '0', STR_PAD_LEFT),
            'qualification' => $request->qualification,
            'section' => $request->section,
            'specialization' => $subjectNames,
            'is_active' => true,
        ]
    );

    // 3. Auto teacher_subjects table fill/update 
    $teacher->teacherSubject()->updateOrCreate(
        ['teacher_id' => $teacher->id],
        [
            'section' => $request->section,
            'subject_1_id' => $subjectIds[0],
            'subject_2_id' => $subjectIds[1] ?? null,
            'subject_3_id' => $subjectIds[2] ?? null,
        ]
    );

    return redirect()->route('dashboard')->with('success', 'Teacher profile and subjects saved successfully!');
}
}
