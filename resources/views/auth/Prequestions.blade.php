@extends('layouts.app')

@section('title', 'Login')


<div class="max-w-7xl  rounded-base  mx-auto p-6 mt-5">
    <h1 class=" text-4xl mx-10 text-center my-5 ">Choose section</h1>
    <h1 class=" text-2xl mx-10 text-center my-5 ">What is your section Are you a ?</h1>

    <div class=" flex max-w-5xl gap-5 items-center justify-around  rounded-base  mx-auto px-6 mt-10">

        <div class="w-full max-w-sm p-6 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
            <h5 class="mb-4 text-xl font-medium text-body">G.C.E</h5>
            <div class="flex items-baseline text-heading">
                <span class="text-5xl font-extrabold tracking-tight">O/L</span>
                <span class="ms-2 font-medium text-body">Student</span>
            </div>
            <ul role="list" class="space-y-4 my-6">
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">2 team members</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">20GB Cloud storage</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">Integration help</span>
                </li>

                <li class="flex items-center decoration-body">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">24×7 phone & email support</span>
                </li>
            </ul>
            <a href="{{ route('OLform') }}" class="">
                <button type="button"
                    class="w-full text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                    Choose section</button>
            </a>
        </div>
        <div class="w-full max-w-sm p-6 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
            <h5 class="mb-4 text-xl font-medium text-body">G.C.E</h5>
            <div class="flex items-baseline text-heading">
                <span class="text-5xl font-extrabold tracking-tight">A/L</span>
                <span class="ms-2 font-medium text-body">Student</span>
            </div>
            <ul role="list" class="space-y-4 my-6">
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">2 team members</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">20GB Cloud storage</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">Integration help</span>
                </li>

                <li class="flex items-center  decoration-body">
                    <svg class="w-5 h-5 shrink-0 text-fg-brand me-1.5" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-body">24×7 phone & email support</span>
                </li>
            </ul>
            <a href="{{ route('ALform.index') }}">
                <button type="button"
                    class="w-full text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                    Choose section
                </button>
            </a>
        </div>
    </div>

</div>
