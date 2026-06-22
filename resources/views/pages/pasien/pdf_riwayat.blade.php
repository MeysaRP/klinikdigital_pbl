<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Rekam Medis - MediTech</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; margin: 40px; }
        .header { border-bottom: 3px solid #09637E; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { color: #09637E; margin: 0; font-size: 24px; }
        .header p { color: #666; margin: 5px 0 0 0; font-size: 12px; }
        .info-box { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #09637E; }
        .section-title { font-weight: bold; color: #555; margin-top: 20px; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; }
        .content-text { line-height: 1.6; }
        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }

        .resep-table { width: 100%; border-collapse: collapse; margin-top: 5px; font-size: 13px; }
        .resep-table th { background: #dbeafe; color: #1e40af; text-align: left; padding: 8px 10px; border: 1px solid #bfdbfe; font-size: 11px; text-transform: uppercase; font-weight: bold; }
        .resep-table td { padding: 8px 10px; border: 1px solid #dbeafe; color: #333; }
        .resep-table tr:nth-child(even) td { background: #f0f7ff; }
        .resep-table td:first-child { text-align: center; color: #999; font-weight: bold; width: 30px; }

        .disclaimer-box { margin-top: 30px; padding: 14px 16px; border: 2px solid #dc2626; border-radius: 6px; background-color: #fef2f2; }
        .disclaimer-box .disclaimer-title { display: flex; align-items: center; margin-bottom: 6px; }
        .disclaimer-box .disclaimer-label { font-weight: bold; color: #dc2626; font-size: 11px; letter-spacing: 1px; }
        .disclaimer-box .disclaimer-text { margin: 0; font-size: 10.5px; color: #374151; line-height: 1.6; }
        .masa-berlaku-row { margin-top: 10px; display: flex; justify-content: space-between; font-size: 9.5px; color: #6b7280; border-top: 1px dashed #d1d5db; padding-top: 8px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>MediTech Clinic</h1>
        <p>Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461 | Telp: (0778) 123456</p>
    </div>

    <div class="info-box">
        <p><strong>Dokter:</strong> {{ $data['dokter'] }}</p>
        <p><strong>Tanggal Periksa:</strong> {{ date('d F Y', strtotime($data['tanggal'])) }}</p>
        <p><strong>Pasien:</strong> {{ $data['pasien'] }}</p>
    </div>

    <div class="section-title">A. Gejala / Keluhan</div>
    <div class="content-text">{{ $data['gejala'] }}</div>

    <div class="section-title">B. Diagnosa</div>
    <div class="content-text" style="font-weight: bold; color: #09637E;">{{ $data['diagnosa'] }}</div>

    <div class="section-title">C. Catatan Dokter</div>
    <div class="content-text" style="background: #fffbeb; padding: 10px; border-radius: 5px;">{{ $data['catatan'] }}</div>

    <div class="section-title">D. Resep Obat</div>
    @php
        $raw = $data['resep_raw'] ?? null;
        $isTable = is_array($raw) && count($raw) > 0 && isset($raw[0]) && is_array($raw[0]);
    @endphp
    @if($isTable)
        <table class="resep-table">
            <thead>
                <tr>
                    <th>#</th>
                    @foreach(array_keys($raw[0]) as $key)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($raw as $idx => $row)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        @foreach(array_keys($raw[0]) as $key)
                            <td>{{ is_array($row[$key] ?? null) ? implode(', ', $row[$key]) : ($row[$key] ?? '-') }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="content-text" style="background: #eff6ff; padding: 10px; border-radius: 5px;">{{ $data['resep'] }}</div>
    @endif

    <div class="disclaimer-box">
        <div class="disclaimer-title">
            <span style="font-size: 15px; margin-right: 6px; color: #dc2626; font-weight: bold;">[!]</span>
            <span class="disclaimer-label">DISCLAIMER</span>
        </div>
        <p class="disclaimer-text">
            Resep obat pada rekam medis ini hanya berlaku untuk pengambilan/pembelian obat
            maksimal <strong>1x24 jam</strong> sejak tanggal pemeriksaan
            (berlaku hingga tanggal <strong>{{ $data['tanggal_berlaku'] }}</strong>).
            Di luar batas waktu tersebut, resep ini dinyatakan <strong>TIDAK BERLAKU</strong>
            dan segala penggunaan resep di luar tanggung jawab <strong>MediTech Clinic</strong>.
        </p>
    </div>

    <div class="masa-berlaku-row">
        <span>Tanggal Periksa: {{ date('d F Y', strtotime($data['tanggal'])) }}</span>
        <span><strong>Masa Berlaku Resep: s/d {{ $data['tanggal_berlaku'] }}</strong></span>
    </div>

    <div class="footer">
        <p>Dokumen ini dikeluarkan secara otomatis oleh sistem MediTech.</p>
        <p>&copy; {{ date('Y') }} Politeknik Negeri Batam - Projek PBL IFpagi2A-02</p>
    </div>

</body>
</html>