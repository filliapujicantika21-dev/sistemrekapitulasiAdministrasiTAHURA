@extends('layout.app')

@section('title', 'Data Persediaan')

@section('page_title', 'Data Persediaan')

@section('content')

<style>

/* =========================================================
   CONTAINER
========================================================= */

.persediaan-card{
    background:#fff;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}


/* =========================================================
   JUDUL LAPORAN
========================================================= */

.laporan-header{
    text-align:center;
    margin-bottom:20px;
}

.laporan-header h2{
    font-size:24px;
    font-weight:700;
    margin:0;
    text-transform:uppercase;
}


/* =========================================================
   FILTER
========================================================= */

.filter-box{
    background:#f8f9fa;
    border:1px solid #ddd;
    border-radius:10px;
    padding:15px;
    margin-bottom:20px;
}

.filter-label{
    font-weight:600;
    margin-bottom:5px;
}

.filter-box .form-control,
.filter-box .form-select{
    height:42px;
    border-radius:8px;
}


.btn-filter{
    background:#198754;
    color:#fff;
    border:none;
    height:42px;
    padding:0 22px;
    border-radius:8px;
    font-weight:600;
}


.btn-filter:hover{
    background:#157347;
    color:#fff;
}


/* =========================================================
   TOMBOL EXPORT
========================================================= */

.action-button{
    margin-bottom:20px;
}


.btn-excel{
    background:#198754;
    color:white;
    border:none;
    border-radius:8px;
    padding:10px 18px;
    font-weight:600;
    text-decoration:none;
}


.btn-excel:hover{
    background:#157347;
    color:white;
}


.btn-print{
    background:#0d6efd;
    color:white;
    border:none;
    border-radius:8px;
    padding:10px 18px;
    font-weight:600;
    text-decoration:none;
}


.btn-print:hover{
    background:#0b5ed7;
    color:white;
}


/* =========================================================
   INFORMASI LAPORAN
========================================================= */

.laporan-info{
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
    font-size:14px;
}


.laporan-info-left{
    font-weight:600;
}


.laporan-info-left span{
    font-weight:400;
}


.laporan-info-right{
    text-align:right;
}


.laporan-info-right strong{
    font-weight:700;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper{
    width:100%;
    overflow-x:auto;
}


/* =========================================================
   TABLE APBD
========================================================= */

.table-apbd{
    width:100%;
    min-width:1350px;
    border-collapse:collapse;
    font-size:13px;
    background:white;
}


.table-apbd th,
.table-apbd td{
    border:1px solid #000;
    padding:8px 6px;
}


/* HEADER */

.table-apbd thead th{
    background:#d9eadf;
    color:#000;
    text-align:center;
    vertical-align:middle;
    font-weight:700;
}


.table-apbd thead tr:first-child th{
    height:42px;
}


.table-apbd thead tr:nth-child(2) th{
    height:32px;
}


/* BODY */

.table-apbd tbody td{
    vertical-align:middle;
}


.table-apbd tbody tr:hover{
    background:#f5f5f5;
}


/* ALIGNMENT */

.text-center{
    text-align:center;
}


.text-right{
    text-align:right;
}


/* NOMOR */

.col-no{
    width:45px;
}


/* KODE */

.col-kode{
    width:150px;
}


/* KATEGORI (TAMBAHAN) */

.col-kategori{
    width:150px;
}


/* NAMA */

.col-nama{
    min-width:200px;
}


/* SATUAN */

.col-satuan{
    width:80px;
}


/* QTY */

.col-qty{
    width:75px;
}


/* RUPIAH */

.col-rp{
    width:120px;
}


/* KETERANGAN */

.col-keterangan{
    min-width:150px;
}


/* EMPTY DATA */

.empty-data{
    text-align:center;
    padding:25px !important;
    color:#777;
}


</style>


<div class="persediaan-card">


<div class="laporan-header">

<h2>
    LAPORAN PERSEDIAAN (APBD)
</h2>

</div>


<div class="filter-box">

<form method="GET"
      action="{{ route('persediaan.index') }}">

<div class="row g-3 align-items-end">


<div class="col-md-4">

<label class="filter-label">
Kategori
</label>


<select
name="kategori_id"
class="form-select">


<option value="">
Semua Kategori
</option>


@foreach($kategori as $kat)


<option
value="{{ $kat->id }}"
{{ request('kategori_id') == $kat->id ? 'selected' : '' }}>

{{ $kat->nama_kategori }}

</option>


@endforeach


</select>

</div>

<div class="col-md-2">
    <button type="submit" class="btn-filter">
        Filter
    </button>
</div>

</div> <!-- tutup row filter -->

<br>

<div class="action-button">

    <a href="{{ route('persediaan.cetak', request()->query()) }}"
       target="_blank"
       class="btn-print">
        🖨 Cetak PDF
    </a>


    <a href="{{ route('persediaan.excel', request()->query()) }}"
       class="btn-excel">
        📊 Export Excel
    </a>

</div>


<div class="table-wrapper">
<table class="table-apbd">


<thead>

<tr>


<th
rowspan="2"
class="col-no">

No

</th>



<th
rowspan="2"
class="col-kode">

Kode Barang

</th>



<!-- TAMBAHAN KATEGORI -->

<th
rowspan="2"
class="col-kategori">

Kategori

</th>



<th
rowspan="2"
class="col-nama">

Nama Barang

</th>



<th
rowspan="2"
class="col-satuan">

Satuan

</th>



<!-- SALDO AWAL -->

<th colspan="2">

Saldo Awal

</th>



<!-- PENAMBAHAN -->

<th colspan="2">

Penambahan

</th>



<!-- PENGURANGAN -->

<th colspan="2">

Pengurangan

</th>



<!-- SALDO AKHIR -->

<th colspan="2">

Saldo Akhir

</th>



<th
rowspan="2"
class="col-keterangan">

Keterangan

</th>


</tr>




<tr>


<th class="col-qty">
Qty
</th>


<th class="col-rp">
Total Rp.
</th>



<th class="col-qty">
Qty
</th>


<th class="col-rp">
Total Rp.
</th>



<th class="col-qty">
Qty
</th>


<th class="col-rp">
Total Rp.
</th>



<th class="col-qty">
Qty
</th>


<th class="col-rp">
Total Rp.
</th>


</tr>


</thead>



<tbody>


@forelse($persediaan as $index => $item)



<tr>



<!-- NO -->

<td class="text-center">

{{ $index + 1 }}

</td>




<!-- KODE BARANG -->

<td>

{{ $item['kode_barang'] }}

</td>




<!-- KATEGORI -->

<td>

{{ $item['kategori'] ?? '-' }}

</td>




<!-- NAMA BARANG -->

<td>

{{ $item['nama_barang'] }}

</td>




<!-- SATUAN -->

<td class="text-center">

{{ $item['satuan'] }}

</td>




<!-- SALDO AWAL -->

<td class="text-center">

{{ number_format(
$item['saldo_awal_qty'],
0,
',',
'.'
) }}

</td>



<td class="text-right">

Rp

{{ number_format(
$item['saldo_awal_rp'],
0,
',',
'.'
) }}

</td>





<!-- PENAMBAHAN -->

<td class="text-center">

{{ number_format(
$item['masuk_qty'],
0,
',',
'.'
) }}

</td>



<td class="text-right">

Rp

{{ number_format(
$item['masuk_rp'],
0,
',',
'.'
) }}

</td>





<!-- PENGURANGAN -->

<td class="text-center">

{{ number_format(
$item['keluar_qty'],
0,
',',
'.'
) }}

</td>



<td class="text-right">

Rp

{{ number_format(
$item['keluar_rp'],
0,
',',
'.'
) }}

</td>





<!-- SALDO AKHIR -->

<td class="text-center">

<strong>

{{ number_format(
$item['saldo_akhir_qty'],
0,
',',
'.'
) }}

</strong>

</td>




<td class="text-right">

<strong>

Rp

{{ number_format(
$item['saldo_akhir_rp'],
0,
',',
'.'
) }}

</strong>

</td>




<!-- KETERANGAN -->

<td>

{{ $item['keterangan'] ?? '' }}

</td>



</tr>


@empty



<tr>

<td
colspan="14"
class="empty-data">

Belum ada data persediaan.

</td>

</tr>



@endforelse


</tbody>


</table>


</div>
<!-- =====================================================
     FOOTER / PENUTUP INFORMASI
===================================================== -->


<div class="mt-3">

    <small class="text-muted">

        * Laporan persediaan berdasarkan data transaksi barang masuk
        dan barang keluar.

    </small>

</div>




</div>


@endsection