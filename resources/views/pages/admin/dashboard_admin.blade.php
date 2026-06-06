@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Admin',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
    <x-sidebar-admin />
@endsection

@section('content')
<div class="space-y-6">

   <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs text-gray-400 font-medium">Total Dokter</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">
                {{ $totalDokter }}
            </p>
        </div>
        <div class="w-12 h-12 bg-[#09637E]/10 rounded-2xl flex items-center justify-center text-xl">🩺</div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs text-gray-400 font-medium">Total Pasien</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">
                {{ $totalPasien }}
            </p>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-xl">👥</div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs text-gray-400 font-medium">Total Jadwal</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">
                {{ $totalJadwal }}
            </p>
        </div>
        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-xl">📅</div>
    </div>

</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4">

    <form method="GET" class="flex flex-col sm:flex-row gap-3">

        <!-- Filter Tanggal -->
        <input type="date"
               name="tanggal"
               value="{{ $tanggal }}"
               class="border border-gray-200 rounded-lg px-3 py-2 text-sm w-full sm:w-auto">

        <!-- Filter Dokter -->
        <select name="dokter_id"
                class="border border-gray-200 rounded-lg px-3 py-2 text-sm w-full sm:w-auto">

            <option value="">Semua Dokter</option>

            @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}"
                    {{ $dokterId == $dokter->id ? 'selected' : '' }}>
                    {{ $dokter->nama }}
                </option>
            @endforeach

        </select>

        <!-- Button -->
        <button type="submit"
                class="bg-[#09637E] text-white px-4 py-2 rounded-lg text-sm hover:opacity-90">
            Filter
        </button>

        <!-- Reset -->
        <a href="{{ route('dashboard.admin') }}"
           class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50">
            Reset
        </a>

    </form>

</div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-base sm:text-lg text-gray-800">Antrian Pasien Hari Ini</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[540px]">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                    <tr>
                        <th class="px-5 py-3.5 text-left">No</th>
                        <th class="px-5 py-3.5 text-left">Nama Pasien</th>
                        <th class="px-5 py-3.5 text-left">Dokter</th>
                        <th class="px-5 py-3.5 text-left">Jam</th>
                        <th class="px-5 py-3.5 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">

@forelse($antrians as $index => $antrian)

<tr class="hover:bg-gray-50 transition">

    <td class="px-5 py-3.5">
        {{ $index + 1 }}
    </td>

    <td class="px-5 py-3.5 font-medium">
        {{ $antrian->pemesanan->nama_pasien ?? '-' }}
    </td>

    <td class="px-5 py-3.5">
        {{ $antrian->pemesanan->dokter->name ?? '-' }}
    </td>

    <td class="px-5 py-3.5">
        {{ $antrian->created_at->format('H:i') }}
    </td>

    <td class="px-5 py-3.5">

        @if($antrian->status == 'menunggu')
            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                Menunggu
            </span>

        @elseif($antrian->status == 'dipanggil')
            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">
                Dipanggil
            </span>

        @elseif($antrian->status == 'selesai')
            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                Selesai
            </span>

        @endif

    </td>

</tr>

@empty

<tr>
    <td colspan="5" class="px-5 py-6 text-center text-gray-400">
        Belum ada antrian pasien
    </td>
</tr>

@endforelse

</tbody>
            </table>
        </div>

    </div>

</div>
@endsection