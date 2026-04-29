<nav class="bg-white border-b border-gray-200 fixed w-full z-20 top-0 start-0 shadow-sm">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3 sm:p-4">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3">
            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z" />
                <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                <path fill-rule="evenodd"
                    d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z"
                    clip-rule="evenodd" />
            </svg>
            <span class="self-center text-xl sm:text-2xl font-bold whitespace-nowrap text-[#09637E]">MediTech</span>
        </a>

        <!-- HAMBURGER MOBILE -->
        <button onclick="toggleMobileMenu()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 transition">
            <svg id="menuIconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="menuIconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- MENU DESKTOP -->
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

        <!-- TOMBOL AUTH DESKTOP -->
        <div class="hidden md:flex md:order-2 space-x-3">
            <a href="{{ route('login') }}"
                class="flex items-center px-5 py-2.5 text-sm font-semibold text-[#09637E] border border-[#09637E] rounded-full hover:bg-[#09637E] hover:text-white transition-all duration-300">
                Masuk
            </a>
            <a href="{{ route('registrasi') }}"
                class="flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-[#09637E] rounded-full hover:bg-[#074d61] shadow-md transition-all duration-300">
                Daftar
            </a>
        </div>
    </div>

    <!-- MENU MOBILE (dropdown) -->
    <div id="mobileMenu" class="md:hidden hidden border-t border-gray-100 bg-white">
        <ul class="flex flex-col p-4 space-y-1">
            <li>
                <a href="{{ route('home') }}"
                    class="block py-2.5 px-4 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'text-white bg-[#09637E]' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('layanan') }}"
                    class="block py-2.5 px-4 rounded-lg text-sm font-medium {{ request()->routeIs('layanan') ? 'text-white bg-[#09637E]' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                    Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}"
                    class="block py-2.5 px-4 rounded-lg text-sm font-medium {{ request()->routeIs('about') ? 'text-white bg-[#09637E]' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                    Tentang Kami
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}"
                    class="block py-2.5 px-4 rounded-lg text-sm font-medium {{ request()->routeIs('contact') ? 'text-white bg-[#09637E]' : 'text-gray-700 hover:bg-gray-100 hover:text-[#09637E]' }}">
                    Kontak
                </a>
            </li>
        </ul>
        <div class="flex gap-3 px-4 pb-4">
            <a href="{{ route('login') }}"
                class="flex-1 text-center px-4 py-2.5 text-sm font-semibold text-[#09637E] border border-[#09637E] rounded-full hover:bg-[#09637E] hover:text-white transition">
                Masuk
            </a>
            <a href="{{ route('registrasi') }}"
                class="flex-1 text-center px-4 py-2.5 text-sm font-semibold text-white bg-[#09637E] rounded-full hover:bg-[#074d61] transition">
                Daftar
            </a>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const iconOpen = document.getElementById('menuIconOpen');
    const iconClose = document.getElementById('menuIconClose');

    menu.classList.toggle('hidden');
    iconOpen.classList.toggle('hidden');
    iconClose.classList.toggle('hidden');
}
</script>