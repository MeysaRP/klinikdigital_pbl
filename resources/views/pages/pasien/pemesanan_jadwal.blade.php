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

            <form id="formPemesanan" action="{{ route('pemesanan.proses') }}" method="POST">
                @csrf

                <!-- Card: Pilih Tanggal -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        Pilih Tanggal
                    </h3>
                    <input type="date" id="tanggalInput" name="tanggal" value="{{ old('tanggal', $selectedDate ?? now()->format('Y-m-d')) }}" onchange="handleTanggalChange()" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] focus:border-[#09637E]">
                    @if(!empty($selectedDayName))
                        <p class="mt-2 text-sm text-gray-500">Menampilkan jadwal dokter untuk <strong>{{ ucfirst($selectedDayName) }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal', $selectedDate ?? now()->format('Y-m-d')))->format('d M Y') }}</strong>.</p>
                    @endif
                    @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Card: Pilih Dokter & Jadwal -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#09637E]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        Pilih Dokter & Jadwal
                    </h3>

                    @if(empty($jadwalPerHari))
                        <div class="text-sm text-gray-500 py-4">
                            @if(!empty($selectedDayName))
                                Tidak ada jadwal dokter tersedia untuk <strong>{{ ucfirst($selectedDayName) }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse(old('tanggal', $selectedDate ?? now()->format('Y-m-d')))->format('d M Y') }}</strong>.
                            @else
                                Belum ada jadwal dokter yang tersedia saat ini.
                            @endif
                        </div>
                    @else
                        <div class="space-y-5">

                            @foreach($jadwalPerHari as $group)
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="inline-flex items-center gap-2 bg-[#09637E] text-white text-sm font-semibold px-4 py-1.5 rounded-lg">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $group['hari'] }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $group['jumlah'] }} jadwal tersedia</span>
                                        <div class="flex-1 h-px bg-gray-200"></div>
                                    </div>

                                    <div class="space-y-2 pl-1">
                                        @foreach($group['jadwals'] as $jadwal)
                                            <label class="jadwal-card flex items-center justify-between p-4 border rounded-xl transition-all duration-200 {{ $jadwal->is_full ? 'cursor-not-allowed opacity-50 bg-gray-50' : 'cursor-pointer' }} {{ old('jadwal_id') == $jadwal->id ? 'border-[#09637E] bg-[#09637E]/5 shadow-sm' : ($jadwal->is_full ? 'border-gray-200 bg-gray-50' : 'border-gray-200 bg-white hover:border-[#09637E]/50 hover:shadow-sm') }}">
                                                <div class="flex items-start gap-3">
                                                    <input type="radio" name="jadwal_id" value="{{ $jadwal->id }}" class="mt-1 accent-[#09637E]" {{ old('jadwal_id') == $jadwal->id ? 'checked' : '' }} {{ $jadwal->is_full ? 'disabled' : '' }} onchange="highlightCard(this)">
                                                    <div>
                                                        <p class="font-semibold text-gray-900">{{ $jadwal->dokter->nama ?? 'Dokter Tidak Ditemukan' }}</p>
                                                        <p class="text-sm text-gray-500 mt-0.5">
                                                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-md font-medium">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB
                                                            </span>
                                                        </p>
                                                        <p class="text-sm {{ $jadwal->is_full ? 'text-red-600 font-semibold' : 'text-gray-400' }} mt-1">
                                                            Kuota:
                                                            @if($jadwal->is_full)
                                                                <span class="text-red-600">{{ $jadwal->kuota_terpakai }}/{{ $jadwal->kuota_pasien }} (PENUH)</span>
                                                            @else
                                                                <span>{{ $jadwal->kuota_terpakai }}/{{ $jadwal->kuota_pasien }}</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    @if($jadwal->is_full)
                                                        <span class="text-xs rounded-full px-2.5 py-1 font-medium whitespace-nowrap bg-red-100 text-red-700">Penuh</span>
                                                    @else
                                                        <span class="text-xs rounded-full px-2.5 py-1 font-medium whitespace-nowrap {{ $jadwal->status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $jadwal->status }}</span>
                                                    @endif
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                    @error('jadwal_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Card: Catatan Keluhan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-3">Catatan Keluhan (Opsional)</h3>
                    <textarea name="keluhan" class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#09637E] h-24 resize-none" placeholder="Contoh: Saya mengalami demam tinggi sudah 2 hari...">{{ old('keluhan') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-[#09637E] hover:bg-[#074d61] text-white font-bold py-3 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    Konfirmasi Pemesanan
                </button>
            </form>

        </div>

        <!-- Sidebar Kanan -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Ringkasan Jadwal</h3>
                <p class="text-sm text-gray-500">Pilih tanggal dan sesi yang sesuai. Jika jadwal tersedia, kamu akan mendapatkan nomor antrian setelah konfirmasi.</p>
                <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-xl">
                    <p class="text-xs text-amber-700 flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span>Pemesanan jadwal dibatasi <strong>1 kali per hari</strong> per pasien.</span>
                    </p>
                </div>
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
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }} • {{ $booking->slot_mulai ?? $booking->jam_mulai }} - {{ $booking->slot_selesai ?? $booking->jam_selesai }} WIB</p>
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

<!-- ==================== MODAL POPUP ==================== -->
<div id="modalPopup" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="tutupModal()"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
        <!-- Ikon -->
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <!-- Judul -->
        <h3 class="text-lg font-bold text-gray-800 text-center mb-2">Pemesanan Gagal</h3>
        <!-- Pesan -->
        <p id="modalPesan" class="text-sm text-gray-500 text-center mb-6"></p>
        <!-- Tombol -->
        <button onclick="tutupModal()" class="w-full bg-[#09637E] hover:bg-[#074d61] text-white font-semibold py-2.5 rounded-xl transition-colors">
            Mengerti
        </button>
    </div>
</div>

<script>
    // Tanggal yang sudah dipesan (dari controller)
    const tanggalSudahDipesan = @json($tanggalSudahDipesan);

    // Blokir tanggal di date input
    const tanggalInput = document.getElementById('tanggalInput');
    if (tanggalInput) {
        // Set min date = hari ini
        tanggalInput.min = new Date().toISOString().split('T')[0];

        // Override submit form untuk cek duplikat tanggal di frontend juga
        document.getElementById('formPemesanan').addEventListener('submit', function(e) {
            const tanggal = tanggalInput.value;
            if (tanggalSudahDipesan.includes(tanggal)) {
                e.preventDefault();
                tampilkanModal('Pemesanan sudah dilakukan pada hari ini. Silakan pilih tanggal lain untuk memesan jadwal baru.');
            }
        });
    }

    function handleTanggalChange() {
        const tanggal = document.getElementById('tanggalInput').value;
        if (!tanggal) return;

        // Cek dulu sebelum redirect
        if (tanggalSudahDipesan.includes(tanggal)) {
            tampilkanModal('Pemesanan sudah dilakukan pada hari ini. Silakan pilih tanggal lain untuk memesan jadwal baru.');
            // Reset ke tanggal sebelumnya
            tanggalInput.value = '{{ old("tanggal", $selectedDate ?? now()->format("Y-m-d")) }}';
            return;
        }

        const url = new URL(window.location.href);
        url.searchParams.set('tanggal', tanggal);
        window.location.href = url.toString();
    }

    // === MODAL FUNCTIONS ===
    function tampilkanModal(pesan) {
        const modal = document.getElementById('modalPopup');
        const content = document.getElementById('modalContent');
        const text = document.getElementById('modalPesan');

        text.textContent = pesan;
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Trigger animasi masuk
        requestAnimationFrame(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        });
    }

    function tutupModal() {
        const modal = document.getElementById('modalPopup');
        const content = document.getElementById('modalContent');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') tutupModal();
    });

    // Auto tampilkan modal kalau ada popup_error dari server (setelah redirect back)
    @if(session('popup_error'))
        document.addEventListener('DOMContentLoaded', function() {
            tampilkanModal('{{ session("popup_error") }}');
        });
    @endif

    // === HIGHLIGHT CARD ===
    function highlightCard(radio) {
        document.querySelectorAll('.jadwal-card').forEach(card => {
            card.classList.remove('border-[#09637E]', 'bg-[#09637E]/5', 'shadow-sm');
            card.classList.add('border-gray-200', 'bg-white');
        });
        const card = radio.closest('.jadwal-card');
        card.classList.remove('border-gray-200', 'bg-white');
        card.classList.add('border-[#09637E]', 'bg-[#09637E]/5', 'shadow-sm');
    }
</script>
@endsection
