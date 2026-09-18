@extends('layout.app')

@section('title','Edit Barang Masuk')

@section('page_title','Edit Barang Masuk')

@section('content')

<div class="card">

    <div class="card-header">

        <h5>Edit Barang Masuk</h5>

    </div>

    <div class="card-body">

        <form action="{{ route('barang-masuk.update',$barang_masuk->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Kategori</label>

                    <select name="kategori_id" class="form-control">

                        @foreach($kategori as $k)

                        <option value="{{ $k->id }}"
                        {{ $barang_masuk->kategori_id==$k->id ? 'selected' : '' }}>

                            {{ $k->nama_kategori }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Kode Barang</label>

                    <input type="text"
                           name="kode_barang"
                           class="form-control"
                           value="{{ $barang_masuk->kode_barang }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Nama Barang</label>

                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="{{ $barang_masuk->nama_barang }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           class="form-control"
                           value="{{ $barang_masuk->satuan }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Qty</label>

                    <input type="number"
                           name="qty"
                           class="form-control"
                           value="{{ $barang_masuk->qty }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Harga</label>

                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ $barang_masuk->harga }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Supplier</label>

                    <input type="text"
                           name="supplier"
                           class="form-control"
                           value="{{ $barang_masuk->supplier }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Tanggal</label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ $barang_masuk->tanggal }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              class="form-control">{{ $barang_masuk->keterangan }}</textarea>

                </div>

            </div>

            <button class="btn btn-success">

                Update

            </button>

            <a href="{{ route('barang-masuk.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection