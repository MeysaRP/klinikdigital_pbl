@extends('layouts.dashboard', [
    'pageTitle' => 'Riwayat Medis',
    'userName' => $userName,
    'userRole' => $userRole,
    'userInitial' => $userInitial
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
            <!-- Filter Status -->
            <div class="w-full sm:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-[#09637E] focus:border-[#09637E]">
                    <option value="all" {{ $statusAktif == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Selesai" {{ $statusAktif == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Menunggu" {{ $statusAktif == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Dibatalkan" {{ $statusAktif == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 min-w-[600px]">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Dokter</th>
                        <th class="px-6 py-3">Keluhan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($riwayat as $item)
                        @php
                            $rekamMedis = $item->antrian?->rekamMedis;

                            $toStr = function($val) {
                                if (is_array($val)) {
                                    $flat = [];
                                    array_walk_recursive($val, function($item) use (&$flat) {
                                        if (!is_array($item)) $flat[] = $item;
                                    });
                                    return count($flat) > 0 ? implode(', ', $flat) : '-';
                                }
                                if (is_object($val)) {
                                    return json_encode((array) $val, JSON_UNESCAPED_UNICODE);
                                }
                                return $val ?? '-';
                            };

                            $strDiagnosa = $toStr($rekamMedis?->diagnosa);
                            $strCatatan = $toStr($rekamMedis?->catatan_dokter);
                            $strResep    = $toStr($rekamMedis?->resep_obat);

                            $rawResep    = $rekamMedis?->resep_obat;
                            $jsonResep   = (is_array($rawResep) || is_object($rawResep))
                                         ? json_encode($rawResep, JSON_UNESCAPED_UNICODE)
                                         : 'null';
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ date('d M Y', strtotime($item->tanggal)) }}
                            </td>
                            <td class="px-6 py-4">
                                dr. {{ $item->dokter?->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->keluhan ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 'Selesai')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Selesai</span>
                                @elseif($item->status == 'Menunggu')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">Menunggu</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-600">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    onclick="openRiwayatModal(this)"
                                    class="text-[#09637E] hover:text-white hover:bg-[#09637E] border border-[#09637E] px-4 py-1.5 rounded-lg text-sm font-semibold transition"
                                    data-id="{{ $item->id }}"
                                    data-dokter="dr. {{ $item->dokter?->nama ?? '-' }}"
                                    data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
                                    data-gejala="{{ $item->keluhan ?? '-' }}"
                                    data-diagnosa="{{ $strDiagnosa }}"
                                    data-catatan="{{ $strCatatan }}"
                                    data-resep="{{ $strResep }}"
                                    data-json-resep="{{ $jsonResep }}"
                                >
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Tidak ada riwayat medis yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= POP UP MODAL ================= -->
<div id="detailModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center flex">
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200">
            <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-gray-50 rounded-t-2xl sticky top-0 z-10">
                <div>
                    <h3 class="text-xl font-bold text-gray-900" id="modalDokter">Nama Dokter</h3>
                    <p class="text-sm text-gray-500" id="modalTanggal">Tanggal</p>
                </div>
                <button onclick="closeRiwayatModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
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
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-1">Catatan Dokter</h4>
                    <p class="text-gray-800 bg-amber-50 p-3 rounded-lg text-sm" id="modalCatatan">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-1">Resep Obat</h4>
                    <div id="modalResep" class="text-gray-800 bg-blue-50 p-3 rounded-lg text-sm">-</div>
                </div>
                <div class="flex items-start gap-2 bg-red-50 border border-red-200 rounded-lg p-3">
                    <span class="text-red-600 font-bold text-sm mt-px">[!]</span>
                    <p class="text-xs text-red-700 leading-relaxed">
                        Resep obat berlaku maksimal <strong>1x24 jam</strong> sejak tanggal pemeriksaan.
                        Untuk bukti sah pengambilan obat di apotek, silakan <strong>Unduh PDF</strong> yang tersedia di bawah.
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-end p-5 border-t border-gray-200 rounded-b-2xl gap-3 sticky bottom-0 bg-white z-10">
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

<script>
    function formatCell(val) {
        if (val === null || val === undefined) return '-';
        if (Array.isArray(val)) return val.join(', ');
        return String(val);
    }

    function renderResepTable(data, fallbackText) {
        if (!data || !Array.isArray(data) || data.length === 0) {
            return '<span>' + fallbackText + '</span>';
        }

        const firstItem = data[0];
        if (typeof firstItem !== 'object' || firstItem === null) {
            let html = '<ul class="space-y-1">';
            data.forEach(item => {
                html += '<li class="flex items-start gap-2"><span class="text-blue-500 mt-0.5">&#8226;</span><span>' + formatCell(item) + '</span></li>';
            });
            html += '</ul>';
            return html;
        }

        const keys = Object.keys(firstItem);

        let html = '<div class="overflow-x-auto -mx-3"><table class="w-full text-sm border-collapse min-w-[300px]">';
        html += '<thead><tr>';
        html += '<th class="text-left px-3 py-2 bg-blue-200/60 text-blue-800 text-xs font-bold uppercase tracking-wide border border-blue-200 rounded-tl-lg">#</th>';
        keys.forEach((key, i) => {
            const rounded = (i === keys.length - 1) ? 'rounded-tr-lg' : '';
            html += '<th class="text-left px-3 py-2 bg-blue-200/60 text-blue-800 text-xs font-bold uppercase tracking-wide border border-blue-200 ' + rounded + '">' + key + '</th>';
        });
        html += '</tr></thead>';

        html += '<tbody>';
        data.forEach((item, idx) => {
            html += '<tr class="hover:bg-blue-50/50 transition-colors">';
            html += '<td class="px-3 py-2.5 border border-blue-100 text-gray-400 font-medium text-xs text-center">' + (idx + 1) + '</td>';
            keys.forEach(key => {
                const val = item[key];
                const cellText = formatCell(val);
                html += '<td class="px-3 py-2.5 border border-blue-100 text-gray-700">' + cellText + '</td>';
            });
            html += '</tr>';
        });
        html += '</tbody></table></div>';

        return html;
    }

    function openRiwayatModal(btn) {
        const id = btn.getAttribute('data-id');
        const dokter = btn.getAttribute('data-dokter');
        const tanggal = btn.getAttribute('data-tanggal');
        const gejala = btn.getAttribute('data-gejala');
        const diagnosa = btn.getAttribute('data-diagnosa');
        const catatan = btn.getAttribute('data-catatan');
        const resep = btn.getAttribute('data-resep');
        const jsonResep = btn.getAttribute('data-json-resep');

        document.getElementById('modalDokter').innerText = dokter;
        document.getElementById('modalTanggal').innerText = tanggal;
        document.getElementById('modalGejala').innerText = gejala;
        document.getElementById('modalDiagnosa').innerText = diagnosa;
        document.getElementById('modalCatatan').innerText = catatan;

        const resepContainer = document.getElementById('modalResep');
        if (jsonResep && jsonResep !== 'null') {
            try {
                const parsed = JSON.parse(jsonResep);
                resepContainer.innerHTML = renderResepTable(parsed, resep);
            } catch (e) {
                resepContainer.innerText = resep;
            }
        } else {
            resepContainer.innerText = resep;
        }

        document.getElementById('btnUnduhPdf').href = "{{ route('riwayat.download-pdf', ['id' => 'REPLACE_ME']) }}".replace("REPLACE_ME", id);

        document.getElementById('detailModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeRiwayatModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection