<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Retribusi - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #2d5016; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn { padding: 12px 25px; border: none; border-radius: 8px; color: white; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .text-center { text-align: center; margin-top: 20px; }
        .alert-danger { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>✏️ Edit Retribusi</h1>
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

            <form action="{{ route('retribusi.update', $retribusi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Kode Transaksi</label>
                    <input type="text" value="{{ $retribusi->kode_transaksi }}" readonly style="background:#f8f9fa;">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Pengunjung *</label>
                        <input type="text" name="nama_pengunjung" value="{{ old('nama_pengunjung', $retribusi->nama_pengunjung) }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon *</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $retribusi->no_telepon) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Identitas *</label>
                        <select name="jenis_identitas" required>
                            <option value="KTP" {{ $retribusi->jenis_identitas == 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="SIM" {{ $retribusi->jenis_identitas == 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="Paspor" {{ $retribusi->jenis_identitas == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor Identitas *</label>
                        <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas', $retribusi->nomor_identitas) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Kendaraan *</label>
                        <select name="jenis_kendaraan" required>
                            <option value="Mobil" {{ $retribusi->jenis_kendaraan == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                            <option value="Motor" {{ $retribusi->jenis_kendaraan == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Bus" {{ $retribusi->jenis_kendaraan == 'Bus' ? 'selected' : '' }}>Bus</option>
                            <option value="Truk" {{ $retribusi->jenis_kendaraan == 'Truk' ? 'selected' : '' }}>Truk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Plat Nomor *</label>
                        <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $retribusi->plat_nomor) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori *</label>
                        <select name="kategori" required>
                            <option value="wisatawan" {{ $retribusi->kategori == 'wisatawan' ? 'selected' : '' }}>Wisatawan</option>
                            <option value="peneliti" {{ $retribusi->kategori == 'peneliti' ? 'selected' : '' }}>Peneliti</option>
                            <option value="pedagang" {{ $retribusi->kategori == 'pedagang' ? 'selected' : '' }}>Pedagang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Orang *</label>
                        <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', $retribusi->jumlah_orang) }}" min="1" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tarif / Orang *</label>
                        <input type="number" name="tarif" value="{{ old('tarif', $retribusi->tarif) }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Status *</label>
                        <select name="status" required>
                            <option value="masuk" {{ $retribusi->status == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ $retribusi->status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                            <option value="batal" {{ $retribusi->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Masuk *</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $retribusi->tanggal_masuk) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Masuk *</label>
                        <input type="time" name="jam_masuk" value="{{ old('jam_masuk', $retribusi->jam_masuk) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3">{{ old('keterangan', $retribusi->keterangan) }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">💾 Update</button>
                    <a href="{{ route('retribusi.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>