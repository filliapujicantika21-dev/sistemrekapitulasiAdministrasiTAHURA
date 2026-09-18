@extends('layout.app')

@section('title', 'Sewa Fasilitas Tahura')

@section('page_title', 'Sewa Fasilitas')

@section('content')

<style>
    .container-sewa {
        max-width: 1200px;
        margin: 10px auto;
    }

    .header-sewa {
        background: linear-gradient(135deg, #2d5016, #4a7c2e);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-sewa h1 {
        font-size: 24px;
        margin: 0;
    }

    .btn-sewa {
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border: none;
    }

    .btn-success-sewa {
        background: #28a745;
    }

    .btn-info-sewa {
        background: #17a2b8;
    }

    .btn-secondary-sewa {
        background: #6c757d;
    }

    .btn-primary-sewa {
        background: #007bff;
    }

    .btn-danger-sewa {
        background: #dc3545;
    }

    .btn-sm-sewa {
        padding: 5px 10px;
        font-size: 12px;
    }


    .table-box {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
    }


    table {
        width:100%;
        border-collapse: collapse;
    }


    th {
        background:#f8f9fa;
        padding:12px;
        text-align:center;
    }


    td {
        padding:12px;
        border-bottom:1px solid #eee;
        text-align:center;
    }


    .badge {
        padding:5px 10px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
    }


    .badge-success {
        background:#d4edda;
        color:#155724;
    }


    .badge-warning {
        background:#fff3cd;
        color:#856404;
    }


    .badge-danger {
        background:#f8d7da;
        color:#721c24;
    }


    .badge-info {
        background:#d1ecf1;
        color:#0c5460;
    }


    .aksi {
        display:flex;
        justify-content:center;
        gap:5px;
    }


    .alert-sewa {
        padding:15px;
        border-radius:10px;
        margin-bottom:20px;
    }

</style>



<div class="container-sewa">


    <div class="header-sewa">

        <h1>
            🏛️ Sewa Fasilitas Tahura
        </h1>


        <div>


            <a href="{{ route('sewa-fasilitas.riwayat') }}"
               class="btn-sewa btn-secondary-sewa">

                📦 Pesanan Selesai

            </a>



            <a href="{{ route('sewa-fasilitas.laporan') }}"
               class="btn-sewa btn-info-sewa">

                📊 Laporan Bulanan

            </a>



            <a href="{{ route('sewa-fasilitas.create') }}"
               class="btn-sewa btn-success-sewa">

                + Sewa Fasilitas

            </a>


        </div>


    </div>



    {{-- NOTIFIKASI --}}

    @if(session('success'))

    <div class="alert-sewa alert-success">

        {{ session('success') }}

    </div>

    @endif



    @if(session('error'))

    <div class="alert-sewa alert-danger">

        {{ session('error') }}

    </div>

    @endif





    <div class="table-box">


        <table>


            <thead>

                <tr>

                    <th>Kode Sewa</th>
                    <th>Penyewa</th>
                    <th>Fasilitas</th>
                    <th>Tanggal Sewa</th>
                    <th>Lama</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>



            <tbody>


            @forelse($sewa as $data)


                @if($data->status_sewa != 'selesai')


                <tr>


                    <td>
                        <b>{{ $data->kode_sewa }}</b>
                    </td>


                    <td>
                        {{ $data->nama_penyewa }}
                    </td>


                    <td>

                        {{ $data->fasilitas }}

                        <br>

                        ({{ $data->jumlah_unit }} unit)

                    </td>



                    <td>

                        {{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d/m/Y') }}

                        -

                        {{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d/m/Y') }}

                    </td>



                    <td>

                        {{ $data->lama_sewa_hari }} hari

                    </td>



                    <td>

                        Rp {{ number_format($data->total_biaya,0,',','.') }}

                    </td>



                    <td>


                        @if($data->status_pembayaran == 'lunas')

                            <span class="badge badge-success">
                                Lunas
                            </span>

                        @elseif($data->status_pembayaran == 'dp')

                            <span class="badge badge-warning">
                                DP
                            </span>

                        @else

                            <span class="badge badge-danger">
                                Belum Bayar
                            </span>

                        @endif


                        <br>


                        @if($data->status_sewa == 'aktif')

                            <span class="badge badge-info">
                                Aktif
                            </span>

                        @endif


                    </td>



                    <td>


                        <div class="aksi">


                            <a href="{{ route('sewa-fasilitas.show',$data->id) }}"
                               class="btn-sewa btn-info-sewa btn-sm-sewa">

                                👁

                            </a>



                            <a href="{{ route('sewa-fasilitas.edit',$data->id) }}"
                               class="btn-sewa btn-primary-sewa btn-sm-sewa">

                                ✏️

                            </a>



                            <a href="{{ route('sewa-fasilitas.invoice',$data->id) }}"
                               class="btn-sewa btn-success-sewa btn-sm-sewa"
                               target="_blank">

                                📄

                            </a>




                            <form action="{{ route('sewa-fasilitas.destroy',$data->id) }}"
                                  method="POST">


                                @csrf

                                @method('DELETE')


                                <button class="btn-sewa btn-danger-sewa btn-sm-sewa"
                                onclick="return confirm('Hapus data ini?')">

                                    🗑

                                </button>


                            </form>


                        </div>


                    </td>


                </tr>


                @endif



            @empty


                <tr>

                    <td colspan="8">


                        🏛️ Belum ada data sewa aktif.


                        <br><br>


                        <a href="{{ route('sewa-fasilitas.create') }}"
                           class="btn-sewa btn-success-sewa">

                            + Sewa Fasilitas

                        </a>


                    </td>

                </tr>


            @endforelse



            </tbody>


        </table>



        <div style="margin-top:20px">

            {{ $sewa->links() }}

        </div>



    </div>



</div>



@endsection