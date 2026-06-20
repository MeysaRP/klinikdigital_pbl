@extends('layouts.dashboard', [
    'pageTitle' => 'Data Dokter',
    'userName' => 'Halo, ' . (session('name') ?? 'Admin'),
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

            <input type="text" id="searchDokter" placeholder="Cari nama dokter..."
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

                        <td class="px-5 py-3.5 font-medium nama">
                            {{ $dokter->nama }}
                        </td>

                        <td class="px-5 py-3.5 str">
                            {{ $dokter->str ?? '-' }}
                        </td>

                        <td class="px-5 py-3.5 hp">
                            {{ $dokter->no_hp ?? '-' }}
                        </td>

                        <td class="px-5 py-3.5 status">
                            @if ($dokter->status === 'Aktif')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">Nonaktif</span>
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

        <div class="flex justify-center px-5 py-3 text-sm text-gray-500">
            Menampilkan {{ count($dokters) }} data dokter
        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH DOKTER ================= --}}
<div id="modalTambah"
    class="fixed inset-0 z-50 hidden items-start sm:items-center justify-center bg-black/40 p-4 overflow-y-auto">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[calc(100vh-4rem)] overflow-y-auto">

        <div class="px-6 py-5">
            <h3 class="text-center font-bold text-lg">
                Tambah Dokter
            </h3>
        </div>

        <div class="p-6 space-y-4">

            <div>
                <label class="block text-sm mb-1">Email</label>
                <input id="tEmail"
                    type="email"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: sarahwijaya@gmail.com">
            </div>

            <div>
                <label class="block text-sm mb-1">Nama Dokter</label>
                <input id="tNama"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: sarah wijaya">
            </div>

            <div>
                <label class="block text-sm mb-1">No. STR</label>
                <input id="tSTR"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: STR001">
            </div>

            <div>
                <label class="block text-sm mb-1">No. HP</label>
                <input id="tHP"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: 081234567899">
            </div>

            <div>
                <label class="block text-sm mb-1">Password</label>

                <div class="relative">
                    <input id="tPass"
                        type="password"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                        placeholder="Masukkan Password">

                    <button type="button"
                        onclick="togglePassword('tPass', 'iconTambah')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="iconTambah" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <div class="flex justify-center gap-4 p-6 pt-0">

            <button
                onclick="closeTambah()"
                class="bg-gray-100 text-gray-600 px-6 py-2 rounded-xl hover:bg-gray-200 transition font-medium">
                Batal
            </button>

            <button
                onclick="simpanDokter()"
                class="bg-[#09637E] text-white px-6 py-2 rounded-xl hover:bg-[#074d61] transition font-medium">
                Simpan
            </button>

        </div>

    </div>
</div>

{{-- ================= MODAL EDIT DOKTER ================= --}}
<div id="modalEdit"
    class="fixed inset-0 z-50 hidden items-start sm:items-center justify-center bg-black/40 p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[calc(100vh-4rem)] overflow-y-auto">
        <div class="px-6 py-5">
            <h3 class="text-center font-bold text-lg">
                Edit Dokter
            </h3>
        </div>
        <div class="p-6 space-y-4">
            <input type="hidden" id="eId">
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input id="eEmail"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
            </div>
            <div>
                <label class="block text-sm mb-1">Nama Dokter</label>
                <input id="eNama"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
            </div>
            <div>
                <label class="block text-sm mb-1">No STR</label>
                <input id="eSTR"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
            </div>
            <div>
                <label class="block text-sm mb-1">No HP</label>
                <input id="eHP"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
            </div>
            <div>
                <label class="block text-sm mb-1">Password Baru (Opsional)</label>
                <div class="relative">
                    <input id="ePass"
                        type="password"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                        placeholder="Kosongkan jika tidak diubah">
                    
                    <button type="button"
                        onclick="togglePassword('ePass', 'iconEdit')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="iconEdit" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select id="eStatus"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center gap-4 p-6 pt-0">
            <button onclick="closeEdit()"
                class="bg-gray-100 text-gray-600 px-6 py-2 rounded-xl hover:bg-gray-200 transition font-medium">
                Batal
            </button>
            <button onclick="updateDokter()"
                class="bg-[#09637E] text-white px-6 py-2 rounded-xl hover:bg-[#074d61] transition font-medium">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const storeUrl = '{{ route("data.dokter.store") }}';
const updateUrlBase = '{{ route("data.dokter.update", ["dokter" => 0]) }}';

let selRow = null;
let selRowId = null;

document.getElementById('searchDokter').addEventListener('input', filterDokter);

function filterDokter() {
    const query = document.getElementById('searchDokter').value.trim().toLowerCase();
    const rows = document.querySelectorAll('#tableDokter tr');
    const clearButton = document.getElementById('btnClearSearch');

    clearButton.classList.toggle('hidden', query.length === 0);

    rows.forEach(row => {
        const name = row.querySelector('.nama')?.innerText.trim().toLowerCase() ?? '';
        row.style.display = name.includes(query) ? '' : 'none';
    });
}

function clearSearch() {
    document.getElementById('searchDokter').value = '';
    document.getElementById('btnClearSearch').classList.add('hidden');
    document.querySelectorAll('#tableDokter tr').forEach(row => row.style.display = '');
}

function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text, timer: 2000, showConfirmButton: false });
}

function openTambah() {
    document.getElementById('modalTambah')
        .classList.remove('hidden');

    document.getElementById('modalTambah')
        .classList.add('flex');
}

function closeTambah() {
    document.getElementById('modalTambah')
        .classList.add('hidden');

    document.getElementById('modalTambah')
        .classList.remove('flex');
}

// Fungsi toggle password dengan ikon mata
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        // Ubah ikon menjadi mata coret (password terlihat)
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l18 18"></path>';
    } else {
        input.type = 'password';
        // Ubah ikon menjadi mata biasa (password tersembunyi)
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
    }
}

async function simpanDokter() {

    let email = document.getElementById('tEmail').value;
    let nama = document.getElementById('tNama').value;
    let str = document.getElementById('tSTR').value;
    let hp = document.getElementById('tHP').value;
    let password = document.getElementById('tPass').value;

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
            password
        })
    });

    const data = await res.json();

    document.getElementById('tableDokter').insertAdjacentHTML('beforeend', `
<tr data-dokter-id="${data.id}" class="hover:bg-gray-50 transition">

    <td class="px-5 py-3.5 text-xs text-gray-500 email">
        ${data.email}
    </td>

    <td class="px-5 py-3.5 font-medium nama">
        ${data.nama}
    </td>

    <td class="px-5 py-3.5 str">
        ${data.str ?? '-'}
    </td>

    <td class="px-5 py-3.5 hp">
        ${data.no_hp ?? '-'}
    </td>

<td class="px-5 py-3.5 status">
        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
            ${data.status}
        </span>
    </td>

    <td class="px-5 py-3.5 text-right">
        <button onclick="openEdit(this)"
            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">
            Edit
        </button>
    </td>

</tr>
`);

    closeTambah();
    showAlert('success', 'Berhasil', 'Dokter ditambahkan');
}

function closeEdit() {

    document.getElementById('modalEdit')
        .classList.add('hidden');

    document.getElementById('modalEdit')
        .classList.remove('flex');
}

function openEdit(btn) {

    selRow = btn.closest('tr');
    selRowId = selRow.dataset.dokterId;

    document.getElementById('eId').value = selRowId;

    document.getElementById('eEmail').value =
        selRow.querySelector('.email').innerText.trim();

    document.getElementById('eNama').value =
        selRow.querySelector('.nama').innerText.trim();

    document.getElementById('eSTR').value =
        selRow.querySelector('.str').innerText.trim();

    document.getElementById('eHP').value =
        selRow.querySelector('.hp').innerText.trim();

    document.getElementById('eStatus').value =
        selRow.querySelector('.status').innerText.trim();

    document.getElementById('modalEdit')
        .classList.remove('hidden');

    document.getElementById('modalEdit')
        .classList.add('flex');
}

async function updateDokter() {

    const id = document.getElementById('eId').value;

    const email = document.getElementById('eEmail').value;
    const nama = document.getElementById('eNama').value;
    const str = document.getElementById('eSTR').value;
    const hp = document.getElementById('eHP').value;
    const status = document.getElementById('eStatus').value;
    const password = document.getElementById('ePass').value;

    try {

        const res = await fetch(
            updateUrlBase.replace('/0', '/' + id),
            {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    name: nama,
                    no_str: str,
                    no_hp: hp,
                    status: status,
                    password: password
                })
            }
        );

        const data = await res.json();

        if (!res.ok) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data dokter gagal diperbarui'
            });

            console.log(data);
            return;
        }

        // Update tabel tanpa refresh
        selRow.querySelector('.email').innerText = data.email;
        selRow.querySelector('.nama').innerText = data.nama;
        selRow.querySelector('.str').innerText = data.str ?? '-';
        selRow.querySelector('.hp').innerText = data.no_hp ?? '-';
        selRow.querySelector('.status').innerHTML = data.status === 'Aktif'
            ? '<span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>'
            : '<span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">Nonaktif</span>';

        closeEdit();

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data dokter berhasil diperbarui',
            timer: 2000,
            showConfirmButton: false
        });

    } catch (err) {

        console.error(err);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat mengupdate data'
        });
    }
}
</script>

@endsection