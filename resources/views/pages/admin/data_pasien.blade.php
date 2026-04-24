@extends('layouts.dashboard', [
    'pageTitle' => 'Data Pasien',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
    <x-sidebar-admin />
@endsection

@section('content')
<div class="space-y-5">

    <!-- TOP BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="relative w-full max-w-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="searchInput" oninput="cariPasien(this.value)" placeholder="Cari Pasien..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition placeholder-gray-400">
        </div>
        <div class="flex items-center gap-2.5">
            <span class="text-sm text-gray-500">Tampilkan</span>
            <select class="px-3 py-2 rounded-lg border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition bg-white text-gray-700 font-medium min-w-[60px]">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span class="text-sm text-gray-500">entri</span>
        </div>
    </div>

    <!-- TABLE (div grid, bukan table bawaan browser) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- HEADER -->
        <div class="grid grid-cols-[100px_1fr_140px_120px_130px] sm:grid-cols-[120px_1fr_160px_130px_140px] bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold" style="box-shadow:0 1px 0 0 #f3f4f6;">
            <div class="px-5 py-3.5">ID Pasien</div>
            <div class="px-5 py-3.5">Nama</div>
            <div class="px-5 py-3.5">No. HP</div>
            <div class="px-5 py-3.5">Tgl. Daftar</div>
            <div class="px-5 py-3.5 text-right">Aksi</div>
        </div>

        <!-- ROWS -->
        <div id="tbodyPasien">
            @foreach ($pasien as $p)
            <div class="pasien-row grid grid-cols-[100px_1fr_140px_120px_130px] sm:grid-cols-[120px_1fr_160px_130px_140px] hover:bg-gray-50/60 transition" data-nama="{{ $p['nama'] }}">
                <div class="px-5 py-3.5">
                    <span class="text-xs font-mono text-gray-400 bg-gray-100 px-2 py-1 rounded-md">{{ $p['id'] }}</span>
                </div>
                <div class="px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <div class="pasien-avatar w-8 h-8 rounded-full bg-[#09637E]/10 text-[#09637E] text-xs font-bold flex items-center justify-center flex-shrink-0">
                            {{ mb_substr(strtoupper(str_replace(' ', '', $p['nama'])), 0, 2) }}
                        </div>
                        <span class="pasien-nama font-medium text-gray-800">{{ $p['nama'] }}</span>
                    </div>
                </div>
                <div class="px-5 py-3.5 pasien-hp text-gray-500">{{ $p['hp'] }}</div>
                <div class="px-5 py-3.5 pasien-tgl text-gray-500">{{ $p['tgl'] }}</div>
                <div class="px-5 py-3.5 text-right">
                    <div class="inline-flex items-center gap-2">
                        <button
                            data-nama="{{ $p['nama'] }}"
                            data-tgl="{{ $p['tgl'] }}"
                            data-jk="Laki-Laki"
                            data-hp="{{ $p['hp'] }}"
                            data-alamat="Jl. Sudirman No.09 Pekanbaru"
                            onclick="openModal(this)"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">
                            Detail
                        </button>
                        <button
                            data-nama="{{ $p['nama'] }}"
                            data-tgl="{{ $p['tgl'] }}"
                            data-jk="Laki-Laki"
                            data-hp="{{ $p['hp'] }}"
                            data-alamat="Jl. Sudirman No.09 Pekanbaru"
                            onclick="openEditModal(this)"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- FOOTER -->
        <div class="px-5 py-3 bg-gray-50" style="box-shadow:0 -1px 0 0 #f3f4f6;">
            <div class="flex items-center justify-between">
                <p class="text-[11px] text-gray-400" id="infoJumlah">Menampilkan {{ count($pasien) }} data pasien</p>
                <div class="flex items-center gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-400 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold bg-[#09637E] text-white">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 hover:bg-gray-200 transition font-medium">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 hover:bg-gray-200 transition font-medium">3</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 hover:bg-gray-200 transition font-medium">4</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-500 hover:bg-gray-200 transition font-medium">5</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-xs text-gray-400 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= MODAL DETAIL ================= -->
<div id="modalDetail" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 pt-6 pb-4" style="box-shadow:0 1px 0 0 #f3f4f6;">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900">Detail Data Pasien</h3>
                    <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Nama Lengkap</p>
                    <p id="nama" class="text-sm font-semibold text-gray-800 mt-0.5">-</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Tanggal Lahir</p>
                    <p id="tgl" class="text-sm font-semibold text-gray-800 mt-0.5">-</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Jenis Kelamin</p>
                    <p id="jk" class="text-sm font-semibold text-gray-800 mt-0.5">-</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">No. HP</p>
                    <p id="hp" class="text-sm font-semibold text-gray-800 mt-0.5">-</p>
                </div>
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-wide font-medium">Alamat</p>
                    <p id="alamat" class="text-sm font-semibold text-gray-800 mt-0.5">-</p>
                </div>
            </div>
            <div class="px-6 py-4" style="box-shadow:0 -1px 0 0 #f3f4f6;">
                <button onclick="closeModal()" class="w-full py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 pt-6 pb-4" style="box-shadow:0 1px 0 0 #f3f4f6;">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900">Edit Data Pasien</h3>
                    <button onclick="closeEditModal()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-[11px] text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama Lengkap</label>
                    <input id="edit_nama" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition text-gray-800">
                </div>
                <div>
                    <label class="block text-[11px] text-gray-400 uppercase tracking-wide font-medium mb-1.5">Tanggal Lahir</label>
                    <input type="date" id="edit_tgl" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition text-gray-800">
                </div>
                <div>
                    <label class="block text-[11px] text-gray-400 uppercase tracking-wide font-medium mb-1.5">Jenis Kelamin</label>
                    <select id="edit_jk" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition text-gray-800 bg-white">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. HP</label>
                    <input id="edit_hp" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition text-gray-800">
                </div>
                <div>
                    <label class="block text-[11px] text-gray-400 uppercase tracking-wide font-medium mb-1.5">Alamat</label>
                    <input id="edit_alamat" class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#09637E]/40 focus:ring-2 focus:ring-[#09637E]/10 transition text-gray-800">
                </div>
            </div>
            <div class="px-6 py-4" style="box-shadow:0 -1px 0 0 #f3f4f6;">
                <div class="flex items-center gap-3">
                    <button onclick="closeEditModal()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold rounded-xl transition">Batal</button>
                    <button onclick="saveEdit()" class="flex-1 py-2.5 bg-[#09637E] hover:bg-[#074f63] text-white text-sm font-semibold rounded-xl transition shadow-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentEditRow = null;

function cariPasien(query) {
    const rows = document.querySelectorAll('.pasien-row');
    const q = query.toLowerCase().trim();
    let tampil = 0;
    rows.forEach(row => {
        const nama = row.dataset.nama.toLowerCase();
        const cocok = nama.includes(q);
        row.style.display = cocok ? '' : 'none';
        if (cocok) tampil++;
    });
    document.getElementById('infoJumlah').textContent = 'Menampilkan ' + tampil + ' data pasien';
}

function openModal(btn) {
    document.getElementById('nama').textContent = btn.dataset.nama;
    document.getElementById('tgl').textContent = btn.dataset.tgl;
    document.getElementById('jk').textContent = btn.dataset.jk;
    document.getElementById('hp').textContent = btn.dataset.hp;
    document.getElementById('alamat').textContent = btn.dataset.alamat;
    document.getElementById('modalDetail').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modalDetail').classList.add('hidden');
    document.body.style.overflow = '';
}

function openEditModal(btn) {
    currentEditRow = btn.closest('.pasien-row');
    document.getElementById('edit_nama').value = btn.dataset.nama;
    document.getElementById('edit_tgl').value = btn.dataset.tgl;
    document.getElementById('edit_jk').value = btn.dataset.jk;
    document.getElementById('edit_hp').value = btn.dataset.hp;
    document.getElementById('edit_alamat').value = btn.dataset.alamat;
    document.getElementById('modalEdit').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.body.style.overflow = '';
    currentEditRow = null;
}

function saveEdit() {
    if (!currentEditRow) return;
    const namaBaru = document.getElementById('edit_nama').value;
    const hpBaru = document.getElementById('edit_hp').value;
    currentEditRow.querySelector('.pasien-nama').textContent = namaBaru;
    const inisial = namaBaru.replace(/\s/g, '').substring(0, 2).toUpperCase();
    currentEditRow.querySelector('.pasien-avatar').textContent = inisial;
    currentEditRow.dataset.nama = namaBaru;
    currentEditRow.querySelector('.pasien-hp').textContent = hpBaru;
    currentEditRow.querySelectorAll('button[data-nama]').forEach(b => {
        b.dataset.nama = namaBaru;
        b.dataset.hp = hpBaru;
        b.dataset.tgl = document.getElementById('edit_tgl').value;
        b.dataset.jk = document.getElementById('edit_jk').value;
        b.dataset.alamat = document.getElementById('edit_alamat').value;
    });
    closeEditModal();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeModal(); closeEditModal(); }
});
</script>

@endsection