@extends('layout.app')

@section('title','Tambah Barang Keluar')

@section('page_title','Tambah Barang Keluar')

@section('content')

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">

            Form Barang Keluar

        </h5>

    </div>

    <div class="card-body">

        <form action="{{ route('barang-keluar.store') }}" method="POST">

            @csrf

            <div class="row">

                <!-- Kategori -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="kategori_id"
                        class="form-control"
                        required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($kategori as $k)

                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Tanggal -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Tanggal Keluar

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        required>

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
                        required>

                </div>

                <!-- Qty -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Qty Keluar

                    </label>

                    <input
                        type="number"
                        name="qty"
                        class="form-control"
                        min="1"
                        required>

                </div>

                <!-- Keterangan -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Keterangan

                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3"></textarea>

                </div>

            </div>

            <hr>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fa fa-save"></i>

                Simpan

            </button>

            <a href="{{ route('barang-keluar.index') }}"
               class="btn btn-secondary">

                <i class="fa fa-arrow-left"></i>

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection