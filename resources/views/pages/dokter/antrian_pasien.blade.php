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

    <!-- HEADER -->
    <h2 class="text-lg font-semibold text-gray-800">Antrian Pasien Hari Ini</h2>

    <!-- FILTER (SUDAH DIRAPIIN) -->
    <div class="flex gap-4">
        <div class="relative">
            <select class="appearance-none border border-gray-200 rounded-xl pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]">
                <option>Tanggal</option>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <div class="relative">
            <select class="appearance-none border border-gray-200 rounded-xl pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#09637E]">
                <option>Status</option>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    <!-- TABLE (SUDAH RAPI TOTAL) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm table-fixed">

            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="w-16 px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Pasien</th>
                    <th class="px-4 py-3 text-left">Keluhan</th>
                    <th class="w-32 px-4 py-3 text-left">Status</th>
                    <th class="w-40 px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-gray-700">

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">05</td>
                    <td class="px-4 py-3 font-medium">Andi Pratama</td>
                    <td class="px-4 py-3">Demam</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Selesai
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button onclick="openModal()" class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs hover:bg-gray-200 transition">
                            Isi Rekam Medis
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">06</td>
                    <td class="px-4 py-3 font-medium">Siti Aminah</td>
                    <td class="px-4 py-3">Batuk</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Menunggu
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button onclick="openModal()" class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs hover:bg-gray-200 transition">
                            Periksa
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">07</td>
                    <td class="px-4 py-3 font-medium">Budi Santoso</td>
                    <td class="px-4 py-3">Flu ringan</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Menunggu
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button onclick="openModal()" class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs hover:bg-gray-200 transition">
                            Periksa
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">08</td>
                    <td class="px-4 py-3 font-medium">Rini Wulandari</td>
                    <td class="px-4 py-3">Pusing</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Menunggu
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button onclick="openModal()" class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs hover:bg-gray-200 transition">
                            Periksa
                        </button>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</div>

<!-- MODAL (SUDAH LEBIH SMOOTH) -->
<div id="modalRM" class="fixed inset-0 bg-black/20 backdrop-blur-sm flex items-center justify-center hidden z-50">

    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl border border-gray-100 p-6">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Rekam Medis Pasien
        </h3>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <input placeholder="Nama Pasien" class="border border-gray-200 rounded-lg p-2">
            <input placeholder="No. Antrian" class="border border-gray-200 rounded-lg p-2">
            <input placeholder="Keluhan" class="border border-gray-200 rounded-lg p-2">

            <div></div>

            <input placeholder="Diagnosa" class="col-span-2 border border-gray-200 rounded-lg p-2">
            <textarea placeholder="Catatan Dokter" class="col-span-2 border border-gray-200 rounded-lg p-2"></textarea>

            <div class="col-span-2 grid grid-cols-3 gap-2">
                <input placeholder="Nama Obat" class="border border-gray-200 rounded-lg p-2">
                <input placeholder="Dosis" class="border border-gray-200 rounded-lg p-2">
                <input placeholder="Keterangan" class="border border-gray-200 rounded-lg p-2">
            </div>

        </div>

        <div class="flex justify-end gap-2 mt-5">
            <button onclick="closeModal()" class="bg-gray-200 px-4 py-1.5 rounded-lg text-sm hover:bg-gray-300">
                Tutup
            </button>

            <button class="bg-[#09637E] text-white px-4 py-1.5 rounded-lg text-sm hover:bg-[#074d61]">
                Simpan
            </button>
        </div>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalRM').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modalRM').classList.add('hidden');
}
</script>

@endsection