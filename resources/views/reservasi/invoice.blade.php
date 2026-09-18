<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Invoice Reservasi Villa Tahura</title>

<style>

@page{
    margin:25px;
}

*{
    font-family:Arial, Helvetica, sans-serif;
    box-sizing:border-box;
}

body{
    font-size:12px;
    color:#222;
    margin:0;
}

table{
    width:100%;
    border-collapse:collapse;
}

.logo{
    width:85px;
}

.invoice-box{
    border:3px solid #000;
    padding:10px 30px;
    font-size:34px;
    font-weight:bold;
    display:inline-block;
}

.title{
    text-align:center;
    font-size:22px;
    font-weight:bold;
    line-height:34px;
}

.alamat{
    font-size:12px;
    font-weight:normal;
    line-height:20px;
}

.line{
    margin-top:15px;
    margin-bottom:20px;
    border-top:3px solid #000;
}

.info-box{
    width:100%;
    border:1px solid #999;
    margin-bottom:25px;
}

.info-box td{
    border:none;
    vertical-align:top;
    padding:18px;
}

.info-left{
    width:50%;
    border-right:1px solid #999;
}

.info-right{
    width:50%;
}

.info-table{
    width:100%;
}

.info-table td{
    padding:7px 0;
    font-size:13px;
}

.label{
    width:150px;
    font-weight:bold;
}

.value{
    padding-left:10px;
}

.detail{
    margin-top:10px;
}

.detail th{
    background:#1f6f43;
    color:#fff;
    border:1px solid #555;
    padding:10px;
    font-size:13px;
}

.detail td{
    border:1px solid #999;
    padding:10px;
    font-size:13px;
}

.total-wrapper{
    width:100%;
    margin-top:20px;
}

.total-box{
    width:320px;
    margin-left:auto;
}

.total-box td{
    border:1px solid #999;
    padding:10px;
}

.invoice-total{
    background:#666;
    color:#fff;
    font-size:15px;
    font-weight:bold;
}

.status{
    margin-top:15px;
    text-align:right;
}

.lunas{
    background:#28a745;
    color:#fff;
    padding:10px 25px;
    font-weight:bold;
}

.dp{
    background:#ffc107;
    color:#000;
    padding:10px 25px;
    font-weight:bold;
}

.belum{
    background:#dc3545;
    color:#fff;
    padding:10px 25px;
    font-weight:bold;
}

.footer{
    margin-top:25px;
    font-size:12px;
    font-style:italic;
}

.signature{
    margin-top:60px;
}

.signature td{
    border:none;
    text-align:center;
}

.ttd{
    height:100px;
}

.nama{
    display:inline-block;
    border-top:1px solid #000;
    min-width:180px;
    padding-top:5px;
    font-weight:bold;
}

</style>

</head>

<body>

@php

switch($reservasi->tipe_villa){

case 'Palawan Superior':
    $hargaVilla=800000;
break;

case 'Palawan Deluxe':
    $hargaVilla=600000;
break;

case 'Cemara Deluxe':
    $hargaVilla=1500000;
break;

case 'Cemara Standar':
    $hargaVilla=1000000;
break;

case 'Cemara Segitiga':
    $hargaVilla=1500000;
break;

case 'Bingkirai Standar':
    $hargaVilla=1000000;
break;

default:
    $hargaVilla=0;

}

$hargaExtraBed=$reservasi->jumlah_extra_bed*100000;

$total=$hargaVilla+$hargaExtraBed;

@endphp

<table>

<tr>

<td width="25%">

<div class="invoice-box">

INVOICE

</div>

</td>

<td width="80%" class="title">

TAMAN HUTAN RAYA SULTAN ADAM

<div class="alamat">

Jl. Tahura Sultan Adam

<br>

Mandiangin Timur,Kec.Karang Intan,Kab.Banjar, Kalimantan Selatan 70661

</div>

</td>

<td align="right">

<img src="{{ public_path('images/logo-tahura.png') }}" class="logo">

</td>

</tr>

</table>

<div class="line"></div>

<table class="info">

<tr>

<td width="50%" valign="top">

<table>

<tr>
<td width="130"><b>Invoice Number</b></td>
<td>: {{ $reservasi->nomor_invoice }}</td>
</tr>

<tr>
<td><b>Date of Issue</b></td>
<td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
</tr>

<tr>
<td><b>Service</b></td>
<td>: Reservasi Villa Tahura</td>
</tr>

<tr>
<td><b>Guest Name</b></td>
<td>: {{ $reservasi->nama_penyewa }}</td>
</tr>

</table>

</td>

<td width="50%" valign="top">

<table>

<tr>
<td width="130"><b>Telephone</b></td>
<td>: {{ $reservasi->nomor_penyewa }}</td>
</tr>

<tr>
<td><b>Villa</b></td>
<td>: {{ $reservasi->tipe_villa }}</td>
</tr>

<tr>
<td><b>Room</b></td>
<td>: {{ $reservasi->nomor_kamar }}</td>
</tr>

<tr>
<td><b>Check In</b></td>
<td>: {{ \Carbon\Carbon::parse($reservasi->check_in)->translatedFormat('d F Y') }}</td>
</tr>

<tr>
<td><b>Check Out</b></td>
<td>: {{ \Carbon\Carbon::parse($reservasi->check_out)->translatedFormat('d F Y') }}</td>
</tr>

</table>

</td>

</tr>

</table>

<table class="detail">

<thead>

<tr>

<th width="50%">Description</th>
<th width="18%">Harga</th>
<th width="12%">Qty</th>
<th width="20%">Jumlah</th>

</tr>

</thead>

<tbody>

<tr>

<td>

Sewa Villa {{ $reservasi->tipe_villa }}

</td>

<td align="right">

Rp {{ number_format($hargaVilla,0,',','.') }}

</td>

<td align="center">

1

</td>

<td align="right">

Rp {{ number_format($hargaVilla,0,',','.') }}

</td>

</tr>

@if($reservasi->jumlah_extra_bed>0)

<tr>

<td>

Extra Bed

</td>

<td align="right">

Rp 100.000

</td>

<td align="center">

{{ $reservasi->jumlah_extra_bed }}

</td>

<td align="right">

Rp {{ number_format($hargaExtraBed,0,',','.') }}

</td>

</tr>

@endif

</tbody>

</table>

<table class="total-box">

<tr>

<td width="60%">

Subtotal

</td>

<td align="right">

Rp {{ number_format($total,0,',','.') }}

</td>

</tr>

<tr>

<td>

Tax

</td>

<td align="right">

Rp 0

</td>

</tr>

<tr class="invoice-total">

<td>

Invoice Total

</td>

<td align="right">

Rp {{ number_format($total,0,',','.') }}

</td>

</tr>

</table>

<div style="clear:both;"></div>

<div class="footer">

<br>

Terima kasih telah melakukan reservasi di <b>Villa Tahura Sultan Adam</b>.

<br>

Harap membawa invoice ini pada saat Check In.

</div>

<table class="signature" width="100%">

<tr>

<td width="50%" align="center">

</td>

<td width="50%" align="center">

Mandiangin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

<br><br>

<b>Penyewa</b>

</td>

</tr>

<tr>

<td class="ttd"></td>

<td class="ttd"></td>

</tr>

<tr>

<td align="center">

<span class="nama">
Admin Villa Tahura
</span>

</td>

<td align="center">

<span class="nama">
{{ strtoupper($reservasi->nama_penyewa) }}
</span>

</td>

</tr>

</table>
</body>

</html>