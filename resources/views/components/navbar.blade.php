<nav class="bg-white border-b border-gray-200 fixed w-full z-20 top-0 start-0 shadow-sm">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                <path fill-rule="evenodd"
                    d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                    clip-rule="evenodd" />
            </svg>
            <span class="self-center text-2xl font-bold whitespace-nowrap text-[#09637E]">MediTech</span>
        </a>

        <!-- MENU -->
        <div class="items-center hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-xl bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 rounded-lg text-sm {{ request()->routeIs('home') ? 'text-white bg-[#09637E] font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('layanan') }}"
                        class="block py-2 px-3 rounded-lg text-sm {{ request()->routeIs('layanan') ? 'text-white bg-[#09637E] font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                        Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                        class="block py-2 px-3 rounded-lg text-sm {{ request()->routeIs('about') ? 'text-white bg-[#09637E] font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="block py-2 px-3 rounded-lg text-sm {{ request()->routeIs('contact') ? 'text-white bg-[#09637E] font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- TOMBOL AUTH -->
        <div class="flex md:order-2 space-x-3">
            <a href="{{ route('login') }}"
                class="hidden md:flex items-center px-5 py-2.5 text-sm font-semibold text-[#09637E] border border-[#09637E] rounded-full hover:bg-[#09637E] hover:text-white transition-all duration-300">
                Login
            </a>
            <a href="{{ route('registrasi') }}"
                class="flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-[#09637E] rounded-full hover:bg-[#074d61] shadow-md transition-all duration-300">
                Registrasi
            </a>
        </div>
    </div>
</nav>