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
                        <td class="px-4 py-2 nama">{{ $j->dokter->nama ?? '-' }}</td>
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
                                onclick="openEdit({
                                    id: {{ $j->id }},
                                    dokter_id: {{ $j->dokter_id }},
                                    hari: '{{ $j->hari }}',
                                    jam_mulai: '{{ $j->jam_mulai }}',
                                    jam_selesai: '{{ $j->jam_selesai }}',
                                    kuota_pasien: {{ $j->kuota_pasien }},
                                    status: '{{ $j->status }}'
                                })"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">
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
                    <label class="block mb-1 font-medium text-gray-700">Pilih Dokter</label>
                    <select id="tDokter" name="dokter_id"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none">
                        <option value="" disabled selected>-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Hari Praktik</label>
                    <select id="tHari" name="hari"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label class="block mb-1 font-medium text-gray-700">Jam Mulai</label>
                        <select id="tMulai" name="jam_mulai"
                            class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                            <option>08:00</option><option>09:00</option><option>10:00</option>
                            <option>11:00</option><option>13:00</option><option>14:00</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-1 font-medium text-gray-700">Jam Selesai</label>
                        <select id="tSelesai" name="jam_selesai"
                            class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                            <option>09:00</option><option>10:00</option><option>11:00</option>
                            <option>12:00</option><option>15:00</option><option>16:00</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Kuota Pasien</label>
                    <select id="tKuota" name="kuota_pasien"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                        <option>1</option><option>5</option><option>10</option>
                        <option>15</option><option>20</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Status</label>
                    <select id="tStatus" name="status"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-3 mt-6">
                <button type="button" onclick="closeTambah()"
                    class="border border-gray-300 px-6 py-2 rounded text-gray-700">
                    Batal
                </button>
                <button type="submit"
                    class="bg-[#09637E] text-white px-6 py-2 rounded">
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
                    <label class="block mb-1 font-medium text-gray-700">Pilih Dokter</label>
                    <select id="eDokter" name="dokter_id"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none">
                        @foreach($dokters as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Hari Praktik</label>
                    <select id="eHari" name="hari"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white focus:outline-none">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label class="block mb-1 font-medium text-gray-700">Jam Mulai</label>
                        <select id="eMulai" name="jam_mulai"
                            class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                            <option>08:00</option><option>09:00</option><option>10:00</option>
                            <option>11:00</option><option>13:00</option><option>14:00</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="block mb-1 font-medium text-gray-700">Jam Selesai</label>
                        <select id="eSelesai" name="jam_selesai"
                            class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                            <option>09:00</option><option>10:00</option><option>11:00</option>
                            <option>12:00</option><option>15:00</option><option>16:00</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Kuota Pasien</label>
                    <select id="eKuota" name="kuota_pasien"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                        <option>1</option><option>5</option><option>10</option>
                        <option>15</option><option>20</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Status</label>
                    <select id="eStatus" name="status"
                        class="border border-gray-300 w-full px-2 py-2 rounded bg-white">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>

            </div>

            <div class="flex justify-center gap-3 mt-6">
                <button type="button" onclick="closeEdit()"
                    class="border border-gray-300 px-6 py-2 rounded text-gray-700">
                    Batal
                </button>
                <button type="submit"
                    class="bg-[#09637E] text-white px-6 py-2 rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>


{{-- ================= JAVASCRIPT ================= --}}
<script>

/* ===== MODAL TAMBAH ===== */
function openTambah() {
    const modal = document.getElementById('modalTambah');
    modal.classList.remove('hidden', 'pointer-events-none');
    modal.classList.add('flex');
}

function closeTambah() {
    const modal = document.getElementById('modalTambah');
    modal.classList.add('hidden', 'pointer-events-none');
    modal.classList.remove('flex');
}

/* ===== MODAL EDIT ===== */
function openEdit(data) {
    // Gunakan route() dari Blade, tinggal ganti nama route-nya
    const baseUrl = "{{ route('data.jadwal.update', ['id' => '__ID__']) }}";
    document.getElementById('formEdit').action = baseUrl.replace('__ID__', data.id);

    setSelect('eDokter',  String(data.dokter_id));
    setSelect('eHari',    data.hari);
    setSelect('eMulai',   data.jam_mulai);
    setSelect('eSelesai', data.jam_selesai);
    setSelect('eKuota',   String(data.kuota_pasien));
    setSelect('eStatus',  data.status);

    const modal = document.getElementById('modalEdit');
    modal.classList.remove('hidden', 'pointer-events-none');
    modal.classList.add('flex');
}
function closeEdit() {
    const modal = document.getElementById('modalEdit');
    modal.classList.add('hidden', 'pointer-events-none');
    modal.classList.remove('flex');
}

// Helper: cocokkan option berdasarkan value atau text
function setSelect(id, val) {
    const sel = document.getElementById(id);
    for (let opt of sel.options) {
        if (opt.value === val || opt.text === val) {
            opt.selected = true;
            break;
        }
    }
}

/* ===== SEARCH ===== */
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchJadwal');

    if (search) {
        search.addEventListener('keyup', function () {
            let val = this.value.toLowerCase();

            document.querySelectorAll('#tableJadwal tr').forEach(row => {
                let namaEl = row.querySelector('.nama');
                if (!namaEl) return;
                let nama = namaEl.innerText.toLowerCase();
                row.style.display = nama.includes(val) ? '' : 'none';
            });
        });
    }
});

</script>

@endsection