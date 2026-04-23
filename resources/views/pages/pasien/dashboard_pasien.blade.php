@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Pasien',
    'userName' => 'Andi Pratama Rayhan',
    'userRole' => 'Pasien',
    'userInitial' => 'AR'
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="space-y-6">

    {{-- HERO CARD (ANTRIAN AKTIF) --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#09637E]/10 rounded-full -mr-10 -mt-10"></div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Janji Temu Berikutnya</p>
                <h2 class="text-xl font-bold text-gray-800">Dr. Sarah Wijaya (Dokter Umum)</h2>
                <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                    <span class="flex items-center gap-1 font-semibold text-[#09637E]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        Senin, 22 Mei 2025
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                        08:00 - 08:30 WIB
                    </span>
                </div>
                <p class="mt-2 text-xs text-gray-500 bg-gray-50 px-3 py-1 rounded-full inline-block">Keluhan: Demam tinggi dan sesak napas</p>
            </div>
            <div class="mt-4 md:mt-0 text-center bg-[#09637E] rounded-xl p-4 text-white min-w-[140px]">
                <p class="text-xs uppercase tracking-wider font-medium opacity-80">No. Antrian</p>
                <p class="text-5xl font-bold mt-1">05</p>
                <span class="px-2 py-0.5 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full mt-2 inline-block">Menunggu</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- LEFT COLUMN (QUICK ACTION & JADWAL) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- QUICK ACTIONS (SUDAH DISAMBUNGKAN) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('pemesanan.jadwal') }}" class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-[#09637E] transition-all group">
                    <div class="p-2 rounded-lg bg-blue-50 text-[#09637E] mr-3 group-hover:bg-[#09637E] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Buat Janji</h3>
                        <p class="text-xs text-gray-500">Pemesanan jadwal</p>
                    </div>
                </a>

                <a href="{{ route('riwayat.medis') }}" class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-green-500 transition-all group">
                    <div class="p-2 rounded-lg bg-green-50 text-green-600 mr-3 group-hover:bg-green-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Rekam Medis</h3>
                        <p class="text-xs text-gray-500">Riwayat sakit</p>
                    </div>
                </a>
            </div>

            {{-- LIST JADWAL (FILTER AKTIF) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <h3 class="font-bold text-lg text-gray-800">Jadwal Pemeriksaan Saya</h3>

                        <!-- FILTER OTOMATIS (PAKAI ONCHANGE) -->
                        <form method="GET" action="{{ route('dashboard.pasien') }}">
                            <select name="status" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg p-2.5 focus:ring-[#09637E] w-full sm:w-auto">
                                <option value="all" {{ $statusAktif == 'all' ? 'selected' : '' }}>Semua Status</option>
                                <option value="Menunggu" {{ $statusAktif == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Selesai" {{ $statusAktif == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($jadwal as $item)
                    <div class="p-5 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    @if($item['status'] == 'Menunggu')
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-700">Akan Datang</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-700">Selesai</span>
                                    @endif
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $item['dokter'] }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-bold text-[#09637E]">{{ date('d F Y', strtotime($item['tanggal'])) }}</span> &bull; {{ $item['jam'] }}
                                </p>
                                @if($item['status'] == 'Menunggu')
                                    <p class="text-xs text-gray-500 italic mt-1">Keluhan: {{ $item['keluhan'] }}</p>
                                @else
                                    <p class="text-sm text-gray-600 mt-1">Diagnosa: <span class="font-medium">{{ $item['keluhan'] }}</span></p>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
                                @if($item['status'] == 'Menunggu')
                                    <!-- TOMBOL UNTUK STATUS MENUNGGU -->
                                    <a href="{{ route('pemesanan.jadwal') }}" class="w-full md:w-auto px-5 py-2 text-sm font-bold text-[#09637E] bg-white border-2 border-[#09637E] rounded-lg hover:bg-[#09637E] hover:text-white shadow-sm transition-all block text-center">
                                        Lihat Detail
                                    </a>
                                @else
                                    <!-- TOMBOL UNTUK STATUS SELESAI -->
                                    <a href="{{ route('riwayat.medis') }}" class="text-sm text-[#09637E] font-semibold hover:underline block text-center md:text-right">
                                        Lihat Rekam Medis →
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 text-center text-gray-400">
                        Tidak ada jadwal ditemukan untuk status ini.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN (PROFIL) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-[#09637E] flex items-center justify-center text-white text-3xl font-bold shadow-lg border-4 border-white mb-4">AR</div>
                    <h3 class="text-xl font-bold text-gray-900">Andi Pratama Rayhan</h3>
                    <p class="text-sm text-gray-500">Pasien Aktif</p>
                </div>
                <div class="text-sm space-y-3 text-gray-600 border-t border-gray-100 pt-6">
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Nama</span><span class="text-gray-900 font-semibold">Andi Pratama Rayhan</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Tanggal Lahir</span><span class="text-gray-900 font-semibold">15 Maret 2001</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Umur</span><span class="text-gray-900 font-semibold">23 Tahun</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Jenis Kelamin</span><span class="text-gray-900 font-semibold">Laki-laki</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">No. HP</span><span class="text-gray-900 font-semibold">0812-3456-7890</span></div>
                    <div class="flex justify-between items-start"><span class="font-medium text-gray-500">Alamat</span><span class="text-gray-900 font-semibold text-right ml-2">Pekanbaru, Riau</span></div>
                </div>
                <a href="{{ route('pasien.profil') }}" class="mt-6 w-full bg-[#09637E] text-white hover:bg-[#074d61] font-semibold py-2.5 rounded-xl transition-colors shadow-sm block text-center">
                    Ubah Profil
                </a>
            </div>
        </div>

    </div>
</div>
@endsection