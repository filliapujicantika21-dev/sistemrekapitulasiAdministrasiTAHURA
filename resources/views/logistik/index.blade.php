@extends('layout.app')

@section('title','Kartu Persediaan')

@section('content')

<div class="card p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Kartu Persediaan</h2>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-success">

            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Barang Masuk</th>
                <th>Barang Keluar</th>
                <th>Saldo</th>
                <th>Keterangan</th>
            </tr>

        </thead>

        <tbody>

            @forelse($kartu as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->tanggal }}</td>

                <td>{{ $item->barang->kode_barang }}</td>

                <td>{{ $item->barang->nama_barang }}</td>

                <td>{{ $item->masuk }}</td>

                <td>{{ $item->keluar }}</td>

                <td>{{ $item->saldo }}</td>

                <td>{{ $item->keterangan }}</td>

            </tr>

            @empty

            <tr>

                <td colspan="8" class="text-center">
                    Belum ada data kartu persediaan.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection