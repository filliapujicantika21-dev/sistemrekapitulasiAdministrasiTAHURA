<?php

namespace App\Exports;

use App\Models\Reservasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservasiExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Reservasi::select(
            'nama_penyewa',
            'nomor_kamar',
            'tipe_villa',
            'check_in',
            'check_out',
            'payment'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Penyewa',
            'Nomor Kamar',
            'Tipe Villa',
            'Check In',
            'Check Out',
            'Status Pembayaran'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => '4CAF50'
                    ],
                ],
            ],
        ];
    }
}