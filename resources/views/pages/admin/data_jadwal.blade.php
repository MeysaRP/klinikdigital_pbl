@extends('layouts.dashboard', [
    'pageTitle' => 'Data Jadwal',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
<x-sidebar-admin />
@endsection

@section('content')
<div class="p-6 bg-white rounded shadow">

    <h2 class="text-lg font-semibold mb-4">DATA JADWAL</h2>

    <div class="flex justify-between mb-4">
        <input type="text" id="searchJadwal" placeholder="Cari Nama Dokter..."
            class="border px-3 py-1 w-1/3 rounded">

        <button onclick="openTambah()"
            class="bg-[#09637E] text-white px-4 py-1 rounded">
            + Tambah Jadwal
        </button>
    </div>

    <div class="border rounded overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-center">
                <tr>
                    <th class="border px-2 py-2">Dokter</th>
                    <th class="border px-2 py-2">Hari</th>
                    <th class="border px-2 py-2">Waktu</th>
                    <th class="border px-2 py-2">Kuota</th>
                    <th class="border px-2 py-2">Status</th>
                    <th class="border px-2 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableJadwal">
                @foreach($jadwal as $j)
                <tr class="text-center">
                    <td class="border px-2 py-1 nama">{{ $j['dokter'] }}</td>
                    <td class="border px-2 py-1">{{ $j['hari'] }}</td>
                    <td class="border px-2 py-1">{{ $j['waktu'] }}</td>
                    <td class="border px-2 py-1">{{ $j['kuota'] }}</td>
                    <td class="border px-2 py-1">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($j['status']=='Aktif') bg-green-100 text-green-600
                        @elseif($j['status']=='Nonaktif') bg-red-100 text-red-600
                        @else bg-yellow-100 text-yellow-600 @endif">
                            {{ $j['status'] }}
                        </span>
                    </td>
                    <td class="border px-2 py-1">
                        <button onclick="openEdit(this)"
                            class="bg-[#09637E] text-white px-3 py-1 rounded text-xs">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- PAGINATION (UPDATED) -->
        <div class="flex justify-end p-3 gap-2 text-sm" id="paginationJadwal">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
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

<!-- MODAL TAMBAH -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-[400px] p-6 rounded-lg shadow-lg">

        <h2 class="text-center font-semibold mb-4">Tambah Jadwal Praktik</h2>

        <div class="space-y-3 text-sm">

            <div>
                <label class="block mb-1 font-medium">Nama Dokter</label>
                <input id="tDokter" placeholder="Masukkan nama dokter"
                    class="w-full border px-2 py-1 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Hari Praktik</label>
                <select id="tHari" class="w-full border px-2 py-1 rounded">
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                </select>
            </div>

            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-1 font-medium">Jam Mulai</label>
                    <select id="tMulai" class="w-full border px-2 py-1 rounded">
                        <option>08:00</option>
                        <option>09:00</option>
                        <option>10:00</option>
                    </select>
                </div>

                <div class="w-1/2">
                    <label class="block mb-1 font-medium">Jam Selesai</label>
                    <select id="tSelesai" class="w-full border px-2 py-1 rounded">
                        <option>10:00</option>
                        <option>11:00</option>
                        <option>12:00</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kuota Pasien</label>
                <select id="tKuota" class="w-full border px-2 py-1 rounded">
                    <option>1</option>
                    <option>5</option>
                    <option>10</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select id="tStatus" class="w-full border px-2 py-1 rounded">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                    <option>Cuti</option>
                </select>
            </div>

        </div>

        <div class="flex justify-center gap-3 mt-5">
            <button onclick="closeTambah()" class="border px-4 py-1 rounded">
                Batal
            </button>
            <button onclick="simpanJadwal()" class="bg-[#09637E] text-white px-4 py-1 rounded">
                Simpan
            </button>
        </div>

    </div>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-[400px] p-6 rounded-lg shadow-lg">

        <h2 class="text-center font-semibold mb-4">Edit Jadwal</h2>

        <div class="space-y-3 text-sm">

            <div>
                <label class="block mb-1 font-medium">Nama Dokter</label>
                <input id="eDokter" class="w-full border px-2 py-1 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Hari</label>
                <select id="eHari" class="w-full border px-2 py-1 rounded">
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                </select>
            </div>

            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-1 font-medium">Jam Mulai</label>
                    <select id="eMulai" class="w-full border px-2 py-1 rounded">
                        <option>08:00</option>
                        <option>09:00</option>
                    </select>
                </div>

                <div class="w-1/2">
                    <label class="block mb-1 font-medium">Jam Selesai</label>
                    <select id="eSelesai" class="w-full border px-2 py-1 rounded">
                        <option>10:00</option>
                        <option>11:00</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kuota Pasien</label>
                <select id="eKuota" class="w-full border px-2 py-1 rounded">
                    <option>1</option>
                    <option>5</option>
                    <option>10</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select id="eStatus" class="w-full border px-2 py-1 rounded">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                    <option>Cuti</option>
                </select>
            </div>

        </div>

        <div class="flex justify-center gap-3 mt-5">
            <button onclick="closeEdit()" class="border px-4 py-1 rounded">
                Batal
            </button>
            <button onclick="updateJadwal()" class="bg-[#09637E] text-white px-4 py-1 rounded">
                Simpan
            </button>
        </div>

    </div>
</div>

<script>
// SEARCH
document.getElementById('searchJadwal').addEventListener('keyup', function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll('#tableJadwal tr').forEach(row=>{
        let nama = row.querySelector('.nama').innerText.toLowerCase();
        row.style.display = nama.includes(val) ? '' : 'none';
    });
});

// PAGINATION ACTIVE
document.querySelectorAll('#paginationJadwal .page-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelectorAll('#paginationJadwal .page-btn')
            .forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// fungsi lain tetap
function openTambah(){ modalTambah.classList.replace('hidden','flex'); }
function closeTambah(){ modalTambah.classList.replace('flex','hidden'); }

function simpanJadwal(){
    let row = `
    <tr class="text-center">
        <td class="border px-2 py-1 nama">${tDokter.value}</td>
        <td class="border px-2 py-1">${tHari.value}</td>
        <td class="border px-2 py-1">${tMulai.value} - ${tSelesai.value}</td>
        <td class="border px-2 py-1">${tKuota.value}</td>
        <td class="border px-2 py-1">${getStatusBadge(tStatus.value)}</td>
        <td class="border px-2 py-1">
            <button onclick="openEdit(this)" class="bg-[#09637E] text-white px-3 py-1 rounded text-xs">Edit</button>
        </td>
    </tr>`;
    tableJadwal.insertAdjacentHTML('beforeend', row);
    closeTambah();
}

let selectedRow;
function openEdit(btn){
    selectedRow = btn.closest('tr');
    eDokter.value = selectedRow.children[0].innerText;
    eStatus.value = selectedRow.children[4].innerText.trim();
    modalEdit.classList.replace('hidden','flex');
}

function closeEdit(){ modalEdit.classList.replace('flex','hidden'); }

function updateJadwal(){
    selectedRow.children[0].innerText = eDokter.value;
    selectedRow.children[4].innerHTML = getStatusBadge(eStatus.value);
    closeEdit();
}
</script>

@endsection