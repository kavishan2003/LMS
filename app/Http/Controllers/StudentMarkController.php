<?php

namespace App\Http\Controllers;

use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class StudentMarkController extends Controller
{
    public function storeOrUpdate(Request $request, $subject_code)
    {
        $user = Auth::user();
        abort_if($user->role !== 'teacher' || ! $user->teacher, 403);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'exam_title' => 'required|string|max:100',
            'marks' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:255',
        ]);

        StudentMark::updateOrCreate(
            [
                'subject_code' => $subject_code,
                'user_id' => $request->user_id,
                'exam_title' => $request->exam_title,
            ],
            [
                'teacher_id' => $user->teacher->id,
                'marks' => $request->marks,
                'remarks' => $request->remarks,
            ]
        );

        return back()->with('success', 'Student marks updated!');
    }
}
