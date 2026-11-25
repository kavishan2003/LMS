<nav class="fixed top-0 z-50 w-full bg-neutral-primary-soft border-b border-default">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar"
                    aria-controls="top-bar-sidebar" type="button"
                    class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h10" />
                    </svg>
                </button>
                <a href="#" class="flex ms-2 md:me-40">
                    {{-- <img src="{{ asset('images/book.jpg') }}" class="h-8 me-3" alt="FlowBite Logo" /> --}}
                    <i class="fa-solid fa-graduation-cap text-2xl" style="color: rgb(177, 151, 252);"></i>
                    <span class="self-center text-lg text-blue-900 font-semibold md:flex hidden">LEARNMS</span>
                </a>
                @auth

                    <span class="text-green-800 block text-lg font-medium ms-2">
                        Welcome
                        @if (Auth::user()->gender == 'male')
                            Mr.
                        @elseif (Auth::user()->gender == 'female')
                            Mrs.
                        @endif
                        <span class="text-lg text-heading">{{ Auth::user()->name }}</span>
                        {{-- <i class="fa-regular fa-hand text-2xl text-blue-600"></i> --}}


                        {{-- @if (Auth::user()->grade_label)
                            <span class="text-sm ms-10 font-medium text-gray-600">
                               ( {{ Auth::user()->grade_label }} )
                            </span>
                            <span class="text-lg">{{ Auth::user()->role }}</span>
                        @endif --}}
                    </span>
                @endauth
            </div>
            <div class="flex items-center ">
                <i class="fa-solid fa-bell text-xl mx-5"></i>

                <div class="flex items-center ms-3">

                    <div>

                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img src="{{ asset('images/profile/default.png') }}" class="w-8 h-8 rounded-full" src="" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-48"
                        id="dropdown-user">
                        <div class="px-4 py-3 border-b border-default-medium" role="none">
                            <p class="text-sm font-medium text-heading" role="none">
                                @if (Auth::user()->gender == 'male')
                                    Mr.
                                @elseif (Auth::user()->gender == 'female')
                                    Mrs.
                                @endif
                                <span class="text-sm text-heading">{{ Auth::user()->name }}</span>

                            </p>
                            <p class="text-sm text-body truncate" role="none">
                                @if (Auth::user()->grade_label)
                                    <span class="text-sm ms-10 font-medium text-gray-600">
                                        ({{ Auth::user()->grade_label }}    )
                                    </span><br>
                                    <span class="text-sm">{{ Auth::user()->role }}</span>
                                @endif
                            </p>
                        </div>
                        <ul class="p-2 text-sm text-body font-medium" role="none">
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                    role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                    role="menuitem">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                    role="menuitem">Earnings</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                        role="menuitem">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
