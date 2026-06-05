@extends('layouts.dashboard', [
    'pageTitle' => 'Data Dokter',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
<x-sidebar-admin />
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<div class="space-y-6">

    <div id="notificationDokter" class="hidden rounded-2xl border border-green-200 bg-green-50 text-green-700 px-4 py-3 text-sm shadow-sm"></div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-5 flex flex-col sm:flex-row justify-between gap-3">
        <div class="relative w-full sm:w-1/3">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input type="text" id="searchDokter" placeholder="Cari email, nama, STR, atau HP..."
                class="w-full bg-gray-50 rounded-xl pl-10 pr-9 py-2.5 text-sm focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 outline-none border border-gray-200">

            <button id="btnClearSearch" onclick="clearSearch()"
                class="absolute right-2 top-1/2 -translate-y-1/2 w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition hidden">
                ✕
            </button>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <h2 class="font-bold text-lg text-gray-800">Kelola Data Dokter</h2>
        <button onclick="openTambah()"
            class="bg-[#09637E] text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#074d61] transition">
            + Tambah Dokter
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[600px]">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-5 py-3.5">Email</th>
                        <th class="px-5 py-3.5">Nama</th>
                        <th class="px-5 py-3.5">No. STR</th>
                        <th class="px-5 py-3.5">No. HP</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableDokter" class="text-gray-700 divide-y divide-gray-100">
                    @foreach ($dokters as $dokter)
                    <tr data-dokter-id="{{ $dokter->id }}" class="hover:bg-gray-50 transition">

                        <td class="px-5 py-3.5 text-xs text-gray-500 email">
                            {{ $dokter->email }}
                        </td>

                        {{-- FIX UTAMA DI SINI --}}
                        <td class="px-5 py-3.5 font-medium nama">
                            {{ $dokter->nama }}
                        </td>

                        <td class="px-5 py-3.5 str">
                            {{ $dokter->str ?? '-' }}
                        </td>

                        <td class="px-5 py-3.5 hp">
                            {{ $dokter->no_hp ?? '-' }}
                        </td>

                        <td class="px-5 py-3.5">
                            @if ($dokter->status === 'Aktif')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">
                                    {{ $dokter->status }}
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-3.5 text-right">
                            <button onclick="openEdit(this)"
                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">
                                Edit
                            </button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="flex justify-center px-5 py-3 text-sm text-gray-500 border-t">
            Menampilkan {{ count($dokters) }} data dokter
        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div id="modalTambah" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40" onclick="closeTambah()"></div>

    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl">

            <div class="p-4 border-b flex justify-between">
                <h3>Tambah Dokter</h3>
                <button onclick="closeTambah()">✕</button>
            </div>

            <div class="p-4 space-y-3">

                <input id="tEmail" placeholder="Email">
                <input id="tNama" placeholder="Nama">
                <input id="tSTR" placeholder="STR">
                <input id="tHP" placeholder="HP">
                <input id="tPass" type="password" placeholder="Password">

                <select id="tStatus">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                    <option>Cuti</option>
                </select>

            </div>

            <div class="p-4 flex justify-end gap-2">
                <button onclick="closeTambah()">Batal</button>
                <button onclick="simpanDokter()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const storeUrl = '{{ route("data.dokter.store") }}';
const updateUrlBase = '{{ route("data.dokter.update", ["dokter" => 0]) }}';

let selRow = null;
let selRowId = null;

function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text, timer: 2000, showConfirmButton: false });
}

function openTambah() {
    document.getElementById('modalTambah').classList.remove('hidden');
}

function closeTambah() {
    document.getElementById('modalTambah').classList.add('hidden');
}

async function simpanDokter() {

    let email = document.getElementById('tEmail').value;
    let nama = document.getElementById('tNama').value;
    let str = document.getElementById('tSTR').value;
    let hp = document.getElementById('tHP').value;
    let password = document.getElementById('tPass').value;
    let status = document.getElementById('tStatus').value;

    const res = await fetch(storeUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email,
            name: nama,
            no_str: str,
            no_hp: hp,
            password,
            status
        })
    });

    const data = await res.json();

    document.getElementById('tableDokter').insertAdjacentHTML('beforeend', `
        <tr data-dokter-id="${data.id}">
            <td class="email">${data.email}</td>
            <td class="nama">${data.nama}</td>
            <td class="str">${data.str ?? '-'}</td>
            <td class="hp">${data.no_hp ?? '-'}</td>
            <td>${data.status}</td>
            <td><button onclick="openEdit(this)">Edit</button></td>
        </tr>
    `);

    closeTambah();
    showAlert('success', 'Berhasil', 'Dokter ditambahkan');
}

function openEdit(btn) {
    selRow = btn.closest('tr');
    selRowId = selRow.dataset.dokterId;
}

</script>

@endsection