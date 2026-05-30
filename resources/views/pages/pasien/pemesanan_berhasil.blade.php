@extends('layouts.dashboard', [
    'pageTitle' => 'Pemesanan Berhasil',
    'userName' => 'Andi Pratama Rayhan',
    'userRole' => 'Pasien',
    'userInitial' => 'AR'
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="flex items-center justify-center min-h-[70vh]">
    <div class="bg-white p-10 rounded-2xl shadow-lg border border-gray-100 text-center max-w-md w-full">

        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h2 class="text-2xl font-extrabold text-gray-800 mb-2">Pemesanan Berhasil!</h2>
        <p class="text-gray-500 mb-6">Silakan datang sesuai jadwal dan jangan lupa membawa KTP/Identitas.</p>

        <div class="bg-[#09637E] text-white rounded-2xl p-6 mb-6 shadow-md">
            <p class="text-sm opacity-80 uppercase tracking-wider font-medium">No. Antrian Anda</p>
            <h1 class="text-6xl font-extrabold mt-2">{{ sprintf('%02d', $booking->nomor_antrian) }}</h1>
            <p class="text-sm mt-2 opacity-90">{{ $booking->dokter->nama ?? 'Dokter' }} • {{ date('H:i', strtotime($booking->jam_mulai)) }} - {{ date('H:i', strtotime($booking->jam_selesai)) }} WIB</p>
            <p class="text-sm opacity-90 mt-2">Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
        </div>

        <div class="bg-gray-50 rounded-2xl p-5 text-left text-sm text-gray-700 mb-8">
            <p><strong>Status:</strong> {{ $booking->status }}</p>
            @if($booking->keluhan)
                <p class="mt-2"><strong>Keluhan:</strong> {{ $booking->keluhan }}</p>
            @endif
        </div>

        <a href="{{ route('dashboard.pasien') }}" class="inline-flex items-center justify-center w-full py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

    </div>
</div>
@endsection
