<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamping Angsana - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 1200px; margin: 30px auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #5d3a1a, #8b5e3c); color: white; padding: 20px; border-radius: 15px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 24px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-primary { background: #007bff; }
        .btn-primary:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-info { background: #17a2b8; }
        .btn-info:hover { background: #138496; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-dark { background: #343a40; color: white; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .text-center { text-align: center; }
        .actions { display: flex; gap: 5px; flex-wrap: wrap; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⛺ Glamping Angsana Tahura</h1>
            <a href="{{ route('glamping.create') }}" class="btn btn-success">+ Tambah Booking</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Tamu</th>
                        <th>Tipe Tenda</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($glamping as $data)
                    <tr>
                        <td><strong>{{ $data->kode_booking }}</strong></td>
                        <td>{{ $data->nama_tamu }}</td>
                        <td><span class="badge badge-dark">{{ $data->tipe_tenda }}</span></td>
                        <td>{{ $data->tanggal_checkin }}</td>
                        <td>{{ $data->tanggal_checkout }}</td>
                        <td>Rp {{ number_format($data->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($data->status_pembayaran == 'lunas')
                                <span class="badge badge-success">✅ Lunas</span>
                            @elseif($data->status_pembayaran == 'dp')
                                <span class="badge badge-warning">🔄 DP</span>
                            @else
                                <span class="badge badge-danger">❌ Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('glamping.show', $data->id) }}" class="btn btn-info btn-sm">👁</a>
                                <a href="{{ route('glamping.edit', $data->id) }}" class="btn btn-primary btn-sm">✏️</a>
                                <form action="{{ route('glamping.destroy', $data->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">🗑</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data glamping.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $glamping->links() }}
        </div>
    </div>
</body>
</html>