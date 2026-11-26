@extends('layouts.admin')

@section('title', 'Contact Teachers')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('title')</h1>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="p-4">
                        {{-- <div class="flex items-center">
                            <input id="teachers-checkbox-all" type="checkbox" value=""
                                class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                            <label for="teachers-checkbox-all" class="sr-only">Table checkbox</label>
                        </div> --}}
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 font-medium">
                        Teacher ID
                    </th> --}}
                    <th scope="col" class="px-6 py-3 font-medium">
                        Name & Email
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Gender & DOB
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Qualification
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Section & Subject
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $teacher)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="w-4 p-4">
                            {{-- <div class="flex items-center">
                                <input id="teacher-checkbox-{{ $teacher->id }}" type="checkbox" value="{{ $teacher->id }}"
                                    class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                                <label for="teacher-checkbox-{{ $teacher->id }}" class="sr-only">Table checkbox</label>
                            </div> --}}
                        </td>

                        <!-- Teacher Code -->
                        {{-- <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $teacher->teacher_code ?? 'TCH-' . str_pad($teacher->id, 3, '0', STR_PAD_LEFT) }}
                        </th> --}}

                        <!-- Name & Email (from users table) -->
                        <td class="px-6 py-4">
                            <div class="font-medium text-heading">{{ $teacher->user->name ?? 'N/A' }}</div>
                            <div class="text-xs text-body">{{ $teacher->user->email ?? 'N/A' }}</div>
                        </td>

                        <!-- Phone (from users table) -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $teacher->user->phone ?? 'N/A' }}
                        </td>

                        <!-- Gender & DOB (from users table) -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="capitalize text-heading">{{ $teacher->user->gender ?? 'N/A' }}</div>
                            <div class="text-xs text-body">{{ $teacher->user->dob ?? 'N/A' }}</div>
                        </td>

                        <!-- Qualification (from teachers table) -->
                        <td class="px-6 py-4">
                            {{ $teacher->qualification ?? 'Not Specified' }}
                        </td>

                        <!-- Section & Specialization (from teachers table) -->
                        <td class="px-6 py-4">
                            <span
                                class="text-xs font-semibold px-2 py-0.5 rounded-base bg-neutral-secondary-medium border border-default-medium text-heading">
                                {{ $teacher->section ?? '-' }}
                            </span>
                            <div class="mt-1 font-medium text-heading">
                                {{ $teacher->specialization ?? 'Not Assigned' }}
                            </div>
                        </td>

                        <!-- Action -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="mailto:{{ $teacher->user->email ?? '' }}"
                                class="font-medium text-emerald-900 hover:underline">
                                Contact
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-6 text-center text-body">
                            No teachers registered yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
