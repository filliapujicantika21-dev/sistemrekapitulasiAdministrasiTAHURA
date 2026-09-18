@extends('layout.app')

@section('title','Tambah Barang Masuk')

@section('page_title','Tambah Barang Masuk')

@section('content')

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">
            Form Barang Masuk
        </h5>

    </div>

    <div class="card-body">

        <form action="{{ route('barang-masuk.store') }}" method="POST">

            @csrf

            <div class="row">

                <!-- Kategori -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select name="kategori_id" class="form-control" required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($kategori as $k)

                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Kode Barang -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        class="form-control"
                        required>

                </div>

                <!-- Nama Barang -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        class="form-control"
                        required>

                </div>

                <!-- Satuan -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Satuan
                    </label>

                    <input
                        type="text"
                        name="satuan"
                        class="form-control"
                        placeholder="Contoh : Buah, Rim, Unit"
                        required>

                </div>

                <!-- Qty -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Qty
                    </label>

                    <input
                        type="number"
                        name="qty"
                        class="form-control"
                        min="1"
                        required>

                </div>

                <!-- Harga -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        min="0"
                        required>

                </div>

                <!-- Supplier -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Supplier
                    </label>

                    <input
                        type="text"
                        name="supplier"
                        class="form-control">

                </div>

                <!-- Tanggal -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Tanggal Masuk
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        required>

                </div>

                <!-- Keterangan -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        rows="3"
                        class="form-control"></textarea>

                </div>

            </div>

            <hr>

            <button
                class="btn btn-success">

                <i class="fa fa-save"></i>

                Simpan

            </button>

            <a href="{{ route('barang-masuk.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection