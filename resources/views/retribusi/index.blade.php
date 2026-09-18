@extends('layout.app')

@section('title','Data Retribusi')

@section('page_title','Data Retribusi')

@section('content')


<style>
    .retribusi-header {
        background: linear-gradient(135deg, #2d5016, #4a7c2e);
        color: white;
        padding: 20px 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .retribusi-header h1 {
        font-size: 24px;
        margin: 0;
        font-weight: 600;
    }

    .btn-retribusi {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        background: #28a745;
    }

    .btn-retribusi:hover {
        background: #218838;
        color: white;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow-x: auto;
    }

    .retribusi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .retribusi-table th,
    .retribusi-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .retribusi-table th {
        background: #f8f9fa;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
    }

    .retribusi-table td {
        text-align: center;
    }

    .badge-retribusi {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-success-retribusi {
        background: #d4edda;
        color: #155724;
    }

    .badge-info-retribusi {
        background: #d1ecf1;
        color: #0c5460;
    }

    .badge-danger-retribusi {
        background: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .action-btn {
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        color: white;
        text-decoration: none;
        cursor: pointer;
        font-size: 13px;
    }

    .action-info {
        background: #17a2b8;
    }

    .action-primary {
        background: #007bff;
    }

    .action-danger {
        background: #dc3545;
    }

    .action-btn:hover {
        opacity: 0.85;
        color: white;
    }

    .empty-data {
        padding: 25px !important;
        text-align: center !important;
        color: #666;
    }
</style>


<!-- HEADER RETRIBUSI -->
<div class="retribusi-header">

    <h1>
        🌿 Data Retribusi Tahura
    </h1>

    <a href="{{ route('retribusi.create') }}" class="btn-retribusi">
        + Tambah Retribusi
    </a>

</div>


<!-- TABEL -->
<div class="table-container">

    <table class="retribusi-table">

        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kendaraan</th>
                <th>Plat</th>
                <th>Total Bayar</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($retribusi as $data)

            <tr>

                <td>
                    <strong>
                        {{ $data->kode_transaksi }}
                    </strong>
                </td>

                <td>
                    {{ $data->nama_pengunjung }}
                </td>

                <td>
                    {{ $data->jenis_kendaraan }}
                </td>

                <td>
                    {{ $data->plat_nomor }}
                </td>

                <td>
                    Rp {{ number_format($data->total_bayar, 0, ',', '.') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('d F Y') }}
                </td>

                <td>

                    @if($data->status == 'masuk')

                        <span class="badge-retribusi badge-success-retribusi">
                            ✅ Masuk
                        </span>

                    @elseif($data->status == 'keluar')

                        <span class="badge-retribusi badge-info-retribusi">
                            📤 Keluar
                        </span>

                    @else

                        <span class="badge-retribusi badge-danger-retribusi">
                            ❌ Batal
                        </span>

                    @endif

                </td>

                <td>

                    <div class="action-buttons">

                        <a href="{{ route('retribusi.show', $data->id) }}"
                           class="action-btn action-info">
                            👁
                        </a>

                        <a href="{{ route('retribusi.edit', $data->id) }}"
                           class="action-btn action-primary">
                            ✏️
                        </a>

                        <form action="{{ route('retribusi.destroy', $data->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="action-btn action-danger"
                                    onclick="return confirm('Hapus data ini?')">
                                🗑
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8" class="empty-data">
                    Belum ada data retribusi.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-3">
        {{ $retribusi->links() }}
    </div>

</div>

@endsection