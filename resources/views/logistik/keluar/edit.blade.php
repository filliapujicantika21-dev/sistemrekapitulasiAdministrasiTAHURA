@extends('layout.app')

@section('title','Edit Barang Keluar')

@section('page_title','Edit Barang Keluar')

@section('content')

<div class="card">

    <div class="card-header">

        <h5>Edit Barang Keluar</h5>

    </div>

    <div class="card-body">

        <form action="{{ route('barang-keluar.update',$barang_keluar->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Kategori</label>

                    <select name="kategori_id" class="form-control">

                        @foreach($kategori as $k)

                        <option value="{{ $k->id }}"
                        {{ $barang_keluar->kategori_id==$k->id ? 'selected' : '' }}>

                            {{ $k->nama_kategori }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Tanggal</label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ $barang_keluar->tanggal }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Kode Barang</label>

                    <input type="text"
                           name="kode_barang"
                           class="form-control"
                           value="{{ $barang_keluar->kode_barang }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Nama Barang</label>

                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="{{ $barang_keluar->nama_barang }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           class="form-control"
                           value="{{ $barang_keluar->satuan }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Qty</label>

                    <input type="number"
                           name="qty"
                           class="form-control"
                           value="{{ $barang_keluar->qty }}">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              class="form-control">{{ $barang_keluar->keterangan }}</textarea>

                </div>

            </div>

            <button class="btn btn-success">

                Update

            </button>

            <a href="{{ route('barang-keluar.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection