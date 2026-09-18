<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Laporan Persediaan APBD</title>

    <style>

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .informasi {
            width: 100%;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .informasi td {
            padding: 2px 0;
            vertical-align: top;
        }

        .informasi .kanan {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-apbd th,
        .table-apbd td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table-apbd th {
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        .table-apbd td {
            vertical-align: middle;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .kode {
            text-align: left;
        }

        .nama {
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            width: 100%;
        }

        .footer td {
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }

        @media print {

            .no-print {
                display: none !important;
            }

        }

        .button-area {
            margin-bottom: 15px;
        }

        .button-area button {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
        }

    </style>

</head>

<body>


<!-- TOMBOL -->

<div class="button-area no-print">

    <button onclick="window.print()">
        Cetak
    </button>

    <button onclick="window.close()">
        Tutup
    </button>

</div>


<!-- JUDUL -->

<div class="header">

    <h2>
        LAPORAN PERSEDIAAN (APBD)
    </h2>

</div>


<!-- INFORMASI -->

<table class="informasi">

    <tr>

        <td width="50%">

            <strong>SKPD/UNIT KERJA :</strong>

            TAHURA SULTAN ADAM

        </td>


        <td width="50%" class="kanan">

            <strong>Tanggal :</strong>

            {{ date('d-m-Y') }}

        </td>

    </tr>


    <tr>

        <td>

            &nbsp;

        </td>


        <td class="kanan">

            <strong>Periode :</strong>

            {{ request('tanggal_awal')
                ? date('d-m-Y', strtotime(request('tanggal_awal')))
                : '-' }}

            s/d

            {{ request('tanggal_akhir')
                ? date('d-m-Y', strtotime(request('tanggal_akhir')))
                : '-' }}

        </td>

    </tr>

</table>


<!-- TABEL -->

<table class="table-apbd">


    <!-- HEADER BARIS 1 -->

    <thead>

        <tr>

            <th rowspan="2" width="4%">
                No
            </th>

            <th rowspan="2" width="11%">
                Kode Barang
            </th>

            <th rowspan="2" width="15%">
                Nama Barang
            </th>

            <th rowspan="2" width="6%">
                Satuan
            </th>


            <th colspan="2">
                Saldo Awal
            </th>


            <th colspan="2">
                Penambahan
            </th>


            <th colspan="2">
                Pengurangan
            </th>


            <th colspan="2">
                Saldo Akhir
            </th>


            <th rowspan="2" width="10%">
                Keterangan
            </th>

        </tr>


        <!-- HEADER BARIS 2 -->

        <tr>

            <th width="5%">
                Qty
            </th>

            <th width="9%">
                Total Rp.
            </th>


            <th width="5%">
                Qty
            </th>

            <th width="9%">
                Total Rp.
            </th>


            <th width="5%">
                Qty
            </th>

            <th width="9%">
                Total Rp.
            </th>


            <th width="5%">
                Qty
            </th>

            <th width="9%">
                Total Rp.
            </th>

        </tr>

    </thead>


    <!-- DATA -->

    <tbody>

        @forelse($persediaan as $index => $item)

            <tr>

                <!-- NO -->

                <td class="center">

                    {{ $index + 1 }}

                </td>


                <!-- KODE -->

                <td class="kode">

                    {{ $item['kode_barang'] }}

                </td>


                <!-- NAMA -->

                <td class="nama">

                    {{ $item['nama_barang'] }}

                </td>


                <!-- SATUAN -->

                <td class="center">

                    {{ $item['satuan'] }}

                </td>


                <!-- =========================
                     SALDO AWAL
                ========================== -->

                <td class="center">

                    {{ number_format(
                        $item['saldo_awal_qty'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="right">

                    Rp
                    {{ number_format(
                        $item['saldo_awal_rp'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <!-- =========================
                     PENAMBAHAN
                ========================== -->

                <td class="center">

                    {{ number_format(
                        $item['masuk_qty'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="right">

                    Rp
                    {{ number_format(
                        $item['masuk_rp'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <!-- =========================
                     PENGURANGAN
                ========================== -->

                <td class="center">

                    {{ number_format(
                        $item['keluar_qty'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="right">

                    Rp
                    {{ number_format(
                        $item['keluar_rp'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <!-- =========================
                     SALDO AKHIR
                ========================== -->

                <td class="center total">

                    {{ number_format(
                        $item['saldo_akhir_qty'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="right total">

                    Rp
                    {{ number_format(
                        $item['saldo_akhir_rp'],
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <!-- KETERANGAN -->

                <td>

                    {{ $item['keterangan'] ?? '' }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="13" class="center">

                    Tidak ada data persediaan.

                </td>

            </tr>

        @endforelse

    </tbody>

</table>


<!-- FOOTER -->

<table class="footer">

    <tr>

        <td width="70%"></td>

        <td width="30%">

            Mengetahui,<br>

            Pengelola Barang<br><br><br><br>

            __________________________

        </td>

    </tr>

</table>


<script>

    // Otomatis membuka dialog print
    window.onload = function() {

        window.print();

    };


    function closeWindow() {

        window.close();

    }

</script>


</body>

</html>