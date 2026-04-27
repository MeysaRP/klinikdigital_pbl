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
    <div class="bg-white rounded-lg p-4 flex flex-col md:flex-row justify-between gap-3 shadow-sm">

        <input type="text" id="searchDokter" placeholder="Cari Dokter..."
            class="bg-gray-100 rounded px-3 py-2 text-sm w-full md:w-1/3 focus:ring-2 focus:ring-primary outline-none border-none">

        <div class="flex items-center gap-2 text-sm">
            <span>Tampilkan</span>
            <select class="bg-gray-100 rounded px-3 py-1 pr-8 outline-none focus:ring-2 focus:ring-primary border-none">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span>entri</span>
        </div>

    </div>

    <!-- HEADER & BUTTON -->
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">
            Kelola Data Dokter
        </h2>
        <button onclick="openTambah()" class="bg-primary text-white px-4 py-2 rounded text-sm hover:bg-opacity-90 transition">
            + Tambah Dokter
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg overflow-hidden shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center border-collapse">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">ID DOKTER</th>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">NAMA</th>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">NO. STR</th>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">NO. HP</th>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">STATUS</th>
                        <th class="p-2 font-semibold text-gray-700 uppercase" style="border: none !important;">AKSI</th>
                    </tr>
                </thead>

                <tbody id="tableDokter">

                    <tr>
                        <td class="p-2" style="border: none !important;">D01</td>
                        <td class="p-2 nama" style="border: none !important;">Dr. Sarah</td>
                        <td class="p-2" style="border: none !important;">1234567</td>
                        <td class="p-2" style="border: none !important;">081234567</td>
                        <td class="p-2" style="border: none !important;">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">AKTIF</span>
                        </td>
                        <td class="p-2" style="border: none !important;">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs text-blue-600 font-semibold hover:bg-blue-200 transition">Edit</button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2" style="border: none !important;">D02</td>
                        <td class="p-2 nama" style="border: none !important;">Dr. Budi</td>
                        <td class="p-2" style="border: none !important;">1234567</td>
                        <td class="p-2" style="border: none !important;">081234567</td>
                        <td class="p-2" style="border: none !important;">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">AKTIF</span>
                        </td>
                        <td class="p-2" style="border: none !important;">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs text-blue-600 font-semibold hover:bg-blue-200 transition">Edit</button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2" style="border: none !important;">D03</td>
                        <td class="p-2 nama" style="border: none !important;">Dr. Rina</td>
                        <td class="p-2" style="border: none !important;">1234567</td>
                        <td class="p-2" style="border: none !important;">081234567</td>
                        <td class="p-2" style="border: none !important;">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-semibold">NONAKTIF</span>
                        </td>
                        <td class="p-2" style="border: none !important;">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs text-blue-600 font-semibold hover:bg-blue-200 transition">Edit</button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center p-3 text-sm text-gray-500">
            <span></span>
            <div class="flex gap-2" id="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
            </div>
        </div>

    </div>

</div>

<!-- MODAL TAMBAH DOKTER (Warna Sesuai Website) -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black opacity-50 transition-opacity" onclick="closeTambah()"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-lg shadow-xl overflow-hidden">
        
        <!-- Header Putih -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Tambah Dokter Baru</h3>
            <button onclick="closeTambah()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold leading-none">&times;</button>
        </div>

        <!-- Body Input Kosong -->
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Nama Lengkap</label>
                <input type="text" id="tNama" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">No. STR</label>
                <input type="text" id="tSTR" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">No. HP</label>
                <input type="text" id="tHP" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Password</label>
                <input type="password" id="tPass" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Status</label>
                <select id="tStatus" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="AKTIF">Aktif</option>
                    <option value="NONAKTIF">Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- Footer (Tombol Primary) -->
        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
            <button onclick="closeTambah()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-50 transition">Batal</button>
            <!-- Warna diubah ke bg-primary sesuai website -->
            <button onclick="simpanDokter()" class="bg-primary text-white px-4 py-2 rounded text-sm hover:bg-opacity-90 transition">Simpan Data</button>
        </div>
    </div>
</div>

<!-- MODAL EDIT DOKTER (Warna Sesuai Website) -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black opacity-50 transition-opacity" onclick="closeEdit()"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-lg shadow-xl overflow-hidden">
        
        <!-- Header Putih -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Edit Data Dokter</h3>
            <button onclick="closeEdit()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold leading-none">&times;</button>
        </div>

        <!-- Body Input Terisi -->
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Nama Lengkap</label>
                <input type="text" id="eNama" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">No. STR</label>
                <input type="text" id="eSTR" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">No. HP</label>
                <input type="text" id="eHP" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Password</label>
                <input type="password" id="ePass" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Kosongkan jika tidak diganti">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Status</label>
                <select id="eStatus" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="AKTIF">Aktif</option>
                    <option value="NONAKTIF">Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- Footer (Tombol Primary) -->
        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
            <button onclick="closeEdit()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-50 transition">Batal</button>
            <!-- Warna diubah ke bg-primary sesuai website -->
            <button onclick="updateDokter()" class="bg-primary text-white px-4 py-2 rounded text-sm hover:bg-opacity-90 transition">Simpan Data</button>
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
}
.page-btn.active{
    background-color: #09637E;
    color: white;
}
</style>

<!-- SCRIPT -->
<script>

// SEARCH
document.getElementById('searchDokter').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    document.querySelectorAll('#tableDokter tr').forEach(row => {
        let nama = row.querySelector('.nama').innerText.toLowerCase();
        row.style.display = nama.includes(value) ? '' : 'none';
    });
});

// PAGINATION ACTIVE
document.querySelectorAll('.page-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// MODAL TAMBAH
function openTambah(){ 
    // Reset semua kolom jadi KOSONG
    document.getElementById('tNama').value = '';
    document.getElementById('tSTR').value = '';
    document.getElementById('tHP').value = '';
    document.getElementById('tPass').value = '';
    document.getElementById('tStatus').value = 'AKTIF';
    
    modalTambah.classList.remove('hidden'); 
    modalTambah.classList.add('flex');
}

function closeTambah(){ 
    modalTambah.classList.add('hidden'); 
    modalTambah.classList.remove('flex');
}

// SIMPAN
function simpanDokter(){
    let nama = document.getElementById('tNama').value;
    let str = document.getElementById('tSTR').value;
    let hp = document.getElementById('tHP').value;
    let status = document.getElementById('tStatus').value;

    if(!nama || !str || !hp) { alert("Nama, STR, dan HP harus diisi!"); return; }

    let badgeClass = status == 'AKTIF' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';

    let row = `
    <tr>
        <td class="p-2" style="border: none !important;">D0${Math.floor(Math.random()*100)}</td>
        <td class="p-2 nama" style="border: none !important;">${nama}</td>
        <td class="p-2" style="border: none !important;">${str}</td>
        <td class="p-2" style="border: none !important;">${hp}</td>
        <td class="p-2" style="border: none !important;">
            <span class="${badgeClass} px-2 py-1 rounded text-xs font-semibold">${status}</span>
        </td>
        <td class="p-2" style="border: none !important;">
            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs text-blue-600 font-semibold hover:bg-blue-200 transition">Edit</button>
        </td>
    </tr>`;
    
    tableDokter.insertAdjacentHTML('beforeend', row);
    closeTambah();
}

// EDIT
let selectedRow;

function openEdit(btn){
    selectedRow = btn.closest('tr');
    
    document.getElementById('eNama').value = selectedRow.querySelector('.nama').innerText;
    document.getElementById('eSTR').value = selectedRow.children[2].innerText;
    document.getElementById('eHP').value = selectedRow.children[3].innerText;
    
    let statusText = selectedRow.children[4].innerText.trim();
    document.getElementById('eStatus').value = statusText;
    document.getElementById('ePass').value = ''; 

    modalEdit.classList.remove('hidden');
    modalEdit.classList.add('flex');
}

function closeEdit(){ 
    modalEdit.classList.add('hidden'); 
    modalEdit.classList.remove('flex');
}

function updateDokter(){
    let nama = document.getElementById('eNama').value;
    let str = document.getElementById('eSTR').value;
    let hp = document.getElementById('eHP').value;
    let status = document.getElementById('eStatus').value;

    if(!nama || !str || !hp) { alert("Nama, STR, dan HP harus diisi!"); return; }

    selectedRow.querySelector('.nama').innerText = nama;
    selectedRow.children[2].innerText = str;
    selectedRow.children[3].innerText = hp;
    
    let badgeClass = status == 'AKTIF' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
    selectedRow.children[4].innerHTML = `<span class="${badgeClass} px-2 py-1 rounded text-xs font-semibold">${status}</span>`;
    
    closeEdit();
}

</script>

@endsection