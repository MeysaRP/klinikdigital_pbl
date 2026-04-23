@extends('layouts.dashboard', [
    'pageTitle' => 'Pemesanan Jadwal',
    'userName' => 'Andi Pratama Rayhan',
    'userRole' => 'Pasien',
    'userInitial' => 'AR'
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pemesanan Jadwal</h1>
        <p class="text-gray-500 text-sm mt-1">Silakan lengkapi data berikut untuk membuat janji temu dengan dokter.</p>
    </div>

    <!-- PROGRESS BAR (Opsional, biar keliatan pro) -->
    <div class="flex items-center justify-between mb-8 px-4">
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-[#09637E] text-white flex items-center justify-center text-sm font-bold">1</div>
            <span class="text-xs mt-1 text-[#09637E] font-semibold">Tanggal</span>
        </div>
        <div class="flex-1 h-1 bg-[#09637E] mx-2"></div>
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-[#09637E] text-white flex items-center justify-center text-sm font-bold">2</div>
            <span class="text-xs mt-1 text-[#09637E] font-semibold">Dokter</span>
        </div>
        <div class="flex-1 h-1 bg-[#09637E] mx-2"></div>
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-[#09637E] text-white flex items-center justify-center text-sm font-bold">3</div>
            <span class="text-xs mt-1 text-[#09637E] font-semibold">Sesi</span>
        </div>
        <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold">4</div>
            <span class="text-xs mt-1 text-gray-500">Konfirmasi</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KOLOM KIRI (Tanggal & Dokter) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- 1. PILIH TANGGAL -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    Pilih Tanggal
                </h3>
                <input type="date" value="2025-11-20" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] focus:border-[#09637E]">
            </div>

            <!-- 2. PILIH DOKTER -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    Pilih Dokter
                </h3>
                <div class="space-y-3">
                    <!-- Dokter 1 (Selected) -->
                    <label class="flex items-center p-4 border-2 border-[#09637E] rounded-xl bg-[#09637E]/5 cursor-pointer">
                        <input type="radio" name="dokter" checked class="w-4 h-4 text-[#09637E] focus:ring-[#09637E]">
                        <div class="ml-3 flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-full bg-[#09637E] text-white flex items-center justify-center font-bold text-sm">SW</div>
                            <div>
                                <p class="font-bold text-gray-900">Dr. Sarah Wijaya</p>
                            </div>
                        </div>
                    </label>

                    <!-- Dokter 2 -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer">
                        <input type="radio" name="dokter" class="w-4 h-4 text-[#09637E] focus:ring-[#09637E]">
                        <div class="ml-3 flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-sm">BH</div>
                            <div>
                                <p class="font-bold text-gray-900">Dr. Budi Hartono</p>
                            </div>
                        </div>
                    </label>

                    <!-- Dokter 3 -->
                    <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer">
                        <input type="radio" name="dokter" class="w-4 h-4 text-[#09637E] focus:ring-[#09637E]">
                        <div class="ml-3 flex items-center gap-3 flex-1">
                            <div class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-sm">BH</div>
                            <div>
                                <p class="font-bold text-gray-900">Dr. Mulyono </p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (Sesi & Keluhan) -->
        <div class="space-y-6">

            <!-- 3. PILIH SESI / JAM -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    Pilih Sesi
                </h3>
                <div class="space-y-3">
                    <!-- Sesi 1 -->
                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#09637E]">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="sesi" class="w-4 h-4 text-[#09637E] focus:ring-[#09637E]">
                            <span class="text-sm font-semibold text-gray-800">08:00 - 10:00 WIB</span>
                        </div>
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-bold">Sisa 15/20</span>
                    </label>

                    <!-- Sesi 2 (Selected) -->
                    <label class="flex items-center justify-between p-3 border-2 border-[#09637E] rounded-xl cursor-pointer bg-[#09637E]/5">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="sesi" checked class="w-4 h-4 text-[#09637E] focus:ring-[#09637E]">
                            <span class="text-sm font-semibold text-gray-800">13:00 - 15:00 WIB</span>
                        </div>
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full font-bold">Sisa 5/15</span>
                    </label>

                    <!-- Sesi 3 (Penuh) -->
                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-not-allowed opacity-50 bg-gray-50">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="sesi" disabled class="w-4 h-4">
                            <span class="text-sm font-semibold text-gray-500 line-through">15:00 - 17:00 WIB</span>
                        </div>
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full font-bold">Penuh</span>
                    </label>
                </div>
            </div>

            <!-- 4. CATATAN KELUHAN -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-3">Catatan Keluhan (Opsional)</h3>
                <textarea class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] h-24 resize-none" placeholder="Contoh: Saya mengalami demam tinggi sudah 2 hari..."></textarea>
            </div>

            <!-- TOMBOL KONFIRMASI -->
            <form action="{{ route('pemesanan.proses') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#09637E] hover:bg-[#074d61] text-white font-bold py-3 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    Konfirmasi Pemesanan
                </button>
            </form>

        </div>

    </div>
</div>
@endsection