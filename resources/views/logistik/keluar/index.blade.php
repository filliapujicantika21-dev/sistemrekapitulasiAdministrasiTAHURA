@extends('layout.app')

@section('title','Barang Keluar')

@section('page_title','Barang Keluar')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            Data Barang Keluar

        </h5>

        <a href="{{ route('barang-keluar.create') }}"
           class="btn btn-success">

            <i class="fa fa-plus"></i>

            Tambah Barang Keluar

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

                        <th>Kode Barang</th>

                        <th>Nama Barang</th>

                        <th>Satuan</th>

                        <th>Qty</th>

                        <th>Keterangan</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($keluar as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->tanggal }}</td>

                        <td>{{ $item->kategori->nama_kategori }}</td>

                        <td>{{ $item->kode_barang }}</td>

                        <td>{{ $item->nama_barang }}</td>

                        <td>{{ $item->satuan }}</td>

                        <td>{{ $item->qty }}</td>

                        <td>{{ $item->keterangan }}</td>

                        <td>

                            <a href="{{ route('barang-keluar.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fa fa-edit"></i>

                            </a>

                            <form action="{{ route('barang-keluar.destroy',$item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data?')">

                                    <i class="fa fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            Belum ada data barang keluar.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection