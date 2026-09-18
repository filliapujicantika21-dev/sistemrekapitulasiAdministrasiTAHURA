<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan - Tahura</title>
    <style>
        /* ===== CSS SAMA SEPERTI INDEX ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 1200px; margin: 30px auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #2d5016, #4a7c2e); color: white; padding: 20px; border-radius: 15px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 24px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-info { background: #17a2b8; }
        .btn-info:hover { background: #138496; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-warning:hover { background: #e0a800; }
        .table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border-left: 6px solid #28a745; }
        .text-center { text-align: center; }
        .mt-20 { margin-top: 20px; }
        
        /* ===== CSS KHUSUS LAPORAN ===== */
        .filter-box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; }
        .filter-box label { font-weight: 600; display: block; margin-bottom: 5px; color: #333; }
        .filter-box select, .filter-box input { padding: 8px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
        .summary-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .summary-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .summary-card .label { font-size: 14px; color: #666; margin-bottom: 10px; }
        .summary-card .value { font-size: 24px; font-weight: bold; color: #2d5016; }
        
        /* ===== PERBAIKAN PRINT CSS ===== */
        @page {
            size: A4 landscape; /* Mengubah kertas menjadi Landscape agar muat */
            margin: 10mm;
        }
        
        @media print {
            .no-print, .filter-box, .btn-print, .btn-back { display: none !important; }
            body { background: white; font-size: 10px; }
            .container { max-width: 100%; margin: 0; padding: 0; }
            .header { background: white !important; color: black !important; border-bottom: 3px solid black; border-radius: 0; padding: 10px 0; }
            .table-container { box-shadow: none; padding: 0; }
            
            /* Perkecil font tabel agar muat di 1 halaman */
            table { font-size: 9px; }
            th, td { padding: 4px 6px; border-bottom: 1px solid #ddd; }
            
            .summary-cards { gap: 10px; }
            .summary-card { box-shadow: none; border: 1px solid #ccc; padding: 10px; }
            .summary-card .value { font-size: 18px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header no-print">
            <h1>📊 Rekapan Laporan Bulanan</h1>
            <div>
                <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary btn-back">← Kembali</a>
            </div>
        </div>

        <!-- FORM FILTER -->
        <div class="filter-box no-print">
            <form action="{{ route('sewa-fasilitas.laporan') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; width: 100%;">
                <div>
                    <label>Bulan</label>
                    <select name="bulan" required>
                        @foreach(['1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $key => $nama)
                            <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Tahun</label>
                    <input type="number" name="tahun" value="{{ $tahun }}" min="2020" max="2100" required>
                </div>
                <button type="submit" class="btn btn-success">Tampilkan Laporan</button>
            </form>
        </div>

        <div class="header" style="background: white; color: #2d5016; border-bottom: 3px solid #2d5016; border-radius: 0;">
            <h1>TAHURA SULTAN ADAM MANDIANGIN</h1>
            <h2 style="margin-top: 10px; font-size: 18px;">Laporan Rekapan Penyewaan</h2>
            <div style="margin-top: 5px; font-size: 16px; color: #666;">Periode: {{ $namaBulanTerpilih }} {{ $tahun }}</div>
        </div>

        <!-- ===== RINGKASAN ===== -->
        <div class="summary-cards">
            <div class="summary-card">
                <div class="label">Total Transaksi</div>
                <div class="value">{{ $totalTransaksi }}</div>
            </div>
            <div class="summary-card">
                <div class="label">Total Pendapatan</div>
                <div class="value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="summary-card">
                <div class="label">Sewa Selesai</div>
                <div class="value">{{ $totalSelesai }}</div>
            </div>
            <div class="summary-card">
                <div class="label">Sewa Aktif</div>
                <div class="value">{{ $totalAktif }}</div>
            </div>
        </div>

        <!-- ===== REKAP FASILITAS ===== -->
        <div class="table-container">
            <h3 style="margin-bottom: 15px;">Rekap Penyewaan Berdasarkan Fasilitas</h3>
            <table>
                <thead>
                    <tr>
                        <th>Fasilitas</th>
                        <th>Jumlah Penyewaan</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapFasilitas as $nama => $data)
                    <tr>
                        <td>{{ $nama }}</td>
                        <td>{{ $data['jumlah'] }}</td>
                        <td>Rp {{ number_format($data['total_pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== REKAP STATUS PEMBAYARAN ===== -->
        <div class="table-container mt-20">
            <h3 style="margin-bottom: 15px;">Rekap Status Pembayaran</h3>
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapPembayaran as $status => $data)
                    <tr>
                        <td>{{ ucfirst($status) }}</td>
                        <td>{{ $data['jumlah'] }}</td>
                        <td>Rp {{ number_format($data['total_nilai'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== TABEL TRANSAKSI ===== -->
        <div class="table-container mt-20">
            <h3 style="margin-bottom: 15px;">Detail Transaksi</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Sewa</th>
                        <th>Nama Penyewa</th>
                        <th>Fasilitas</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Lama</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Status Bayar</th>
                        <th>Status Sewa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $data->kode_sewa }}</strong></td>
                        <td>{{ $data->nama_penyewa }}</td>
                        <td>{{ $data->fasilitas }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td>{{ $data->jam_mulai }}</td>
                        <td>{{ $data->lama_sewa_hari }} hari</td>
                        <td>Rp {{ number_format($data->harga_sewa, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($data->total_biaya, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $data->status_pembayaran == 'lunas' ? 'badge-success' : ($data->status_pembayaran == 'dp' ? 'badge-warning' : 'badge-danger') }}">
                                {{ ucfirst($data->status_pembayaran) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $data->status_sewa == 'aktif' ? 'badge-info' : 'badge-secondary' }}">
                                {{ ucfirst($data->status_sewa) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center" style="padding: 40px; color: #999;">
                            📊 Tidak ada transaksi pada periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TOMBOL CETAK -->
        <div class="text-center mt-20 no-print">
            <button onclick="window.print()" class="btn btn-warning">🖨 Cetak Laporan</button>
        </div>
    </div>
</body>
</html>