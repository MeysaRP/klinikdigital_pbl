<aside id="mainSidebar"
       class="sidebar-transition fixed top-0 left-0 z-50 w-64 h-screen pt-4 bg-white border-r border-gray-200 -translate-x-full md:translate-x-0 md:z-40">

    <div class="overflow-y-auto py-5 px-3 h-full bg-white">
        <!-- HEADER SIDEBAR -->
        <div class="flex items-center justify-between pl-2.5 mb-8">
            <a href="/" class="flex items-center">
                <svg class="w-8 h-8 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v3h-2V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v3H5V5Z"/>
                    <path d="M6 10a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H6Zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"/>
                    <path fill-rule="evenodd" d="M1 6a1 1 0 0 1 1-1h2v12H2a1 1 0 0 1-1-1V6Zm16-1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-2V5h2Z" clip-rule="evenodd"/>
                </svg>
                <span class="self-center text-xl font-bold whitespace-nowrap text-[#09637E] ml-2">MediTech</span>
            </a>
            <button onclick="toggleSidebar()" class="md:hidden w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- MENU -->
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard.admin') }}"
                   class="flex items-center p-3 text-sm font-medium rounded-xl group {{ request()->routeIs('dashboard.admin') ? 'bg-[#09637E] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.admin') ? 'text-white' : 'text-gray-400 group-hover:text-[#09637E]' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('data.dokter') }}"
                   class="flex items-center p-3 text-sm font-medium rounded-xl group {{ request()->routeIs('data.dokter') ? 'bg-[#09637E] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('data.dokter') ? 'text-white' : 'text-gray-400 group-hover:text-[#09637E]' }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 4h18v4H3V4zm0 6h18v10H3V10zm4 2v6h2v-6H7zm4 0v6h2v-6h-2z"/>
                    </svg>
                    Data Dokter
                </a>
            </li>
            <li>
                <a href="{{ route('data.pasien') }}"
                   class="flex items-center p-3 text-sm font-medium rounded-xl group {{ request()->routeIs('data.pasien') ? 'bg-[#09637E] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('data.pasien') ? 'text-white' : 'text-gray-400 group-hover:text-[#09637E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Data Pasien
                </a>
            </li>
            <li>
                <a href="{{ route('data.jadwal') }}"
                   class="flex items-center p-3 text-sm font-medium rounded-xl group {{ request()->routeIs('data.jadwal') ? 'bg-[#09637E] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('data.jadwal') ? 'text-white' : 'text-gray-400 group-hover:text-[#09637E]' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1z"/>
                    </svg>
                    Data Jadwal
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profil') }}"
                   class="flex items-center p-3 text-sm font-medium rounded-xl group {{ request()->routeIs('admin.profil') ? 'bg-[#09637E] text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.profil') ? 'text-white' : 'text-gray-400 group-hover:text-[#09637E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
            </li>
        </ul>
    </div>

    <!-- LOGOUT -->
    <div class="absolute bottom-0 left-0 justify-center p-4 w-full border-t border-gray-200 bg-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full p-3 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>