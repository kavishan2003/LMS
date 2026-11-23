{{-- <div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div> --}}

@extends('layouts.app')

@section('title', 'Login')

<div class="max-w-5xl border border-default rounded-base shadow-xs mx-auto px-6 py-8 mt-10">

    <!-- Header -->
    <div class="mb-6 border-b border-default-medium pb-4">
        <h2 class="text-2xl font-bold text-heading">Select Your Subjects</h2>
        <p class="mt-1 text-sm text-body">
            Choose your grade and medium to view your compulsory main subjects and select your optional subjects.
        </p>
    </div>

    <form method="POST" action="{{ route('OLform.create') }}">
        @csrf

        <!-- Step 1: Grade & Medium Selection -->
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <!-- Grade -->
            <div>
                <label for="grade" class="block mb-2 text-sm font-medium text-heading">Select Grade</label>
                <select name="grade" id="grade" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" disabled {{ old('grade') ? '' : 'selected' }}>Choose grade (6 - 11)</option>
                    <option value="6" {{ old('grade') == '6' ? 'selected' : '' }}>Grade 6</option>
                    <option value="7" {{ old('grade') == '7' ? 'selected' : '' }}>Grade 7</option>
                    <option value="8" {{ old('grade') == '8' ? 'selected' : '' }}>Grade 8</option>
                    <option value="9" {{ old('grade') == '9' ? 'selected' : '' }}>Grade 9</option>
                    <option value="10" {{ old('grade') == '10' ? 'selected' : '' }}>Grade 10 (O/L)</option>
                    <option value="11" {{ old('grade') == '11' ? 'selected' : '' }}>Grade 11 (O/L)</option>
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
        </div>

        <!-- Step 2: Auto Main Subjects Table + Religion + O/L Basket Subjects -->
        <div id="subjects_container" class="hidden">

            <!-- Compulsory Main Subjects Table -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium text-heading">
                        Compulsory Main Subjects (Auto-Assigned)
                    </label>
                    <span id="subject_count_badge"
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
                        <tbody id="main_subjects_tbody" class="divide-y divide-default-medium">
                            <!-- JS  auto fill -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Religion Selection (Grade 6-11 all) -->
            <div class="mb-6">
                <label for="religion_id" class="block mb-2 text-sm font-medium text-heading">Select Religion
                    Subject</label>
                <select name="religion_id" id="religion_id" required
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="" selected disabled>Choose religion</option>
                </select>
                @error('religion_id')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Basket Subjects (only grade 10/11) -->
            <div id="basket_section" class="hidden mb-6 pt-4 border-t border-default-medium">
                <h3 class="text-sm font-semibold text-heading mb-1">O/L Basket Subjects (Select 3 Subjects)</h3>
                <p class="text-xs text-body mb-4">Choose one subject from each basket category.</p>

                <div class="grid gap-6 md:grid-cols-3">
                    <!-- Basket 1 -->
                    <div>
                        <label for="basket_1" class="block mb-2 text-sm font-medium text-heading">Basket Subject
                            1</label>
                        <select name="basket_subjects[]" id="basket_1"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Basket 1</option>
                        </select>
                    </div>

                    <!-- Basket 2 -->
                    <div>
                        <label for="basket_2" class="block mb-2 text-sm font-medium text-heading">Basket Subject
                            2</label>
                        <select name="basket_subjects[]" id="basket_2"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Basket 2</option>
                        </select>
                    </div>

                    <!-- Basket 3 -->
                    <div>
                        <label for="basket_3" class="block mb-2 text-sm font-medium text-heading">Basket Subject
                            3</label>
                        <select name="basket_subjects[]" id="basket_3"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="" selected disabled>Select Basket 3</option>
                        </select>
                    </div>
                </div>

                @error('basket_subjects')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('basket_subjects.*')
                    <p class="mt-1.5 text-sm text-red-600">Please select 3 distinct basket subjects.</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-10 py-2.5 focus:outline-none">
                    Save Subjects
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const allOlSubjects = @json($olsubjects);

    const gradeSelect = document.getElementById('grade');
    const mediumSelect = document.getElementById('medium');
    const subjectsContainer = document.getElementById('subjects_container');
    const mainSubjectsTbody = document.getElementById('main_subjects_tbody');
    const subjectCountBadge = document.getElementById('subject_count_badge');
    const religionSelect = document.getElementById('religion_id');
    const basketSection = document.getElementById('basket_section');
    const basketSelects = [
        document.getElementById('basket_1'),
        document.getElementById('basket_2'),
        document.getElementById('basket_3')
    ];

    function updateSubjectsUI() {
        const grade = parseInt(gradeSelect.value);
        const medium = mediumSelect.value;

        if (!grade || !medium) {
            subjectsContainer.classList.add('hidden');
            return;
        }

        subjectsContainer.classList.remove('hidden');

        // 1. Main Subjects Table auto-populate 
        const mainSubjects = allOlSubjects.filter(sub =>
            sub.medium === medium && sub.category === 'Main'
        );

        subjectCountBadge.textContent = `${mainSubjects.length} Subjects`;
        mainSubjectsTbody.innerHTML = '';

        mainSubjects.forEach((sub, index) => {
            mainSubjectsTbody.innerHTML += `
                <tr class="hover:bg-neutral-secondary-medium/40">
                    <td class="px-4 py-3 font-medium text-heading">${index + 1}</td>
                    <td class="px-4 py-3">${sub.subject_code}</td>
                    <td class="px-4 py-3 font-medium text-heading">${sub.name}</td>
                    <td class="px-4 py-3">${sub.medium}</td>
                </tr>
            `;
        });

        // 2. Religion Dropdown (Grade 6-11 )
        const religionSubjects = allOlSubjects.filter(sub =>
            sub.medium === medium && sub.category === 'Religion'
        );

        religionSelect.innerHTML = '<option value="" selected disabled>Choose religion</option>';
        religionSubjects.forEach(sub => {
            religionSelect.innerHTML += `<option value="${sub.id}">${sub.name} (${sub.medium})</option>`;
        });

        // 3. Grade 10 / 11 (O/L)  Basket Subjects 3 
        if (grade === 10 || grade === 11) {
            basketSection.classList.remove('hidden');

            const basket1 = allOlSubjects.filter(s => s.medium === medium && (s.category === 'Basket 1' || s
                .category === 'Basket'));
            const basket2 = allOlSubjects.filter(s => s.medium === medium && (s.category === 'Aesthetic' || s
                .category === 'Basket'));
            const basket3 = allOlSubjects.filter(s => s.medium === medium && (s.category === 'Basket 3' || s
                .category === 'Basket'));

            const lists = [basket1, basket2, basket3];

            basketSelects.forEach((selectEl, idx) => {
                selectEl.required = true;
                selectEl.innerHTML = `<option value="" selected disabled>Select Basket ${idx + 1}</option>`;
                lists[idx].forEach(sub => {
                    selectEl.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                });
            });
        } else {
            // Grade 6 - 9  Basket section  hide 
            basketSection.classList.add('hidden');
            basketSelects.forEach(selectEl => {
                selectEl.required = false;
                selectEl.value = '';
            });
        }
    }

    gradeSelect.addEventListener('change', updateSubjectsUI);
    mediumSelect.addEventListener('change', updateSubjectsUI);

    window.addEventListener('DOMContentLoaded', updateSubjectsUI);
</script>
