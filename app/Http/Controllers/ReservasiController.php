<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReservasiExport;
use Maatwebsite\Excel\Facades\Excel;


class ReservasiController extends Controller
{
    /**
     * Menampilkan data reservasi
     */
    public function index()
{
    $reservasi = Reservasi::orderBy('id', 'desc')->get();

    return view('reservasi.index', compact('reservasi'));
}

    /**
     * Form tambah reservasi
     */
    public function create()
    {
        return view('reservasi.create');
    }

    /**
     * Simpan data reservasi
     */
    public function store(Request $request)
    {
        $request->validate([
    'nama_penyewa'      => 'required|max:100',
    'nomor_penyewa'     => 'required|max:15',
    'nomor_kamar'       => 'required|max:20',
    'tipe_villa'        => 'required',
    'check_in'          => 'required|date',
    'check_out'         => 'required|date|after_or_equal:check_in',
    'payment'           => 'required',
    'jumlah_extra_bed'  => 'required|integer|min:0',
],[
    'nama_penyewa.required'         => 'Nama penyewa wajib diisi.',
    'nomor_penyewa.required'        => 'Nomor penyewa wajib diisi.',
    'nomor_penyewa.max'             => 'Nomor penyewa maksimal 15 digit.',
    'nomor_kamar.required'          => 'Nomor kamar wajib diisi.',
    'tipe_villa.required'           => 'Tipe villa wajib dipilih.',
    'check_in.required'             => 'Tanggal check in wajib diisi.',
    'check_out.required'            => 'Tanggal check out wajib diisi.',
    'check_out.after_or_equal'      => 'Check out tidak boleh sebelum check in.',
    'payment.required'              => 'Status pembayaran wajib dipilih.',
    'jumlah_extra_bed.required'     => 'Jumlah extra bed wajib diisi.',
    'jumlah_extra_bed.integer'      => 'Jumlah extra bed harus berupa angka.',
    'jumlah_extra_bed.min'          => 'Jumlah extra bed tidak boleh kurang dari 0.',
]);

        // Membuat nomor invoice otomatis
$lastReservasi = Reservasi::latest()->first();

if ($lastReservasi) {
    $nomor = $lastReservasi->id + 1;
} else {
    $nomor = 1;
}

$lastId = (Reservasi::max('id') ?? 0) + 1;

$nomorInvoice = 'INV-' . now()->format('Ymd') . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);

       $data = [
    'nomor_invoice' => $nomorInvoice,
    'nama_penyewa' => $request->nama_penyewa,
    'nomor_penyewa' => $request->nomor_penyewa,
    'nomor_kamar' => $request->nomor_kamar,
    'tipe_villa' => $request->tipe_villa,
    'jumlah_extra_bed' => $request->jumlah_extra_bed,
    'check_in' => $request->check_in,
    'check_out' => $request->check_out,
    'payment' => $request->payment,
];

$cek = Reservasi::where('nomor_kamar', $request->nomor_kamar)
    ->where(function ($query) use ($request) {
        $query->whereBetween('check_in', [$request->check_in, $request->check_out])
              ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
              ->orWhere(function ($q) use ($request) {
                  $q->where('check_in', '<=', $request->check_in)
                    ->where('check_out', '>=', $request->check_out);
              });
    })
    ->exists();

if ($cek) {
    return back()
        ->withInput()
        ->with('error', '❌ Nomor kamar '.$request->nomor_kamar.' sudah dibooking pada tanggal tersebut.');
}

$reservasi = Reservasi::create($data);

      return redirect()->route('reservasi.index')
    ->with('success', 'Data reservasi berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasi.edit', compact('reservasi'));
    }

    /**
     * Update data reservasi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penyewa' => 'required|max:100',
            'nomor_kamar' => 'required|max:20',
            'tipe_villa' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'payment' => 'required',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update([
            'nama_penyewa' => $request->nama_penyewa,
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_villa' => $request->tipe_villa,
            'nomor_penyewa' => $request->nomor_penyewa,
            'jumlah_extra_bed' => $request->jumlah_extra_bed,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'payment' => $request->payment,
        ]);

       return redirect()->route('reservasi.index')
    ->with('success', 'Data reservasi berhasil diperbarui.');
    }

    /**
     * Hapus data reservasi
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->delete();

        return redirect()->route('reservasi.index')
    ->with('success', 'Data reservasi berhasil dihapus.');
    }


    /**
     * Preview PDF
     */
    public function preview()
    {
        $reservasi = Reservasi::all();

        $pdf = Pdf::loadView('reservasi.pdf', compact('reservasi'))
          ->setPaper('A4', 'landscape');

        return $pdf->stream('Reservasi_Villa_Tahura.pdf');
    }

    /**
     * Download PDF
     */
    public function pdf()
    {
        $reservasi = Reservasi::all();

        $pdf = Pdf::loadView('reservasi.pdf', compact('reservasi'))
          ->setPaper('A4', 'landscape');
        return $pdf->download('Reservasi_Villa_Tahura.pdf');
    }

    /**
     * Export Excel
     */
    public function excel()
    {
        return Excel::download(
            new ReservasiExport,
            'Reservasi_Villa_Tahura.xlsx'
        );
    }


public function cekKamar(Request $request)
{
    $kamar = [
        "Palawan Superior" => ["1P"],
        "Palawan Deluxe" => ["2P","3P","4P"],
        "Cemara Standar" => ["1A","2A"],
        "Cemara Deluxe" => ["1C","2C"],
        "Cemara Segitiga" => ["1S","2S"],
        "Bingkirai Standar" => ["1B","2B","3B"],
    ];

    $daftarKamar = $kamar[$request->tipe_villa] ?? [];

    if (!$request->check_in || !$request->check_out) {
        return response()->json($daftarKamar);
    }

    $kamarTerpakai = Reservasi::where(function ($q) use ($request) {
        $q->whereBetween('check_in', [$request->check_in, $request->check_out])
          ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
          ->orWhere(function ($qq) use ($request) {
              $qq->where('check_in', '<=', $request->check_in)
                 ->where('check_out', '>=', $request->check_out);
          });
    })
    ->pluck('nomor_kamar')
    ->toArray();

    $tersedia = array_values(array_diff($daftarKamar, $kamarTerpakai));

    return response()->json($tersedia);
}


public function invoice($id)
{
    $reservasi = Reservasi::findOrFail($id);

    $pdf = Pdf::loadView('reservasi.invoice', compact('reservasi'))
              ->setPaper('A4', 'portrait');

    return $pdf->stream('Invoice_'.$reservasi->nomor_invoice.'.pdf');
}

public function invoicePdf($id)
{
    $reservasi = Reservasi::findOrFail($id);

    return Pdf::loadView(
        'reservasi.invoice',
        compact('reservasi')
    )
    ->setPaper('A4')
    ->download(
        'Invoice_'.$reservasi->nomor_invoice.'.pdf'
    );
}


}