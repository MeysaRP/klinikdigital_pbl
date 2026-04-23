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
<div class="p-6 bg-white rounded shadow">

    <h2 class="text-lg font-semibold mb-4">DATA PASIEN</h2>

    <!-- Table -->
    <table class="w-full border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">ID Pasien</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">No. HP</th>
                <th class="border px-2 py-1">Tgl.Daftar</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasien as $p)
            <tr>
                <td class="border px-2 py-1">{{ $p['id'] }}</td>
                <td class="border px-2 py-1">{{ $p['nama'] }}</td>
                <td class="border px-2 py-1">{{ $p['hp'] }}</td>
                <td class="border px-2 py-1">{{ $p['tgl'] }}</td>
                <td class="border px-2 py-1 text-center space-x-2">

                <!-- DETAIL -->
            <button 
                onclick="openModal('{{ $p['nama'] }}','{{ $p['tgl'] }}','Laki-Laki','{{ $p['hp'] }}','Jl. Sudirman No.09 Pekanbaru')"
                class="bg-primary hover:bg-primary/90 text-white px-3 py-1 rounded-md text-xs">
                Detail
            </button>

                <!-- EDIT -->
            <button 
                onclick="openEditModal('{{ $p['nama'] }}','{{ $p['tgl'] }}','Laki-Laki','{{ $p['hp'] }}','Jl. Sudirman No.09 Pekanbaru')"
                class="bg-primary/20 text-primary hover:bg-primary hover:text-white px-3 py-1 rounded-md text-xs">
                Edit
            </button>

        </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- ================= MODAL ================= -->
<div id="modalDetail" 
class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white w-[400px] p-6 rounded-xl shadow-2xl border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-center">Detail Data Pasien</h2>

        <div class="space-y-2 text-sm">
            <div>
                <label>Nama Lengkap</label>
                <input id="nama" class="w-full border px-2 py-1" readonly>
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input id="tgl" class="w-full border px-2 py-1" readonly>
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <input id="jk" class="w-full border px-2 py-1" readonly>
            </div>

            <div>
                <label>No.HP</label>
                <input id="hp" class="w-full border px-2 py-1" readonly>
            </div>

            <div>
                <label>Alamat</label>
                <input id="alamat" class="w-full border px-2 py-1" readonly>
            </div>
        </div>

        <div class="text-center mt-4">
            <button onclick="closeModal()" 
        class="bg-[#09637E] text-white px-4 py-1">
            Tutup
        </button>
        </div>
    </div>

</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit" 
class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white w-[400px] p-6 rounded-xl shadow-2xl border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-center">Edit Data Pasien</h2>

        <div class="space-y-2 text-sm">

            <div>
                <label>Nama Lengkap</label>
                <input id="edit_nama" class="w-full border px-2 py-1">
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input type="date" id="edit_tgl" class="w-full border px-2 py-1">
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <select id="edit_jk" class="w-full border px-2 py-1">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div>
                <label>No.HP</label>
                <input id="edit_hp" class="w-full border px-2 py-1">
            </div>

            <div>
                <label>Alamat</label>
                <input id="edit_alamat" class="w-full border px-2 py-1">
            </div>

        </div>

        <div class="flex justify-center gap-3 mt-4">
        <button onclick="closeEditModal()" 
        class="border border-[#09637E] text-[#09637E] px-4 py-1">
            Batal
        </button>

    <button 
    class="bg-[#09637E] text-white px-4 py-1">
        Simpan
    </button>
        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
function openModal(nama, tgl, jk, hp, alamat) {
    document.getElementById('nama').value = nama;
    document.getElementById('tgl').value = tgl;
    document.getElementById('jk').value = jk;
    document.getElementById('hp').value = hp;
    document.getElementById('alamat').value = alamat;

    document.getElementById('modalDetail').classList.remove('hidden');
    document.getElementById('modalDetail').classList.add('flex');
}

function closeModal() {
    document.getElementById('modalDetail').classList.remove('flex');
    document.getElementById('modalDetail').classList.add('hidden');
}

function openEditModal(nama, tgl, jk, hp, alamat) {
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_tgl').value = tgl;
    document.getElementById('edit_jk').value = jk;
    document.getElementById('edit_hp').value = hp;
    document.getElementById('edit_alamat').value = alamat;

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.remove('flex');
    document.getElementById('modalEdit').classList.add('hidden');
}
</script>

@endsection