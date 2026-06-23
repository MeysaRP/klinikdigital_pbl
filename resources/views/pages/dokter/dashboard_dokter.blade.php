@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Dokter',
    'userName'  => 'dr. ' . (session('name') ?? 'Dokter'),
    'userRole'  => 'Dokter',
    'userInitial' => strtoupper(substr(session('name') ?? 'D', 0, 1))
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <!-- WELCOME BANNER -->
    <div class="relative bg-gradient-to-br from-[#09637E] to-[#074f63] rounded-2xl p-6 text-white overflow-hidden">
        <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/5 rounded-full"></div>
        <div class="absolute -right-4 bottom-0 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="absolute left-1/2 -bottom-6 w-32 h-32 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm text-white/70">{{ now()->format('l, d F Y') }}</p>
            </div>
            
            <h1 class="text-lg font-bold">Selamat datang, dr. {{ session('name') ?? 'Dokter' }}</h1>
            <p class="text-sm text-white/60 mt-1">Semangat menjalani praktek hari ini!</p>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        
        <!-- CARD PASIEN MENUNGGU -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs text-gray-400 font-medium">Pasien Menunggu</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $menungguCount }}</p>
                    <div class="mt-3 flex items-center gap-2">
                        <span class="text-xs text-gray-400">dari {{ $menungguCount + $selesaiCount }} total antrian</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center ml-4">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- CARD SELESAI HARI INI -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs text-gray-400 font-medium">Selesai hari ini</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $selesaiCount }}</p>
                    <div class="mt-3">
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ $persen }}% dari kuota {{ $kuotaHariIni }} pasien</p>
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center ml-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- ANTRIAN SELANJUTNYA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
            <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">Antrian Selanjutnya</h3>
        </div>

        <div class="p-6">
            @if($antrianSelanjutnya)
            <div class="flex flex-col sm:flex-row gap-5">
                <div class="flex-1 space-y-3.5">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#09637E]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">No. antrian</p>
                            <p class="text-lg font-bold text-gray-900 -mt-0.5">{{ $antrianSelanjutnya->nomor_antrian }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#09637E]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Nama</p>
                            <p class="text-sm font-semibold text-gray-800 -mt-0.5">{{ $antrianSelanjutnya->pemesanan->nama_pasien ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#09637E]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Keluhan</p>
                            <p class="text-sm font-semibold text-gray-800 -mt-0.5">{{ $antrianSelanjutnya->pemesanan->keluhan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex sm:flex-col items-center sm:items-end justify-center sm:justify-center sm:pt-2">
                    <a href="{{ route('dokter.antrian') }}" class="w-full sm:w-auto bg-[#09637E] hover:bg-[#074d61] text-white px-6 py-3 rounded-xl text-sm font-semibold transition inline-flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Mulai Periksa
                    </a>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm text-gray-400 font-medium">Tidak ada antrian menunggu saat ini.</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection