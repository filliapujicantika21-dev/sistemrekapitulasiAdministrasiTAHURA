<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Retribusi - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #2d5016; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .info-item { padding: 10px; background: #f8f9fa; border-radius: 8px; }
        .info-item label { font-weight: 600; color: #666; display: block; font-size: 12px; }
        .info-item .value { font-size: 16px; margin-top: 5px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .text-center { text-align: center; margin-top: 20px; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .mt-20 { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>🌿 Detail Retribusi</h1>
                <a href="{{ route('retribusi.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>Kode Transaksi</label>
                    <div class="value"><strong>{{ $retribusi->kode_transaksi }}</strong></div>
                </div>
                <div class="info-item">
                    <label>Status</label>
                    <div class="value">
                        @if($retribusi->status == 'masuk')
                            <span class="badge badge-success">✅ Masuk</span>
                        @elseif($retribusi->status == 'keluar')
                            <span class="badge badge-info">📤 Keluar</span>
                        @else
                            <span class="badge badge-danger">❌ Batal</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <label>Nama Pengunjung</label>
                    <div class="value">{{ $retribusi->nama_pengunjung }}</div>
                </div>
                <div class="info-item">
                    <label>No. Telepon</label>
                    <div class="value">{{ $retribusi->no_telepon }}</div>
                </div>
                <div class="info-item">
                    <label>Jenis Identitas</label>
                    <div class="value">{{ $retribusi->jenis_identitas }}</div>
                </div>
                <div class="info-item">
                    <label>Nomor Identitas</label>
                    <div class="value">{{ $retribusi->nomor_identitas }}</div>
                </div>
                <div class="info-item">
                    <label>Jenis Kendaraan</label>
                    <div class="value">{{ $retribusi->jenis_kendaraan }}</div>
                </div>
                <div class="info-item">
                    <label>Plat Nomor</label>
                    <div class="value">{{ $retribusi->plat_nomor }}</div>
                </div>
                <div class="info-item">
                    <label>Kategori</label>
                    <div class="value">{{ ucfirst($retribusi->kategori) }}</div>
                </div>
                <div class="info-item">
                    <label>Jumlah Orang</label>
                    <div class="value">{{ $retribusi->jumlah_orang }} orang</div>
                </div>
                <div class="info-item">
                    <label>Tarif / Orang</label>
                    <div class="value">Rp {{ number_format($retribusi->tarif, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <label>Total Bayar</label>
                    <div class="value" style="font-size: 20px; color: #2d5016; font-weight: bold;">Rp {{ number_format($retribusi->total_bayar, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <label>Tanggal Masuk</label>
                    <div class="value">{{ $retribusi->tanggal_masuk }}</div>
                </div>
                <div class="info-item">
                    <label>Jam Masuk</label>
                    <div class="value">{{ $retribusi->jam_masuk }}</div>
                </div>
                @if($retribusi->tanggal_keluar)
                <div class="info-item">
                    <label>Tanggal Keluar</label>
                    <div class="value">{{ $retribusi->tanggal_keluar }}</div>
                </div>
                <div class="info-item">
                    <label>Jam Keluar</label>
                    <div class="value">{{ $retribusi->jam_keluar }}</div>
                </div>
                @endif
                <div class="info-item" style="grid-column: span 2;">
                    <label>Keterangan</label>
                    <div class="value">{{ $retribusi->keterangan ?? '-' }}</div>
                </div>
            </div>

            <div class="text-center mt-20">
                <a href="{{ route('retribusi.edit', $retribusi->id) }}" class="btn btn-primary">✏️ Edit</a>
                @if($retribusi->status == 'masuk')
                    <form action="{{ route('retribusi.checkout', $retribusi->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">✅ Checkout</button>
                    </form>
                @endif
                <a href="{{ route('retribusi.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>