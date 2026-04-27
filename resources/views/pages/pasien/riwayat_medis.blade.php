@extends('layouts.dashboard', [
    'pageTitle' => 'Riwayat Medis',
    'userName' => 'Andi Pratama Rayhan',
    'userRole' => 'Pasien',
    'userInitial' => 'AR'
])

@section('sidebar')
    <x-sidebar-pasien />
@endsection

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Pemeriksaan</h1>
        <p class="text-gray-500 text-sm mt-1">Catatan rekam medis pemeriksaan kesehatan Anda.</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <form method="GET" action="{{ route('riwayat.medis') }}" class="flex flex-col sm:flex-row gap-4 items-end">
            <!-- Filter Tahun -->
            <div class="w-full sm:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <select name="tahun" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                    <option value="all" {{ $tahunAktif == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                    <option value="2025" {{ $tahunAktif == '2025' ? 'selected' : '' }}>2025</option>
                    <option value="2024" {{ $tahunAktif == '2024' ? 'selected' : '' }}>2024</option>
                    <option value="2023" {{ $tahunAktif == '2023' ? 'selected' : '' }}>2023</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div class="w-full sm:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                    <option value="all" {{ $statusAktif == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Selesai" {{ $statusAktif == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Menunggu" {{ $statusAktif == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Dibatalkan" {{ $statusAktif == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <!-- Tombol Filter -->
            <button type="submit" class="px-6 py-2.5 bg-[#09637E] text-white text-sm font-semibold rounded-xl hover:bg-[#074d61] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Terapkan Filter
            </button>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Dokter</th>
                        <th class="px-6 py-3">Poli</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($riwayat as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ date('d M Y', strtotime($item['tanggal'])) }}</td>
                        <td class="px-6 py-4">{{ $item['dokter'] }}</td>
                        <td class="px-6 py-4">{{ $item['poli'] }}</td>
                        <td class="px-6 py-4">
                            @if($item['status'] == 'Selesai')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Selesai</span>
                            @elseif($item['status'] == 'Menunggu')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">Menunggu</span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-600">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <!-- TOMBOL DETAIL (MENGGUNAKAN DATA ATTRIBUTE) -->
                            <button onclick="openRiwayatModal(this)"
                                    class="text-[#09637E] hover:text-white hover:bg-[#09637E] border border-[#09637E] px-4 py-1.5 rounded-lg text-sm font-semibold transition"
                                    data-id="{{ $item['id'] }}"
                                    data-dokter="{{ $item['dokter'] }}"
                                    data-tanggal="{{ date('d M Y', strtotime($item['tanggal'])) }}"
                                    data-gejala="{{ $item['gejala'] }}"
                                    data-diagnosa="{{ $item['diagnosa'] }}"
                                    data-resep="{{ $item['resep'] }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400">Tidak ada riwayat medis yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= POP UP MODAL ================= -->
<div id="detailModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center flex">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-gray-50 rounded-t-2xl">
                <div>
                    <h3 class="text-xl font-bold text-gray-900" id="modalDokter">Nama Dokter</h3>
                    <p class="text-sm text-gray-500" id="modalTanggal">Tanggal</p>
                </div>
                <button onclick="closeRiwayatModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6 space-y-5">
                <div>
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-1">Gejala / Keluhan</h4>
                    <p class="text-gray-800 bg-gray-50 p-3 rounded-lg text-sm" id="modalGejala">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-1">Diagnosa</h4>
                    <p class="text-gray-800 font-semibold" id="modalDiagnosa">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-1">Resep Obat</h4>
                    <p class="text-gray-800 bg-blue-50 p-3 rounded-lg text-sm" id="modalResep">-</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-5 border-t border-gray-200 rounded-b-2xl gap-3">
                <button onclick="closeRiwayatModal()" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100">
                    Tutup
                </button>
                <a id="btnUnduhPdf" href="#" target="_blank" class="px-5 py-2.5 text-sm font-medium text-white bg-[#09637E] rounded-xl hover:bg-[#074d61] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Script JS -->
<script>
    function openRiwayatModal(btn) {
        // Ambil data dari tombol menggunakan data-attribute (Anti Error Tanda Kutip)
        const id = btn.getAttribute('data-id');
        const dokter = btn.getAttribute('data-dokter');
        const tanggal = btn.getAttribute('data-tanggal');
        const gejala = btn.getAttribute('data-gejala');
        const diagnosa = btn.getAttribute('data-diagnosa');
        const resep = btn.getAttribute('data-resep');

        // Masukkan data ke modal
        document.getElementById('modalDokter').innerText = dokter;
        document.getElementById('modalTanggal').innerText = tanggal;
        document.getElementById('modalGejala').innerText = gejala;
        document.getElementById('modalDiagnosa').innerText = diagnosa;
        document.getElementById('modalResep').innerText = resep;

        // PERBAIKAN LOGIKA PDF:
        // Kita pakai 'REPLACE_ME' agar tidak merusak port IP (misal 127.0.0.1)
        document.getElementById('btnUnduhPdf').href = "{{ route('riwayat.download-pdf', ['id' => 'REPLACE_ME']) }}".replace("REPLACE_ME", id);

        // Buka Modal
        document.getElementById('detailModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeRiwayatModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection