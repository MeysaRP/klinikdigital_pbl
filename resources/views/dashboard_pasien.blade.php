@extends('layouts.dashboard_pasien')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">Selamat datang kembali, Andi!</h2>
        <p class="text-gray-500 mt-1">Kelola jadwal pemeriksaan kesehatan Anda di sini.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: JADWAL -->
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- Header Filter -->
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <h3 class="font-bold text-lg text-gray-800">Jadwal Pemeriksaan Saya</h3>
                        <div class="flex gap-2 items-center">
                            <select class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg p-2.5">
                                <option>Semua Status</option>
                                <option>Menunggu</option>
                                <option>Selesai</option>
                            </select>
                            <button class="p-2.5 bg-[#09637E] text-white rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- LIST JADWAL -->
                <div class="divide-y divide-gray-100">

                    <!-- ITEM 1 (Akan Datang - PERBAIKAN TOMBOL) -->
                    <div class="p-5 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <!-- Kiri: Info Utama -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-700">Akan Datang</span>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">Dr. Sarah Wijaya</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-bold text-[#09637E]">22 Mei 2025</span> &bull; 08:00 - 08:30 WIB
                                </p>
                                <p class="text-xs text-gray-500 italic mt-1">Keluhan: Demam tinggi</p>
                            </div>

                            <!-- Kanan: Tombol Aksi (GAYA OUTLINE AGAR KELIHATAN) -->
                            <div class="flex-shrink-0">
                                <button class="w-full md:w-auto px-5 py-2 text-sm font-bold text-[#09637E] bg-white border-2 border-[#09637E] rounded-lg hover:bg-[#09637E] hover:text-white shadow-sm transition-all">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ITEM 2 (Menunggu) -->
                    <div class="p-5 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-700">Menunggu Antrian</span>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">Dr. Budi Hartono</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-bold text-[#09637E]">29 Oktober 2025</span> &bull; 10:00 - 10:30 WIB
                                </p>
                                <p class="text-xs text-gray-500 italic mt-1">Keluhan: Sakit kepala</p>
                            </div>

                            <!-- Kanan: Tombol Batalkan -->
                            <div class="flex-shrink-0">
                                <button class="w-full md:w-auto px-5 py-2 text-sm font-bold text-red-600 bg-white border-2 border-red-300 rounded-lg hover:bg-red-50 transition-colors">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ITEM 3 (Selesai) -->
                    <div class="p-5 bg-gray-50 opacity-60">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-gray-200 text-gray-600">Selesai</span>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">Dr. Andi Setiawan</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-semibold text-gray-700">15 Januari 2024</span> &bull; 14:00 - 14:30 WIB
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <button class="text-sm text-[#09637E] font-semibold hover:underline">
                                    Lihat Rekam Medis
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT: PROFIL -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">

                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-[#09637E] flex items-center justify-center text-white text-3xl font-bold shadow-lg border-4 border-white mb-4">
                        AR
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Andi Pratama Rayhan</h3>
                    <p class="text-sm text-gray-500">Pasien Aktif</p>
                </div>

                <!-- Data Profil (Alamat Sejajar) -->
                <div class="text-sm space-y-3 text-gray-600 border-t border-gray-100 pt-6">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-500">Nama</span>
                        <span class="text-gray-900 font-semibold">Andi Pratama Rayhan</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-500">Tanggal Lahir</span>
                        <span class="text-gray-900 font-semibold">15 Maret 2001</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-500">Umur</span>
                        <span class="text-gray-900 font-semibold">23 Tahun</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-500">Jenis Kelamin</span>
                        <span class="text-gray-900 font-semibold">Laki-laki</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-500">No. HP</span>
                        <span class="text-gray-900 font-semibold">0812-3456-7890</span>
                    </div>
                    <!-- Alamat Sejajar (Samping) -->
                    <div class="flex justify-between items-start">
                        <span class="font-medium text-gray-500">Alamat</span>
                        <span class="text-gray-900 font-semibold text-right ml-2">Pekanbaru, Riau</span>
                    </div>
                </div>

                <button class="mt-6 w-full bg-white border-2 border-[#09637E] text-[#09637E] hover:bg-[#09637E] hover:text-white font-semibold py-2.5 rounded-xl transition-colors shadow-sm">
                    Ubah Profil
                </button>

            </div>
        </div>

    </div>
</div>

@endsection