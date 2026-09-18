<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE - Tahura Sultan Adam Bukit Batu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f0f4f8; padding: 40px 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .invoice-wrapper { max-width: 1000px; width: 100%; background: #ffffff; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.10); padding: 40px 45px; }
        .header-top { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 3px solid #1e3a0b; padding-bottom: 20px; margin-bottom: 25px; }
        .header-left h1 { font-size: 32px; font-weight: 700; color: #1e3a0b; letter-spacing: 4px; margin: 0; }
        .header-left .sub-info { margin-top: 8px; font-size: 14px; color: #333; }
        .header-left .sub-info span { font-weight: 600; color: #1e3a0b; }
        .header-right { text-align: right; }
        .header-right .logo-placeholder .nama-tahura { font-size: 18px; letter-spacing: 2px; font-weight: 700; color: #1e3a0b; }
        .header-right .logo-placeholder .nama-tahura2 { font-size: 20px; letter-spacing: 2px; font-weight: 700; color: #1e3a0b; }
        .header-right .logo-placeholder .mandiangin { font-size: 13px; font-weight: 600; color: #1e3a0b; }
        .header-right .alamat { font-size: 12px; color: #555; margin-top: 2px; }
        .header-right .logo-wrapper { display: flex; align-items: center; justify-content: flex-end; gap: 15px; }

        .info-penyewa { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; background: #f8faf8; padding: 18px 22px; border-radius: 12px; margin-bottom: 25px; border-left: 5px solid #2d5016; }
        .info-penyewa .kolom p { margin: 4px 0; font-size: 14px; }
        .info-penyewa .kolom .label { font-weight: 600; color: #1e3a0b; }

        .table-detail { width: 100%; border-collapse: collapse; margin: 20px 0 25px 0; font-size: 14px; }
        .table-detail thead th { background: #e6f0da; color: #1e3a0b; font-weight: 600; padding: 12px 14px; border: 1px solid #c5d8b5; text-align: left; }
        .table-detail tbody td { padding: 12px 14px; border: 1px solid #dde6d6; vertical-align: middle; }
        .table-detail tbody tr:nth-child(even) { background: #f9fbf8; }

        .total-section { display: flex; justify-content: flex-end; margin-top: 10px; margin-bottom: 30px; }
        .total-box { width: 340px; background: #1e3a0b; color: #fff; border-radius: 12px; padding: 18px 24px; }
        .total-box .row-total { display: flex; justify-content: space-between; font-size: 14px; padding: 4px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .total-box .row-total:last-child { border-bottom: none; font-size: 20px; font-weight: 700; padding-top: 10px; margin-top: 6px; border-top: 2px solid #fff; }
        .total-box .row-total .label-total { font-weight: 400; }
        .total-box .row-total .value-total { font-weight: 600; }

        .footer-invoice { text-align: center; border-top: 2px solid #1e3a0b; padding-top: 20px; margin-top: 10px; }
        .footer-invoice .terima-kasih { font-size: 14px; color: #1e3a0b; font-weight: 500; margin-bottom: 4px; }
        .footer-invoice .pesan { font-size: 13px; color: #555; margin-bottom: 20px; }
        .footer-invoice .signature-area { display: flex; justify-content: space-between; padding: 0 40px; margin-top: 10px; }
        .footer-invoice .signature-area .sign-item { text-align: center; width: 200px; }
        .footer-invoice .signature-area .sign-item .garis { border-top: 1px solid #333; margin: 25px 0 4px 0; width: 100%; }
        .footer-invoice .signature-area .sign-item .label-sign { font-size: 13px; font-weight: 500; color: #1e3a0b; }

        .actions { text-align: center; margin-top: 30px; display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; }
        .btn-custom { padding: 8px 32px; border-radius: 30px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; border: 2px solid #1e3a0b; background: transparent; color: #1e3a0b; transition: all 0.25s ease; cursor: pointer; }
        .btn-custom:hover { background: #1e3a0b; color: #fff; }
        .btn-custom-print { background: #1e3a0b; color: #fff; border: 2px solid #1e3a0b; }
        .btn-custom-print:hover { background: #2d5016; border-color: #2d5016; }

        @media (max-width: 700px) {
            .invoice-wrapper { padding: 20px; }
            .header-top { flex-direction: column; align-items: flex-start; gap: 15px; }
            .header-right { text-align: left; width: 100%; }
            .header-right .logo-wrapper { justify-content: flex-start; }
            .info-penyewa { grid-template-columns: 1fr; gap: 12px; }
            .total-section { justify-content: center; }
            .total-box { width: 100%; }
            .footer-invoice .signature-area { flex-direction: column; align-items: center; gap: 30px; padding: 0; }
            .footer-invoice .signature-area .sign-item { width: 100%; }
        }
        @media print {
            body { background: #fff; padding: 0; }
            .invoice-wrapper { box-shadow: none; border-radius: 0; padding: 30px; }
            .btn-custom, .btn-custom-print { display: none; }
            .actions { display: none; }
            .table-detail thead th { background: #e6f0da !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .total-box { background: #1e3a0b !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .header-right .logo-wrapper img { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
<div class="invoice-wrapper">
    <div class="header-top">
        <div class="header-left">
            <h1>INVOICE</h1>
            <div class="sub-info">
                <div><span>Invoice Number:</span> {{ $sewa->kode_sewa ?? 'INV-' . date('Ymd') . '-' . str_pad($sewa->id ?? 0, 4, '0', STR_PAD_LEFT) }}</div>
                <div><span>Date of issue:</span> {{ date('Y/m/d') }}</div>
            </div>
        </div>
        <div class="header-right">
            <div class="logo-wrapper">
                <!-- LOGO TAHURA (GAMBAR) -->
                <img src="{{ asset('images/logo-tahura.png') }}" 
                     alt="Logo Tahura Sultan Adam" 
                     style="max-height: 75px; width: auto; border-radius: 50%; border: 2px solid #1e3a0b;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <!-- FALLBACK: kalau gambar gagal load, muncul teks -->
                <div style="width: 75px; height: 75px; background: #1e3a0b; border-radius: 50%; display: none; align-items: center; justify-content: center; border: 2px solid #4a7c2e; flex-shrink: 0; font-size: 28px; color: white; font-weight: 700;">
                    TS
                </div>
                <div class="logo-placeholder">
                    <div class="nama-tahura">TAMAN HUTAN RAYA</div>
                    <div class="nama-tahura2">SULTAN ADAM</div>
                    <div class="mandiangin">BUKIT BATU</div>
                    <div class="alamat">Dusun Manunggul, Desa Tiwingan Baru</div>
                    <div class="alamat">RT 003 RW 001, Kec. Aranio</div>
                    <div class="alamat">Kab. Banjar, Kalimantan Selatan</div>
                    <div class="alamat">Telp. (0511) 4774107</div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-penyewa">
        <div class="kolom">
            <p><span class="label">Nama Penyewa</span><br>{{ $sewa->nama_penyewa ?? '-' }}</p>
            <p><span class="label">Telepon</span><br>{{ $sewa->no_telepon ?? '-' }}</p>
            <p><span class="label">Alamat</span><br>{{ $sewa->alamat ?? '-' }}</p>
        </div>
        <div class="kolom">
            <p><span class="label">Kode Sewa</span><br>{{ $sewa->kode_sewa ?? '-' }}</p>
            <p><span class="label">Check In</span><br>{{ \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d/m/Y') ?? '-' }} {{ $sewa->jam_mulai ?? '' }}</p>
            <p><span class="label">Check Out</span><br>{{ \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d/m/Y') ?? '-' }} {{ $sewa->jam_selesai ?? '' }}</p>
        </div>
    </div>

    <table class="table-detail">
        <thead><tr><th>Nama Fasilitas</th><th>Jumlah</th><th>Harga</th><th>Durasi (Hari)</th><th>Subtotal</th></tr></thead>
        <tbody>
            <tr>
                <td><strong>{{ $sewa->fasilitas ?? '-' }}</strong></td>
                <td>{{ $sewa->jumlah_unit ?? 0 }}</td>
                <td>Rp {{ number_format($sewa->harga_sewa ?? 0, 0, ',', '.') }}</td>
                <td>{{ $sewa->lama_sewa_hari ?? 0 }}</td>
                <td><strong>Rp {{ number_format($sewa->total_biaya ?? 0, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-box">
            <div class="row-total"><span class="label-total">Subtotal</span><span class="value-total">Rp {{ number_format($sewa->total_biaya ?? 0, 0, ',', '.') }}</span></div>
            <div class="row-total"><span class="label-total">Diskon</span><span class="value-total">Rp 0</span></div>
            <div class="row-total"><span class="label-total">Pajak</span><span class="value-total">Rp 0</span></div>
            <div class="row-total"><span class="label-total">TOTAL PEMBAYARAN</span><span class="value-total">Rp {{ number_format($sewa->total_biaya ?? 0, 0, ',', '.') }}</span></div>
        </div>
    </div>

    <div class="footer-invoice">
        <div class="terima-kasih">Terima kasih telah melakukan penyewaan fasilitas di Tahura Sultan Adam Bukit Batu.</div>
        <div class="pesan">Semoga perjalanan Anda menyenangkan.</div>
        <div class="signature-area">
            <div class="sign-item"><div class="garis"></div><div class="label-sign">Petugas Tahura</div></div>
            <div class="sign-item"><div class="garis"></div><div class="label-sign">Penyewa</div></div>
        </div>
    </div>

    <div class="actions">
        <button onclick="window.print()" class="btn-custom btn-custom-print">🖨️ CETAK</button>
        <a href="{{ route('sewa-fasilitas.index') }}" class="btn-custom">KEMBALI</a>
    </div>
</div>
</body>
</html>