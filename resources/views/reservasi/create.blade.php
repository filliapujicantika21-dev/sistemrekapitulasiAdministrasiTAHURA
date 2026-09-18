@extends('layout.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>
            Tambah Reservasi Villa Tahura
        </h3>

    </div>

    <div class="card-body">
        @if(session('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <i class="bi bi-exclamation-triangle-fill"></i>

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

@endif

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('reservasi.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Nama Penyewa

                </label>

                <input
                    type="text"
                    name="nama_penyewa"
                    class="form-control"
                    value="{{ old('nama_penyewa') }}"
                    placeholder="Masukkan nama penyewa">

            </div>




            <div class="mb-3">
    <label>Tipe Villa</label>
    <select name="tipe_villa" id="tipe_villa" class="form-control" required>
        <option value="">-- Pilih Tipe Villa --</option>
        <option value="Palawan Superior">Palawan Superior</option>
        <option value="Palawan Deluxe">Palawan Deluxe</option>
        <option value="Cemara Standar">Cemara Standar</option>
        <option value="Cemara Deluxe">Cemara Deluxe</option>
        <option value="Cemara Segitiga">Cemara Segitiga</option>
        <option value="Bingkirai Standar">Bingkirai Standar</option>
    </select>
</div>

<div class="mb-3">
    <label>Nomor Kamar</label>
    <select name="nomor_kamar" id="nomor_kamar" class="form-control" required>
        <option value="">Pilih tipe villa terlebih dahulu</option>
    </select>
</div>


        <div class="mb-3">

    <label class="form-label">
        Nomor Penyewa
    </label>

    <input
        type="text"
        name="nomor_penyewa"
        class="form-control"
        value="{{ old('nomor_penyewa') }}"
        placeholder="Contoh: 081234567890">

</div>

        <div class="mb-3">

    <label class="form-label">

        Jumlah Extra Bed

    </label>

    <input
        type="number"
        name="jumlah_extra_bed"
        class="form-control"
        value="{{ old('jumlah_extra_bed',0) }}"
        min="0"
        placeholder="0">

</div>

            <div class="mb-3">

    <label class="form-label">
        Check In
    </label>

    <input
        type="date"
        name="check_in"
        class="form-control"
        required>

</div>

            <div class="mb-3">

                <label class="form-label">

                    Check Out

                </label>

                <input
                    type="date"
                    name="check_out"
                    class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">

                    Payment

                </label>

                <select
                    name="payment"
                    class="form-select">

                    <option value="">-- Pilih Status Pembayaran --</option>

                    <option value="Down Payment">

                        Down Payment

                    </option>

                    <option value="Pending">

                        Pending

                    </option>

                    <option value="Full Payment">

                        Full Payment

                    </option>

                </select>

            </div>


            <button
                class="btn btn-success">

                <i class="bi bi-save"></i>

                Simpan

            </button>


            <a href="{{ route('reservasi.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </form>
            <script>

const kamar = {
    "Palawan Superior": ["1P"],
    "Palawan Deluxe": ["2P", "3P", "4P"],
    "Cemara Standar": ["1A", "2A"],
    "Cemara Deluxe": ["1C", "2C"],
    "Cemara Segitiga": ["1C", "2C"],
    "Bingkirai Standar": ["1B", "2B", "3B"]
};

document.getElementById('tipe_villa').addEventListener('change', function () {

    let tipe = this.value;
    let nomor = document.getElementById('nomor_kamar');

    nomor.innerHTML = '<option value="">-- Pilih Nomor Kamar --</option>';

    if (kamar[tipe]) {

        kamar[tipe].forEach(function(item) {

            let option = document.createElement('option');
            option.value = item;
            option.text = item;

            nomor.appendChild(option);

        });

    }

});

</script>
    </div>

</div>

@endsection