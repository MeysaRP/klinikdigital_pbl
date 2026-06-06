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

                        {{-- ✅ AMAN RELASI DOKTER --}}
                        <td class="px-4 py-2 nama">
                            {{ optional($j->dokter)->nama ?? '-' }}
                        </td>

                        <td class="px-4 py-2">{{ $j->hari }}</td>
                        <td class="px-4 py-2">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                        <td class="px-4 py-2">{{ $j->kuota_pasien }}</td>

                        <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                            @if($j->status=='Aktif') bg-green-100 text-green-600
                            @elseif($j->status=='Nonaktif') bg-red-100 text-red-600
                            @else bg-yellow-100 text-yellow-600 @endif">
                                {{ $j->status }}
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            <button type="button"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-xs"
                                onclick="openEdit(this)"
                                data-id="{{ $j->id }}"
                                data-dokter="{{ $j->dokter_id }}"
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
<div id="modalTambah" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 pointer-events-none">
    <div class="bg-white w-full max-w-[400px] p-6 rounded-lg shadow-lg mx-4">

        <form action="{{ route('data.jadwal.store') }}" method="POST">
            @csrf

            <h2 class="text-center font-semibold mb-4">Tambah Jadwal Praktik</h2>

            <div class="space-y-3 text-sm">

                <div>
                    <label>Pilih Dokter</label>
                    <select name="dokter_id" class="border w-full px-2 py-2 rounded">
                        <option value="" disabled selected>-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Hari</label>
                    <select name="hari" class="border w-full px-2 py-2 rounded">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div>
                    <label>Jam Mulai</label>
                    <select name="jam_mulai" class="border w-full px-2 py-2 rounded">
                        @for($i=0;$i<24;$i++)
                            <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label>Jam Selesai</label>
                    <select name="jam_selesai" class="border w-full px-2 py-2 rounded">
                        @for($i=0;$i<24;$i++)
                            <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label>Kuota</label>
                    <input type="number" name="kuota_pasien"
                        class="border w-full px-2 py-2 rounded" min="1">
                </div>

                <div>
                    <label>Status</label>
                    <select name="status" class="border w-full px-2 py-2 rounded">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-3 mt-6">
                <button type="button" onclick="closeTambah()" class="border px-6 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-[#09637E] text-white px-6 py-2 rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 pointer-events-none">
    <div class="bg-white w-full max-w-[400px] p-6 rounded-lg shadow-lg mx-4">

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <h2 class="text-center font-semibold mb-4">Edit Jadwal Praktik</h2>

            <div class="space-y-3 text-sm">

                <div>
                    <label>Pilih Dokter</label>
                    <select id="eDokter" name="dokter_id" class="border w-full px-2 py-2 rounded">
                        @foreach($dokters as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Hari</label>
                    <select id="eHari" name="hari" class="border w-full px-2 py-2 rounded">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div>
                    <label>Jam Mulai</label>
                    <select id="eMulai" name="jam_mulai" class="border w-full px-2 py-2 rounded">
                        @for($i=0;$i<24;$i++)
                            <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label>Jam Selesai</label>
                    <select id="eSelesai" name="jam_selesai" class="border w-full px-2 py-2 rounded">
                        @for($i=0;$i<24;$i++)
                            <option value="{{ sprintf('%02d:00',$i) }}">{{ sprintf('%02d:00',$i) }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label>Kuota</label>
                    <input type="number" id="eKuota" name="kuota_pasien"
                        class="border w-full px-2 py-2 rounded" min="1">
                </div>

                <div>
                    <label>Status</label>
                    <select id="eStatus" name="status" class="border w-full px-2 py-2 rounded">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-3 mt-6">
                <button type="button" onclick="closeEdit()" class="border px-6 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-[#09637E] text-white px-6 py-2 rounded">
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

    document.getElementById('eDokter').value = el.dataset.dokter;
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