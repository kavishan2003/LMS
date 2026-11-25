@extends('layouts.admin')

@section('title', 'Profile')

@section('content')



    <div id="accordion-open" data-accordion="open" class="rounded-base border mb-5 border-default overflow-hidden shadow-xs">
        <h2 id="accordion-open-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body rounded-t-base border border-t-0 border-x-0 border-b-default hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">

                <span class="flex items-center text-2xl font-light"><svg class="w-5 h-5 me-2 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>{{ $subject->name }} (Grade {{ $studentGrade }})</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-1" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default"
            aria-labelledby="accordion-open-heading-1">
            <div class="p-6 ">

                <!-- 2. Subject Banner Image (Subject code prefix auto change) -->
                @php
                    // separate OL01 from the course code 
                    $codePrefix = explode('-', $subject->subject_code)[0];
                    $imagePath = "images/subjects/{$codePrefix}.jpg";
                    // when images are not there
                    $finalImage = file_exists(public_path($imagePath))
                        ? asset($imagePath)
                        : asset('images/subjects/default.jpg');
                @endphp

                <div class="mb-6 overflow-hidden rounded-lg shadow-sm border border-gray-200">
                    <img src="{{ $finalImage }}" alt="{{ $subject->name }}" class="w-full h-48 sm:h-64 object-cover">
                </div>
                <!-- Subject Header -->
                <div class="mb-6">
                    <h1 class="text-xl text-blue-400">Hello and welcome to the course!</h1>
                    <span class="text-sm font-semibold text-emerald-700">{{ $subject->subject_code }} •
                        {{ $subject->medium }}
                        Medium</span>
                    {{-- <h1 class="text-2xl font-bold text-gray-900">{{ $subject->name }} (Grade {{ $studentGrade }})</h1>  --}}
                    <p class="text-sm text-gray-500">Category:{{ $subject->category }} </p>
                </div>

                <!-- Course Content / Lessons Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Course Materials & Lessons</h2>

                    <p class="text-gray-600">No course content uploaded for {{ $subject->name }} yet.</p>
                </div>
            </div>
        </div>
        <h2 id="accordion-open-heading-2">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body border border-x-0 border-b-default border-t-0 hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
                <span class="flex items-center text-2xl font-light"><svg class="w-5 h-5 me-2 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>Course Content & Activities</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-2" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default"
            aria-labelledby="accordion-open-heading-2">
            <div class="p-4 md:p-5">
                <p class="mb-2 text-body">Flowbite is first conceptualized and designed using the Figma software so
                    everything you see in the library has a design equivalent in our Figma file.</p>
                <p class="text-body">Check out the <a href="https://flowbite.com/figma/"
                        class="text-fg-brand hover:underline">Figma design system</a> based on the utility classes from
                    Tailwind CSS and components from Flowbite.</p>
            </div>
        </div>
        <h2 id="accordion-open-heading-3">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
                <span class="flex items-center text-2xl font-light"><svg class="w-5 h-5 me-2 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg> Past Papers and Model Papers</span>
                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m5 15 7-7 7 7" />
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
            <div class="p-4 md:p-5 border border-t-default border-b-0 border-x-0">
                <p class="mb-2 text-body">The main difference is that the core components from Flowbite are open source
                    under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies
                    on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
                <p class="mb-2 text-body">However, we actually recommend using both Flowbite, Flowbite Pro, and even
                    Tailwind UI as there is no technical reason stopping you from using the best of two worlds.</p>
                <p class="mb-2 text-body">Learn more about these technologies:</p>
                <ul class="ps-5 text-body list-disc">
                    <li><a href="https://flowbite.com/pro/" class="text-fg-brand hover:underline">Flowbite Pro</a></li>
                    <li><a href="https://tailwindui.com/" rel="nofollow" class="text-fg-brand hover:underline">Tailwind
                            UI</a></li>
                </ul>
            </div>
        </div>
    </div>




@endsection
