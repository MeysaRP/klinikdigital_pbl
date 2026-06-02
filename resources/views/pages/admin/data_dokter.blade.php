@extends('layouts.dashboard', ['pageTitle' => 'Data Dokter', 'userName' => 'Halo, Admin', 'userRole' => 'Admin', 'userInitial' => 'A'])
@section('sidebar') <x-sidebar-admin /> @endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> @section('content') <div class="space-y-6">
        <div id="notificationDokter"
            class="hidden rounded-2xl border border-green-200 bg-green-50 text-green-700 px-4 py-3 text-sm shadow-sm"></div>
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-5 flex flex-col sm:flex-row justify-between gap-3">
            <div class="relative w-full sm:w-1/3"> <svg
                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg> <input type="text" id="searchDokter" placeholder="Cari email, nama, STR, atau HP..."
                    class="w-full bg-gray-50 rounded-xl pl-10 pr-9 py-2.5 text-sm focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 outline-none border border-gray-200">
                <button id="btnClearSearch" onclick="clearSearch()"
                    class="absolute right-2 top-1/2 -translate-y-1/2 w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition hidden"><svg
                        class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg></button> </div>
        </div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <h2 class="font-bold text-lg text-gray-800">Kelola Data Dokter</h2> <button onclick="openTambah()"
                class="bg-[#09637E] text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#074d61] transition"> +
                Tambah Dokter </button>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left min-w-[600px]">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                        <tr>
                            <th class="px-5 py-3.5">Email</th>
                            <th class="px-5 py-3.5">Nama</th>
                            <th class="px-5 py-3.5">No. STR</th>
                            <th class="px-5 py-3.5">No. HP</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableDokter" class="text-gray-700 divide-y divide-gray-100"> @foreach ($dokters as $dokter)
                        <tr data-dokter-id="{{ $dokter->id }}" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3.5 text-xs text-gray-500 email">{{ $dokter->email }}</td>
                            <td class="px-5 py-3.5 font-medium nama">{{ $dokter->nama }}</td>
                            <td class="px-5 py-3.5 str">{{ $dokter->str }}</td>
                            <td class="px-5 py-3.5 hp">{{ $dokter->no_hp }}</td>
                            <td class="px-5 py-3.5"> @if ($dokter->status === 'Aktif') <span
                                class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Aktif</span>
                            @else <span
                                    class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">{{ $dokter->status }}</span>
                                @endif </td>
                            <td class="px-5 py-3.5 text-right"> <button onclick="openEdit(this)"
                                    class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button>
                            </td>
                    </tr> @endforeach </tbody>
                </table>
            </div>
            <div class="flex justify-center items-center px-5 py-3 text-sm text-gray-500 border-t border-gray-100"> <span
                    id="infoJumlah" class="text-center">Menampilkan {{ count($dokters) }} data dokter</span> </div>
        </div>
    </div> <!-- MODAL TAMBAH -->
    <div id="modalTambah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeTambah()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-base font-bold text-gray-900">Tambah Dokter Baru</h3> <button onclick="closeTambah()"
                        class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg> </button>
                </div>
                <div class="p-6 space-y-4">
                    <div> <label
                            class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Email</label>
                        <input type="email" id="tEmail" placeholder="dr.sarah@meditech.local"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama
                            Lengkap</label> <input type="text" id="tNama" placeholder="Dr. Sarah Wijaya"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No.
                            STR</label> <input type="text" id="tSTR" placeholder="Masukkan No. STR"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No.
                            HP</label> <input type="text" id="tHP" placeholder="Masukkan No. HP"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label
                            class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Password</label>
                        <input type="password" id="tPass" placeholder="Masukkan password"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3"> <button onclick="closeTambah()"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                    <button onclick="simpanDokter()"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan
                        Data</button> </div>
            </div>
        </div>
    </div>
    </div> <!-- MODAL EDIT -->
    <div id="modalEdit" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEdit()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-base font-bold text-gray-900">Edit Data Dokter</h3> <button onclick="closeEdit()"
                        class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg> </button>
                </div>
                <div class="p-6 space-y-4">
                    <div> <label
                            class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Email</label>
                        <input type="email" id="eEmail"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Nama
                            Lengkap</label> <input type="text" id="eNama"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No.
                            STR</label> <input type="text" id="eSTR"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">No.
                            HP</label> <input type="text" id="eHP"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label
                            class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Password</label>
                        <input type="password" id="ePass" placeholder="Kosongkan jika tidak diganti"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    </div>
                    <div> <label
                            class="block text-xs text-gray-400 uppercase tracking-wide font-medium mb-1.5">Status</label>
                        <select id="eStatus"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 bg-white">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                            <option value="Cuti">Cuti</option>
                        </select> </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3"> <button onclick="closeEdit()"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                    <button onclick="updateDokter()"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan
                        Data</button> </div>
            </div>
        </div>
    </div>
    </div>
    <script> let searchTimeout = null; const csrfToken = document.querySelector('meta[name="csrf-token"]').content; const storeUrl = '{{ route('data.dokter.store') }}'; const updateUrlBase = '{{ route('data.dokter.update', ['dokter' => 0]) }}'; let selRow = null; let selRowId = null; /* ========================= SWEETALERT REPLACEMENT ========================= */ function showAlert(icon, title, text) { Swal.fire({ icon: icon, title: title, text: text, timer: 2000, showConfirmButton: false }); } /* ========================= SEARCH ========================= */ function tampilSemua() { let t = 0; document.querySelectorAll('#tableDokter tr').forEach(function (r) { r.style.display = ''; t++; }); document.getElementById('infoJumlah').textContent = 'Menampilkan ' + t + ' data dokter'; document.getElementById('btnClearSearch').classList.add('hidden'); } function clearSearch() { document.getElementById('searchDokter').value = ''; tampilSemua(); } function cariDokter() { let v = document.getElementById('searchDokter').value.toLowerCase().trim(); if (!v) { tampilSemua(); return; } let t = 0; document.querySelectorAll('#tableDokter tr').forEach(function (r) { let e = r.querySelector('.email') ? r.querySelector('.email').innerText.toLowerCase() : ''; let n = r.querySelector('.nama') ? r.querySelector('.nama').innerText.toLowerCase() : ''; let s = r.querySelector('.str') ? r.querySelector('.str').innerText.toLowerCase() : ''; let h = r.querySelector('.hp') ? r.querySelector('.hp').innerText.toLowerCase() : ''; let c = e.includes(v) || n.includes(v) || s.includes(v) || h.includes(v); r.style.display = c ? '' : 'none'; if (c) t++; }); document.getElementById('infoJumlah').textContent = 'Menampilkan ' + t + ' data dokter'; document.getElementById('btnClearSearch').classList.remove('hidden'); } document.getElementById('searchDokter').addEventListener('input', function () { if (searchTimeout) clearTimeout(searchTimeout); if (!this.value.toLowerCase().trim()) { tampilSemua(); } else { searchTimeout = setTimeout(cariDokter, 400); } }); /* ========================= MODAL TAMBAH ========================= */ function openTambah() { ['tEmail', 'tNama', 'tSTR', 'tHP', 'tPass'].forEach(id => document.getElementById(id).value = ''); document.getElementById('modalTambah').classList.remove('hidden'); document.getElementById('modalTambah').classList.add('flex'); document.body.style.overflow = 'hidden'; } function closeTambah() { document.getElementById('modalTambah').classList.add('hidden'); document.getElementById('modalTambah').classList.remove('flex'); document.body.style.overflow = ''; } /* ========================= SIMPAN DOKTER ========================= */ async function simpanDokter() { let email = document.getElementById('tEmail').value; let nama = document.getElementById('tNama').value; let str = document.getElementById('tSTR').value; let hp = document.getElementById('tHP').value; let password = document.getElementById('tPass').value; if (!email || !nama || !str || !hp || !password) { showAlert('error', 'Gagal', 'Email, Nama, STR, HP, dan Password harus diisi!'); return; } const response = await fetch(storeUrl, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', }, body: JSON.stringify({ email, nama, str, no_hp: hp, password }), }); if (!response.ok) { const result = await response.json().catch(() => ({})); showAlert('error', 'Gagal', result.message || 'Gagal menyimpan data.'); return; } const data = await response.json(); let badgeClass = data.status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'; document.getElementById('tableDokter').insertAdjacentHTML('beforeend', '<tr data-dokter-id="' + data.id + '" class="hover:bg-gray-50 transition">' + '<td class="px-5 py-3.5 text-xs text-gray-500 email">' + data.email + '</td>' + '<td class="px-5 py-3.5 font-medium nama">' + data.nama + '</td>' + '<td class="px-5 py-3.5 str">' + data.str + '</td>' + '<td class="px-5 py-3.5 hp">' + data.no_hp + '</td>' + '<td class="px-5 py-3.5"><span class="px-3 py-1 text-xs rounded-full ' + badgeClass + ' font-medium">' + data.status + '</span></td>' + '<td class="px-5 py-3.5 text-right"><button onclick="openEdit(this)" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">Edit</button></td>' + '</tr>'); closeTambah(); showAlert('success', 'Berhasil', 'Dokter baru berhasil ditambahkan.'); } /* ========================= EDIT ========================= */ function openEdit(btn) { selRow = btn.closest('tr'); selRowId = selRow.dataset.dokterId; document.getElementById('eEmail').value = selRow.querySelector('.email').innerText; document.getElementById('eNama').value = selRow.querySelector('.nama').innerText; document.getElementById('eSTR').value = selRow.querySelector('.str').innerText; document.getElementById('eHP').value = selRow.querySelector('.hp').innerText; document.getElementById('eStatus').value = selRow.querySelector('span').innerText.trim(); document.getElementById('ePass').value = ''; document.getElementById('modalEdit').classList.remove('hidden'); document.getElementById('modalEdit').classList.add('flex'); document.body.style.overflow = 'hidden'; } function closeEdit() { document.getElementById('modalEdit').classList.add('hidden'); document.getElementById('modalEdit').classList.remove('flex'); document.body.style.overflow = ''; } /* ========================= UPDATE DOKTER ========================= */ async function updateDokter() { let email = document.getElementById('eEmail').value; let nama = document.getElementById('eNama').value; let str = document.getElementById('eSTR').value; let hp = document.getElementById('eHP').value; let status = document.getElementById('eStatus').value; let password = document.getElementById('ePass').value; if (!email || !nama || !str || !hp) { showAlert('error', 'Gagal', 'Email, Nama, STR, dan HP harus diisi!'); return; } if (!selRowId) { showAlert('error', 'Error', 'Dokter tidak ditemukan.'); return; } const url = updateUrlBase.replace('/0', '/' + selRowId); const response = await fetch(url, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', }, body: JSON.stringify({ email, nama, str, no_hp: hp, status, password }), }); if (!response.ok) { const result = await response.json().catch(() => ({})); showAlert('error', 'Gagal', result.message || 'Gagal memperbarui data.'); return; } const data = await response.json(); selRow.querySelector('.email').innerText = data.email; selRow.querySelector('.nama').innerText = data.nama; selRow.querySelector('.str').innerText = data.str; selRow.querySelector('.hp').innerText = data.no_hp; let badgeClass = data.status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'; let statusSpan = selRow.querySelector('span'); statusSpan.className = 'px-3 py-1 text-xs rounded-full ' + badgeClass + ' font-medium'; statusSpan.innerText = data.status; closeEdit(); showAlert('success', 'Berhasil', 'Perubahan data dokter berhasil disimpan.'); } /* ========================= ESC CLOSE MODAL ========================= */ document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeTambah(); closeEdit(); } }); </script>
@endsection