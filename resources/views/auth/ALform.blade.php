@extends('layouts.app')

@section('title', 'Login')

<div class="max-w-5xl border border-default rounded-base shadow-xs mx-auto px-6 py-8 mt-10">

    <!-- Header -->
    <div class="mb-6 border-b border-default-medium pb-4">
        <h2 class="text-2xl font-bold text-heading">Select Your A/L Subjects</h2>
        <p class="mt-1 text-sm text-body">
            Choose your grade, medium, and stream to view your compulsory subjects and select your 3 stream subjects.
        </p>
    </div>

    <form method="POST" action="{{ route('ALform.create') }}">
        @csrf

        <!-- Step 1: Grade, Medium & Stream Selection -->
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <!-- Grade -->
            <div>
                <label for="grade" class="block mb-2 text-sm font-medium text-heading">Select Grade</label>
                <select name="grade" id="grade" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled {{ old('grade') ? '' : 'selected' }}>Choose grade</option>
                    <option value="12" {{ old('grade') == '12' ? 'selected' : '' }}>Grade 12 (A/L)</option>
                    <option value="13" {{ old('grade') == '13' ? 'selected' : '' }}>Grade 13 (A/L)</option>
                </select>
                @error('grade')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Medium -->
            <div>
                <label for="medium" class="block mb-2 text-sm font-medium text-heading">Select Medium</label>
                <select name="medium" id="medium" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled {{ old('medium') ? '' : 'selected' }}>Choose medium</option>
                    <option value="Sinhala" {{ old('medium') == 'Sinhala' ? 'selected' : '' }}>Sinhala</option>
                    <option value="Tamil" {{ old('medium') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                    <option value="English" {{ old('medium') == 'English' ? 'selected' : '' }}>English</option>
                </select>
                @error('medium')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stream -->
            <div>
                <label for="stream" class="block mb-2 text-sm font-medium text-heading">Select A/L Stream</label>
                <select name="stream" id="stream" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled {{ old('stream') ? '' : 'selected' }}>Choose stream</option>
                    <option value="Science" {{ old('stream') == 'Science' ? 'selected' : '' }}>Science (Bio / Maths)
                    </option>
                    <option value="Commerce" {{ old('stream') == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                    <option value="Arts" {{ old('stream') == 'Arts' ? 'selected' : '' }}>Arts</option>
                    <option value="Engineering Technology"
                        {{ old('stream') == 'Engineering Technology' ? 'selected' : '' }}>Engineering Technology (ET)
                    </option>
                    <option value="Bio Systems Technology"
                        {{ old('stream') == 'Bio Systems Technology' ? 'selected' : '' }}>Bio Systems Technology (BST)
                    </option>
                </select>
                @error('stream')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Step 2: Compulsory Subjects Table + Stream Subjects Selection -->
        <div id="al_subjects_container" class="hidden">

            <!-- Compulsory Subjects Table (General English & Common General Test) -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium text-heading">
                        Compulsory Subjects (Auto-Assigned)
                    </label>
                    <span id="compulsory_count_badge"
                        class="text-xs font-medium px-2.5 py-0.5 rounded-base bg-neutral-secondary-medium border border-default-medium text-heading">
                    </span>
                </div>

                <div class="overflow-x-auto border border-default-medium rounded-base shadow-xs">
                    <table class="w-full text-sm text-left text-body">
                        <thead
                            class="text-xs uppercase bg-neutral-secondary-medium text-heading border-b border-default-medium">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-12">#</th>
                                <th scope="col" class="px-4 py-3">Subject Code</th>
                                <th scope="col" class="px-4 py-3">Subject Name</th>
                                <th scope="col" class="px-4 py-3">Medium</th>
                            </tr>
                        </thead>
                        <tbody id="compulsory_subjects_tbody" class="divide-y divide-default-medium">
                            <!-- JS auto fill -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Stream Subjects (Select 3 Subjects) -->
            <div class="mb-6 pt-4 border-t border-default-medium">
                <h3 class="text-sm font-semibold text-heading mb-1">Stream Subjects (Select 3 Subjects)</h3>
                <p class="text-xs text-body mb-4">Choose 3 subjects relevant to your selected A/L stream.</p>

                <div class="grid gap-6 md:grid-cols-3">
                    <!-- Subject 1 -->
                    <div>
                        <label for="al_sub_1" class="block mb-2 text-sm font-medium text-heading">Subject 1</label>
                        <select name="al_subjects[]" id="al_sub_1" required
                            class="al-stream-select bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Subject 1</option>
                        </select>
                    </div>

                    <!-- Subject 2 -->
                    <div>
                        <label for="al_sub_2" class="block mb-2 text-sm font-medium text-heading">Subject 2</label>
                        <select name="al_subjects[]" id="al_sub_2" required
                            class="al-stream-select bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Subject 2</option>
                        </select>
                    </div>

                    <!-- Subject 3 -->
                    <div>
                        <label for="al_sub_3" class="block mb-2 text-sm font-medium text-heading">Subject 3</label>
                        <select name="al_subjects[]" id="al_sub_3" required
                            class="al-stream-select bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Subject 3</option>
                        </select>
                    </div>
                </div>

                @error('al_subjects')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('al_subjects.*')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-10 py-2.5 focus:outline-none">
                    Save A/L Subjects
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const allAlSubjects = @json($alsubjects);

    const gradeSelect = document.getElementById('grade');
    const mediumSelect = document.getElementById('medium');
    const streamSelect = document.getElementById('stream');
    const subjectsContainer = document.getElementById('al_subjects_container');
    const compulsoryTbody = document.getElementById('compulsory_subjects_tbody');
    const compulsoryBadge = document.getElementById('compulsory_count_badge');
    const streamSelects = [
        document.getElementById('al_sub_1'),
        document.getElementById('al_sub_2'),
        document.getElementById('al_sub_3')
    ];
    console.log(allAlSubjects)

    function updateAlSubjectsUI() {
        const grade = gradeSelect.value;
        const medium = mediumSelect.value;
        const stream = streamSelect.value;

        if (!grade || !medium || !stream) {
            subjectsContainer.classList.add('hidden');
            return;
        }

        subjectsContainer.classList.remove('hidden');

        // 1. Compulsory Subjects (General English & Common General Test)
        const compulsorySubjects = allAlSubjects.filter(sub =>
            sub.medium === medium && sub.category === 'Common'
        );

        compulsoryBadge.textContent = `${compulsorySubjects.length} Compulsory Subjects`;
        compulsoryTbody.innerHTML = '';

        compulsorySubjects.forEach((sub, index) => {
            compulsoryTbody.innerHTML += `
                <tr class="hover:bg-neutral-secondary-medium/40">
                    <td class="px-4 py-3 font-medium text-heading">${index + 1}</td>
                    <td class="px-4 py-3">${sub.subject_code}</td>
                    <td class="px-4 py-3 font-medium text-heading">${sub.name}</td>
                    <td class="px-4 py-3">${sub.medium}</td>
                </tr>
            `;
        });

        // 2. Filter relevant subjects
        const filteredStreamSubjects = allAlSubjects.filter(sub =>
            sub.medium === medium && sub.category === stream
        );

        streamSelects.forEach((selectEl, idx) => {
            selectEl.innerHTML = `<option value="" selected disabled>Select Subject ${idx + 1}</option>`;
            filteredStreamSubjects.forEach(sub => {
                selectEl.innerHTML +=
                    `<option value="${sub.id}">${sub.subject_code} - ${sub.name}</option>`;
            });
        });
    }

    // disable drop down multiple values
    function preventDuplicateSelection() {
        const selectedValues = streamSelects.map(sel => sel.value).filter(val => val !== '');

        streamSelects.forEach(selectEl => {
            Array.from(selectEl.options).forEach(option => {
                if (option.value === '') return;
                if (selectedValues.includes(option.value) && selectEl.value !== option.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    gradeSelect.addEventListener('change', updateAlSubjectsUI);
    mediumSelect.addEventListener('change', updateAlSubjectsUI);
    streamSelect.addEventListener('change', updateAlSubjectsUI);

    streamSelects.forEach(sel => {
        sel.addEventListener('change', preventDuplicateSelection);
    });

    window.addEventListener('DOMContentLoaded', updateAlSubjectsUI);
</script>
