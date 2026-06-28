@extends('layouts.dashboard', [
    'pageTitle' => 'Antrian Pasien', 
    'userName'  => 'dr. ' . (session('name') ?? 'Dokter'), 
    'userRole'  => 'Dokter',
    'userInitial' => strtoupper(substr(session('name') ?? 'D', 0, 1)) 
])

@section('sidebar')
    <x-sidebar-dokter />
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
        <div class="relative w-full max-w-xs">
            <input type="date" id="filterTanggal" value="{{ $tanggal ?? now()->format('Y-m-d') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40 cursor-pointer">
        </div>
        <div class="relative w-full max-w-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="searchPasien" oninput="filterPasien()" placeholder="Cari pasien..." class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40">
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm min-w-[800px]">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide font-semibold">
                <tr>
                    <th class="px-5 py-4 text-left align-middle whitespace-nowrap">No</th>
                    <th class="px-5 py-4 text-left align-middle whitespace-nowrap">Nama Pasien</th>
                    <th class="px-5 py-4 text-left align-middle">Keluhan</th>
                    <th class="px-5 py-4 text-center align-middle whitespace-nowrap">Status</th>
                    <!-- ▼ UBAH TULISAN DI SINI ▼ -->
                    <th class="px-5 py-4 text-center align-middle whitespace-nowrap">Riwayat Pemeriksaan</th>
                    <!-- ▲ UBAH TULISAN DI SINI ▲ -->
                    <th class="px-5 py-4 text-center align-middle whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbodyPasien" class="text-gray-700 divide-y divide-gray-100">
                @forelse($antrians as $antrian)
                    <tr id="row-{{ $antrian->id }}" class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 text-left align-middle whitespace-nowrap">{{ $antrian->nomor_antrian }}</td>
                        <td class="px-5 py-4 text-left align-middle font-medium whitespace-nowrap">{{ $antrian->pemesanan->nama_pasien ?? '-' }}</td>
                        <td class="px-5 py-4 text-left align-middle max-w-xs break-words">{{ $antrian->pemesanan->keluhan ?? '-' }}</td>   
                        <td class="px-5 py-4 text-center align-middle whitespace-nowrap">
                            @if($antrian->status == 'selesai')
                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center align-middle whitespace-nowrap">
                            <button 
                                onclick="openRiwayatModal(this)" 
                                data-email="{{ $antrian->pemesanan->email ?? '' }}"
                                data-nama="{{ $antrian->pemesanan->nama_pasien ?? '-' }}"
                                class="inline-flex items-center gap-1.5 border border-[#09637E] text-[#09637E] text-xs px-3 py-1.5 rounded-lg hover:bg-[#09637E] hover:text-white transition font-medium"
                                title="Lihat riwayat pemeriksaan pasien"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Riwayat
                            </button>
                        </td>
                        <td class="px-5 py-4 text-center align-middle whitespace-nowrap">
                            @if($antrian->status != 'selesai')
                                <button onclick="openModal(this)" data-id="{{ $antrian->id }}" data-nama="{{ $antrian->pemesanan->nama_pasien ?? '-' }}" data-no="{{ $antrian->nomor_antrian }}" data-keluhan="{{ $antrian->pemesanan->keluhan ?? '-' }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#09637E] text-white hover:bg-[#074d61] transition shadow-sm" title="Isi Rekam Medis">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                            @else
                                <button onclick="openDetail(this)" data-nama="{{ $antrian->pemesanan->nama_pasien ?? '-' }}" data-no="{{ $antrian->nomor_antrian }}" data-keluhan="{{ $antrian->pemesanan->keluhan ?? '-' }}" data-diagnosa="{{ $antrian->rekamMedis->diagnosa ?? '-' }}" data-catatan="{{ $antrian->rekamMedis->catatan_dokter ?? '-' }}" data-resep="{{ json_encode($antrian->rekamMedis->resep_obat ?? []) }}" class="bg-[#09637E] text-white text-xs px-3 py-1.5 rounded-lg hover:bg-[#074d61] transition font-medium">Detail</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-400">Belum ada antrian pada tanggal ini</td></tr>
                @endforelse
            </tbody>
        </table>
        <div id="emptyState" class="hidden py-12 text-center text-sm text-gray-400">Pasien tidak ditemukan.</div>
    </div>
</div>

<!-- ========== MODAL REKAM MEDIS ========== -->
<div id="modalRM" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4" onclick="closeModal()">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-2xl max-h-[90vh] flex flex-col mx-auto" onclick="event.stopPropagation()">
        <div class="px-6 py-4 border-b border-gray-100 flex-shrink-0"><h3 class="text-base font-bold text-gray-900">Rekam Medis Pasien</h3></div>
        <div class="overflow-y-auto p-6 flex-1">
            <form id="formRekamMedis" action="{{ route('dokter.rekammedis.simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="antrian_id" id="rmAntrianId">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div><label class="block text-xs font-medium text-gray-500 mb-1">Nama Pasien</label><input type="text" id="rmNama" readonly class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-100 text-gray-500 text-sm cursor-not-allowed"></div>
                    <div><label class="block text-xs font-medium text-gray-500 mb-1">No. Antrian</label><input type="text" id="rmNo" readonly class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-100 text-gray-500 text-sm cursor-not-allowed"></div>
                    <div><label class="block text-xs font-medium text-gray-500 mb-1">Keluhan</label><input type="text" id="rmKeluhan" readonly class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-100 text-gray-500 text-sm cursor-not-allowed"></div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                        <select id="rmStatus" name="status" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10">
                            <option value="menunggu">Menunggu</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="col-span-1 sm:col-span-2"><label class="block text-xs font-medium text-gray-500 mb-1">Diagnosa</label><input type="text" id="rmDiagnosa" name="diagnosa" placeholder="Contoh: Demam" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40"></div>
                    <div class="col-span-1 sm:col-span-2"><label class="block text-xs font-medium text-gray-500 mb-1">Catatan Dokter</label><textarea id="rmCatatan" name="catatan_dokter" placeholder="Contoh: Istirahat cukup..." class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-[#09637E]/10 focus:border-[#09637E]/40" rows="3"></textarea></div>
                    <div class="col-span-1 sm:col-span-2">
                        <div class="flex items-center justify-between mb-2"><span class="text-sm font-semibold text-gray-700">Resep Obat</span><button type="button" onclick="tambahObat()" id="btnTambahObat" class="text-xs text-[#09637E] hover:underline font-medium">+ Tambah Obat</button></div>
                        <div id="obatContainer" class="space-y-2"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 flex-shrink-0">
            <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">Tutup</button>
            <button type="submit" form="formRekamMedis" id="btnSimpanRM" class="px-5 py-2 rounded-xl text-sm font-semibold text-white bg-[#09637E] hover:bg-[#074d61] transition">Simpan</button>
        </div>
    </div>
</div>

<!-- ========== MODAL RIWAYAT PEMERIKSAAN PASIEN (BARU) ========== -->
<div id="modalRiwayat" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4" onclick="closeRiwayatModal()">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-3xl max-h-[90vh] flex flex-col mx-auto" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-shrink-0">
            <div>
                <h3 class="text-base font-bold text-gray-900">📋 Riwayat Pemeriksaan</h3>
                <p class="text-sm text-gray-500 mt-0.5" id="riwayatNamaPasien">-</p>
            </div>
            <button onclick="closeRiwayatModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg w-8 h-8 inline-flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <!-- Content -->
        <div class="overflow-y-auto p-6 flex-1" id="riwayatContent">
            <div class="text-center py-8 text-gray-400 text-sm">Memuat riwayat...</div>
        </div>
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end flex-shrink-0">
            <button onclick="closeRiwayatModal()" class="px-5 py-2 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">Tutup</button>
        </div>
    </div>
</div>

<div id="toast" class="fixed top-6 right-6 z-[60] hidden"><div class="bg-white border border-gray-200 rounded-2xl shadow-lg px-5 py-3.5 flex items-center gap-3"><div class="w-7 h-7 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div><span class="text-sm text-gray-700 font-medium">Rekam medis berhasil disimpan!</span></div></div>

<script>
document.getElementById('filterTanggal').addEventListener('change', function() { if(this.value) window.location.href = "{{ route('dokter.antrian') }}?tanggal=" + this.value; });
function filterPasien() { const q=document.getElementById('searchPasien').value.toLowerCase(); const rows=document.querySelectorAll('#tbodyPasien tr[id^="row-"]'); let f=false; rows.forEach(r=>{const m=r.cells[1].textContent.toLowerCase().includes(q)||r.cells[2].textContent.toLowerCase().includes(q); r.style.display=m?'':'none'; if(m)f=true;}); document.getElementById('emptyState').classList.toggle('hidden',f); }

function openModal(btn) { 
    document.getElementById('rmAntrianId').value=btn.dataset.id; 
    document.getElementById('rmNama').value=btn.dataset.nama; 
    document.getElementById('rmNo').value=btn.dataset.no; 
    document.getElementById('rmKeluhan').value=btn.dataset.keluhan; 
    document.getElementById('rmStatus').value='menunggu';
    document.getElementById('rmDiagnosa').value=''; 
    document.getElementById('rmCatatan').value=''; 
    document.getElementById('obatContainer').innerHTML=buatBarisObat(); 
    
    document.getElementById('rmDiagnosa').removeAttribute('readonly'); document.getElementById('rmDiagnosa').classList.remove('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('rmCatatan').removeAttribute('readonly'); document.getElementById('rmCatatan').classList.remove('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('rmStatus').removeAttribute('disabled'); document.getElementById('rmStatus').classList.remove('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('btnTambahObat').style.display = 'inline-block';
    document.getElementById('btnSimpanRM').style.display='block'; 
    
    document.getElementById('modalRM').classList.remove('hidden'); 
    document.body.style.overflow='hidden'; 
}

function closeModal() { document.getElementById('modalRM').classList.add('hidden'); document.body.style.overflow=''; }

function buatBarisObat(readonly = false) { 
    const ro = readonly ? 'readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-100 text-gray-500 cursor-not-allowed"' : 'class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm"';
    return `<div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row"><input type="text" name="obat_nama[]" placeholder="Nama Obat" ${ro}><input type="text" name="obat_dosis[]" placeholder="Dosis" ${ro}><input type="text" name="obat_ket[]" placeholder="Keterangan" ${ro}></div>`; 
}
function tambahObat() { document.getElementById('obatContainer').insertAdjacentHTML('beforeend', buatBarisObat(false)); }
document.addEventListener('keydown', e=>{if(e.key==='Escape'){closeModal();closeRiwayatModal();}});

function openDetail(btn) { 
    document.getElementById('rmAntrianId').value=''; 
    document.getElementById('rmNama').value=btn.dataset.nama; 
    document.getElementById('rmNo').value=btn.dataset.no; 
    document.getElementById('rmKeluhan').value=btn.dataset.keluhan; 
    document.getElementById('rmStatus').value='selesai';
    document.getElementById('rmDiagnosa').value=btn.dataset.diagnosa; 
    document.getElementById('rmCatatan').value=btn.dataset.catatan; 
    
    let resepData=[]; try{resepData=JSON.parse(btn.dataset.resep); if(typeof resepData==='string')resepData=JSON.parse(resepData); if(!Array.isArray(resepData))resepData=[];}catch(e){resepData=[];} 
    let htmlObat=''; 
    if(resepData.length>0){
        resepData.forEach(o=>{htmlObat+=`<div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center obat-row"><input type="text" value="${o.nama_obat||''}" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-100 text-gray-500 cursor-not-allowed"><input type="text" value="${o.dosis||''}" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-100 text-gray-500 cursor-not-allowed"><input type="text" value="${o.keterangan||''}" readonly class="flex-1 min-w-0 border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-100 text-gray-500 cursor-not-allowed"></div>`;});
    } else { htmlObat='<p class="text-sm text-gray-400 italic">Tidak ada resep obat</p>'; } 
    
    document.getElementById('obatContainer').innerHTML=htmlObat; 

    document.getElementById('rmNama').setAttribute('readonly',true); 
    document.getElementById('rmNo').setAttribute('readonly',true); 
    document.getElementById('rmKeluhan').setAttribute('readonly',true); 
    document.getElementById('rmDiagnosa').setAttribute('readonly',true); document.getElementById('rmDiagnosa').classList.add('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('rmCatatan').setAttribute('readonly',true); document.getElementById('rmCatatan').classList.add('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('rmStatus').setAttribute('disabled',true); document.getElementById('rmStatus').classList.add('bg-gray-100', 'cursor-not-allowed');
    document.getElementById('btnTambahObat').style.display = 'none';
    document.getElementById('btnSimpanRM').style.display='none'; 

    document.getElementById('modalRM').classList.remove('hidden'); 
    document.body.style.overflow='hidden'; 
}

// ========== RIWAYAT PEMERIKSAAN (BARU) ==========

function openRiwayatModal(btn) {
    const email = btn.dataset.email;
    const nama = btn.dataset.nama;

    document.getElementById('riwayatNamaPasien').textContent = nama;
    document.getElementById('riwayatContent').innerHTML = `
        <div class="flex flex-col items-center justify-center py-10 gap-3">
            <svg class="w-8 h-8 text-[#09637E] animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span class="text-sm text-gray-400">Memuat riwayat pemeriksaan...</span>
        </div>`;
    document.getElementById('modalRiwayat').classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    fetch(`{{ route('dokter.riwayat-pasien') }}?email=${encodeURIComponent(email)}`)
        .then(res => {
            if (!res.ok) throw new Error('Gagal memuat');
            return res.json();
        })
        .then(data => {
            if (data.length === 0) {
                document.getElementById('riwayatContent').innerHTML = `
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-gray-400 text-sm">Belum ada riwayat pemeriksaan untuk pasien ini.</p>
                    </div>`;
                return;
            }
            let html = '<div class="space-y-4">';
            data.forEach((item, index) => {
                html += renderHistoryCard(item, index);
            });
            html += '</div>';
            document.getElementById('riwayatContent').innerHTML = html;
        })
        .catch(err => {
            document.getElementById('riwayatContent').innerHTML = `
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-red-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-red-400 text-sm">Gagal memuat riwayat pemeriksaan.</p>
                </div>`;
        });
}

function closeRiwayatModal() {
    document.getElementById('modalRiwayat').classList.add('hidden');
    document.body.style.overflow = '';
}

function renderHistoryCard(item, index) {
    let resepHtml = '';
    const resep = item.resep;

    if (resep && Array.isArray(resep) && resep.length > 0) {
        const firstItem = resep[0];
        if (typeof firstItem === 'object' && firstItem !== null) {
            const keys = Object.keys(firstItem);
            resepHtml = `
                <div class="mt-3">
                    <p class="text-xs font-bold text-gray-500 uppercase mb-1.5">Resep Obat</p>
                    <div class="overflow-x-auto -mx-1">
                        <table class="w-full text-xs border-collapse min-w-[280px]">
                            <thead>
                                <tr>
                                    <th class="text-left px-2 py-1.5 bg-blue-100 text-blue-800 font-bold uppercase border border-blue-200 rounded-tl-lg">#</th>
                                    ${keys.map((k, i) => `<th class="text-left px-2 py-1.5 bg-blue-100 text-blue-800 font-bold uppercase border border-blue-200 ${i === keys.length - 1 ? 'rounded-tr-lg' : ''}">${k.replace(/_/g, ' ')}</th>`).join('')}
                                </tr>
                            </thead>
                            <tbody>
                                ${resep.map((obat, idx) => `
                                    <tr class="hover:bg-blue-50/50">
                                        <td class="px-2 py-1.5 border border-blue-100 text-gray-400 text-center">${idx + 1}</td>
                                        ${keys.map(k => `<td class="px-2 py-1.5 border border-blue-100 text-gray-700">${obat[k] ?? '-'}</td>`).join('')}
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>`;
        } else {
            resepHtml = `
                <div class="mt-3">
                    <p class="text-xs font-bold text-gray-500 uppercase mb-1.5">Resep Obat</p>
                    <div class="bg-blue-50 rounded-lg p-2.5">
                        <ul class="space-y-0.5">${resep.map(r => `<li class="text-xs text-gray-700 flex items-start gap-1.5"><span class="text-blue-500 mt-0.5">•</span>${r}</li>`).join('')}</ul>
                    </div>
                </div>`;
        }
    } else {
        resepHtml = `
            <div class="mt-3">
                <p class="text-xs font-bold text-gray-500 uppercase mb-1.5">Resep Obat</p>
                <p class="text-xs text-gray-400 italic">Tidak ada resep obat</p>
            </div>`;
    }

    return `
    <div class="border border-gray-100 rounded-xl p-4 bg-gradient-to-br from-white to-gray-50/50 hover:shadow-sm transition">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#09637E]/10 text-[#09637E] text-xs font-bold">${index + 1}</span>
                <span class="text-sm font-semibold text-[#09637E]">${item.tanggal}</span>
            </div>
            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">${item.dokter}</span>
        </div>
        <div class="space-y-2 text-sm">
            <div class="flex gap-2">
                <span class="text-gray-400 min-w-[70px]">Keluhan</span>
                <span class="text-gray-700">: ${item.keluhan}</span>
            </div>
            <div class="flex gap-2">
                <span class="text-gray-400 min-w-[70px]">Diagnosa</span>
                <span class="text-gray-800 font-semibold">: ${item.diagnosa}</span>
            </div>
            <div class="flex gap-2">
                <span class="text-gray-400 min-w-[70px]">Catatan</span>
                <span class="text-gray-700">: ${item.catatan}</span>
            </div>
        </div>
        ${resepHtml}
    </div>`;
}

// ========== FORM SUBMIT (DIPERBARUI: cells[4] → cells[5] untuk Aksi) ==========
document.getElementById('formRekamMedis').addEventListener('submit', function(e) {
    e.preventDefault(); const form=this; const formData=new FormData(form); const submitBtn=document.getElementById('btnSimpanRM'); submitBtn.innerHTML='Menyimpan...'; submitBtn.disabled=true;
    fetch(form.action, { method:'POST', body:formData, headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'} })
    .then(response => { if (!response.ok) return response.json().then(err => { throw err; }); return response.json(); })
    .then(data => {
        if(data.success) { 
            closeModal(); showToast(data.message); 
            const row=document.getElementById('row-'+data.antrian_id); 
            if(row){
                if(data.status === 'selesai'){
                    row.cells[3].innerHTML = '<span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>';
                    const n=document.getElementById('rmNama').value.replace(/"/g, '&quot;'); const k=document.getElementById('rmKeluhan').value.replace(/"/g, '&quot;'); const d=data.diagnosa.replace(/"/g, '&quot;'); const c=data.catatan.replace(/"/g, '&quot;'); const r=JSON.stringify(data.resep).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
                    // ⚠️ PERHATIAN: cells[5] bukan cells[4] karena ada kolom Riwayat baru
                    row.cells[5].innerHTML = `<button onclick="openDetail(this)" data-nama="${n}" data-no="${document.getElementById('rmNo').value}" data-keluhan="${k}" data-diagnosa="${d}" data-catatan="${c}" data-resep='${r}' class="bg-[#09637E] text-white text-xs px-3 py-1.5 rounded-lg hover:bg-[#074d61] transition font-medium">Detail</button>`;
                } else {
                    row.cells[3].innerHTML = '<span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Menunggu</span>';
                }
            } 
        }
    })
    .catch(error => { console.error('Error:', error); if(error.errors){alert('Gagal menyimpan:\n'+Object.values(error.errors).flat().join('\n'));}else{alert('Terjadi kesalahan.');} })
    .finally(() => { submitBtn.innerHTML='Simpan'; submitBtn.disabled=false; });
});

function showToast(msg) { const t=document.getElementById('toast'); t.classList.remove('hidden'); setTimeout(()=>t.classList.add('hidden'),3000); }
</script>
@endsection