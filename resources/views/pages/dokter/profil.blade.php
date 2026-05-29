@extends('layouts.dashboard', [
    'pageTitle' => 'Profil',
    'userName' => 'Dr. Santi Wijaya',
    'userRole' => 'Dokter',
    'userInitial' => 'DS'
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <!-- CARD PROFIL -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <!-- BANNER -->
        <div class="h-28 bg-gradient-to-r from-[#09637E] to-[#0a829e] relative">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 800 120" fill="none">
                    <circle cx="700" cy="20" r="80" fill="white"/>
                    <circle cx="750" cy="100" r="60" fill="white"/>
                    <circle cx="50" cy="100" r="50" fill="white"/>
                </svg>
            </div>
        </div>

        <!-- PROFIL BODY -->
        <div class="px-6 pb-6">
            <div class="flex flex-col sm:flex-row sm:items-end gap-5 -mt-12">

                <!-- FOTO -->
                <div class="relative flex-shrink-0">
                    <div class="w-24 h-24 rounded-2xl bg-white border-4 border-white shadow-md flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                    </div>
                </div>

                <!-- INFO UTAMA -->
                <div class="flex-1 pb-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Dr. Santi Wijaya</h3>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-green-50 text-green-700 rounded-full border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUICK INFO BAR -->
            <div class="mt-5 pt-5 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gray-50 rounded-lg flex items-center justify-center text-sm">📅</div>
                    <div>
                        <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Bergabung</p>
                        <p class="text-sm font-semibold text-gray-800">Januari 2024</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gray-50 rounded-lg flex items-center justify-center text-sm">👥</div>
                    <div>
                        <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Total Pasien</p>
                        <p class="text-sm font-semibold text-gray-800">148</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CARD INFORMASI DOKTER -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2.5">
            <div class="w-8 h-8 bg-[#09637E]/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-gray-800">Informasi Dokter</h3>
        </div>

        <div class="divide-y divide-gray-50">
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-sm">👤</div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400">Nama Lengkap</p>
                    <p class="text-sm font-semibold text-gray-900">Dr. Santi Wijaya</p>
                </div>
            </div>

            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-sm">🩺</div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400">No. STR</p>
                    <p class="text-sm font-semibold text-gray-900">12345678</p>
                </div>
            </div>

            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-sm">📱</div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400">No. Handphone</p>
                    <p class="text-sm font-semibold text-gray-900">081250101875</p>
                </div>
            </div>

            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-sm">📧</div>
                <div class="flex-1 min-w-0">
                     <p class="text-xs text-gray-400">Email</p>
                     <p class="text-sm font-semibold text-gray-900">dr.sarah@meditech.local</p>
                </div>
            </div>

            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-sm">🏥</div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400">Status</p>
                    <span class="inline-flex items-center gap-1.5 mt-0.5 px-2.5 py-1 text-xs font-medium bg-green-50 text-green-700 rounded-full border border-green-100">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                        Aktif
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection