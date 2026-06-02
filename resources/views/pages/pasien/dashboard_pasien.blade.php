@extends('layouts.dashboard', [
    'pageTitle' => 'Dashboard Pasien',
    'userName' => $userName,
    'userRole' => $userRole,
    'userInitial' => $userInitial
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
                @if($nextBooking)
                    <h2 class="text-xl font-bold text-gray-800">{{ $nextBooking->dokter?->nama ?? 'Dokter' }} (Dokter Umum)</h2>
                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                        <span class="flex items-center gap-1 font-semibold text-[#09637E]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            {{ date('l, d F Y', strtotime($nextBooking->tanggal)) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                            {{ date('H:i', strtotime($nextBooking->jam_mulai)) }} - {{ date('H:i', strtotime($nextBooking->jam_selesai)) }} WIB
                        </span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 bg-gray-50 px-3 py-1 rounded-full inline-block">Keluhan: {{ $nextBooking->keluhan }}</p>
                @else
                    <h2 class="text-xl font-bold text-gray-800">Belum ada jadwal berikutnya</h2>
                    <p class="mt-2 text-xs text-gray-500 bg-gray-50 px-3 py-1 rounded-full inline-block">Silakan buat janji jika Anda membutuhkan konsultasi.</p>
                @endif
            </div>
            <div class="mt-4 md:mt-0 text-center bg-[#09637E] rounded-2xl p-4 text-white min-w-[140px]">
                <p class="text-xs uppercase tracking-wider font-medium opacity-80">No. Antrian</p>
                <p class="text-5xl font-bold mt-1">{{ $nextBooking?->nomor_antrian ?? '-' }}</p>
                @if($nextBooking && $nextBooking->status === 'Menunggu')
                    <span class="px-2 py-0.5 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full mt-2 inline-block">Menunggu</span>
                @elseif($nextBooking)
                    <span class="px-2 py-0.5 bg-green-500 text-white text-xs font-bold rounded-full mt-2 inline-block">Selesai</span>
                @else
                    <span class="px-2 py-0.5 bg-gray-500 text-white text-xs font-bold rounded-full mt-2 inline-block">Belum ada</span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- LEFT COLUMN (QUICK ACTION & JADWAL) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- QUICK ACTIONS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('pemesanan.jadwal') }}" class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-[#09637E] transition-all group">
                    <div class="p-2.5 rounded-xl bg-blue-50 text-[#09637E] mr-3 group-hover:bg-[#09637E] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Buat Janji</h3>
                        <p class="text-xs text-gray-500">Pemesanan jadwal</p>
                    </div>
                </a>

                <a href="{{ route('riwayat.medis') }}" class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-green-500 transition-all group">
                    <div class="p-2.5 rounded-xl bg-green-50 text-green-600 mr-3 group-hover:bg-green-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Rekam Medis</h3>
                        <p class="text-xs text-gray-500">Riwayat sakit</p>
                    </div>
                </a>
            </div>

            {{-- LIST JADWAL --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <h3 class="font-bold text-base sm:text-lg text-gray-800">Jadwal Pemeriksaan Saya</h3>
                        <form method="GET" action="{{ route('dashboard.pasien') }}" class="w-full sm:w-auto">
                            <select name="status" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-xl p-2.5 focus:ring-[#09637E] w-full">
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
                                    {{-- FIXED: "Akan Datang" diganti "Menunggu" --}}
                                    @if($item->status === 'Menunggu')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-yellow-100 text-yellow-700">Menunggu</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-green-100 text-green-700">Selesai</span>
                                    @endif
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $item->dokter?->nama ?? '-' }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-semibold text-[#09637E]">{{ date('d F Y', strtotime($item->tanggal)) }}</span> &bull; {{ date('H:i', strtotime($item->jam_mulai)) }} - {{ date('H:i', strtotime($item->jam_selesai)) }} WIB
                                </p>
                                <p class="text-xs text-gray-500 italic mt-1">Keluhan: {{ $item->keluhan ?? '-' }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <button
                                    class="btn-detail w-full md:w-auto px-5 py-2 text-sm font-semibold text-[#09637E] bg-white border-2 border-[#09637E] rounded-xl hover:bg-[#09637E] hover:text-white shadow-sm transition-all block text-center"
                                    onclick="openDetailModal(this)"
                                    data-dokter="{{ $item->dokter?->nama ?? '-' }}"
                                    data-tanggal="{{ date('d F Y', strtotime($item->tanggal)) }}"
                                    data-jam="{{ date('H:i', strtotime($item->jam_mulai)) }} - {{ date('H:i', strtotime($item->jam_selesai)) }} WIB"
                                    data-keluhan="{{ $item->keluhan ?? '-' }}"
                                    data-status="{{ $item->status }}"
                                    data-antrian="{{ $item->nomor_antrian ?? '-' }}">
                                    Lihat Detail
                                </button>
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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:sticky lg:top-24">
                <div class="flex flex-col items-center text-center mb-6">
                    {{-- FIXED: pakai $userInitial dari controller, bukan substr array --}}
                    <div class="w-24 h-24 rounded-full bg-[#09637E] flex items-center justify-center text-white text-3xl font-bold shadow-lg border-4 border-white mb-4">{{ $userInitial }}</div>
                    {{-- FIXED: $profil['nama'] diganti $profil->name --}}
                    <h3 class="text-xl font-bold text-gray-900">{{ $profil?->name ?? 'Pasien' }}</h3>
                    <p class="text-sm text-gray-500">Pasien Aktif</p>
                </div>
                <div class="text-sm space-y-3 text-gray-600 border-t border-gray-100 pt-6">
                    {{-- FIXED: semua $profil['...'] diganti $profil->... --}}
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Nama</span><span class="text-gray-900 font-semibold">{{ $profil?->name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Tanggal Lahir</span><span class="text-gray-900 font-semibold">{{ $profil?->tgl_lahir ? date('d F Y', strtotime($profil->tgl_lahir)) : '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">Jenis Kelamin</span><span class="text-gray-900 font-semibold">{{ $profil?->jk == 'L' ? 'Laki-laki' : ($profil?->jk == 'P' ? 'Perempuan' : '-') }}</span></div>
                    <div class="flex justify-between items-center"><span class="font-medium text-gray-500">No. HP</span><span class="text-gray-900 font-semibold">{{ $profil?->no_hp ?? '-' }}</span></div>
                    <div class="flex justify-between items-start"><span class="font-medium text-gray-500">Alamat</span><span class="text-gray-900 font-semibold text-right ml-2">{{ $profil?->alamat ?? '-' }}</span></div>
                </div>
                <a href="{{ route('pasien.profil') }}" class="mt-6 w-full bg-[#09637E] text-white hover:bg-[#074d61] font-semibold py-2.5 rounded-xl transition-colors shadow-sm block text-center">
                    Ubah Profil
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ================= MODAL DETAIL JADWAL ================= -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-base font-bold text-gray-900">Detail Jadwal</h3>
                <button onclick="closeDetailModal()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400 uppercase tracking-wide font-medium">Status</span>
                    <span id="modalStatus" class="px-3 py-1 text-xs rounded-full font-medium"></span>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 bg-[#09637E]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Dokter</p>
                        <p id="modalDokter" class="text-sm font-semibold text-gray-900 -mt-0.5">-</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 bg-[#09637E]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Tanggal</p>
                        <p id="modalTanggal" class="text-sm font-semibold text-gray-900 -mt-0.5">-</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 bg-[#09637E]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Jam</p>
                        <p id="modalJam" class="text-sm font-semibold text-gray-900 -mt-0.5">-</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 bg-amber-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">Keluhan</p>
                        <p id="modalKeluhan" class="text-sm font-semibold text-gray-900 -mt-0.5">-</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">No. Antrian</p>
                        <p id="modalAntrian" class="text-sm font-semibold text-gray-900 -mt-0.5">-</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center gap-3" id="modalFooter">
                    <button onclick="closeDetailModal()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition">
                        Tutup
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script -->
<script>
function openDetailModal(btn) {
    const dokter = btn.getAttribute('data-dokter');
    const tanggal = btn.getAttribute('data-tanggal');
    const jam = btn.getAttribute('data-jam');
    const keluhan = btn.getAttribute('data-keluhan');
    const status = btn.getAttribute('data-status');
    const antrian = btn.getAttribute('data-antrian');

    document.getElementById('modalDokter').textContent = dokter;
    document.getElementById('modalTanggal').textContent = tanggal;
    document.getElementById('modalJam').textContent = jam;
    document.getElementById('modalKeluhan').textContent = keluhan;
    document.getElementById('modalAntrian').textContent = antrian;

    const statusEl = document.getElementById('modalStatus');
    const footerEl = document.getElementById('modalFooter');

    if (status === 'Menunggu') {
        // FIXED: "Akan Datang" diganti "Menunggu"
        statusEl.className = 'px-3 py-1 text-xs rounded-full font-medium bg-yellow-100 text-yellow-700';
        statusEl.textContent = 'Menunggu';
        footerEl.innerHTML = `
            <button onclick="closeDetailModal()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition">Tutup</button>
            <a href="{{ route('pemesanan.jadwal') }}" class="flex-1 py-2.5 bg-[#09637E] hover:bg-[#074d61] text-white text-sm font-semibold rounded-xl transition block text-center">Ubah Jadwal</a>
        `;
    } else {
        statusEl.className = 'px-3 py-1 text-xs rounded-full font-medium bg-green-100 text-green-700';
        statusEl.textContent = 'Selesai';
        footerEl.innerHTML = `
            <button onclick="closeDetailModal()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition">Tutup</button>
            <a href="{{ route('riwayat.medis') }}" class="flex-1 py-2.5 bg-[#09637E] hover:bg-[#074d61] text-white text-sm font-semibold rounded-xl transition block text-center">Lihat Rekam Medis</a>
        `;
    }

    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDetailModal();
});
</script>

@endsection
