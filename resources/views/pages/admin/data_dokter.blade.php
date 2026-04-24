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

    <!-- HEADER -->
    <h2 class="text-xl font-semibold text-gray-800 uppercase">
        Data Dokter
    </h2>

    <!-- FILTER -->
    <div class="bg-white border rounded-lg p-4 flex flex-col md:flex-row justify-between gap-3">

        <input type="text" id="searchDokter" placeholder="Cari Dokter..."
            class="border rounded px-3 py-2 text-sm w-full md:w-1/3 focus:ring-2 focus:ring-primary">

        <div class="flex items-center gap-2 text-sm">
            <span>Tampilkan</span>
            <select class="border rounded px-3 py-1 pr-8">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span>entri</span>
        </div>

    </div>

    <!-- BUTTON -->
    <div class="flex justify-end">
        <button onclick="openTambah()" class="bg-primary text-white px-4 py-2 rounded text-sm">
            + Tambah Dokter
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-lg overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center border-collapse">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">No. STR</th>
                        <th class="p-2 border">No. HP</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableDokter">

                    <tr>
                        <td class="p-2 border">D01</td>
                        <td class="p-2 border nama">Dr. Sarah</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Aktif</span>
                        </td>
                        <td class="p-2 border">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs">Edit</button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D02</td>
                        <td class="p-2 border nama">Dr. Budi</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Aktif</span>
                        </td>
                        <td class="p-2 border">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs">Edit</button>
                        </td>
                    </tr>

                    <tr>
                        <td class="p-2 border">D03</td>
                        <td class="p-2 border nama">Dr. Rina</td>
                        <td class="p-2 border">1234567</td>
                        <td class="p-2 border">081234567</td>
                        <td class="p-2 border">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">Nonaktif</span>
                        </td>
                        <td class="p-2 border">
                            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs">Edit</button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center p-3 text-sm text-gray-500">

            <span>Menampilkan data dokter</span>

            <!-- PAGINATION -->
            <div class="flex gap-2" id="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
            </div>

        </div>

    </div>

</div>

<!-- STYLE PAGINATION -->
<style>
.page-btn{
    width: 32px;
    height: 32px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.page-btn.active{
    background-color: #09637E;
    color: white;
    border-color: #09637E;
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
function openTambah(){ modalTambah.classList.replace('hidden','flex'); }
function closeTambah(){ modalTambah.classList.replace('flex','hidden'); }

// SIMPAN
function simpanDokter(){
    let row = `
    <tr>
        <td class="p-2 border">D0${Math.floor(Math.random()*100)}</td>
        <td class="p-2 border nama">${tNama.value}</td>
        <td class="p-2 border">${tSTR.value}</td>
        <td class="p-2 border">${tHP.value}</td>
        <td class="p-2 border">
            <span class="${tStatus.value=='Aktif'?'bg-green-100 text-green-600':'bg-red-100 text-red-600'} px-2 py-1 rounded text-xs">${tStatus.value}</span>
        </td>
        <td class="p-2 border">
            <button onclick="openEdit(this)" class="bg-blue-100 px-3 py-1 rounded text-xs">Edit</button>
        </td>
    </tr>`;
    tableDokter.insertAdjacentHTML('beforeend', row);
    closeTambah();
}

// EDIT
let selectedRow;

function openEdit(btn){
    selectedRow = btn.closest('tr');
    eNama.value = selectedRow.children[1].innerText;
    eSTR.value = selectedRow.children[2].innerText;
    eHP.value = selectedRow.children[3].innerText;
    eStatus.value = selectedRow.children[4].innerText.trim();
    modalEdit.classList.replace('hidden','flex');
}

function closeEdit(){ modalEdit.classList.replace('flex','hidden'); }

function updateDokter(){
    selectedRow.children[1].innerText = eNama.value;
    selectedRow.children[2].innerText = eSTR.value;
    selectedRow.children[3].innerText = eHP.value;
    selectedRow.children[4].innerHTML =
        `<span class="${eStatus.value=='Aktif'?'bg-green-100 text-green-600':'bg-red-100 text-red-600'} px-2 py-1 rounded text-xs">${eStatus.value}</span>`;
    closeEdit();
}

</script>

@endsection