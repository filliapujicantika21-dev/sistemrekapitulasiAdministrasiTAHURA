<table border="1">

<tr>
    <th colspan="10" style="font-size:18px;">
        LAPORAN PERSEDIAAN BARANG
    </th>
</tr>

<tr>
    <th colspan="10">
        TAHURA SULTAN ADAM
    </th>
</tr>

<tr></tr>

<tr>

<th>No</th>

<th>Kategori</th>

<th>Kode Barang</th>

<th>Nama Barang</th>

<th>Satuan</th>

<th>Barang Masuk</th>

<th>Barang Keluar</th>

<th>Saldo</th>

<th>Harga</th>

<th>Nilai Persediaan</th>

</tr>

@php
$no=1;
@endphp

@foreach($persediaan as $item)

<tr>

<td>{{ $no++ }}</td>

<td>{{ $item['kategori'] }}</td>

<td>{{ $item['kode_barang'] }}</td>

<td>{{ $item['nama_barang'] }}</td>

<td>{{ $item['satuan'] }}</td>

<td>{{ $item['masuk'] }}</td>

<td>{{ $item['keluar'] }}</td>

<td>{{ $item['saldo'] }}</td>

<td>{{ $item['harga'] }}</td>

<td>{{ $item['nilai'] }}</td>

</tr>

@endforeach

</table>