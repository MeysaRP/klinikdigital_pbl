@extends('layouts.dashboard', [
    'pageTitle' => 'Jadwal Saya', 
    'userName'  => session('name'), 
    'userRole'  => 'Dokter',
    'userInitial' => substr(session('name'), 0, 1) 
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <!-- SUMMARY CARDS (DINAMIS DARI DATABASE) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Jadwal Aktif</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $aktifCount }} <span class="text-sm font-normal text-gray-400">dari {{ $jadwals->count() }}</span></p>
                </div>
                <div class="w-12 h-12 bg-[#09637E]/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#09637E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Pasien Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $pasienHariIni }} <span class="text-sm font-normal text-gray-400">pemesanan hari ini</span></p>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium">Hari Cuti</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $cutiCount }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $cutiDays ?: 'Tidak ada' }}</p>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER -->
    <div class="relative w-full max-w-xs">
        <label class="block text-xs text-gray-500 mb-1.5 font-medium">Cari Hari</label>
        <div class="relative" id="dropdownWrapper">
            <div class="flex items-center border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:border-gray-300 transition" onclick="toggleDropdown()">
                <input type="text" id="hariInput" placeholder="Pilih hari..." class="flex-1 text-sm bg-transparent outline-none border-none p-0 text-gray-700 placeholder-gray-400" oninput="filterHari()" onfocus="openDropdown()" onclick="event.stopPropagation()">
                <svg id="chevron" class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
            <div id="dropdownList" class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden hidden z-20">
                <div class="py-1" id="hariOptions">
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Senin')">Senin</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Selasa')">Selasa</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Rabu')">Rabu</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Kamis')">Kamis</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Jumat')">Jumat</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Sabtu')">Sabtu</div>
                    <div class="px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer transition" onclick="pilihHari('Minggu')">Minggu</div>
                </div>
                <div id="hariEmpty" class="hidden px-3 py-3 text-sm text-gray-400 text-center">Tidak ditemukan</div>
            </div>
        </div>
    </div>

    <!-- TABLE (DINAMIS DARI DATABASE) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[640px]">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                        <th class="px-5 py-3.5 text-left rounded-tl-2xl">Hari</th>
                        <th class="px-5 py-3.5 text-left">Jam</th>
                        <th class="px-5 py-3.5 text-center">Kapasitas</th>
                        <th class="px-5 py-3.5 text-center">Terisi</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-right rounded-tr-2xl">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbodyJadwal" class="text-gray-700">
                    @forelse($jadwals as $jadwal)
                        @php
                            $statusClass = match(strtolower($jadwal->status)) {
                                'aktif' => 'bg-green-50 text-green-600 border-green-100',
                                'penuh' => 'bg-blue-50 text-blue-600 border-blue-100',
                                default => 'bg-red-50 text-red-400 border-red-100',
                            };
                        @endphp
                        <tr class="border-b border-gray-50 hover:bg-gray-50/60 transition jadwal-row" data-hari="{{ strtolower($jadwal->hari) }}">
                            <td class="px-5 py-4 font-medium">{{ ucfirst($jadwal->hari) }}</td>
                            <td class="px-5 py-4">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-10 h-7 rounded-lg bg-gray-50 text-xs font-semibold">{{ $jadwal->kuota_pasien }}</span></td>
                            <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-10 h-7 rounded-lg bg-[#09637E]/10 text-[#09637E] text-xs font-semibold">{{ $jadwal->pemesanan_count }}</span></td>
                            <td class="px-5 py-4 text-center"><span class="px-3 py-1 text-xs rounded-full {{ $statusClass }} font-medium border">{{ ucfirst($jadwal->status) }}</span></td>
                            <td class="px-5 py-4 text-right">
                                <button class="bg-[#09637E] hover:bg-[#074d61] text-white px-4 py-2 rounded-xl text-xs font-semibold transition inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Lihat Pasien
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-400">Belum ada jadwal dokter. Silakan minta admin menambahkan jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div><!-- tutup overflow-x-auto -->
        <div id="jadwalEmpty" class="hidden py-12 text-center text-sm text-gray-400">Jadwal tidak ditemukan.</div>
    </div>

    <!-- MODAL DAFTAR PASIEN (Ini statis dulu dari kodemu sebelumnya, nanti bisa disambungkan ke database) -->
    <div id="pasienModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closePasienModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-900" id="modalTitle">Daftar Pasien</h3>
                            <p class="text-xs text-gray-400 mt-1">Poliklinik Umum • {{ session('nama') }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-[#09637E]/10 text-[#09637E] text-xs font-semibold rounded-lg">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span id="modalCount">0</span> orang terdaftar
                        </span>
                    </div>
                </div>
                <div class="flex-1 overflow-auto">
                    <table class="w-full text-sm">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                                <th class="px-5 py-3 text-left w-12">No</th>
                                <th class="px-5 py-3 text-left">Nama Pasien</th>
                                <th class="px-5 py-3 text-left">Keluhan</th>
                                <th class="px-5 py-3 text-center w-24">Status</th>
                                <th class="px-5 py-3 text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="modalTbody" class="text-gray-700"></tbody>
                    </table>
                    <div id="modalEmpty" class="hidden py-10 text-center text-sm text-gray-400">Belum ada pasien terdaftar.</div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-1" id="paginationContainer"></div>
                    <button onclick="closePasienModal()" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition">Tutup</button>
                </div>
            </div>
        </div>
    </div>

<script>
let dropdownOpen = false;
let hariTerpilih = '';

const dataPasien = {
    0: { jam: '08:00 - 10:00', pasien: [
        { nama: 'Andi Pratama', keluhan: 'Demam', status: 'Menunggu' },
        { nama: 'Siti Aminah', keluhan: 'Batuk Pilek', status: 'Menunggu' },
    ]},
    1: { jam: '10:00 - 12:00', pasien: [
        { nama: 'Rini Wulandari', keluhan: 'Demam', status: 'Menunggu' },
    ]}
    // (Data dummy disingkat biar kode tidak terlalu panjang, silakan sesuaikan nanti)
};

const perPage = 5;
let currentIdx = null;
let currentPage = 1;

function openPasienModal(idx) {
    currentIdx = idx; currentPage = 1;
    const data = dataPasien[idx]; if (!data) return;
    document.getElementById('modalTitle').textContent = 'Daftar Pasien | ' + data.jam;
    document.getElementById('modalCount').textContent = data.pasien.length;
    renderModalTable(); renderPagination();
    document.getElementById('pasienModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closePasienModal() {
    document.getElementById('pasienModal').classList.add('hidden');
    document.body.style.overflow = ''; currentIdx = null;
}
function renderModalTable() {
    const data = dataPasien[currentIdx];
    const tbody = document.getElementById('modalTbody');
    const emptyEl = document.getElementById('modalEmpty');
    if (!data || data.pasien.length === 0) { tbody.innerHTML = ''; emptyEl.classList.remove('hidden'); return; }
    emptyEl.classList.add('hidden');
    const start = (currentPage - 1) * perPage;
    const pageData = data.pasien.slice(start, start + perPage);
    tbody.innerHTML = pageData.map((p, i) => {
        const no = start + i + 1;
        const initials = p.nama.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        return `<tr class="border-b border-gray-50 hover:bg-gray-50/60 transition">
            <td class="px-5 py-3.5 text-gray-400 text-xs font-medium">${no}</td>
            <td class="px-5 py-3.5"><div class="flex items-center gap-2.5"><div class="w-8 h-8 rounded-full bg-[#09637E]/10 text-[#09637E] text-xs font-bold flex items-center justify-center flex-shrink-0">${initials}</div><span class="font-medium text-gray-800">${p.nama}</span></div></td>
            <td class="px-5 py-3.5 text-gray-500">${p.keluhan}</td>
            <td class="px-5 py-3.5 text-center"><span class="px-2.5 py-1 text-xs rounded-full bg-amber-50 text-amber-600 font-medium border border-amber-100">${p.status}</span></td>
            <td class="px-5 py-3.5 text-center"><button class="px-3 py-1.5 text-xs rounded-xl bg-[#09637E] hover:bg-[#074d61] text-white font-semibold transition">Periksa</button></td>
        </tr>`;
    }).join('');
}
function renderPagination() {
    const data = dataPasien[currentIdx];
    const container = document.getElementById('paginationContainer');
    const totalPages = Math.ceil(data.pasien.length / perPage);
    if (totalPages <= 1) { container.innerHTML = ''; return; }
    let html = `<button onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold transition ${currentPage === 1 ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 hover:bg-gray-100'}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>`;
    for (let i = 1; i <= totalPages; i++) {
        html += `<button onclick="goToPage(${i})" class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold transition ${i === currentPage ? 'bg-[#09637E] text-white' : 'text-gray-500 hover:bg-gray-100'}">${i}</button>`;
    }
    html += `<button onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold transition ${currentPage === totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 hover:bg-gray-100'}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>`;
    container.innerHTML = html;
}
function goToPage(page) {
    const totalPages = Math.ceil(dataPasien[currentIdx].pasien.length / perPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page; renderModalTable(); renderPagination();
}
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closePasienModal(); });

function toggleDropdown() { dropdownOpen ? closeDropdown() : openDropdown(); }
function openDropdown() { document.getElementById('dropdownList').classList.remove('hidden'); document.getElementById('chevron').style.transform = 'rotate(180deg)'; dropdownOpen = true; }
function closeDropdown() { document.getElementById('dropdownList').classList.add('hidden'); document.getElementById('chevron').style.transform = 'rotate(0)'; dropdownOpen = false; }
function filterHari() {
    const q = document.getElementById('hariInput').value.toLowerCase();
    const options = document.querySelectorAll('#hariOptions > div');
    let found = false;
    options.forEach(opt => { const match = opt.textContent.toLowerCase().includes(q); opt.style.display = match ? '' : 'none'; if (match) found = true; });
    document.getElementById('hariEmpty').classList.toggle('hidden', found);
    if (!dropdownOpen) openDropdown();
}
function pilihHari(hari) {
    document.getElementById('hariInput').value = hari;
    hariTerpilih = hari.toLowerCase();
    closeDropdown(); filterTabel();
}
function filterTabel() {
    const rows = document.querySelectorAll('.jadwal-row');
    let found = false;
    rows.forEach(row => { const match = row.dataset.hari.includes(hariTerpilih); row.style.display = match ? '' : 'none'; if (match) found = true; });
    document.getElementById('jadwalEmpty').classList.toggle('hidden', found);
}
document.addEventListener('click', function(e) {
    if (!document.getElementById('dropdownWrapper').contains(e.target)) {
        closeDropdown();
        if (!document.getElementById('hariInput').value.trim()) {
            hariTerpilih = '';
            document.querySelectorAll('.jadwal-row').forEach(r => r.style.display = '');
            document.getElementById('jadwalEmpty').classList.add('hidden');
        }
    }
});
document.getElementById('hariInput').addEventListener('input', function() {
    if (!this.value.trim()) {
        hariTerpilih = '';
        document.querySelectorAll('.jadwal-row').forEach(r => r.style.display = '');
        document.getElementById('jadwalEmpty').classList.add('hidden');
    }
});
</script>

@endsection