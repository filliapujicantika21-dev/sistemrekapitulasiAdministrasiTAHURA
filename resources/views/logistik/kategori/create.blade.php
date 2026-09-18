@extends('layout.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">Tambah Kategori</h3>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input
                type="text"
                name="nama_kategori"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>

        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection

