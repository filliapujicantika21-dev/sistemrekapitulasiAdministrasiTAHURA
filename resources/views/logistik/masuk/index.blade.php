@extends('layout.app')

@section('title','Barang Masuk')

@section('page_title','Barang Masuk')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Data Barang Masuk
        </h5>

        <a href="{{ route('barang-masuk.create') }}"
           class="btn btn-success">

            <i class="fa fa-plus"></i>

            Tambah Barang Masuk

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Kategori</th>

                    <th>Kode</th>

                    <th>Nama Barang</th>

                    <th>Satuan</th>

                    <th>Qty</th>

                    <th>Harga</th>

                    <th>Supplier</th>

                    <th>Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($masuk as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->tanggal }}</td>

                    <td>{{ $item->kategori->nama_kategori }}</td>

                    <td>{{ $item->kode_barang }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    <td>{{ $item->satuan }}</td>

                    <td>{{ $item->qty }}</td>

                    <td>
                        Rp {{ number_format($item->harga,0,',','.') }}
                    </td>

                    <td>{{ $item->supplier }}</td>

                    <td width="130">

                        <a href="{{ route('barang-masuk.edit',$item->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fa fa-edit"></i>

                        </a>

                        <form action="{{ route('barang-masuk.destroy',$item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus data?')"
                                class="btn btn-danger btn-sm">

                                <i class="fa fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="10"
                        class="text-center">

                        Belum ada data.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection