@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('title')</h1>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">

        {{-- ඔයාගේ + grid boxes ටික මෙතනට දාන්න --}}
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded bg-gray-100">+</div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-100">+</div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-100">+</div>
        </div>
    </div>
@endsection