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
<div class="space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-5 flex flex-col sm:flex-row justify-between gap-3">
        <div class="relative w-full sm:w-1/3">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="searchJadwal" placeholder="Cari Nama Dokter..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
        </div>

        <button onclick="openTambah()"
            class="bg-[#09637E] text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#074d61] transition whitespace-nowrap">
            + Tambah Jadwal
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[600px]">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-5 py-3.5">Dokter</th>
                        <th class="px-5 py-3.5">Hari</th>
                        <th class="px-5 py-3.5">Waktu</th>
                        <th class="px-5 py-3.5">Kuota</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableJadwal" class="text-gray-700 divide-y divide-gray-100">
                    @foreach($jadwal as $j)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-5 py-3.5 font-medium nama">
                            {{-- DEBUG: Kalau muncul "Dokter Tidak Ditemukan", berarti relasi DB bermasalah --}}
                            {{ optional($j->dokter)->nama ?? 'Dokter Tidak Ditemukan (ID: ' . $j->dokter_id . ')' }}
                        </td>

                        <td class="px-5 py-3.5">{{ $j->hari }}</td>
                        <td class="px-5 py-3.5">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                        <td class="px-5 py-3.5">{{ $j->kuota_pasien }}</td>

                        <td class="px-5 py-3.5">
                            <span class="px-3 py-1 text-xs rounded-full font-medium
                            @if($j->status=='Aktif') bg-green-100 text-green-700
                            @elseif($j->status=='Nonaktif') bg-red-100 text-red-600
                            @else bg-yellow-100 text-yellow-600 @endif">
                                {{ $j->status }}
                            </span>
                        </td>

                        <td class="px-5 py-3.5 text-right">
                            <button type="button"
                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition"
                                onclick="openEdit(this)"
                                data-id="{{ $j->id }}"
                                data-dokter="{{ $j->dokter_id }}"
                                data-dokter-nama="{{ optional($j->dokter)->nama ?? 'Dokter Hilang' }}"
                                data-hari="{{ $j->hari }}"
                                data-mulai="{{ $j->jam_mulai }}"
                                data-selesai="{{ $j->jam_selesai }}"
                                data-kuota="{{ $j->kuota_pasien }}"
                                data-status="{{ $j->status }}">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div id="modalTambah" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50 pointer-events-none p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-y-auto max-h-[calc(100vh-4rem)]">

        <form action="{{ route('data.jadwal.store') }}" method="POST">
            @csrf

            <div class="px-6 py-5">
                <h2 class="text-center font-bold text-lg">Tambah Jadwal Praktik</h2>
            </div>

            <div class="p-6 pt-0 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Pilih Dokter</label>
                    <select name="dokter_id" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option value="" disabled selected>-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Hari</label>
                    <select name="hari" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jam Mulai</label>
                        <select name="jam_mulai" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                            @for($i=0;$i<24;$i++)
                                <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jam Selesai</label>
                        <select name="jam_selesai" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                            @for($i=0;$i<24;$i++)
                                <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kuota</label>
                    <input type="number" name="kuota_pasien"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition" min="1" placeholder="Contoh: 15">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-4 p-6 pt-2">
                <button type="button" onclick="closeTambah()"
                    class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="bg-[#09637E] text-white px-6 py-2.5 rounded-xl hover:bg-[#074d61] transition font-medium shadow-md shadow-[#09637E]/30">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
<div id="modalEdit" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50 pointer-events-none p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-y-auto max-h-[calc(100vh-4rem)]">

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="px-6 py-5">
                <h2 class="text-center font-bold text-lg">Edit Jadwal Praktik</h2>
            </div>

            <div class="p-6 pt-0 space-y-4">

                {{-- DOKTER: Read-Only, tidak bisa diubah saat edit jadwal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Dokter</label>
                    <input type="hidden" id="eDokterId" name="dokter_id">
                    <input type="text" id="eDokterNama" class="w-full border border-gray-200 bg-gray-100 rounded-xl px-4 py-2.5 cursor-not-allowed text-gray-500 outline-none" disabled placeholder="Nama Dokter">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Hari</label>
                    <select id="eHari" name="hari" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jam Mulai</label>
                        <select id="eMulai" name="jam_mulai" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                            @for($i=0;$i<24;$i++)
                                <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jam Selesai</label>
                        <select id="eSelesai" name="jam_selesai" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                            @for($i=0;$i<24;$i++)
                                <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kuota</label>
                    <input type="number" id="eKuota" name="kuota_pasien"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition" min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <select id="eStatus" name="status" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-4 p-6 pt-2">
                <button type="button" onclick="closeEdit()"
                    class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="bg-[#09637E] text-white px-6 py-2.5 rounded-xl hover:bg-[#074d61] transition font-medium shadow-md shadow-[#09637E]/30">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function openTambah() {
    const modal = document.getElementById('modalTambah');
    modal.classList.remove('hidden','pointer-events-none');
    modal.classList.add('flex');
}

function closeTambah() {
    const modal = document.getElementById('modalTambah');
    modal.classList.add('hidden','pointer-events-none');
    modal.classList.remove('flex');
}

function openEdit(el) {
    const baseUrl = "{{ route('data.jadwal.update', ['id' => '__ID__']) }}";

    document.getElementById('formEdit').action =
        baseUrl.replace('__ID__', el.dataset.id);

    // Mengisi ID dokter (tersembunyi) dan Nama dokter (tampilan read-only)
    document.getElementById('eDokterId').value = el.dataset.dokter;
    document.getElementById('eDokterNama').value = el.dataset.dokterNama;

    document.getElementById('eHari').value = el.dataset.hari;
    document.getElementById('eMulai').value = el.dataset.mulai.substring(0,5);
    document.getElementById('eSelesai').value = el.dataset.selesai.substring(0,5);
    document.getElementById('eKuota').value = el.dataset.kuota;
    document.getElementById('eStatus').value = el.dataset.status;

    const modal = document.getElementById('modalEdit');
    modal.classList.remove('hidden','pointer-events-none');
    modal.classList.add('flex');
}

function closeEdit() {
    const modal = document.getElementById('modalEdit');
    modal.classList.add('hidden','pointer-events-none');
    modal.classList.remove('flex');
}

/* SEARCH */
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchJadwal');

    if(search){
        search.addEventListener('keyup', function(){
            let val = this.value.toLowerCase();
            document.querySelectorAll('#tableJadwal tr').forEach(row=>{
                let namaEl = row.querySelector('.nama');
                if(!namaEl) return;
                row.style.display = namaEl.innerText.toLowerCase().includes(val) ? '' : 'none';
            });
        });
    }
});

</script>

{{-- ================= SWEETALERT ================= --}}
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
@endif

@if(session('error'))
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}'
});
@endif
</script>

@endsection