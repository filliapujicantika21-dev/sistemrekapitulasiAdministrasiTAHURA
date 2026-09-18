<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sewa Fasilitas - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 900px; margin: 30px auto; padding: 20px; }
        
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #2d5016; font-size: 24px; }
        .card-header h1 small { font-size: 14px; color: #666; font-weight: normal; display: block; margin-top: 5px; }
        
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .info-item { padding: 15px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #2d5016; }
        .info-item.full-width { grid-column: span 2; }
        .info-item label { font-weight: 600; color: #666; display: block; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .info-item .value { font-size: 16px; color: #333; word-break: break-word; }
        .info-item .value .badge { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 13px; font-weight: 600; }
        
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }
        
        .badge-status { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 13px; font-weight: 600; }
        .badge-aktif { background: #d1ecf1; color: #0c5460; }
        .badge-selesai { background: #e2e3e5; color: #383d41; }
        .badge-batal { background: #f8d7da; color: #721c24; }
        
        .btn { padding: 10px 25px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; transition: all 0.3s; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        
        .text-center { text-align: center; margin-top: 30px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }
        
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; animation: slideDown 0.5s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .alert-success { background: #d4edda; color: #155724; border-left: 6px solid #28a745; }
        .alert-danger { background: #f8d7da; color: #721c24; border-left: 6px solid #dc3545; }
        .alert .close-btn { background: none; border: none; font-size: 24px; cursor: pointer; color: inherit; opacity: 0.6; transition: opacity 0.3s; }
        .alert .close-btn:hover { opacity: 1; }
        
        .total-box { background: linear-gradient(135deg, #2d5016, #4a7c2e); color: white; padding: 20px; border-radius: 10px; text-align: center; }
        .total-box label { font-size: 14px; opacity: 0.8; display: block; }
        .total-box .value { font-size: 28px; font-weight: bold; }
        
        .button-group { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- HEADER -->
            <div class="card-header">
                <div>
                    <h1>🏛️ Detail Sewa Fasilitas <small>Informasi lengkap penyewaan</small></h1>
                </div>
                <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <!-- NOTIFIKASI -->
            @if(session('success'))
                <div class="alert alert-success" id="alert-success">
                    <span>✅ {{ session('success') }}</span>
                    <button class="close-btn" onclick="closeAlert(this)">×</button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" id="alert-danger">
                    <span>❌ {{ session('error') }}</span>
                    <button class="close-btn" onclick="closeAlert(this)">×</button>
                </div>
            @endif

            <!-- DATA -->
            <div class="info-grid">
                <!-- Kode Sewa -->
                <div class="info-item">
                    <label>📌 Kode Sewa</label>
                    <div class="value"><strong>{{ $sewa->kode_sewa }}</strong></div>
                </div>
                <!-- Status Sewa -->
                <div class="info-item">
                    <label>📋 Status Sewa</label>
                    <div class="value">
                        @if($sewa->status_sewa == 'aktif')
                            <span class="badge-aktif">🟢 Aktif</span>
                        @elseif($sewa->status_sewa == 'selesai')
                            <span class="badge-selesai">⏹️ Selesai</span>
                        @else
                            <span class="badge-batal">🔴 Batal</span>
                        @endif
                    </div>
                </div>
                <!-- Nama Penyewa -->
                <div class="info-item">
                    <label>👤 Nama Penyewa</label>
                    <div class="value">{{ $sewa->nama_penyewa }}</div>
                </div>
                <!-- No Telepon -->
                <div class="info-item">
                    <label>📞 No. Telepon</label>
                    <div class="value">{{ $sewa->no_telepon }}</div>
                </div>
                <!-- Fasilitas -->
                <div class="info-item">
                    <label>🏛️ Fasilitas</label>
                    <div class="value">
                        @if($sewa->fasilitas == 'Pendopo Agung')
                            Pendopo
                        @else
                            {{ $sewa->fasilitas }}
                        @endif
                    </div>
                </div>
                <!-- Kategori Sewa -->
                <div class="info-item">
                    <label>📂 Kategori Sewa</label>
                    <div class="value">{{ $sewa->kategori_sewa }}</div>
                </div>
                <!-- Jumlah Unit -->
                <div class="info-item">
                    <label>🔢 Jumlah Unit</label>
                    <div class="value">{{ $sewa->jumlah_unit }}</div>
                </div>
                <!-- Harga Sewa / Unit -->
                <div class="info-item">
                    <label>💰 Harga Sewa / Unit</label>
                    <div class="value">Rp {{ number_format($sewa->harga_sewa, 0, ',', '.') }}</div>
                </div>
                <!-- Tanggal Mulai -->
                <div class="info-item">
                    <label>📅 Tanggal Mulai</label>
                    <div class="value">{{ \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d/m/Y') }} {{ $sewa->jam_mulai }}</div>
                </div>
                <!-- Tanggal Selesai -->
                <div class="info-item">
                    <label>📅 Tanggal Selesai</label>
                    <div class="value">{{ \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d/m/Y') }} {{ $sewa->jam_selesai }}</div>
                </div>
                <!-- Lama Sewa -->
                <div class="info-item">
                    <label>⏳ Lama Sewa</label>
                    <div class="value">{{ $sewa->lama_sewa_hari }} hari {{ $sewa->lama_sewa_jam > 0 ? $sewa->lama_sewa_jam . ' jam' : '' }}</div>
                </div>
                <!-- Status Pembayaran -->
                <div class="info-item">
                    <label>💳 Status Pembayaran</label>
                    <div class="value">
                        @if($sewa->status_pembayaran == 'lunas')
                            <span class="badge-success">✅ Lunas</span>
                        @elseif($sewa->status_pembayaran == 'dp')
                            <span class="badge-warning">🔄 DP</span>
                        @else
                            <span class="badge-danger">❌ Belum Bayar</span>
                        @endif
                    </div>
                </div>
                <!-- Total Biaya -->
                <div class="info-item full-width">
                    <div class="total-box">
                        <label>💰 TOTAL BIAYA</label>
                        <div class="value">Rp {{ number_format($sewa->total_biaya, 0, ',', '.') }}</div>
                    </div>
                </div>
                <!-- Keterangan -->
                <div class="info-item full-width">
                    <label>📝 Keterangan</label>
                    <div class="value">{{ $sewa->keterangan ?? '-' }}</div>
                </div>
            </div>

            <!-- ===== TOMBOL AKSI ===== -->
            <div class="text-center">
                <div class="button-group">
                    <a href="{{ route('sewa-fasilitas.edit', $sewa->id) }}" class="btn btn-primary">✏️ Edit Sewa</a>
                    
                    <!-- TOMBOL INVOICE -->
                    <a href="{{ route('sewa-fasilitas.invoice', $sewa->id) }}" class="btn btn-success" target="_blank">
                        📄 Invoice
                    </a>
                    
                    @if($sewa->status_sewa == 'aktif')
                        {{-- PERBAIKAN TERAKHIR: HAPUS @method('PUT') KARENA ROUTE SUDAH PAKAI POST --}}
                        <form action="{{ route('sewa-fasilitas.selesaikan', $sewa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin menyelesaikan sewa ini?')">✅ Selesaikan Sewa</button>
                        </form>
                    @endif

                    <form action="{{ route('sewa-fasilitas.destroy', $sewa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('⚠️ Yakin ingin menghapus data ini? Data tidak bisa dikembalikan!')">🗑 Hapus</button>
                    </form>
                    
                    <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });

        function closeAlert(btn) {
            const alert = btn.parentElement;
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 300);
        }
    </script>
</body>
</html>