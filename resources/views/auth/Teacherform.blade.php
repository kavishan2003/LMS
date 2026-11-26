@extends('layouts.app')

@section('title', 'Register')

<div class="max-w-5xl border border-default rounded-base shadow-xs mx-auto px-6 py-8 mt-10">

    <!-- Header -->
    <div class="mb-6 border-b border-default-medium pb-4">
        <h2 class="text-2xl font-bold text-heading">Teacher Profile & Subject Details</h2>
        <p class="mt-1 text-sm text-body">
            Enter your academic qualifications and select the section and subject you teach.
        </p>
    </div>

    <form method="POST" action="{{ route('teacher.store') }}">
        @csrf

        <!-- Step 1: Qualification & Section -->
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <!-- Qualification -->
            <div>
                <label for="qualification" class="block mb-2 text-sm font-medium text-heading">
                    Highest Qualification
                </label>
                <input type="text" name="qualification" id="qualification" required
                    value="{{ old('qualification', $teacher->qualification ?? '') }}"
                    placeholder="e.g., B.Sc. (Hons), PGDE, M.Ed."
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                @error('qualification')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section (O/L or A/L) -->
            <div>
                <label for="section" class="block mb-2 text-sm font-medium text-heading">Teaching Section</label>
                <select name="section" id="section" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled {{ old('section', $teacher->section ?? '') ? '' : 'selected' }}>
                        Choose section
                    </option>
                    <option value="OL" {{ old('section', $teacher->section ?? '') == 'OL' ? 'selected' : '' }}>
                        O/L Section (Grades 6 - 11)
                    </option>
                    <option value="AL" {{ old('section', $teacher->section ?? '') == 'AL' ? 'selected' : '' }}>
                        A/L Section (Grades 12 - 13)
                    </option>
                </select>
                @error('section')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Medium (Filter helper) -->
            <div>
                <label for="medium" class="block mb-2 text-sm font-medium text-heading">Teaching Medium</label>
                <select name="medium" id="medium" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled selected>Choose medium</option>
                    <option value="Sinhala" {{ old('medium') == 'Sinhala' ? 'selected' : '' }}>Sinhala</option>
                    <option value="Tamil" {{ old('medium') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                    <option value="English" {{ old('medium') == 'English' ? 'selected' : '' }}>English</option>
                </select>
            </div>
        </div>

        <!-- Step 2: Subject Selection (Auto-filtered by Section & Medium) -->
        {{-- <div id="subject_selection_container" class="hidden pt-4 border-t border-default-medium">
            <div class="mb-6">
                <label for="specialization" class="block mb-2 text-sm font-medium text-heading">
                    Select Teaching Subject
                </label>
                <p class="text-xs text-body mb-3">
                    Select the primary subject you are assigned to teach in this section.
                </p>

                <select name="specialization" id="specialization" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full md:w-1/2 px-3 py-2.5 shadow-xs">
                    <option value="" selected disabled>Choose subject</option>
                </select>

                @error('specialization')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-10 py-2.5 focus:outline-none">
                    Save Teacher Profile
                </button>
            </div>
        </div> --}}
        <!-- Step 2: Multiple Subject Selection (Auto-filtered by Section & Medium) -->
        <div id="subject_selection_container" class="hidden pt-4 border-t border-default-medium">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-sm font-medium text-heading">
                        Select Teaching Subjects
                    </label>
                    <span id="selected_count_badge"
                        class="text-xs font-medium px-2.5 py-0.5 rounded-base bg-neutral-secondary-medium border border-default-medium text-heading">
                        0 Selected
                    </span>
                </div>
                <p class="text-xs text-body mb-4">
                    Select one or more subjects you are assigned to teach in this section.
                </p>

                <!-- Dynamic Checkboxes Grid -->
                <div id="subjects_checkbox_grid" class="grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                    <!-- JS auto fill -->
                </div>

                @error('specialization')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('specialization.*')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-10 py-2.5 focus:outline-none">
                    Save Teacher Profile
                </button>
            </div>
        </div>
    </form>
</div>

{{-- <script>
    const olSubjects = @json($olsubjects);
    const alSubjects = @json($alsubjects);
    const savedSpecialization = @json(old('specialization', $teacher->specialization ?? ''));

    const sectionSelect = document.getElementById('section');
    const mediumSelect = document.getElementById('medium');
    const subjectContainer = document.getElementById('subject_selection_container');
    const subjectSelect = document.getElementById('specialization');

    function updateTeacherSubjects() {
        const section = sectionSelect.value;
        const medium = mediumSelect.value;

        if (!section || !medium) {
            subjectContainer.classList.add('hidden');
            return;
        }

        subjectContainer.classList.remove('hidden');

        // select the relevant table for the subjects
        const sourceList = section === 'OL' ? olSubjects : alSubjects;
        const filtered = sourceList.filter(sub => sub.medium === medium);

        subjectSelect.innerHTML = '<option value="" selected disabled>Choose subject</option>';

        filtered.forEach(sub => {
            const label = `${sub.subject_code} - ${sub.name} (${sub.medium})`;
            const isSelected = savedSpecialization === sub.name ? 'selected' : '';
            subjectSelect.innerHTML += `<option value="${sub.name}" ${isSelected}>${label}</option>`;
        });
    }

    sectionSelect.addEventListener('change', updateTeacherSubjects);
    mediumSelect.addEventListener('change', updateTeacherSubjects);

    window.addEventListener('DOMContentLoaded', updateTeacherSubjects);
</script> --}}
<script>
    const olSubjects = @json($olsubjects);
    const alSubjects = @json($alsubjects);
    const savedSpecializations = @json(old('specialization', $teacher->specialization ?? []));

    const sectionSelect = document.getElementById('section');
    const mediumSelect = document.getElementById('medium');
    const subjectContainer = document.getElementById('subject_selection_container');
    const checkboxGrid = document.getElementById('subjects_checkbox_grid');
    const selectedCountBadge = document.getElementById('selected_count_badge');

    function updateSelectedCount() {
        const checkboxes = checkboxGrid.querySelectorAll('input[type="checkbox"]');
        const checkedBoxes = checkboxGrid.querySelectorAll('input[type="checkbox"]:checked');

        selectedCountBadge.textContent = `${checkedBoxes.length} / 3 Selected`;

        // after selecting 3 the checkbox disables
        checkboxes.forEach(cb => {
            if (!cb.checked) {
                cb.disabled = checkedBoxes.length >= 3;
            }
        });
    }

    function updateTeacherSubjects() {
        const section = sectionSelect.value;
        const medium = mediumSelect.value;

        if (!section || !medium) {
            subjectContainer.classList.add('hidden');
            return;
        }

        subjectContainer.classList.remove('hidden');

        const sourceList = section === 'OL' ? olSubjects : alSubjects;
        const filtered = sourceList.filter(sub => sub.medium === medium);

        checkboxGrid.innerHTML = '';

        filtered.forEach(sub => {
            const isChecked = Array.isArray(savedSpecializations) && savedSpecializations.includes(sub.name) ?
                'checked' : '';

            checkboxGrid.innerHTML += `
                <label for="sub_${sub.id}" 
                    class="flex items-start p-3 border border-default-medium rounded-base bg-neutral-secondary-medium/40 hover:bg-neutral-secondary-medium cursor-pointer transition">
                    <input id="sub_${sub.id}" type="checkbox" name="subject_ids[]" value="${sub.id}" ${isChecked}
                        onchange="updateSelectedCount()"
                        class="w-4 h-4 mt-0.5 text-brand border-default-medium rounded-xs focus:ring-2 focus:ring-brand-soft">
                    <div class="ms-3 text-sm">
                        <span class="font-medium text-heading block">${sub.name}</span>
                        <span class="text-xs text-body">${sub.subject_code} • ${sub.medium}</span>
                    </div>
                </label>
            `;
        });

        updateSelectedCount();
    }

    sectionSelect.addEventListener('change', updateTeacherSubjects);
    mediumSelect.addEventListener('change', updateTeacherSubjects);

    window.addEventListener('DOMContentLoaded', updateTeacherSubjects);
</script>
