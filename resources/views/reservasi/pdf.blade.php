<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Laporan Reservasi Villa Tahura</title>

    <style>

        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .header{
            text-align: center;
        }

        .logo{
            width: 80px;
            height: 80px;
        }

        h2{
            margin:5px 0;
        }

        h4{
            margin:3px 0;
        }

        hr{
            border:1px solid black;
            margin-top:10px;
            margin-bottom:15px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background:#198754;
            color:white;
            text-align:center;
            padding:8px;
        }

        td{
            padding:6px;
            text-align:center;
        }

        .footer{
            margin-top:40px;
            width:100%;
        }

        .ttd{
            width:250px;
            float:right;
            text-align:center;
        }

    </style>

</head>

<body>

<div class="header">

    <img src="{{ public_path('images/logo-tahura.png') }}" class="logo">

    <h2>RESERVASI VILLA TAHURA</h2>

    <h4>Laporan Data Reservasi Villa</h4>

    <p>
        Tahura Sultan Adam <br>
        Kalimantan Selatan
    </p>

</div>

<hr>

<table>

    <thead>

        <tr>

            <th>No</th>
            <th>No Invoice</th>
            <th>Nama Penyewa</th>
            <th>No Penyewa</th>
            <th>No Kamar</th>
            <th>Tipe Villa</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Extra Bed</th>
            <th>Payment</th>

        </tr>

    </thead>

    <tbody>
        @php

function hargaVilla($tipe)
{
    switch($tipe){

        case 'Palawan Superior':
            return 850000;

        case 'Palawan Deluxe':
            return 750000;

        case 'Cemara Deluxe':
            return 650000;

        case 'Cemara Standar':
            return 500000;

        case 'Cemara Segitiga':
            return 450000;

        case 'Bingkirai Standar':
            return 400000;

        default:
            return 0;

    }
}

@endphp

    @foreach($reservasi as $r)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $r->nomor_invoice }}</td>

            <td>{{ $r->nama_penyewa }}</td>

            <td>{{ $r->nomor_penyewa }}</td>

            <td>{{ $r->nomor_kamar }}</td>

            <td>{{ $r->tipe_villa }}</td>

            <td>{{ \Carbon\Carbon::parse($r->check_in)->translatedFormat('d F Y') }}</td>

            <td>{{ \Carbon\Carbon::parse($r->check_out)->translatedFormat('d F Y') }}</td>

            <td>{{ $r->jumlah_extra_bed }}</td>

            <td>{{ $r->payment }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

<div class="footer">
    @php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp

    <div class="ttd">

       <p>
    Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</p>

        <br><br><br>

        <b>Admin Reservasi</b>

    </div>

</div>

</body>

</html>