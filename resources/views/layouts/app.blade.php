<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title', 'LMS')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @fonts

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>

<body class="">
    @php
        $flashAlerts = [
            'success' => [
                'classes' => 'text-green-800 border-green-300 bg-green-50',
                'btn' => 'text-green-600 hover:bg-green-200',
            ],
            'error' => [
                'classes' => 'text-red-800 border-red-300 bg-red-50',
                'btn' => 'text-red-600 hover:bg-red-200',
            ],
            'info' => [
                'classes' => 'text-blue-800 border-blue-300 bg-blue-50',
                'btn' => 'text-blue-600 hover:bg-blue-200',
            ],
            'warning' => [
                'classes' => 'text-yellow-800 border-yellow-300 bg-yellow-50',
                'btn' => 'text-yellow-600 hover:bg-yellow-200',
            ],
        ];
    @endphp


    <div class="fixed top-5 right-5 z-50 w-11/12 md:w-1/3 space-y-3 pointer-events-none">
        @foreach ($flashAlerts as $type => $style)
            @if (session($type))
                <div class="flash-alert pointer-events-auto p-4 text-sm rounded-base border shadow-lg transition-all duration-300 {{ $style['classes'] }}"
                    role="alert">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 shrink-0 mt-2 me-2 text-lg" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{-- <h3 class="font-semibold">{{ $style['title'] }}</h3> --}}
                        </div>

                        <div class="mt-2 text-sm leading-relaxed">
                            {{ session($type) }}
                        </div>

                        <button type="button" onclick="this.closest('.flash-alert').remove()" aria-label="Close"
                            class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 shrink-0 {{ $style['btn'] }}">
                            <span class="sr-only">Close</span>
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                        </button>
                    </div>


                </div>
            @endif
        @endforeach
    </div>




    



    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script>
        setTimeout(() => {
            document.querySelectorAll('.flash-alert').forEach(el => el.remove());
        }, 10000);
    </script>

    {{-- @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif --}}
</body>

</html>
