@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('title')</h1>
    {{-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg"> --}}


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
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Date of Birth
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Users as $User)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-{{ $User->id }}" type="checkbox" value="{{ $User->id }}"
                                    class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                                <label for="table-checkbox-{{ $User->id }}" class="sr-only">Table checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $User->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $User->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $User->phone }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $User->gender ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $User->role }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $User->dob ?? 'N/A' }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                            <a href="#" class="font-medium text-danger hover:underline ms-3">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{-- </div> --}}
@endsection
