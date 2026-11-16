@extends('layouts.app')
@section('title', 'dashboard')


@include('partials.navbar')

@include('partials.sidebar')

<main class="p-4 sm:ml-64 pt-20">
    @yield('content')
</main>
