@extends('layouts.dashboard', [
    'pageTitle' => 'Antrian Pasien',
    'userName' => 'Dr. Sarah Wijaya',
    'userRole' => 'Dokter',
    'userInitial' => 'DS'
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">

    <h2 class="font-bold text-lg text-gray-800">Antrian Pasien Hari Ini</h2>

    <div class="relative w-full max-w-sm">
        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" id="searchPasien" oninput="filterPasien()" placeholder="Cari pasien..." class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm min-w-[580px]">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                <tr>
                    <th class="w-16 px-5 py-3.5 text-left">No</th>
                    <th class="px-5 py-3.5 text-left">Nama Pasien</th>
                    <th class="px-5 py-3.5 text-left">Keluhan</th>
                    <th class="w-32 px-5 py-3.5 text-left">Status</th>
                    <th class="w-40 px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbodyPasien" class="text-gray-700 divide-y divide-gray-100">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5">05</td>
                    <td class="px-5 py-3.5 font-medium">Andi Pratama</td>
                    <td class="px-5 py-3.5">Demam</td>
                    <td class="px-5 py-3.5">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <button onclick="openModal(this)" data-nama="Andi Pratama" data-no="05" data-keluhan="Demam" class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                            Isi Rekam Medis
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5">06</td>
                    <td class="px-5 py-3.5 font-medium">Siti Aminah</td>
                    <td class="px-5 py-3.5">Batuk</td>
                    <td class="px-5 py-3.5">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <button class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Periksa</button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5">07</td>
                    <td class="px-5 py-3.5 font-medium">Budi Santoso</td>
                    <td class="px-5 py-3.5">Flu ringan</td>
                    <td class="px-5 py-3.5">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <button class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Periksa</button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5">08</td>
                    <td class="px-5 py-3.5 font-medium">Rini Wulandari</td>
                    <td class="px-5 py-3.5">Pusing</td>
                    <td class="px-5 py-3.5">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <button class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Periksa</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="emptyState" class="hidden py-12 text-center text-sm text-gray-400">Pasien tidak ditemukan.</div>
    </div>

</div>

<!-- MODAL REKAM MEDIS -->
<div id="modalRM" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50" onclick="closeModal()">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-2xl p-5 sm:p-6 mx-4" onclick="event.stopPropagation()">
        <h3 class="text-base font-bold text-gray-900 mb-5">Rekam Medis Pasien</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <input type="text" id="rmNama" placeholder="Nama Pasien" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            <input type="text" id="rmNo" placeholder="No. Antrian" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            <input type="text" id="rmKeluhan" placeholder="Keluhan" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            <div></div>
            <input type="text" id="rmDiagnosa" placeholder="Diagnosa" class="col-span-1 sm:col-span-2 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
            <textarea id="rmCatatan" placeholder="Catatan Dokter" class="col-span-1 sm:col-span-2 border border-gray-200 rounded-xl px-3 py-2.5 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40" rows="3"></textarea>
            <div class="col-span-1 sm:col-span-2">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Resep Obat</span>
                    <button type="button" onclick="tambahObat()" class="text-xs text-[#09637E] hover:underline font-medium">+ Tambah Obat</button>
                </div>
                <div id="obatContainer" class="space-y-2">
                    <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row">
                        <input type="text" placeholder="Nama Obat" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <input type="text" placeholder="Dosis" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <input type="text" placeholder="Keterangan" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <button type="button" onclick="hapusObat(this)" class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">Tutup</button>
            <button onclick="simpanRM()" class="px-5 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="fixed top-6 right-6 z-[60] hidden">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg px-5 py-3.5 flex items-center gap-3">
        <div class="w-7 h-7 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <span class="text-sm text-gray-700 font-medium">Rekam medis berhasil disimpan!</span>
    </div>
</div>

<script>
function filterPasien() {
    const q = document.getElementById('searchPasien').value.toLowerCase();
    const rows = document.querySelectorAll('#tbodyPasien tr');
    let found = false;
    rows.forEach(r => {
        const match = r.cells[1].textContent.toLowerCase().includes(q) || r.cells[2].textContent.toLowerCase().includes(q);
        r.style.display = match ? '' : 'none';
        if (match) found = true;
    });
    document.getElementById('emptyState').classList.toggle('hidden', found);
}

function openModal(btn) {
    document.getElementById('rmNama').value = btn.dataset.nama;
    document.getElementById('rmNo').value = btn.dataset.no;
    document.getElementById('rmKeluhan').value = btn.dataset.keluhan;
    document.getElementById('rmDiagnosa').value = '';
    document.getElementById('rmCatatan').value = '';
    document.getElementById('obatContainer').innerHTML = buatBarisObat();
    document.getElementById('modalRM').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modalRM').classList.add('hidden');
    document.body.style.overflow = '';
}

function buatBarisObat() {
    return '<div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row">' +
        '<input type="text" placeholder="Nama Obat" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '<input type="text" placeholder="Dosis" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '<input type="text" placeholder="Keterangan" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '<button type="button" onclick="hapusObat(this)" class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 transition">' +
            '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>' +
        '</button>' +
    '</div>';
}

function tambahObat() {
    document.getElementById('obatContainer').insertAdjacentHTML('beforeend', buatBarisObat());
}

function hapusObat(btn) {
    if (document.querySelectorAll('.obat-row').length > 1) {
        btn.closest('.obat-row').remove();
    }
}

function simpanRM() {
    const diagnosa = document.getElementById('rmDiagnosa').value.trim();
    if (!diagnosa) {
        document.getElementById('rmDiagnosa').style.borderColor = '#ef4444';
        document.getElementById('rmDiagnosa').focus();
        return;
    }
    closeModal();
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

@endsection