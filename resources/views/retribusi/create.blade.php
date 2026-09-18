<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Retribusi - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #2d5016; font-size: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { border-color: #2d5016; outline: none; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn { padding: 12px 25px; border: none; border-radius: 8px; color: white; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .text-center { text-align: center; margin-top: 20px; }
        .text-danger { color: #dc3545; font-size: 13px; margin-top: 5px; }
        .alert-danger { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>🌿 Tambah Retribusi</h1>
                <a href="{{ route('retribusi.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            @if($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('retribusi.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Kode Transaksi</label>
                    <input type="text" name="kode_transaksi" value="{{ $kode_transaksi }}" readonly>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Pengunjung *</label>
                        <input type="text" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon *</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Identitas *</label>
                        <select name="jenis_identitas" required>
                            <option value="">Pilih</option>
                            <option value="KTP" {{ old('jenis_identitas') == 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="SIM" {{ old('jenis_identitas') == 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="Paspor" {{ old('jenis_identitas') == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor Identitas *</label>
                        <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Kendaraan *</label>
                        <select name="jenis_kendaraan" required>
                            <option value="">Pilih</option>
                            <option value="Mobil" {{ old('jenis_kendaraan') == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                            <option value="Motor" {{ old('jenis_kendaraan') == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Bus" {{ old('jenis_kendaraan') == 'Bus' ? 'selected' : '' }}>Bus</option>
                            <option value="Truk" {{ old('jenis_kendaraan') == 'Truk' ? 'selected' : '' }}>Truk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Plat Nomor *</label>
                        <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori *</label>
                        <select name="kategori" required>
                            <option value="">Pilih</option>
                            <option value="wisatawan" {{ old('kategori') == 'wisatawan' ? 'selected' : '' }}>Wisatawan</option>
                            <option value="peneliti" {{ old('kategori') == 'peneliti' ? 'selected' : '' }}>Peneliti</option>
                            <option value="pedagang" {{ old('kategori') == 'pedagang' ? 'selected' : '' }}>Pedagang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Orang *</label>
                        <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', 1) }}" min="1" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tarif / Orang *</label>
                        <input type="number" name="tarif" value="{{ old('tarif') }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Total Bayar</label>
                        <input type="text" id="total_bayar_display" value="Rp 0" readonly style="background:#f8f9fa; font-weight:bold; font-size:16px;">
                        <input type="hidden" name="total_bayar" id="total_bayar_hidden" value="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Masuk *</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Masuk *</label>
                        <input type="time" name="jam_masuk" value="{{ old('jam_masuk', date('H:i')) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                    <a href="{{ route('retribusi.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tarifInput = document.querySelector('input[name="tarif"]');
            const jumlahInput = document.querySelector('input[name="jumlah_orang"]');
            const displayTotal = document.getElementById('total_bayar_display');
            const hiddenTotal = document.getElementById('total_bayar_hidden');

            function hitungTotal() {
                const tarif = parseFloat(tarifInput.value) || 0;
                const jumlah = parseInt(jumlahInput.value) || 1;
                const total = tarif * jumlah;
                displayTotal.value = 'Rp ' + total.toLocaleString('id-ID');
                hiddenTotal.value = total;
            }

            tarifInput.addEventListener('input', hitungTotal);
            jumlahInput.addEventListener('input', hitungTotal);
            hitungTotal();
        });
    </script>
</body>
</html>