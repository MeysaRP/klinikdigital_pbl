@extends('layouts.dashboard', [
    'pageTitle' => 'Data Pasien',
    'userName' => 'Halo, Admin',
    'userRole' => 'Admin',
    'userInitial' => 'A'
])

@section('sidebar')
<x-sidebar-admin />
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="space-y-5">

    <!-- SEARCH -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="relative w-full max-w-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" oninput="cariPasien(this.value)"
                placeholder="Cari Pasien..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">

            <table class="w-full text-sm min-w-[700px]">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-5 py-3.5 text-left">ID</th>
                        <th class="px-5 py-3.5 text-left">Nama</th>
                        <th class="px-5 py-3.5 text-left">No HP</th>
                        <th class="px-5 py-3.5 text-left">Tanggal Lahir</th>
                        <th class="px-5 py-3.5 text-left">Jenis Kelamin</th>
                        <th class="px-5 py-3.5 text-left">Alamat</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-100">
                @foreach ($pasien as $p)
                <tr class="pasien-row hover:bg-gray-50 transition"
                    data-id="{{ $p->id }}"
                    data-nama="{{ $p->name }}">

                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $p->id }}</td>

                    <td class="px-5 py-3.5 font-medium">{{ $p->name }}</td>

                    <td class="px-5 py-3.5 pasien-no_hp">
                        {{ $p->no_hp }}
                    </td>

                    <td class="px-5 py-3.5">
                        {{ $p->tgl_lahir }}
                    </td>

                    {{-- JENIS KELAMIN (FIX FLEXIBLE) --}}
                    <td class="px-5 py-3.5">
                        @php
                            $jk = strtolower($p->jk);
                        @endphp

                        @if($jk == 'laki-laki' || $jk == 'l' || $jk == 'male')
                            <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-medium">
                                Laki-Laki
                            </span>

                        @elseif($jk == 'perempuan' || $jk == 'p' || $jk == 'female')
                            <span class="px-3 py-1 text-xs bg-pink-100 text-pink-700 rounded-full font-medium">
                                Perempuan
                            </span>

                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- ALAMAT (AUTO WRAP) --}}
                    <td class="px-5 py-3.5 text-gray-600 whitespace-normal break-words max-w-xs">
                        {{ $p->alamat ?? '-' }}
                    </td>

                    <td class="px-5 py-3.5 text-right">
                        <button
                            data-id="{{ $p->id }}"
                            data-nama="{{ $p->name }}"
                            data-tgl="{{ $p->tgl_lahir }}"
                            data-jk="{{ $p->jk }}"
                            data-no_hp="{{ $p->no_hp }}"
                            data-alamat="{{ $p->alamat }}"
                            onclick="openEditModal(this)"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-[#09637E]/10 text-[#09637E] hover:bg-[#09637E] hover:text-white transition">
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

<!-- MODAL -->
<div id="modalEdit" class="fixed inset-0 hidden z-50 items-center justify-center">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEditModal()"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4 w-full">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-y-auto max-h-[calc(100vh-4rem)]">

            <div class="px-6 py-5">
                <h2 class="text-center font-bold text-lg">Edit Pasien</h2>
            </div>

            <div class="p-6 pt-0 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Pasien</label>
                    <input id="edit_nama" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                    <input id="edit_tgl" type="date" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Jenis Kelamin</label>
                    <select id="edit_jk" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition appearance-none">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">No HP</label>
                    <input id="edit_hp" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                    <input id="edit_alamat" class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-[#09637E]/20 focus:border-[#09637E] transition">
                </div>
            </div>

            <div class="flex justify-center gap-4 p-6 pt-2">
                <button onclick="closeEditModal()" class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                    Batal
                </button>
                <button onclick="saveEdit()" class="bg-[#09637E] text-white px-6 py-2.5 rounded-xl hover:bg-[#074d61] transition font-medium shadow-md shadow-[#09637E]/30">
                    Simpan
                </button>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
let currentRow = null;

function openEditModal(btn) {
    currentRow = btn.closest('.pasien-row');

    document.getElementById('edit_nama').value = btn.dataset.nama;
    document.getElementById('edit_tgl').value = btn.dataset.tgl;
    document.getElementById('edit_jk').value = btn.dataset.jk;
    document.getElementById('edit_hp').value = btn.dataset.no_hp;
    document.getElementById('edit_alamat').value = btn.dataset.alamat;

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalEdit').classList.remove('flex');
}

function saveEdit() {
    const id = currentRow.dataset.id;

    fetch(`/dashboard/admin/data_pasien/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            name: document.getElementById('edit_nama').value,
            tgl_lahir: document.getElementById('edit_tgl').value,
            jk: document.getElementById('edit_jk').value,
            no_hp: document.getElementById('edit_hp').value,
            alamat: document.getElementById('edit_alamat').value
        })
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) throw new Error(data.message);
        return data;
    })
    .then(data => {

        currentRow.querySelector('.pasien-no_hp').textContent =
            document.getElementById('edit_hp').value;

        closeEditModal();

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: data.message,
            timer: 2000,
            showConfirmButton: false
        });

    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: err.message || 'Terjadi kesalahan'
        });
    });
}

function cariPasien(q) {
    document.querySelectorAll('.pasien-row').forEach(row => {
        row.style.display =
            row.dataset.nama.toLowerCase().includes(q.toLowerCase())
            ? '' : 'none';
    });
}
</script>

@endsection