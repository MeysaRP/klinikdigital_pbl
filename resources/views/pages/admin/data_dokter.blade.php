@extends('layouts.dashboard', [
    'pageTitle' => 'Data Dokter',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
<x-sidebar-admin />
@endsection

@section('content')

<div class="space-y-6">

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-5 flex flex-col sm:flex-row justify-between gap-3">

        <!-- SEARCH DENGAN TOMBOL X -->
        <div class="relative w-full sm:w-1/3">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="searchDokter" placeholder="Cari username, nama, STR, atau HP..."
                class="w-full bg-gray-50 rounded-xl pl-10 pr-9 py-2.5 text-sm focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 outline-none border border-gray-200">
            <button id="btnClearSearch" onclick="clearSearch()" class="absolute right-2 top-1/2 -translate-y-1/2 w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition hidden">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex items-center gap-2 text-sm text-gray-500">
            <span>Tampilkan</span>
            <select class="bg-gray-50 rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 border border-gray-200">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span>entri</span>
        </div>

    </div>

    <!-- HEADER & BUTTON -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <h2 class="font-bold text-lg text-gray-800">Kelola Data Dokter</h2>
        <button onclick="openTambah()" class="bg-[#09637E] text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#074d61] transition">
            + Tambah Dokter
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[700px]">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                    <tr>
                        <th class="px-5 py-3.5">Username</th>
                        <th class="px-5 py-3.5">Nama</th>
                        <th class="px-5 py-3.5">No. STR</th>
                        <th class="px-5 py-3.5">No. HP</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableDokter" class="text-gray-700 divide-y divide-gray-100">

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 font-mono text-xs text-gray-400 username">dr.sarah</td>
                        <td class="px-5 py-3.5 font-medium nama">Dr. Sarah</td>
                        <td class="px-5 py-3.5 str">1234567</td>
                        <td class="px-5 py-3.5 hp">081234567</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 font-mono text-xs text-gray-400 username">dr.budi</td>
                        <td class="px-5 py-3.5 font-medium nama">Dr. Budi</td>
                        <td class="px-5 py-3.5 str">1234567</td>
                        <td class="px-5 py-3.5 hp">081234567</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 font-mono text-xs text-gray-400 username">dr.rina</td>
                        <td class="px-5 py-3.5 font-medium nama">Dr. Rina</td>
                        <td class="px-5 py-3.5 str">1234567</td>
                        <td class="px-5 py-3.5 hp">081234567</td>
                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">Nonaktif</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col sm:flex-row justify-between items-center px-5 py-3 text-sm text-gray-500 border-t border-gray-100 gap-2">
            <span id="infoJumlah">Menampilkan 3 data dokter</span>
            <div class="flex gap-2" id="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
            </div>
        </div>

    </div>

</div>

<!-- MODAL TAMBAH DOKTER -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeTambah()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-900">Tambah Dokter Baru</h3>
                <button onclick="closeTambah()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Username</label>
                    <input type="text" id="tUsername" placeholder="Contoh: dr.sarah" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama Lengkap</label>
                    <input type="text" id="tNama" placeholder="Contoh: Dr. Sarah Wijaya" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. STR</label>
                    <input type="text" id="tSTR" placeholder="Masukkan No. STR" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. HP</label>
                    <input type="text" id="tHP" placeholder="Masukkan No. HP" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Password</label>
                    <input type="password" id="tPass" placeholder="Masukkan password" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Status</label>
                    <select id="tStatus" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 bg-white">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                <button onclick="closeTambah()" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                <button onclick="simpanDokter()" class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT DOKTER -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEdit()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-900">Edit Data Dokter</h3>
                <button onclick="closeEdit()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Username</label>
                    <input type="text" id="eUsername" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama Lengkap</label>
                    <input type="text" id="eNama" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. STR</label>
                    <input type="text" id="eSTR" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No. HP</label>
                    <input type="text" id="eHP" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Password</label>
                    <input type="password" id="ePass" placeholder="Kosongkan jika tidak diganti" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Status</label>
                    <select id="eStatus" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 bg-white">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                <button onclick="closeEdit()" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                <button onclick="updateDokter()" class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<!-- STYLE PAGINATION -->
<style>
.page-btn{
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 8px;
    background-color: #f3f4f6;
    color: #4b5563;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.page-btn:hover{ background-color: #e5e7eb; }
.page-btn.active{
    background-color: #09637E;
    color: white;
}
</style>

<!-- SCRIPT -->
<script>

let searchTimeout = null;

// ========== FUNGSI: TAMPILKAN SEMUA BARIS ==========
function tampilkanSemua() {
    let total = 0;
    document.querySelectorAll('#tableDokter tr').forEach(function(row) {
        row.style.display = '';
        total++;
    });
    document.getElementById('infoJumlah').textContent = 'Menampilkan ' + total + ' data dokter';
    document.getElementById('btnClearSearch').classList.add('hidden');
}

// ========== FUNGSI: HAPUS PENCARIAN ==========
function clearSearch() {
    document.getElementById('searchDokter').value = '';
    tampilkanSemua();
    document.getElementById('searchDokter').focus();
}

// ========== FUNGSI: CARI DOKTER ==========
function cariDokter() {
    let inputEl = document.getElementById('searchDokter');
    let value = inputEl.value.toLowerCase().trim();

    if (value === '') {
        tampilkanSemua();
        return;
    }

    let tampil = 0;
    document.querySelectorAll('#tableDokter tr').forEach(function(row) {
        let username = row.querySelector('.username') ? row.querySelector('.username').innerText.toLowerCase() : '';
        let nama = row.querySelector('.nama') ? row.querySelector('.nama').innerText.toLowerCase() : '';
        let str = row.querySelector('.str') ? row.querySelector('.str').innerText.toLowerCase() : '';
        let hp = row.querySelector('.hp') ? row.querySelector('.hp').innerText.toLowerCase() : '';

        let cocok = username.includes(value) || nama.includes(value) || str.includes(value) || hp.includes(value);
        row.style.display = cocok ? '' : 'none';
        if (cocok) tampil++;
    });

    document.getElementById('infoJumlah').textContent = 'Menampilkan ' + tampil + ' data dokter';
    document.getElementById('btnClearSearch').classList.remove('hidden');
}

// ========== EVENT: INPUT PENCARIAN ==========
document.getElementById('searchDokter').addEventListener('input', function() {
    if (searchTimeout) clearTimeout(searchTimeout);

    let value = this.value.toLowerCase().trim();

    if (value === '') {
        tampilkanSemua();
    } else {
        searchTimeout = setTimeout(cariDokter, 400);
    }
});

// ========== PAGINATION ==========
document.querySelectorAll('.page-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.page-btn').forEach(function(b) { b.classList.remove('active'); });
        this.classList.add('active');
    });
});

// ========== MODAL TAMBAH ==========
function openTambah() {
    document.getElementById('tUsername').value = '';
    document.getElementById('tNama').value = '';
    document.getElementById('tSTR').value = '';
    document.getElementById('tHP').value = '';
    document.getElementById('tPass').value = '';
    document.getElementById('tStatus').value = 'Aktif';

    document.getElementById('modalTambah').classList.remove('hidden');
    document.getElementById('modalTambah').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeTambah() {
    document.getElementById('modalTambah').classList.add('hidden');
    document.getElementById('modalTambah').classList.remove('flex');
    document.body.style.overflow = '';
}

function simpanDokter() {
    let username = document.getElementById('tUsername').value;
    let nama = document.getElementById('tNama').value;
    let str = document.getElementById('tSTR').value;
    let hp = document.getElementById('tHP').value;
    let status = document.getElementById('tStatus').value;

    if (!username || !nama || !str || !hp) { alert("Username, Nama, STR, dan HP harus diisi!"); return; }

    let badgeClass = status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600';

    let row = '<tr class="hover:bg-gray-50 transition">' +
        '<td class="px-5 py-3.5 font-mono text-xs text-gray-400 username">' + username + '</td>' +
        '<td class="px-5 py-3.5 font-medium nama">' + nama + '</td>' +
        '<td class="px-5 py-3.5 str">' + str + '</td>' +
        '<td class="px-5 py-3.5 hp">' + hp + '</td>' +
        '<td class="px-5 py-3.5"><span class="px-3 py-1 text-xs rounded-full ' + badgeClass + ' font-medium">' + status + '</span></td>' +
        '<td class="px-5 py-3.5 text-right"><button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button></td>' +
    '</tr>';

    document.getElementById('tableDokter').insertAdjacentHTML('beforeend', row);
    closeTambah();
}

// ========== MODAL EDIT ==========
let selectedRow = null;

function openEdit(btn) {
    selectedRow = btn.closest('tr');

    document.getElementById('eUsername').value = selectedRow.querySelector('.username').innerText;
    document.getElementById('eNama').value = selectedRow.querySelector('.nama').innerText;
    document.getElementById('eSTR').value = selectedRow.querySelector('.str').innerText;
    document.getElementById('eHP').value = selectedRow.querySelector('.hp').innerText;

    let statusSpan = selectedRow.querySelector('span');
    document.getElementById('eStatus').value = statusSpan.innerText.trim();
    document.getElementById('ePass').value = '';

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeEdit() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalEdit').classList.remove('flex');
    document.body.style.overflow = '';
}

function updateDokter() {
    let username = document.getElementById('eUsername').value;
    let nama = document.getElementById('eNama').value;
    let str = document.getElementById('eSTR').value;
    let hp = document.getElementById('eHP').value;
    let status = document.getElementById('eStatus').value;

    if (!username || !nama || !str || !hp) { alert("Username, Nama, STR, dan HP harus diisi!"); return; }

    selectedRow.querySelector('.username').innerText = username;
    selectedRow.querySelector('.nama').innerText = nama;
    selectedRow.querySelector('.str').innerText = str;
    selectedRow.querySelector('.hp').innerText = hp;

    let badgeClass = status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600';
    selectedRow.querySelector('span').className = 'px-3 py-1 text-xs rounded-full ' + badgeClass + ' font-medium';
    selectedRow.querySelector('span').innerText = status;

    closeEdit();
}

// ========== ESC UNTUK TUTUP MODAL ==========
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeTambah(); closeEdit(); }
});

</script>

@endsection