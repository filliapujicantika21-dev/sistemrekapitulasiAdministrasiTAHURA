<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking Glamping - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #5d3a1a; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .info-item { padding: 10px; background: #f8f9fa; border-radius: 8px; }
        .info-item label { font-weight: 600; color: #666; display: block; font-size: 12px; }
        .info-item .value { font-size: 16px; margin-top: 5px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .text-center { text-align: center; margin-top: 20px; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-dark { background: #343a40; color: white; }
        .mt-20 { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>⛺ Detail Booking Glamping</h1>
                <a href="{{ route('glamping.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>Kode Booking</label>
                    <div class="value"><strong>{{ $glamping->kode_booking }}</strong></div>
                </div>
                <div class="info-item">
                    <label>Status Pembayaran</label>
                    <div class="value">
                        @if($glamping->status_pembayaran == 'lunas')
                            <span class="badge badge-success">✅ Lunas</span>
                        @elseif($glamping->status_pembayaran == 'dp')
                            <span class="badge badge-warning">🔄 DP</span>
                        @else
                            <span class="badge badge-danger">❌ Belum Bayar</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <label>Nama Tamu</label>
                    <div class="value">{{ $glamping->nama_tamu }}</div>
                </div>
                <div class="info-item">
                    <label>No. Telepon</label>
                    <div class="value">{{ $glamping->no_telepon }}</div>
                </div>
                <div class="info-item">
                    <label>Nomor Identitas</label>
                    <div class="value">{{ $glamping->nomor_identitas }}</div>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <div class="value">{{ $glamping->email ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <label>Tipe Tenda</label>
                    <div class="value"><span class="badge badge-dark">{{ $glamping->tipe_tenda }}</span></div>
                </div>
                <div class="info-item">
                    <label>Jumlah Tenda</label>
                    <div class="value">{{ $glamping->jumlah_tenda }}</div>
                </div>
                <div class="info-item">
                    <label>Jumlah Orang</label>
                    <div class="value">{{ $glamping->jumlah_orang }} orang</div>
                </div>
                <div class="info-item">
                    <label>Lama Menginap</label>
                    <div class="value">{{ $glamping->lama_menginap }} malam</div>
                </div>
                <div class="info-item">
                    <label>Harga / Malam</label>
                    <div class="value">Rp {{ number_format($glamping->harga_per_malam, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <label>Total Harga</label>
                    <div class="value" style="font-size: 20px; color: #5d3a1a; font-weight: bold;">Rp {{ number_format($glamping->total_harga, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <label>Tanggal Check-in</label>
                    <div class="value">{{ $glamping->tanggal_checkin }}</div>
                </div>
                <div class="info-item">
                    <label>Tanggal Check-out</label>
                    <div class="value">{{ $glamping->tanggal_checkout }}</div>
                </div>
                <div class="info-item">
                    <label>Fasilitas Tambahan</label>
                    <div class="value">{{ $glamping->fasilitas_tambahan ?? '-' }}</div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <label>Catatan</label>
                    <div class="value">{{ $glamping->catatan ?? '-' }}</div>
                </div>
            </div>

            <div class="text-center mt-20">
                <a href="{{ route('glamping.edit', $glamping->id) }}" class="btn btn-primary">✏️ Edit</a>
                <a href="{{ route('glamping.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>