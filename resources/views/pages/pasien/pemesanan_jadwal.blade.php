@extends('layouts.dashboard', [
    'pageTitle' => 'Pemesanan Jadwal',
    'userName' => $userName,
    'userRole' => $userRole,
    'userInitial' => $userInitial
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pemesanan Jadwal</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih dokter dan jadwal yang tersedia untuk membuat janji temu.</p>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="mb-4 p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">

            <form action="{{ route('pemesanan.proses') }}" method="POST">
                @csrf

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        Pilih Tanggal
                    </h3>
                    <input type="date" id="tanggalInput" name="tanggal" value="{{ old('tanggal', $selectedDate ?? now()->format('Y-m-d')) }}" onchange="handleTanggalChange()" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] focus:border-[#09637E]">
                    @if(!empty($selectedDayName))
                        <p class="mt-2 text-sm text-gray-500">Menampilkan jadwal dokter untuk <strong>{{ $selectedDayName }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal', $selectedDate ?? now()->format('Y-m-d')))->format('d M Y') }}</strong>.</p>
                    @endif
                    @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        Pilih Dokter & Jadwal
                    </h3>

                    @if($jadwals->isEmpty())
                        <div class="text-sm text-gray-500">
                            @if(!empty($selectedDayName))
                                Tidak ada jadwal dokter tersedia untuk <strong>{{ $selectedDayName }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal', $selectedDate ?? now()->format('Y-m-d')))->format('d M Y') }}</strong>.
                            @else
                                Belum ada jadwal dokter yang tersedia saat ini.
                            @endif
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($jadwals as $jadwal)
                                <label class="flex items-center justify-between p-4 border rounded-xl transition hover:border-[#09637E] {{ old('jadwal_id') == $jadwal->id ? 'border-[#09637E] bg-[#09637E]/10' : 'border-gray-200 bg-white' }}">
                                    <div class="flex items-start gap-3">
                                        <input type="radio" name="jadwal_id" value="{{ $jadwal->id }}" class="mt-1 text-[#09637E] focus:ring-[#09637E]" {{ old('jadwal_id') == $jadwal->id ? 'checked' : '' }}>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $jadwal->dokter->nama ?? 'Dokter Tidak Ditemukan' }}</p>
                                            <p class="text-sm text-gray-500">{{ ucfirst(strtolower($jadwal->hari)) }} • {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB</p>
                                            <p class="text-sm text-gray-500 mt-1">Kuota pasien: {{ $jadwal->kuota_pasien }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs rounded-full px-2 py-1 {{ $jadwal->status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $jadwal->status }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                    @error('jadwal_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-3">Catatan Keluhan (Opsional)</h3>
                    <textarea name="keluhan" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] h-24 resize-none" placeholder="Contoh: Saya mengalami demam tinggi sudah 2 hari...">{{ old('keluhan') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-[#09637E] hover:bg-[#074d61] text-white font-bold py-3 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    Konfirmasi Pemesanan
                </button>
            </form>

        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Ringkasan Jadwal</h3>
                <p class="text-sm text-gray-500">Pilih tanggal dan sesi yang sesuai. Jika jadwal tersedia, kamu akan mendapatkan nomor antrian setelah konfirmasi.</p>
            </div>

            @if($bookings->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4">Riwayat Pemesanan</h3>
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="border border-gray-200 rounded-2xl p-4 bg-gray-50">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $booking->dokter->nama ?? 'Dokter' }}</p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }} • {{ $booking->slot_mulai }} - {{ $booking->slot_selesai }} WIB</p>
                                        <p class="text-sm text-gray-500 mt-1">No. Antrian: {{ sprintf('%02d', $booking->nomor_antrian) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $booking->status === 'Menunggu' ? 'bg-yellow-100 text-yellow-800' : ($booking->status === 'Dibatalkan' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700') }}">{{ $booking->status }}</span>
                                    </div>
                                </div>
                                @if($booking->status === 'Menunggu')
                                    <form action="{{ route('pemesanan.batal', ['booking' => $booking->id]) }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">Batalkan Pemesanan</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    function handleTanggalChange() {
        const tanggal = document.getElementById('tanggalInput').value;
        if (!tanggal) {
            return;
        }
        const url = new URL(window.location.href);
        url.searchParams.set('tanggal', tanggal);
        window.location.href = url.toString();
    }
</script>
@endsection
