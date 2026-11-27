@extends('layouts.admin')

@section('title', $subject->name)

@section('content')

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-emerald-800 rounded-base bg-emerald-50 border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-base bg-red-50 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div id="accordion-open" data-accordion="open" class="rounded-base border mb-5 border-default overflow-hidden shadow-xs">

        {{-- ================= ACCORDION 1: SUBJECT OVERVIEW ================= --}}
        <h2 id="accordion-open-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body rounded-t-base border border-t-0 border-x-0 border-b-default hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                <span class="flex items-center text-2xl font-light">
                    {{ $subject->name }} @if($studentGrade) (Grade {{ $studentGrade }}) @endif
                </span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-1" class="border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-open-heading-1">
            <div class="p-6">
                @php
                    $codePrefix = explode('-', $subject->subject_code)[0];
                    $imagePath = "images/subjects/{$codePrefix}.jpg";
                    $finalImage = file_exists(public_path($imagePath)) ? asset($imagePath) : asset('images/subjects/default.jpg');
                @endphp

                <div class="mb-6 overflow-hidden rounded-lg shadow-sm border border-gray-200">
                    <img src="{{ $finalImage }}" alt="{{ $subject->name }}" class="w-full h-48 sm:h-64 object-cover">
                </div>
                <div>
                    <h1 class="text-xl text-blue-500 font-semibold">Welcome to {{ $subject->name }}</h1>
                    <span class="text-sm font-semibold text-emerald-700">{{ $subject->subject_code }} • {{ $subject->medium }} Medium</span>
                    <p class="text-sm text-gray-500">Category: {{ $subject->category }}</p>
                </div>
            </div>
        </div>

        {{-- ================= ACCORDION 2: LESSONS, NOTES, DRIVE & YOUTUBE ================= --}}
        <h2 id="accordion-open-heading-2">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body border border-x-0 border-b-default border-t-0 hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-2" aria-expanded="true" aria-controls="accordion-open-body-2">
                <span class="flex items-center text-2xl font-light">Course Content, Notes & Video Lessons</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-2" class="border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-open-heading-2">
            <div class="p-6 space-y-6">

                {{-- TEACHER ONLY: Add Lesson / Drive / YouTube Form --}}
                @if (Auth::user()->role === 'teacher')
                    <form action="{{ route('materials.store', $subject->subject_code) }}" method="POST" enctype="multipart/form-data"
                        class="p-5 bg-neutral-secondary-medium/40 border border-default-medium rounded-base space-y-4">
                        @csrf
                        <input type="hidden" name="category" value="lesson">
                        <h3 class="text-base font-semibold text-heading">+ Add New Lesson / Note / Video</h3>

                        <div class="grid gap-4 md:grid-cols-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Title</label>
                                <input type="text" name="title" required placeholder="e.g., Unit 01 - Short Notes"
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Resource Type</label>
                                <select name="type" id="lesson_type_select" onchange="toggleLessonInput()"
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                                    <option value="file">Document (PDF / Word / PPTX)</option>
                                    <option value="youtube">YouTube Video Lesson</option>
                                    <option value="gdrive">Google Drive Link</option>
                                </select>
                            </div>
                            <div id="lesson_file_input">
                                <label class="block mb-1 text-xs font-medium text-heading">Upload File (PDF, DOCX, PPTX)</label>
                                <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx"
                                    class="w-full text-sm border border-default-medium rounded-base bg-white">
                            </div>
                            <div id="lesson_url_input" class="hidden">
                                <label class="block mb-1 text-xs font-medium text-heading">YouTube / Google Drive URL</label>
                                <input type="url" name="external_url" placeholder="https://..."
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                            </div>
                        </div>

                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-brand rounded-base hover:bg-brand-strong">
                            Upload Content
                        </button>
                    </form>
                @endif

                {{-- Display Lessons List --}}
                <div class="grid gap-4 md:grid-cols-2">
                    @forelse ($lessons as $lesson)
                        <div class="p-4 border border-default-medium rounded-base bg-white shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase px-2 py-0.5 rounded bg-blue-50 text-blue-700">
                                        {{ $lesson->type === 'file' ? strtoupper($lesson->file_extension) : $lesson->type }}
                                    </span>
                                    @if (Auth::user()->role === 'teacher')
                                        <form action="{{ route('materials.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:underline">Remove</button>
                                        </form>
                                    @endif
                                </div>
                                <h4 class="mt-2 font-semibold text-heading">{{ $lesson->title }}</h4>

                                @if ($lesson->type === 'youtube' && $lesson->youtube_embed_url)
                                    <iframe class="w-full h-48 mt-3 rounded" src="{{ $lesson->youtube_embed_url }}" allowfullscreen></iframe>
                                @elseif ($lesson->type === 'gdrive')
                                    <a href="{{ $lesson->external_url }}" target="_blank" class="inline-block mt-3 text-sm text-emerald-700 font-medium hover:underline">
                                        Open in Google Drive →
                                    </a>
                                @elseif ($lesson->type === 'file')
                                    <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank" download
                                        class="inline-block mt-3 text-sm text-brand font-medium hover:underline">
                                        Download File ({{ strtoupper($lesson->file_extension) }}) ↓
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-body col-span-2">No lessons or course materials uploaded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ================= ACCORDION 3: PAST PAPERS & MODEL PAPERS ================= --}}
        <h2 id="accordion-open-heading-3">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body border border-x-0 border-b-default border-t-0 hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
                <span class="flex items-center text-2xl font-light">Past Papers & Model Papers</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-3" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-open-heading-3">
            <div class="p-6 space-y-6">

                {{-- TEACHER ONLY: Upload Past/Model Paper --}}
                @if (Auth::user()->role === 'teacher')
                    <form action="{{ route('materials.store', $subject->subject_code) }}" method="POST" enctype="multipart/form-data"
                        class="p-5 bg-neutral-secondary-medium/40 border border-default-medium rounded-base space-y-4">
                        @csrf
                        <input type="hidden" name="category" value="paper">
                        <input type="hidden" name="type" value="file">
                        <h3 class="text-base font-semibold text-heading">+ Upload Past Paper / Model Paper</h3>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Paper Title & Year</label>
                                <input type="text" name="title" required placeholder="e.g., 2024 A/L Past Paper - Part I & II"
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Paper File (PDF / Word)</label>
                                <input type="file" name="file" required accept=".pdf,.doc,.docx"
                                    class="w-full text-sm border border-default-medium rounded-base bg-white">
                            </div>
                        </div>

                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-brand rounded-base hover:bg-brand-strong">
                            Upload Paper
                        </button>
                    </form>
                @endif

                {{-- Papers List --}}
                <ul class="divide-y divide-default-medium border border-default-medium rounded-base bg-white">
                    @forelse ($papers as $paper)
                        <li class="p-4 flex items-center justify-between">
                            <div>
                                <p class="font-medium text-heading">{{ $paper->title }}</p>
                                <span class="text-xs text-body">Uploaded {{ $paper->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{ asset('storage/' . $paper->file_path) }}" target="_blank" download
                                    class="text-sm font-medium text-emerald-700 hover:underline">Download</a>
                                @if (Auth::user()->role === 'teacher')
                                    <form action="{{ route('materials.destroy', $paper->id) }}" method="POST" onsubmit="return confirm('Delete this paper?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:underline">Remove</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-sm text-body">No past papers or model papers uploaded yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- ================= ACCORDION 4: ASSIGNMENTS & DROPBOX ================= --}}
        <h2 id="accordion-open-heading-4">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body border border-x-0 border-b-default border-t-0 hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-4" aria-expanded="false" aria-controls="accordion-open-body-4">
                <span class="flex items-center text-2xl font-light">Assignments & Submission Dropbox</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-4" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-open-heading-4">
            <div class="p-6 space-y-6">

                {{-- TEACHER ONLY: Create Assignment Form --}}
                @if (Auth::user()->role === 'teacher')
                    <form action="{{ route('assignments.store', $subject->subject_code) }}" method="POST" enctype="multipart/form-data"
                        class="p-5 bg-neutral-secondary-medium/40 border border-default-medium rounded-base space-y-4">
                        @csrf
                        <h3 class="text-base font-semibold text-heading">+ Create New Assignment</h3>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Assignment Title</label>
                                <input type="text" name="title" required placeholder="e.g., Assignment 01 - Algebra"
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-heading">Submission Deadline</label>
                                <input type="datetime-local" name="deadline" required
                                    class="w-full text-sm rounded-base border border-default-medium px-3 py-2">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 text-xs font-medium text-heading">Assignment Introduction & Instructions</label>
                            <textarea name="instructions" rows="3" placeholder="Enter guidelines, word limits, formatting rules..."
                                class="w-full text-sm rounded-base border border-default-medium px-3 py-2"></textarea>
                        </div>

                        <div>
                            <label class="block mb-1 text-xs font-medium text-heading">Question Paper / Attachment (Optional)</label>
                            <input type="file" name="attachment" class="text-sm border border-default-medium rounded-base bg-white">
                        </div>

                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-brand rounded-base hover:bg-brand-strong">
                            Publish Assignment
                        </button>
                    </form>
                @endif

                {{-- Assignments List --}}
                <div class="space-y-4">
                    @forelse ($assignments as $assignment)
                        @php $isExpired = now()->greaterThan($assignment->deadline); @endphp
                        <div class="p-5 border border-default-medium rounded-base bg-white shadow-xs">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h4 class="text-lg font-bold text-heading">{{ $assignment->title }}</h4>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded {{ $isExpired ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-800' }}">
                                    Deadline: {{ $assignment->deadline->format('M d, Y h:i A') }}
                                </span>
                            </div>

                            <p class="mt-2 text-sm text-body whitespace-pre-line">{{ $assignment->instructions }}</p>

                            @if ($assignment->attachment_path)
                                <a href="{{ asset('storage/' . $assignment->attachment_path) }}" download
                                    class="inline-block mt-2 text-sm font-medium text-brand hover:underline">
                                    Download Question Sheet ↓
                                </a>
                            @endif

                            {{-- STUDENT DROPBOX UPLOAD --}}
                            @if (Auth::user()->role === 'student')
                                @php $mySubmission = $assignment->submissions->where('user_id', Auth::id())->first(); @endphp
                                <div class="mt-4 pt-4 border-t border-default-medium">
                                    @if ($mySubmission)
                                        <p class="text-xs text-emerald-700 font-semibold mb-2">
                                            ✓ Submitted: {{ $mySubmission->original_filename }} ({{ $mySubmission->updated_at->diffForHumans() }})
                                        </p>
                                    @endif

                                    @if (!$isExpired)
                                        <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-center gap-3">
                                            @csrf
                                            <input type="file" name="submission_file" required class="text-xs border border-default-medium rounded-base">
                                            <button type="submit" class="px-4 py-1.5 text-xs font-medium text-white bg-emerald-700 rounded-base hover:bg-emerald-800">
                                                {{ $mySubmission ? 'Re-upload Answer' : 'Submit to Dropbox' }}
                                            </button>
                                        </form>
                                    @else
                                        <p class="text-xs text-red-600 font-medium">Submission Dropbox is closed.</p>
                                    @endif
                                </div>
                            @endif

                            {{-- TEACHER VIEW SUBMISSIONS --}}
                            @if (Auth::user()->role === 'teacher')
                                <div class="mt-4 pt-4 border-t border-default-medium">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-semibold text-heading">Student Submissions ({{ $assignment->submissions->count() }})</span>
                                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Delete assignment?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:underline">Delete Assignment</button>
                                        </form>
                                    </div>
                                    <ul class="text-xs space-y-1">
                                        @forelse ($assignment->submissions as $sub)
                                            <li class="flex justify-between p-2 bg-gray-50 rounded">
                                                <span>{{ $sub->student->name }} ({{ $sub->original_filename }})</span>
                                                <a href="{{ asset('storage/' . $sub->file_path) }}" download class="text-brand font-semibold hover:underline">Download Answer</a>
                                            </li>
                                        @empty
                                            <li class="text-body">No submissions yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-body">No assignments posted yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ================= ACCORDION 5: STUDENT MARKS MANAGEMENT ================= --}}
        <h2 id="accordion-open-heading-5">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-5" aria-expanded="false" aria-controls="accordion-open-body-5">
                <span class="flex items-center text-2xl font-light">Subject Marks & Results</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-5" class="hidden" aria-labelledby="accordion-open-heading-5">
            <div class="p-6 border border-t-default border-b-0 border-x-0">
                @if (Auth::user()->role === 'teacher')
                    <h3 class="text-base font-semibold text-heading mb-4">Update Student Marks ({{ $subject->name }})</h3>
                    <div class="overflow-x-auto border border-default-medium rounded-base">
                        <table class="w-full text-sm text-left text-body">
                            <thead class="text-xs uppercase bg-neutral-secondary-medium text-heading border-b border-default-medium">
                                <tr>
                                    <th class="px-4 py-3">Student Name</th>
                                    <th class="px-4 py-3">Exam / Term</th>
                                    <th class="px-4 py-3">Marks (0 - 100)</th>
                                    <th class="px-4 py-3">Remarks</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-medium bg-white">
                                @forelse ($enrolledStudents as $student)
                                    @php $record = $marksByStudent->get($student->id); @endphp
                                    <tr>
                                        <form action="{{ route('marks.update', $subject->subject_code) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $student->id }}">
                                            <td class="px-4 py-3 font-medium text-heading">{{ $student->name }}</td>
                                            <td class="px-4 py-3">
                                                <input type="text" name="exam_title" value="{{ $record->exam_title ?? 'Term 1' }}" required
                                                    class="text-xs rounded border border-default-medium px-2 py-1 w-28">
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="number" step="0.01" min="0" max="100" name="marks" value="{{ $record->marks ?? '' }}" required
                                                    class="text-xs rounded border border-default-medium px-2 py-1 w-24">
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="text" name="remarks" value="{{ $record->remarks ?? '' }}" placeholder="Good / Needs improvement"
                                                    class="text-xs rounded border border-default-medium px-2 py-1 w-40">
                                            </td>
                                            <td class="px-4 py-3">
                                                <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-emerald-700 rounded hover:bg-emerald-800">
                                                    Save
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-body">No students enrolled in this subject yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Student View Own Marks --}}
                    <h3 class="text-base font-semibold text-heading mb-3">Your Marks</h3>
                    <ul class="divide-y divide-default-medium border border-default-medium rounded-base bg-white">
                        @forelse ($marksByStudent as $mark)
                            <li class="p-4 flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-heading">{{ $mark->exam_title }}</p>
                                    <p class="text-xs text-body">{{ $mark->remarks }}</p>
                                </div>
                                <span class="text-lg font-bold text-emerald-700">{{ $mark->marks }}%</span>
                            </li>
                        @empty
                            <li class="p-4 text-sm text-body">No marks published for this subject yet.</li>
                        @endforelse
                    </ul>
                @endif
            </div>
        </div>

    </div>

    <script>
        function toggleLessonInput() {
            const type = document.getElementById('lesson_type_select').value;
            const fileInput = document.getElementById('lesson_file_input');
            const urlInput = document.getElementById('lesson_url_input');

            if (type === 'file') {
                fileInput.classList.remove('hidden');
                urlInput.classList.add('hidden');
            } else {
                fileInput.classList.add('hidden');
                urlInput.classList.remove('hidden');
            }
        }
    </script>

@endsection