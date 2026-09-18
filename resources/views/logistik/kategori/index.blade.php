@extends('layout.app')

@section('title','Kategori Barang')

@section('content')

<div class="card p-4">

    <div class="d-flex justify-content-between mb-3">

        <h3>Data Kategori</h3>

        <a href="{{ route('kategori.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i>
            Tambah Kategori
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-success">

            <tr>

                <th width="70">No</th>
                <th>Nama Kategori</th>
                <th width="180">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($kategori as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->nama_kategori }}</td>

                <td>

                    <a href="{{ route('kategori.edit',$item->id) }}"
                        class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('kategori.destroy',$item->id) }}"
                        method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus kategori?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3" class="text-center">

                    Belum ada data kategori.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection