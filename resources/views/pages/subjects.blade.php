@extends('layouts.admin')

@section('title', 'Subjects')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('title')</h1>

    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="table-checkbox" type="checkbox" value=""
                                class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                            <label for="table-checkbox" class="sr-only">Table checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Subject Code
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Subject Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Medium
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($OLSubjects as $OLSubject)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-{{ $OLSubject->id }}" type="checkbox" value="{{ $OLSubject->id }}"
                                    class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                                <label for="table-checkbox-{{ $OLSubject->id }}" class="sr-only">Table checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $OLSubject->subject_code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $OLSubject->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $OLSubject->medium }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $OLSubject->category }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                            <a href="#" class="font-medium text-emerald-900 hover:underline ms-3">View more</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-body">
                            No subjects selected yet.
                        </td>
                    </tr>
                @endforelse
                {{-- @foreach ($OLSubjects as $OLSubject)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-{{ $OLSubject->id }}" type="checkbox" value="{{ $OLSubject->id }}"
                                    class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                                <label for="table-checkbox-{{ $OLSubject->id }}" class="sr-only">Table checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $OLSubject->subject_code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $OLSubject->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $OLSubject->medium }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $OLSubject->category }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                            <a href="#" class="font-medium text-danger hover:underline ms-3">Remove</a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>


@endsection
