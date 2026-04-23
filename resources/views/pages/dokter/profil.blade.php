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

    <!-- CARD UTAMA -->
    <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-6">

        <!-- FOTO -->
        <div class="relative">
            <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>
            </div>

            <!-- ICON CAMERA -->
            <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow">
                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 5a2 2 0 012-2h2l1-1h2l1 1h2a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/>
                </svg>
            </div>
        </div>

        <!-- INFO -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Dr. Santi Wijaya</h3>
            <p class="text-sm text-gray-500 mt-1">ID Dokter: D001</p>
            <span class="inline-block mt-2 px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                Aktif
            </span>
        </div>

    </div>

    <!-- INFORMASI -->
    <div class="bg-white rounded-2xl shadow-sm p-6 space-y-5">

        <h3 class="text-sm font-semibold text-gray-700">
            Informasi Dokter
        </h3>

        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                👤
            </div>
            <div>
                <p class="text-xs text-gray-500">Nama Lengkap</p>
                <p class="text-sm font-semibold text-gray-900">Dr. Santi Wijaya</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                🩺
            </div>
            <div>
                <p class="text-xs text-gray-500">No. STR</p>
                <p class="text-sm font-semibold text-gray-900">12345678</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                📱
            </div>
            <div>
                <p class="text-xs text-gray-500">No HP</p>
                <p class="text-sm font-semibold text-gray-900">081250101875</p>
            </div>
        </div>

    </div>

</div>
@endsection