@extends('layouts.dashboard')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-green-900">
            Selamat datang, Admin!
        </h2>
        <p class="text-sm text-gray-600">
            Kelola data dokter dan pasien
        </p>
    </div>

    <!-- CARD SUMMARY -->
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded-xl shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Dokter</p>
                <h3 class="text-2xl font-bold">45</h3>
                <span class="text-xs text-gray-400">5 dari bulan lalu</span>
            </div>
            <div class="text-3xl">🩺</div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pasien</p>
                <h3 class="text-2xl font-bold">1.205</h3>
                <span class="text-xs text-gray-400">15 dari bulan lalu</span>
            </div>
            <div class="text-3xl">👥</div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Jadwal Hari Ini</p>
                <h3 class="text-2xl font-bold">85</h3>
                <span class="text-xs text-gray-400">8 dari kemarin</span>
            </div>
            <div class="text-3xl">📅</div>
        </div>

    </div>

    <!-- DATA SECTION -->
    <div class="grid grid-cols-3 gap-6">

        <!-- DATA DOKTER -->
        <div class="bg-white p-5 rounded-xl shadow">
            <div class="flex justify-between mb-4">
                <h3 class="font-semibold">Data Dokter</h3>
                <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                    + Tambah
                </button>
            </div>

            <input type="text" placeholder="Cari dokter..."
                class="w-full border rounded p-2 text-sm mb-3">

            <ul class="text-sm space-y-2">
                <li class="flex justify-between border-b pb-1">
                    <span>Dr. Sarah</span>
                    <span class="text-gray-400">Penyakit Dalam</span>
                </li>
                <li class="flex justify-between border-b pb-1">
                    <span>Dr. Budi</span>
                    <span class="text-gray-400">Jantung</span>
                </li>
                <li class="flex justify-between">
                    <span>Dr. Ani</span>
                    <span class="text-gray-400">Lambung</span>
                </li>
            </ul>

            <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                Lihat semua →
            </p>
        </div>

        <!-- DATA PASIEN -->
        <div class="bg-white p-5 rounded-xl shadow">
            <div class="flex justify-between mb-4">
                <h3 class="font-semibold">Data Pasien</h3>
                <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                    + Tambah
                </button>
            </div>

            <input type="text" placeholder="Cari pasien..."
                class="w-full border rounded p-2 text-sm mb-3">

            <ul class="text-sm space-y-2">
                <li class="flex justify-between border-b pb-1">
                    <span>Budi Santoso</span>
                    <span class="text-gray-400">Laki-laki</span>
                </li>
                <li class="flex justify-between border-b pb-1">
                    <span>Ani Lestari</span>
                    <span class="text-gray-400">Perempuan</span>
                </li>
                <li class="flex justify-between">
                    <span>Citra Dewi</span>
                    <span class="text-gray-400">Perempuan</span>
                </li>
            </ul>

            <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                Lihat semua →
            </p>
        </div>

        <!-- DATA JADWAL -->
        <div class="bg-white p-5 rounded-xl shadow">
            <div class="flex justify-between mb-4">
                <h3 class="font-semibold">Data Jadwal</h3>
                <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                    + Tambah
                </button>
            </div>

            <input type="text" placeholder="Cari jadwal..."
                class="w-full border rounded p-2 text-sm mb-3">

            <ul class="text-sm space-y-2">
                <li class="flex justify-between border-b pb-1">
                    <span>Dr. Sarah</span>
                    <span class="text-gray-400">09:00</span>
                </li>
                <li class="flex justify-between border-b pb-1">
                    <span>Dr. Budi</span>
                    <span class="text-gray-400">10:00</span>
                </li>
                <li class="flex justify-between">
                    <span>Dr. Ani</span>
                    <span class="text-gray-400">11:00</span>
                </li>
            </ul>

            <p class="text-right text-sm mt-3 text-green-600 cursor-pointer">
                Lihat semua →
            </p>
        </div>

    </div>

    <!-- AKTIVITAS -->
    <div class="bg-white p-5 rounded-xl shadow">
        <h3 class="font-semibold mb-4">Aktivitas Terbaru</h3>

        <div class="grid grid-cols-4 gap-4 text-sm">

            <div class="bg-green-50 p-3 rounded">
                Pasien baru mendaftar <br>
                <span class="text-gray-400">22 Mei 2024</span>
            </div>

            <div class="bg-green-50 p-3 rounded">
                Jadwal baru ditambahkan <br>
                <span class="text-gray-400">21 Mei 2024</span>
            </div>

            <div class="bg-green-50 p-3 rounded">
                Jadwal baru dibuat <br>
                <span class="text-gray-400">21 Mei 2024</span>
            </div>

            <div class="bg-green-50 p-3 rounded">
                Laporan dibuat <br>
                <span class="text-gray-400">20 Mei 2024</span>
            </div>

        </div>
    </div>

</div>
@endsection