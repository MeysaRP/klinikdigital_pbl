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
<div class="p-4 sm:p-6 bg-white rounded shadow">

    <div class="flex flex-col sm:flex-row justify-between mb-4 gap-3">
        <input type="text" id="searchJadwal" placeholder="Cari Nama Dokter..."
            class="border border-gray-300 px-3 py-2 w-full sm:w-1/3 rounded-lg bg-gray-50 focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">

        <button onclick="openTambah()"
            class="bg-[#09637E] text-white px-4 py-2 rounded-lg whitespace-nowrap">
            + Tambah Jadwal
        </button>
    </div>

    <div class="rounded overflow-hidden">

        <div class="overflow-x-auto">
        <table class="w-full text-sm min-w-[600px]">
            <thead class="bg-gray-100 text-center">
                <tr>
                    <th class="px-4 py-2 border-b border-gray-300">Dokter</th>
                    <th class="px-4 py-2 border-b border-gray-300">Hari</th>
                    <th class="px-4 py-2 border-b border-gray-300">Waktu</th>
                    <th class="px-4 py-2 border-b border-gray-300">Kuota</th>
                    <th class="px-4 py-2 border-b border-gray-300">Status</th>
                    <th class="px-4 py-2 border-b border-gray-300">Aksi</th>
                </tr>
            </thead>

            <tbody id="tableJadwal">
                @foreach($jadwal as $j)
                <tr class="text-center hover:bg-gray-50 border-b border-gray-100">
                    <td class="px-4 py-2 nama">{{ $j['dokter'] }}</td>
                    <td class="px-4 py-2">{{ $j['hari'] }}</td>
                    <td class="px-4 py-2">{{ $j['waktu'] }}</td>
                    <td class="px-4 py-2">{{ $j['kuota'] }}</td>
                    <td class="px-4 py-2">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($j['status']=='Aktif') bg-green-100 text-green-600
                        @elseif($j['status']=='Nonaktif') bg-red-100 text-red-600
                        @else bg-yellow-100 text-yellow-600 @endif">
                            {{ $j['status'] }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <button onclick="openEdit(this)"
                            class="bg-[#09637E] text-white px-3 py-1 rounded text-xs">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <div class="flex justify-end p-2 gap-2 text-sm" id="paginationJadwal">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
        </div>

    </div>

</div>

<style>
.page-btn{
    width: 28px;
    height: 28px;
    border: none;
    background-color: #f3f4f6;
    color: #374151;
    border-radius: 6px;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.page-btn:hover{ background-color: #e5e7eb; }
.page-btn.active{ background-color: #09637E; color: white; }
</style>

<!-- MODAL TAMBAH -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-[400px] p-6 rounded-lg shadow-lg mx-4">
        <h2 class="text-center font-semibold mb-4">Tambah Jadwal Praktik</h2>
        <div class="space-y-3 text-sm">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Pilih Dokter</label>
                <select id="tDokter" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option value="" disabled selected>-- Pilih Dokter --</option>
                    <option value="Dr. Aditya">Dr. Aditya</option>
                    <option value="Dr. Citra">Dr. Citra</option>
                    <option value="Dr. Budi">Dr. Budi</option>
                    <option value="Dr. Siti">Dr. Siti</option>
                    <option value="Dr. Erwin">Dr. Erwin</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Hari Praktik</label>
                <select id="tHari" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
                </select>
            </div>
            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-1 font-medium text-gray-700">Jam Mulai</label>
                    <select id="tMulai" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                        <option>08:00</option><option>09:00</option><option>10:00</option><option>11:00</option><option>13:00</option><option>14:00</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block mb-1 font-medium text-gray-700">Jam Selesai</label>
                    <select id="tSelesai" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                        <option>09:00</option><option>10:00</option><option>11:00</option><option>12:00</option><option>15:00</option><option>16:00</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Kuota Pasien</label>
                <select id="tKuota" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>1</option><option>5</option><option>10</option><option>15</option><option>20</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Status</label>
                <select id="tStatus" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>Aktif</option><option>Nonaktif</option><option>Cuti</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center gap-3 mt-6">
            <button onclick="closeTambah()" class="border border-gray-300 px-6 py-2 rounded text-gray-700 hover:bg-gray-50 transition">Batal</button>
            <button onclick="simpanJadwal()" class="bg-[#09637E] text-white px-6 py-2 rounded hover:bg-[#075066] transition">Simpan</button>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-[400px] p-6 rounded-lg shadow-lg mx-4">
        <h2 class="text-center font-semibold mb-4">Edit Jadwal</h2>
        <div class="space-y-3 text-sm">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Pilih Dokter</label>
                <input id="eDokter" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Hari Praktik</label>
                <select id="eHari" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
                </select>
            </div>
            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-1 font-medium text-gray-700">Jam Mulai</label>
                    <select id="eMulai" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                        <option>08:00</option><option>09:00</option><option>10:00</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label class="block mb-1 font-medium text-gray-700">Jam Selesai</label>
                    <select id="eSelesai" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                        <option>10:00</option><option>11:00</option><option>12:00</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Kuota Pasien</label>
                <select id="eKuota" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>1</option><option>5</option><option>10</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Status</label>
                <select id="eStatus" class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none focus:border-[#09637E] focus:ring-1 focus:ring-[#09637E]">
                    <option>Aktif</option><option>Nonaktif</option><option>Cuti</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center gap-3 mt-6">
            <button onclick="closeEdit()" class="border border-gray-300 px-6 py-2 rounded text-gray-700 hover:bg-gray-50 transition">Batal</button>
            <button onclick="updateJadwal()" class="bg-[#09637E] text-white px-6 py-2 rounded hover:bg-[#075066] transition">Simpan</button>
        </div>
    </div>
</div>

<script>
document.getElementById('searchJadwal').addEventListener('keyup', function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll('#tableJadwal tr').forEach(row=>{
        let nama = row.querySelector('.nama').innerText.toLowerCase();
        row.style.display = nama.includes(val) ? '' : 'none';
    });
});

document.querySelectorAll('#paginationJadwal .page-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelectorAll('#paginationJadwal .page-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

function getStatusBadge(status) {
    if (status === 'Aktif') return '<span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600">' + status + '</span>';
    else if (status === 'Nonaktif') return '<span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">' + status + '</span>';
    else return '<span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-600">' + status + '</span>';
}

function openTambah(){ modalTambah.classList.replace('hidden','flex'); }
function closeTambah(){ modalTambah.classList.replace('flex','hidden'); }

function simpanJadwal(){
    let row = `<tr class="text-center hover:bg-gray-50 border-b border-gray-100">
        <td class="px-4 py-2 nama">${tDokter.value}</td>
        <td class="px-4 py-2">${tHari.value}</td>
        <td class="px-4 py-2">${tMulai.value} - ${tSelesai.value}</td>
        <td class="px-4 py-2">${tKuota.value}</td>
        <td class="px-4 py-2">${getStatusBadge(tStatus.value)}</td>
        <td class="px-4 py-2"><button onclick="openEdit(this)" class="bg-[#09637E] text-white px-3 py-1 rounded text-xs">Edit</button></td>
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