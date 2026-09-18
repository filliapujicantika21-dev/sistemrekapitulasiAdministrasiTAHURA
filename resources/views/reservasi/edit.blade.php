@extends('layout.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning text-dark">

        <h3>Edit Reservasi Villa Tahura</h3>

    </div>

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
    <label class="form-label">Nomor Invoice</label>

    <input
        type="text"
        class="form-control"
        value="{{ $reservasi->nomor_invoice }}"
        readonly>

    <input
        type="hidden"
        name="nomor_invoice"
        value="{{ $reservasi->nomor_invoice }}">
</div>

            <!-- Nama Penyewa -->
            <div class="mb-3">

                <label class="form-label">Nama Penyewa</label>

                <input
                    type="text"
                    name="nama_penyewa"
                    class="form-control"
                    value="{{ old('nama_penyewa', $reservasi->nama_penyewa) }}">

            </div>

            <!-- Nomor Kamar -->
           <div class="mb-3">

    <label class="form-label">Nomor Kamar</label>

    <select name="nomor_kamar"
            id="nomor_kamar"
            class="form-select">

    </select>

</div>
            <!-- Tipe Villa -->
            <div class="mb-3">

    <label class="form-label">Tipe Villa</label>

    <select name="tipe_villa" id="tipe_villa" class="form-select">

        <option value="">-- Pilih Tipe Villa --</option>

        <option value="Palawan Superior" {{ $reservasi->tipe_villa == 'Palawan Superior' ? 'selected' : '' }}>Palawan Superior</option>

        <option value="Palawan Deluxe" {{ $reservasi->tipe_villa == 'Palawan Deluxe' ? 'selected' : '' }}>Palawan Deluxe</option>

        <option value="Cemara Standar" {{ $reservasi->tipe_villa == 'Cemara Standar' ? 'selected' : '' }}>Cemara Standar</option>

        <option value="Cemara Deluxe" {{ $reservasi->tipe_villa == 'Cemara Deluxe' ? 'selected' : '' }}>Cemara Deluxe</option>

        <option value="Cemara Segitiga" {{ $reservasi->tipe_villa == 'Cemara Segitiga' ? 'selected' : '' }}>Cemara Segitiga</option>

        <option value="Bingkirai Standar" {{ $reservasi->tipe_villa == 'Bingkirai Standar' ? 'selected' : '' }}>Bingkirai Standar</option>

    </select>

</div>

            <div class="mb-3">
    <label class="form-label">Nomor Penyewa</label>
    <input type="text" name="nomor_penyewa" class="form-control"
           value="{{ old('nomor_penyewa', $reservasi->nomor_penyewa ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Jumlah Extra Bed</label>
    <input type="number" name="jumlah_extra_bed" class="form-control"
           value="{{ old('jumlah_extra_bed', $reservasi->jumlah_extra_bed ?? 0) }}"
           min="0">
</div>

            <!-- Check In -->
            <div class="mb-3">

                <label class="form-label">Check In</label>

                <input
                    type="date"
                    name="check_in"
                    class="form-control"
                    value="{{ old('check_in', $reservasi->check_in) }}">

            </div>

            <!-- Check Out -->
            <div class="mb-3">

                <label class="form-label">Check Out</label>

                <input
                    type="date"
                    name="check_out"
                    class="form-control"
                    value="{{ old('check_out', $reservasi->check_out) }}">

            </div>

            <!-- Payment -->
            <div class="mb-3">

                <label class="form-label">Payment</label>

                <select name="payment" class="form-select">

                    @foreach(['Down Payment','Pending','Full Payment'] as $status)

                        <option value="{{ $status }}"
                            {{ old('payment', $reservasi->payment) == $status ? 'selected' : '' }}>

                            {{ $status }}

                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit" class="btn btn-success">

                <i class="bi bi-check-circle"></i>

                Update

            </button>

            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection

<script>

document.addEventListener('DOMContentLoaded', function(){

    const kamar = {

        "Palawan Superior": ["1P"],

        "Palawan Deluxe": ["2P","3P","4P"],

        "Cemara Standar": ["1A","2A"],

        "Cemara Deluxe": ["1C","2C"],

        "Cemara Segitiga": ["1C","2C"],

        "Bingkirai Standar": ["1B","2B","3B"]

    };

    const tipe = document.getElementById('tipe_villa');
    const nomor = document.getElementById('nomor_kamar');

    function loadKamar(){

        nomor.innerHTML = "";

        let daftar = kamar[tipe.value];

        if(daftar){

            daftar.forEach(function(item){

                let option = document.createElement("option");

                option.value = item;
                option.text = item;

                if(item == "{{ $reservasi->nomor_kamar }}"){
                    option.selected = true;
                }

                nomor.appendChild(option);

            });

        }

    }

    loadKamar();

    tipe.addEventListener('change', loadKamar);

});

</script>