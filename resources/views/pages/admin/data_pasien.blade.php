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
        <input type="text" oninput="cariPasien(this.value)"
            placeholder="Cari Pasien..."
            class="w-full max-w-sm border rounded-xl px-4 py-2">
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">

            <table class="w-full text-sm min-w-[700px]">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
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

                <tbody>
                @foreach ($pasien as $p)
                <tr class="pasien-row"
                    data-id="{{ $p->id }}"
                    data-nama="{{ $p->name }}">

                    <td class="px-5 py-3.5">{{ $p->id }}</td>

                    <td class="px-5 py-3.5">{{ $p->name }}</td>

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
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                Laki-Laki
                            </span>

                        @elseif($jk == 'perempuan' || $jk == 'p' || $jk == 'female')
                            <span class="px-2 py-1 text-xs bg-pink-100 text-pink-700 rounded-full">
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
                            class="px-3 py-1.5 text-xs bg-amber-50 text-amber-600 rounded-lg">
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
<div id="modalEdit" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-black/40" onclick="closeEditModal()"></div>

    <div class="absolute inset-0 flex items-center justify-center">
        <div class="bg-white w-full max-w-md p-5 rounded-xl">

            <h2 class="text-center font-bold mb-3">Edit Pasien</h2>

            <input id="edit_nama" class="w-full border p-2 mb-2 rounded">
            <input id="edit_tgl" type="date" class="w-full border p-2 mb-2 rounded">

            <select id="edit_jk" class="w-full border p-2 mb-2 rounded">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <input id="edit_hp" class="w-full border p-2 mb-2 rounded">
            <input id="edit_alamat" class="w-full border p-2 mb-2 rounded">

            <div class="flex gap-2 mt-3">
                <button onclick="closeEditModal()" class="flex-1 bg-gray-300 p-2 rounded">Batal</button>
                <button onclick="saveEdit()" class="flex-1 text-white p-2 rounded" style="background-color: #09637E;">Simpan</button>
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
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
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
            text: data.message
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