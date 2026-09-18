<?php

namespace App\Exports;

use App\Models\Reservasi;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class InvoiceExport implements FromArray, WithStyles, ShouldAutoSize, WithDrawings
{
    protected $reservasi;

    public function __construct($id)
    {
        $this->reservasi = Reservasi::findOrFail($id);
    }

    public function array(): array
    {
        switch ($this->reservasi->tipe_villa){

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

        $hargaExtra=$this->reservasi->jumlah_extra_bed*100000;

        $total=$hargaVilla+$hargaExtra;

        return [

            ['','','INVOICE RESERVASI VILLA TAHURA'],
            [],
            ['Nomor Invoice',$this->reservasi->nomor_invoice],
            ['Tanggal',now()->translatedFormat('d F Y')],
            [],
            ['Nama Penyewa',$this->reservasi->nama_penyewa],
            ['Nomor Telepon',$this->reservasi->nomor_penyewa],
            ['Tipe Villa',$this->reservasi->tipe_villa],
            ['Nomor Kamar',$this->reservasi->nomor_kamar],
            ['Check In',$this->reservasi->check_in],
            ['Check Out',$this->reservasi->check_out],
            ['Status Pembayaran',$this->reservasi->payment],
            [],
            ['Keterangan','Qty','Harga','Total'],
            ['Sewa Villa',1,$hargaVilla,$hargaVilla],
            ['Extra Bed',$this->reservasi->jumlah_extra_bed,100000,$hargaExtra],
            [],
            ['','','Subtotal',$total],
            ['','','Pajak',0],
            ['','','TOTAL',$total],
            [],
            ['Terima kasih telah melakukan reservasi di Villa Tahura Sultan Adam'],
            ['Harap membawa invoice ini saat Check In.'],
            [],
            ['Admin Reservasi','','','Banjarbaru, '.now()->translatedFormat('d F Y')],
            ['','','','Penyewa'],
            [],
            [],
            [],
            [],
            ['Admin Villa Tahura','','',strtoupper($this->reservasi->nama_penyewa)]
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->mergeCells('C1:D1');

        $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(18);

        $sheet->getStyle('A14:D14')->getFont()->setBold(true);

        $sheet->getStyle('A14:D14')->getFill()
              ->setFillType('solid')
              ->getStartColor()
              ->setARGB('2E7D32');

        $sheet->getStyle('A14:D14')->getFont()->getColor()->setARGB('FFFFFF');

        $sheet->getStyle('C20:D20')->getFont()->setBold(true);

        $sheet->getStyle('C20:D20')->getFill()
              ->setFillType('solid')
              ->getStartColor()
              ->setARGB('666666');

        $sheet->getStyle('C20:D20')->getFont()->getColor()->setARGB('FFFFFF');

        foreach(range('A','D') as $col){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [];
    }

    public function drawings()
{
    $drawing = new Drawing();

    $drawing->setName('Logo-tahura');
    $drawing->setDescription('Logo-tahura');

    $drawing->setPath(public_path('images/logo-tahura.png'));

    $drawing->setHeight(100);

    $drawing->setCoordinates('A1');

    $drawing->setOffsetX(10);
    $drawing->setOffsetY(10);

    return $drawing;
}
}