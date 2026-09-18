<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Reservasi Villa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .navbar {
            background: #ffffff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .navbar h2 {
            margin: 0;
            color: #333;
        }

        .container {
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #e91e63;
        }

        .btn-primary:hover {
            background: #c2185b;
        }

        .btn-success {
            background: #28a745;
        }

        .btn-danger {
            background: #dc3545;
        }

        .btn-warning {
            background: #ffc107;
            color: #222;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e91e63;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #fafafa;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .aksi {
            display: flex;
            gap: 5px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Villa Tahura</h2>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                Logout
            </button>
        </form>
    </div>

    <div class="container">

        <div class="header">
            <h1>Data Reservasi Villa</h1>

            <a href="{{ route('reservasi.create') }}" class="btn btn-primary">
                + Tambah Reservasi
            </a>
        </div>

        {{-- Pesan berhasil --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Nama Penyewa</th>
                        <th>No. Penyewa</th>
                        <th>No. Kamar</th>
                        <th>Tipe Villa</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Extra Bed</th>
                        <th>Payment</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($reservasi as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $item->nomor_invoice }}
                            </td>

                            <td>
                                {{ $item->nama_penyewa }}
                            </td>

                            <td>
                                {{ $item->nomor_penyewa }}
                            </td>

                            <td>
                                {{ $item->nomor_kamar }}
                            </td>

                            <td>
                                {{ $item->tipe_villa }}
                            </td>

                            <td>
                                {{ $item->check_in }}
                            </td>

                            <td>
                                {{ $item->check_out }}
                            </td>

                            <td>
                                {{ $item->jumlah_extra_bed }}
                            </td>

                            <td>
                                {{ $item->payment }}
                            </td>

                            <td>
                                <div class="aksi">

                                    <a href="{{ route('reservasi.edit', $item->id) }}"
                                       class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('reservasi.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="empty">
                                Belum ada data reservasi.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>