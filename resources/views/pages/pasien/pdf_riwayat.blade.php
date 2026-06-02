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
    </style>
</head>
<body>

    <div class="header">
        <h1>MediTech Clinic</h1>
        <p>Jl. Politeknik No. 1, Batam | Telp: (0778) 123456</p>
    </div>

    <div class="info-box">
        <p><strong>Dokter:</strong> {{ $data['dokter'] }}</p>
        <p><strong>Tanggal Periksa:</strong> {{ date('d F Y', strtotime($data['tanggal'])) }}</p>
        <p><strong>Poli:</strong> {{ $data['poli'] }}</p>
        <p><strong>Pasien:</strong> {{ $data['pasien'] }}</p>
    </div>

    <div class="section-title">A. Gejala / Keluhan</div>
    <div class="content-text">{{ $data['gejala'] }}</div>

    <div class="section-title">B. Diagnosa</div>
    <div class="content-text" style="font-weight: bold; color: #09637E;">{{ $data['diagnosa'] }}</div>

    <div class="section-title">C. Resep Obat</div>
    <div class="content-text" style="background: #eff6ff; padding: 10px; border-radius: 5px;">{{ $data['resep'] }}</div>

    <div class="footer">
        <p>Dokumen ini dikeluarkan secara otomatis oleh sistem MediTech.</p>
        <p>&copy; {{ date('Y') }} Politeknik Negeri Batam - Projek PBL IFpagi2A-02</p>
    </div>

</body>
</html>