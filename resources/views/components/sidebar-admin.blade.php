<aside class="fixed top-0 left-0 w-64 h-full bg-white border-r p-5 flex flex-col">

    <!-- LOGO -->
    <h1 class="text-xl font-bold text-primary mb-8">MediTech</h1>

    <!-- MENU -->
    <ul class="space-y-2 text-sm flex-1">

        <!-- DASHBOARD -->
        <li>
            <a href="{{ route('dashboard.admin') }}"
               class="flex items-center gap-3 p-3 rounded-xl
               {{ request()->routeIs('dashboard.admin') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
               
                <!-- ICON -->
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard.admin') ? 'text-white' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L2 8h2v8h4v-4h4v4h4V8h2L10 2z"/>
                </svg>

                Dashboard
            </a>
        </li>

        <!-- DATA DOKTER -->
        <li>
            <a href="{{ route('data.dokter') }}"
               class="flex items-center gap-3 p-3 rounded-xl
               {{ request()->routeIs('data.dokter') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
               
                <svg class="w-5 h-5 {{ request()->routeIs('data.dokter') ? 'text-white' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 4h18v4H3V4zm0 6h18v10H3V10zm4 2v6h2v-6H7zm4 0v6h2v-6h-2z"/>
                </svg>

                Data Dokter
            </a>
        </li>

        <!-- DATA PASIEN -->
        <li>
            <a href="#"
               class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-100">
               
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>

                Data Pasien
            </a>
        </li>

        <!-- DATA JADWAL -->
        <li>
            <a href="#"
               class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-100">
               
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1z"/>
                </svg>

                Data Jadwal
            </a>
        </li>

    </ul>

</aside>