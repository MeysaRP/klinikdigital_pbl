@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Dokter',
    'userName' => 'Dr. Sarah Wijaya',
    'userRole' => 'Dokter',
    'userInitial' => 'DS'
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Selamat datang, dr. Sarah Wijaya
            </h2>
            <p class="text-sm text-gray-500">Kamis, 24 November 2025</p>
        </div>
    </div>

    <!-- CARD STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- PASIEN MENUNGGU -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Pasien Menunggu</p>
            <h3 class="text-3xl font-bold text-gray-800">5</h3>
        </div>

        <!-- SELESAI -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Selesai hari ini</p>
            <h3 class="text-3xl font-bold text-gray-800">10</h3>
        </div>

    </div>

    <!-- ANTRIAN -->
    <div class="bg-white p-6 rounded-xl border border-gray-200">

        <h3 class="text-sm font-semibold text-gray-600 mb-4">
            ANTRIAN SELANJUTNYA
        </h3>

        <div class="border border-gray-300 rounded-lg p-4">
            <p class="text-sm text-gray-600">No. antrian: <span class="font-semibold">06</span></p>
            <p class="text-sm text-gray-600">Nama: <span class="font-semibold">Budi Santoso</span></p>
            <p class="text-sm text-gray-600 mb-3">Keluhan: <span class="font-semibold">Sakit Kepala</span></p>

            <button class="bg-gray-200 px-4 py-1.5 text-sm rounded hover:bg-gray-300">
                Mulai Periksa
            </button>
        </div>

    </div>

</div>
@endsection