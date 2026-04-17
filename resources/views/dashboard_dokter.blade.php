@extends('layouts.dashboard_dokter')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            Selamat datang, Dr. Sarah Wijaya
        </h2>
        <p class="text-gray-500 mt-1">
            Kelola jadwal praktik dan pasien Anda hari ini
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: JADWAL -->
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- HEADER -->
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-lg text-gray-800">
                        Jadwal Praktik Hari Ini
                    </h3>
                </div>

                <!-- LIST -->
                <div class="divide-y divide-gray-100">

                    <!-- ITEM -->
                    <div class="p-5 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">09:00</p>
                                <h4 class="font-bold text-gray-900">Budi Santoso</h4>
                                <p class="text-xs text-gray-500">Demam & Batuk</p>
                            </div>

                            <div class="text-right">
                                <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-700">
                                    Selesai
                                </span>
                                <div class="mt-2">
                                    <button class="text-sm text-[#09637E] font-semibold hover:underline">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ITEM -->
                    <div class="p-5 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">10:30</p>
                                <h4 class="font-bold text-gray-900">Ani Lestari</h4>
                                <p class="text-xs text-gray-500">Sakit Kepala</p>
                            </div>

                            <div class="text-right">
                                <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-700">
                                    Berlangsung
                                </span>
                                <div class="mt-2">
                                    <button class="text-sm text-[#09637E] font-semibold hover:underline">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ITEM -->
                    <div class="p-5 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">13:00</p>
                                <h4 class="font-bold text-gray-900">Citra Dewi</h4>
                                <p class="text-xs text-gray-500">Nyeri Perut</p>
                            </div>

                            <div class="text-right">
                                <span class="px-2 py-1 text-xs font-bold rounded bg-gray-200 text-gray-600">
                                    Menunggu
                                </span>
                                <div class="mt-2">
                                </div>
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
                        DS
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Dr. Sarah Wijaya</h3>
                    <p class="text-sm text-gray-500">Dokter</p>
                </div>

                <div class="text-sm space-y-3 text-gray-600 border-t border-gray-100 pt-6">
                    <div class="flex justify-between">
                        <span>No. SIP</span>
                        <span class="font-semibold text-gray-900">SIP123456</span>
                    </div>
                    <div class="flex justify-between">
                        <span>No. HP</span>
                        <span class="font-semibold text-gray-900">081234567890</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Alamat</span>
                        <span class="font-semibold text-gray-900">Batam</span>
                    </div>
                </div>

                <button class="mt-6 w-full bg-[#09637E] text-white py-2.5 rounded-xl hover:bg-[#074d61] transition">
                    Ubah Profil
                </button>

            </div>
        </div>

    </div>

</div>

@endsection