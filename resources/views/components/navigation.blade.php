<header>
    <nav class="z-40 fixed w-full bg-white border border-b-[#1a9df7] px-4 lg:px-6 py-4">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/img/logo.png') }}" class="w-16 mr-5" alt="Flowbite Logo" />
                {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ config('app.name') }}</span> --}}
            </a>
            <div class="flex items-center lg:order-2">
                @if (Auth::user())
                    <div class="hidden lg:flex">
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#1a9df7] md:p-0 md:w-auto">
                            {{ auth()->user() == null ? '' : auth()->user()->name }}
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li>
                                    @if (Auth::user()->is_rator == true || Auth::user()->is_admin == true)
                                        <a href="/admin"
                                            class="hover:text-white block px-4 py-2 hover:bg-[#1a9df7]">Dashboard</a>
                                    @else
                                        <a href="/user"
                                            class="hover:text-white block px-4 py-2 hover:bg-[#1a9df7]">Dashboard</a>
                                    @endif
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="{{ route('logout') }}"
                                    class="hover:text-white block px-4 py-2 text-sm text-gray-700 hover:bg-[#1a9df7]">Sign
                                    out</a>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/user"
                        class="ml-5 text-white bg-[#1a9df7] hover:bg-[#a80062c5] focus:ring-4 focus:ring-[#a80062c1] font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2">Log
                        In</a>
                @endif
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    @auth
                        <li class="lg:hidden bg-[#1a9df7] border rounded-lg">
                            <span class="block py-2 px-3 text-white md:bg-transparent md:p-0">
                                {{ auth()->user() == null ? '' : auth()->user()->name }}
                            </span>
                        </li>
                        <li class="lg:hidden">
                            <a href="/user" class="block py-2 px-3 hover:text-[#1a9df7] rounded md:bg-transparent md:p-0">
                                Dasbor
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ url('') == url()->current() ? '#home' : url('') . '#home' }}"
                            class="nav-link block py-2 px-3 hover:text-[#1a9df7] md:bg-transparent md:p-0"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ url('') == url()->current() ? '#compe' : url('') . '#compe' }}"
                            class="nav-link block py-2 px-3 hover:text-[#1a9df7] md:bg-transparent md:p-0"
                            aria-current="page"> Kompetisi
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('') == url()->current() ? '#contact' : url('') . '#contact' }}"
                            class="nav-link block py-2 px-3 hover:text-[#1a9df7] md:bg-transparent md:p-0"
                            aria-current="page">
                            Kontak</a>
                    </li>
                    <li>
                        <a href="{{ url('') == url()->current() ? '#about' : url('') . '#about' }}"
                            class="nav-link block py-2 px-3 hover:text-[#1a9df7] md:bg-transparent md:p-0"
                            aria-current="page">
                            Tentang
                        </a>
                    </li>
                    <li class="lg:hidden">
                        <a href="{{ route('logout') }}"
                            class="block py-2 px-3 hover:text-[#1a9df7] rounded md:bg-transparent md:p-0">Sign
                            out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
