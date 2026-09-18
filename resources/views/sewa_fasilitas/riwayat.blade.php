<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 1200px; margin: 30px auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #2d5016, #4a7c2e); color: white; padding: 20px; border-radius: 15px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 24px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-info { background: #17a2b8; }
        .btn-info:hover { background: #138496; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border-left: 6px solid #28a745; }
        .text-center { text-align: center; }
        .actions { display: flex; gap: 5px; flex-wrap: wrap; }
        .mt-20 { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Pesanan Selesai</h1>
            <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary">← Kembali ke Aktif</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode Sewa</th>
                        <th>Penyewa</th>
                        <th>Fasilitas</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sewa as $data)
                    <tr>
                        <td><strong>{{ $data->kode_sewa }}</strong></td>
                        <td>{{ $data->nama_penyewa }}</td>
                        <td>
                            @if($data->fasilitas == 'Pendopo Agung')
                                Pendopo
                            @else
                                {{ $data->fasilitas }}
                            @endif
                            ({{ $data->jumlah_unit }} unit)
                        </td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td>{{ $data->lama_sewa_hari }} hari</td>
                        <td>Rp {{ number_format($data->total_biaya, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-secondary">⏹️ Selesai</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('sewa-fasilitas.show', $data->id) }}" class="btn btn-info btn-sm">👁 Detail</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 40px; color: #999;">
                            📦 Belum ada pesanan yang selesai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-20">
                {{ $sewa->links() }}
            </div>
        </div>
    </div>
</body>
</html>