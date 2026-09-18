@extends('layout.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h3>

            Data Reservasi Villa Tahura

        </h3>

    </div>

    <div class="card-body">



                <div class="mb-3">

                <a href="{{ route('reservasi.create') }}"
                class="btn btn-primary">

                <i class="bi bi-plus-circle-fill"></i>

                Tambah Reservasi

                </a>

                <a href="{{ route('reservasi.preview') }}"
                class="btn btn-warning">

                <i class="bi bi-eye-fill"></i>

                Preview PDF

                </a>

                <a href="{{ route('reservasi.pdf') }}"
                class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf-fill"></i>

                Print PDF

                </a>

                <a href="{{ route('reservasi.excel') }}"
                class="btn btn-success">

                <i class="bi bi-file-earmark-excel-fill"></i>

                Print Excel

                </a>

                </div>



             <div class="row mb-4">

                    <div class="col-md-3">

                    <div class="card bg-primary text-white">

                    <div class="card-body text-center">

                    <h2>

                    {{ $reservasi->count() }}

                    </h2>

                    <p>Total Reservasi</p>

                    </div>

                    </div>

                    </div>

                    <div class="col-md-3">

                    <div class="card bg-warning text-dark">

                    <div class="card-body text-center">

                    <h2>

                    {{ $reservasi->where('payment','Down Payment')->count() }}

                    </h2>

                    <p>Down Payment</p>

                    </div>

                    </div>

                    </div>

                    <div class="col-md-3">

                    <div class="card bg-danger text-white">

                    <div class="card-body text-center">

                    <h2>

                    {{ $reservasi->where('payment','Pending')->count() }}

                    </h2>

                    <p>Pending</p>

                    </div>

                    </div>

                    </div>

                    <div class="col-md-3">

                    <div class="card bg-success text-white">

                    <div class="card-body text-center">

                    <h2>

                    {{ $reservasi->where('payment','Full Payment')->count() }}

                    </h2>

                    <p>Full Payment</p>

                    </div>

                    </div>

                    </div>

                    </div>


                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                    <tr>

                        <th>No</th>

                        <th>No Invoice</th>

                        <th>Nama Penyewa</th>

                        <th>Nomor Kamar</th>

                        <th>Tipe Villa</th>

                        <th>Nomor Penyewa</th>

                        <th>Jumlah Extra Bed</th>

                        <th>Check In</th>

                        <th>Check Out</th>

                        <th>Payment</th>

                        <th width="160">

                            Aksi

                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($reservasi as $r)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $r->nomor_invoice }}</td>

                            <td>{{ $r->nama_penyewa }}</td>

                            <td>{{ $r->nomor_kamar }}</td>

                            <td>{{ $r->tipe_villa }}</td>

                            <td>{{ $r->nomor_penyewa }}</td>

                            <td>{{ $r->jumlah_extra_bed }}</td>

                            <td>{{ \Carbon\Carbon::parse($r->check_in)->translatedFormat('d F Y') }}</td>

                            <td>{{ \Carbon\Carbon::parse($r->check_out)->translatedFormat('d F Y') }}</td>

                            <td>

                                @if($r->payment=="Down Payment")

                                    <span class="badge bg-warning">

                                        Down Payment

                                    </span>

                                @elseif($r->payment=="Pending")

                                    <span class="badge bg-danger">

                                        Pending

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        Full Payment

                                    </span>

                                @endif

                            </td>

                            <td>

                        <a href="{{ route('reservasi.edit',$r->id) }}"

                           class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil-square"></i>

                        </a>

                       <a href="{{ route('reservasi.invoice.pdf',$r->id) }}"
                            class="btn btn-danger btn-sm"
                            target="_blank">

                            <i class="bi bi-file-earmark-pdf"></i>

                        </a>

                        <form
                            action="{{ route('reservasi.destroy',$r->id) }}"
                            method="POST"
                            style="display:inline">

                            @csrf

                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="btn btn-danger btn-sm">

                                <i class="bi bi-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Tidak ada data reservasi

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection