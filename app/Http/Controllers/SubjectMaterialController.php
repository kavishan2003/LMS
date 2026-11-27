<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectMaterial;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SubjectMaterialController extends Controller
{
    public function store(Request $request, $subject_code)
    {
        $user = Auth::user();
        abort_if($user->role !== 'teacher' || !$user->teacher, 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:lesson,paper',
            'type' => 'required|in:file,youtube,gdrive',
            'file' => 'required_if:type,file|nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:20480', // 20MB max
            'external_url' => 'required_if:type,youtube,gdrive|nullable|url',
        ]);

        $filePath = null;
        $extension = null;

        if ($request->type === 'file' && $request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filePath = $file->store("subjects/{$subject_code}/{$request->category}s", 'public');
        }

        SubjectMaterial::create([
            'subject_code' => $subject_code,
            'teacher_id' => $user->teacher->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
            'file_path' => $filePath,
            'file_extension' => $extension,
            'external_url' => $request->type !== 'file' ? $request->external_url : null,
        ]);

        return back()->with('success', 'Material added successfully!');
    }

    public function destroy(SubjectMaterial $material)
    {
        $user = Auth::user();
        abort_if($user->role !== 'teacher' || $material->teacher_id !== $user->teacher?->id, 403);

        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();
        return back()->with('success', 'Material removed successfully!');
    }
}