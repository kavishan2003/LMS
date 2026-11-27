<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function store(Request $request, $subject_code)
    {
        $user = Auth::user();
        abort_if($user->role !== 'teacher' || ! $user->teacher, 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'deadline' => 'required|date|after:now',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store("subjects/{$subject_code}/assignments", 'public');
        }

        Assignment::create([
            'subject_code' => $subject_code,
            'teacher_id' => $user->teacher->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'attachment_path' => $attachmentPath,
            'deadline' => $request->deadline,
        ]);

        return back()->with('success', 'Assignment created successfully!');
    }

    public function destroy(Assignment $assignment)
    {
        $user = Auth::user();
        abort_if($user->role !== 'teacher' || $assignment->teacher_id !== $user->teacher?->id, 403);

        if ($assignment->attachment_path) {
            Storage::disk('public')->delete($assignment->attachment_path);
        }
        $assignment->delete();

        return back()->with('success', 'Assignment deleted!');
    }

    // Student Dropbox Upload
    public function submit(Request $request, Assignment $assignment)
    {
        $user = Auth::user();
        abort_if($user->role !== 'student', 403);

        if (now()->greaterThan($assignment->deadline)) {
            return back()->with('error', 'Deadline has passed! Submissions are closed.');
        }

        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,doc,docx,zip,jpg,png|max:20480',
            'student_note' => 'nullable|string|max:500',
        ]);

        $existing = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing && Storage::disk('public')->exists($existing->file_path)) {
            Storage::disk('public')->delete($existing->file_path);
        }

        $file = $request->file('submission_file');
        $path = $file->store("submissions/{$assignment->id}", 'public');

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'user_id' => $user->id],
            [
                'file_path' => $path,
                'original_filename' => $file->getClientOriginalName(),
                'student_note' => $request->student_note,
            ]
        );

        return back()->with('success', 'Assignment submitted to Dropbox!');
    }
}
