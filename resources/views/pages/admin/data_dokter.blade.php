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

                    <!-- BARIS UNTUK PESAN DATA TIDAK DITEMUKAN -->
                    <tr id="rowEmptyDokter" class="hidden">
                        <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-400">
                            Data tidak ditemukan
                        </td>
                    </tr>
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
                <p id="err-tEmail" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label class="block text-sm mb-1">Nama Dokter</label>
                <input id="tNama"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: sarah wijaya">
                <p id="err-tNama" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label class="block text-sm mb-1">No. STR</label>
                <input id="tSTR"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: STR001">
                <p id="err-tSTR" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div>
                <label class="block text-sm mb-1">No. HP</label>
                <input id="tHP"
                    type="text"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition"
                    placeholder="contoh: 081234567899">
                <p id="err-tHP" class="text-red-500 text-xs mt-1 hidden"></p>
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
                <p id="err-tPass" class="text-red-500 text-xs mt-1 hidden"></p>
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
                <p id="err-eEmail" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>
            <div>
                <label class="block text-sm mb-1">Nama Dokter</label>
                <input id="eNama"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                <p id="err-eNama" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>
            <div>
                <label class="block text-sm mb-1">No STR</label>
                <input id="eSTR"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                <p id="err-eSTR" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>
            <div>
                <label class="block text-sm mb-1">No HP</label>
                <input id="eHP"
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                <p id="err-eHP" class="text-red-500 text-xs mt-1 hidden"></p>
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
                <p id="err-ePass" class="text-red-500 text-xs mt-1 hidden"></p>
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
    const rows = document.querySelectorAll('#tableDokter tr:not(#rowEmptyDokter)');
    const clearButton = document.getElementById('btnClearSearch');
    const emptyRow = document.getElementById('rowEmptyDokter');

    clearButton.classList.toggle('hidden', query.length === 0);

    let adaYangTampil = false;

    rows.forEach(row => {
        const name = row.querySelector('.nama')?.innerText.trim().toLowerCase() ?? '';
        if (name.includes(query)) {
            row.style.display = '';
            adaYangTampil = true;
        } else {
            row.style.display = 'none';
        }
    });

    // Tampilkan/sembunyikan teks "Data tidak ditemukan"
    if (!adaYangTampil && query.length > 0) {
        emptyRow.classList.remove('hidden');
    } else {
        emptyRow.classList.add('hidden');
    }
}

function clearSearch() {
    document.getElementById('searchDokter').value = '';
    document.getElementById('btnClearSearch').classList.add('hidden');
    document.getElementById('rowEmptyDokter').classList.add('hidden');
    document.querySelectorAll('#tableDokter tr:not(#rowEmptyDokter)').forEach(row => row.style.display = '');
}

// === FUNGSI UNTUK MENAMPILKAN ERROR DI BAWAH INPUT SECARA REALTIME ===
function clearErrors(ids) {
    ids.forEach(id => {
        const input = document.getElementById(id);
        const errEl = document.getElementById('err-' + id);
        if (input) input.classList.remove('border-red-500');
        if (errEl) {
            errEl.textContent = '';
            errEl.classList.add('hidden');
        }
    });
}

function displayErrors(errors, mapping) {
    for (const [field, inputId] of Object.entries(mapping)) {
        if (errors[field]) {
            const input = document.getElementById(inputId);
            const errEl = document.getElementById('err-' + inputId);
            if (input) input.classList.add('border-red-500');
            if (errEl) {
                errEl.textContent = errors[field][0]; // Ambil pesan error pertama
                errEl.classList.remove('hidden');
            }
        }
    }
}

function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text, timer: 2000, showConfirmButton: false });
}

function openTambah() {
    // Bersihkan form dan error sebelum membuka modal
    document.getElementById('tEmail').value = '';
    document.getElementById('tNama').value = '';
    document.getElementById('tSTR').value = '';
    document.getElementById('tHP').value = '';
    document.getElementById('tPass').value = '';
    clearErrors(['tEmail', 'tNama', 'tSTR', 'tHP', 'tPass']);

    document.getElementById('modalTambah').classList.remove('hidden');
    document.getElementById('modalTambah').classList.add('flex');
}

function closeTambah() {
    document.getElementById('modalTambah').classList.add('hidden');
    document.getElementById('modalTambah').classList.remove('flex');
}

// Fungsi toggle password dengan ikon mata
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l18 18"></path>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
    }
}

async function simpanDokter() {
    // Bersihkan error lama saat klik simpan
    clearErrors(['tEmail', 'tNama', 'tSTR', 'tHP', 'tPass']);

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

    if (!res.ok) {
        // Tampilkan error spesifik di bawah masing-masing inputan
        if (data.errors) {
            displayErrors(data.errors, {
                email: 'tEmail',
                name: 'tNama',
                no_str: 'tSTR',
                no_hp: 'tHP',
                password: 'tPass'
            });
        }
        return;
    }

    document.getElementById('tableDokter').insertAdjacentHTML('beforeend', `
        <tr data-dokter-id="${data.id}" class="hover:bg-gray-50 transition">
            <td class="px-5 py-3.5 text-xs text-gray-500 email">${data.email}</td>
            <td class="px-5 py-3.5 font-medium nama">${data.nama}</td>
            <td class="px-5 py-3.5 str">${data.str ?? '-'}</td>
            <td class="px-5 py-3.5 hp">${data.no_hp ?? '-'}</td>
            <td class="px-5 py-3.5 status">
                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">${data.status}</span>
            </td>
            <td class="px-5 py-3.5 text-right">
                <button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button>
            </td>
        </tr>
    `);

    filterDokter();
    closeTambah();
    showAlert('success', 'Berhasil', 'Dokter ditambahkan');
}

function closeEdit() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalEdit').classList.remove('flex');
}

function openEdit(btn) {
    // Bersihkan error lama
    clearErrors(['eEmail', 'eNama', 'eSTR', 'eHP', 'ePass']);

    selRow = btn.closest('tr');
    selRowId = selRow.dataset.dokterId;

    document.getElementById('eId').value = selRowId;
    document.getElementById('eEmail').value = selRow.querySelector('.email').innerText.trim();
    document.getElementById('eNama').value = selRow.querySelector('.nama').innerText.trim();
    document.getElementById('eSTR').value = selRow.querySelector('.str').innerText.trim();
    document.getElementById('eHP').value = selRow.querySelector('.hp').innerText.trim();
    document.getElementById('eStatus').value = selRow.querySelector('.status').innerText.trim();

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
}

async function updateDokter() {
    // Bersihkan error lama saat klik simpan
    clearErrors(['eEmail', 'eNama', 'eSTR', 'eHP', 'ePass']);

    const id = document.getElementById('eId').value;
    const email = document.getElementById('eEmail').value;
    const nama = document.getElementById('eNama').value;
    const str = document.getElementById('eSTR').value;
    const hp = document.getElementById('eHP').value;
    const status = document.getElementById('eStatus').value;
    const password = document.getElementById('ePass').value;

    try {
        const res = await fetch(updateUrlBase.replace('/0', '/' + id), {
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
        });

        const data = await res.json();

        if (!res.ok) {
            // Tampilkan error spesifik di bawah masing-masing inputan
            if (data.errors) {
                displayErrors(data.errors, {
                    email: 'eEmail',
                    name: 'eNama',
                    no_str: 'eSTR',
                    no_hp: 'eHP',
                    password: 'ePass'
                });
            } else {
                showAlert('error', 'Gagal', 'Data dokter gagal diperbarui');
            }
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
        showAlert('success', 'Berhasil', 'Data dokter berhasil diperbarui');

    } catch (err) {
        console.error(err);
        showAlert('error', 'Error', 'Terjadi kesalahan saat mengupdate data');
    }
}
</script>

@endsection