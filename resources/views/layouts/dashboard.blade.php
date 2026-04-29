<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - MediTech' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #09637E; border-radius: 3px; }

        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- OVERLAY -->
    <div id="sidebarOverlay"
         class="sidebar-overlay fixed inset-0 bg-black/50 z-40 opacity-0 pointer-events-none md:hidden"
         onclick="toggleSidebar()">
    </div>

    @yield('sidebar')

    <!-- INI YANG DIPERBAIKI: min-w-0 -->
    <div class="flex flex-col flex-1 md:ml-64 sidebar-transition min-w-0">

        <!-- TOPBAR: min-w-0 -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 min-w-0">
            <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()"
                            class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-gray-100 text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 truncate">{{ $pageTitle ?? 'Dashboard' }}</h2>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ $userName ?? 'User' }}</p>
                        <p class="text-xs text-gray-500">{{ $userRole ?? 'Role' }}</p>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#09637E] flex items-center justify-center text-white font-bold shadow-md border-2 border-white text-sm sm:text-base">
                        {{ $userInitial ?? 'U' }}
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN: overflow-auto + min-w-0 -->
        <main class="flex-1 p-4 sm:p-6 bg-gray-50 overflow-auto min-w-0">
            @yield('content')
        </main>

        <!-- FOOTER: min-w-0 -->
        <footer class="bg-[#09637E] p-3 sm:p-4 text-center min-w-0">
            <span class="text-[10px] sm:text-xs text-white/70">© 2026 Politeknik Negeri Batam - Projek PBL IFpagi2A-02</span>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('-translate-x-full');
    sidebar.classList.toggle('translate-x-0');
    overlay.classList.toggle('opacity-0');
    overlay.classList.toggle('pointer-events-none');
    overlay.classList.toggle('opacity-100');
    overlay.classList.toggle('pointer-events-auto');
    document.body.classList.toggle('overflow-hidden');
}
</script>
</body>
</html>