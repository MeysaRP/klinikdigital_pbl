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
                @forelse($antrians as $antrian)
                    <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5">
                    {{ $antrian->nomor_antrian }}
                </td>

                <td class="px-5 py-3.5 font-medium">
                    {{ $antrian->pemesanan->nama_pasien ?? '-' }}
                </td>

                <td class="px-5 py-3.5">
                    {{ $antrian->pemesanan->keluhan ?? '-' }}
                </td>   

                <td class="px-5 py-3.5">
                    @if($antrian->status == 'menunggu')
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                    Menunggu
                </span>
                    @elseif($antrian->status == 'dipanggil')
                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">
                    Dipanggil
                </span>
                    @else
                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                    Selesai
                </span>
                    @endif
            </td>

                <td class="px-5 py-3.5 text-right">
                    @if($antrian->status != 'selesai')
                        <button
                            onclick="openModal(this)"
                            data-id="{{ $antrian->id }}"
                            data-nama="{{ $antrian->pemesanan->nama_pasien ?? '-' }}"
                            data-no="{{ $antrian->nomor_antrian }}"
                            data-keluhan="{{ $antrian->pemesanan->keluhan ?? '-' }}"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#09637E] text-white hover:bg-[#074d61] transition shadow-sm"
                            title="Isi Rekam Medis">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
            </button>
                    @else
                        <button 
                            onclick="openDetail(this)"
                            data-nama="{{ $antrian->pemesanan->nama_pasien ?? '-' }}"
                            data-no="{{ $antrian->nomor_antrian }}"
                            data-keluhan="{{ $antrian->pemesanan->keluhan ?? '-' }}"
                            data-diagnosa="{{ $antrian->rekamMedis->diagnosa ?? '-' }}"
                            data-catatan="{{ $antrian->rekamMedis->catatan_dokter ?? '-' }}"
                            data-status="{{ $antrian->status }}"
                            data-resep="{{ json_encode($antrian->rekamMedis->resep_obat ?? []) }}"
                            class="bg-[#09637E] text-white text-xs px-3 py-1.5 rounded-lg hover:bg-[#074d61] transition font-medium"
>
                            Detail  
                    </button>
                    @endif
                </td>
            </tr>
            @empty
                <tr>
                <td colspan="5" class="text-center py-5 text-gray-400">
                    Belum ada antrian
                </td>
            </tr>
                @endforelse
        </tbody>
        </table>
        <div id="emptyState" class="hidden py-12 text-center text-sm text-gray-400">Pasien tidak ditemukan.</div>
    </div>

</div>

<!-- MODAL REKAM MEDIS -->
<div id="modalRM" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50" onclick="closeModal()">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-2xl p-5 sm:p-6 mx-4" onclick="event.stopPropagation()">
        <h3 class="text-base font-bold text-gray-900 mb-5">Rekam Medis Pasien</h3>
        
        <form action="{{ route('dokter.rekammedis.simpan') }}" method="POST">
            @csrf

            <input type="hidden" name="antrian_id" id="rmAntrianId">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <!-- NAMA PASIEN + LABEL -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Pasien</label>
                <input type="text" id="rmNama" placeholder="Nama Pasien" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            </div>
            
            <!-- NO ANTRIAN + LABEL -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">No. Antrian</label>
                <input type="text" id="rmNo" placeholder="No. Antrian" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            </div>
            
            <!-- KELUHAN + LABEL -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Keluhan</label>
                <input type="text" id="rmKeluhan" placeholder="Keluhan" class="border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 text-gray-500 text-sm">
            </div>
            
            <!-- STATUS (DROPDOWN) -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                <select id="rmStatus" name="status" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                    <option value="menunggu">Menunggu</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            
            <!-- DIAGNOSA (TANPA LABEL) -->
            <input type="text" id="rmDiagnosa" name="diagnosa" placeholder="Diagnosa" class="col-span-1 sm:col-span-2 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
            
            <!-- CATATAN DOKTER (TANPA LABEL) -->
            <textarea id="rmCatatan" name="catatan_dokter" placeholder="Catatan Dokter" class="col-span-1 sm:col-span-2 border border-gray-200 rounded-xl px-3 py-2.5 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40" rows="3"></textarea>
            
            <!-- RESEP OBAT -->
            <div class="col-span-1 sm:col-span-2">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold text-gray-700">Resep Obat</span>
                    <button type="button" onclick="tambahObat()" class="text-xs text-[#09637E] hover:underline font-medium">+ Tambah Obat</button>
                </div>
                <div id="obatContainer" class="space-y-2">
                    <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row">
                        <input type="text" placeholder="Nama Obat" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <input type="text" placeholder="Dosis" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <input type="text" placeholder="Keterangan" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
                        <!-- Tombol Hapus Dihapus -->
                    </div>
                </div>
            </div>
        </div>
        
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">
                    Tutup
                </button>

                <button type="submit"
                    class="px-5 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">
                    Simpan
                </button>
            </div>

        </form>

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
    document.getElementById('rmAntrianId').value = btn.dataset.id;
    document.getElementById('rmNama').value = btn.dataset.nama;
    document.getElementById('rmNo').value = btn.dataset.no;
    document.getElementById('rmKeluhan').value = btn.dataset.keluhan;
    document.getElementById('rmStatus').value = 'menunggu';
    document.getElementById('rmDiagnosa').value = '';
    document.getElementById('rmCatatan').value = '';
    document.getElementById('obatContainer').innerHTML = buatBarisObat();

    const inputs = document.querySelectorAll('#modalRM input, #modalRM textarea, #modalRM select');
    inputs.forEach(input => input.removeAttribute('readonly'));
    document.getElementById('rmStatus').removeAttribute('disabled');

    const btnSimpan = document.querySelector('#modalRM button[type="submit"]');
    if(btnSimpan) btnSimpan.style.display = 'block';

    document.getElementById('modalRM').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modalRM').classList.add('hidden');
    document.body.style.overflow = '';
}

function buatBarisObat() {
    return '<div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row">' +
        '<input type="text" name="obat_nama[]" placeholder="Nama Obat" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '<input type="text" name="obat_dosis[]" placeholder="Dosis" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '<input type="text" name="obat_ket[]" placeholder="Keterangan" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">' +
        '</div>';
}

function tambahObat() {
    document.getElementById('obatContainer').insertAdjacentHTML('beforeend', buatBarisObat());
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

function openDetail(btn) {
    document.getElementById('rmNama').value = btn.dataset.nama;
    document.getElementById('rmNo').value = btn.dataset.no;
    document.getElementById('rmKeluhan').value = btn.dataset.keluhan;
    document.getElementById('rmStatus').value = btn.dataset.status;
    
    document.getElementById('rmDiagnosa').value = btn.dataset.diagnosa;
    document.getElementById('rmCatatan').value = btn.dataset.catatan;

    const resepJson = btn.dataset.resep; 
    let resepData = [];
    try {
        resepData = JSON.parse(resepJson);
        // Fallback kalau data di database double-encoded
        if (typeof resepData === 'string') {
            resepData = JSON.parse(resepData);
        }
        if (!Array.isArray(resepData)) resepData = [];
    } catch(e) {
        resepData = [];
    }
    
    let htmlObat = '';
    if (resepData.length > 0) {
        resepData.forEach(obat => {
            htmlObat += '<div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row">' +
                '<input type="text" value="' + (obat.nama_obat || '') + '" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 text-gray-500">' +
                '<input type="text" value="' + (obat.dosis || '') + '" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 text-gray-500">' +
                '<input type="text" value="' + (obat.keterangan || '') + '" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 text-gray-500">' +
                '</div>';
        });
    } else {
        htmlObat = '<p class="text-sm text-gray-400 italic">Tidak ada resep obat</p>';
    }
    document.getElementById('obatContainer').innerHTML = htmlObat;

    const inputs = document.querySelectorAll('#modalRM input, #modalRM textarea, #modalRM select');
    inputs.forEach(input => input.setAttribute('readonly', true));
    document.getElementById('rmStatus').setAttribute('disabled', true);

    const btnSimpan = document.querySelector('#modalRM button[type="submit"]');
    if(btnSimpan) btnSimpan.style.display = 'none';

    document.getElementById('modalRM').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
</script>

@endsection