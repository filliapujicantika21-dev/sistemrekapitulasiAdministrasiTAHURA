<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sewa Fasilitas - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #2d5016; font-size: 24px; }
        .card-header h1 small { font-size: 14px; color: #666; font-weight: normal; display: block; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #333; }
        .form-group label .required { color: #dc3545; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px;
            font-size: 14px; transition: border 0.3s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #2d5016; outline: none; box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
        }
        .form-group input[readonly] { background: #f8f9fa; cursor: default; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        
        .btn { padding: 12px 25px; border: none; border-radius: 8px; color: white; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; transition: all 0.3s; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .text-center { text-align: center; margin-top: 20px; }
        
        .alert-danger { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
        .alert-danger ul { margin-left: 20px; }
        
        .total-display { background: #e8f5e9; padding: 10px 15px; border-radius: 8px; font-weight: bold; font-size: 18px; color: #2d5016; border: 2px solid #4a7c2e; text-align: center; }
        .harga-info { font-size: 12px; color: #666; margin-top: 5px; }
        
        .field-hidden { display: none; }
        .field-visible { display: block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div>
                    <h1>✏️ Edit Sewa Fasilitas <small>Ubah data penyewaan fasilitas</small></h1>
                </div>
                <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary">← Kembali</a>
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

            <form action="{{ route('sewa-fasilitas.update', $sewa->id) }}" method="POST" id="formSewa">
                @csrf
                @method('PUT')

                <!-- KODE SEWA -->
                <div class="form-group">
                    <label>Kode Sewa</label>
                    <input type="text" value="{{ $sewa->kode_sewa }}" readonly style="background:#f8f9fa;">
                </div>

                <!-- NAMA & TELEPON -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Penyewa <span class="required">*</span></label>
                        <input type="text" name="nama_penyewa" value="{{ old('nama_penyewa', $sewa->nama_penyewa) }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon <span class="required">*</span></label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $sewa->no_telepon) }}" required>
                    </div>
                </div>

                <!-- FASILITAS & KATEGORI -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Fasilitas <span class="required">*</span></label>
                        <select name="fasilitas" id="fasilitas" required>
                            <option value="">Pilih Fasilitas</option>
                            <optgroup label="📍 Mandiangin">
                                <option value="Pesanggrahan" {{ $sewa->fasilitas == 'Pesanggrahan' ? 'selected' : '' }}>🛖 Pesanggrahan</option>
                                <option value="Rumah Banjar" {{ $sewa->fasilitas == 'Rumah Banjar' ? 'selected' : '' }}>🏠 Rumah Banjar</option>
                                <option value="Pendopo" {{ $sewa->fasilitas == 'Pendopo' ? 'selected' : '' }}>🏛️ Pendopo</option>
                                <option value="Camp Ground Angsana" {{ $sewa->fasilitas == 'Camp Ground Angsana' ? 'selected' : '' }}>⛺ Camp Ground Angsana</option>
                            </optgroup>
                            <optgroup label="📍 Bukit Batu">
                                <option value="Gazebo Besar" {{ $sewa->fasilitas == 'Gazebo Besar' ? 'selected' : '' }}>🌳 Gazebo Besar</option>
                                <option value="Gazebo Kecil" {{ $sewa->fasilitas == 'Gazebo Kecil' ? 'selected' : '' }}>🌿 Gazebo Kecil</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Sewa <span class="required">*</span></label>
                        <select name="kategori_sewa" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Pernikahan" {{ $sewa->kategori_sewa == 'Pernikahan' ? 'selected' : '' }}>💍 Pernikahan</option>
                            <option value="Rapat" {{ $sewa->kategori_sewa == 'Rapat' ? 'selected' : '' }}>📋 Rapat</option>
                            <option value="Acara Adat" {{ $sewa->kategori_sewa == 'Acara Adat' ? 'selected' : '' }}>🎭 Acara Adat</option>
                            <option value="Konser" {{ $sewa->kategori_sewa == 'Konser' ? 'selected' : '' }}>🎵 Konser</option>
                            <option value="Pameran" {{ $sewa->kategori_sewa == 'Pameran' ? 'selected' : '' }}>🖼️ Pameran</option>
                            <option value="Lainnya" {{ $sewa->kategori_sewa == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                        </select>
                    </div>
                </div>

                <!-- ===== BAGIAN PESANGGRAHAN (DURASI 4 JAM) ===== -->
                <div id="pesanggrahan_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam_pesanggrahan" id="durasi_jam_pesanggrahan" class="form-control" min="4" step="4" value="{{ old('durasi_jam', $sewa->durasi_jam ?? 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam. Harga Rp300.000/4 jam.</small>
                        </div>
                    </div>
                </div>

                <!-- ===== BAGIAN PENDOPO (DURASI 4 JAM) ===== -->
                <div id="pendopo_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam_pendopo" id="durasi_jam_pendopo" class="form-control" min="4" step="4" value="{{ old('durasi_jam', $sewa->durasi_jam ?? 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam</small>
                        </div>
                    </div>
                </div>

                <!-- ===== BAGIAN GAZEBO (DURASI 4 JAM) ===== -->
                <div id="gazebo_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam_gazebo" id="durasi_jam_gazebo" class="form-control" min="4" step="4" value="{{ old('durasi_jam', $sewa->durasi_jam ?? 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam</small>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH & HARGA -->
                <div class="form-row" id="default_durasi">
                    <div class="form-group">
                        <label>Jumlah Unit <span class="required">*</span></label>
                        <input type="number" name="jumlah_unit" id="jumlah_unit" value="{{ old('jumlah_unit', $sewa->jumlah_unit) }}" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa (per unit) <span class="required">*</span></label>
                        <input type="number" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa', $sewa->harga_sewa) }}" min="0" required readonly>
                        <div class="harga-info">💡 Harga otomatis muncul saat memilih fasilitas</div>
                    </div>
                </div>

                <!-- TANGGAL & JAM -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="required">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $sewa->tanggal_mulai) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai <span class="required">*</span></label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $sewa->jam_mulai) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Selesai <span class="required">*</span></label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $sewa->tanggal_selesai) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai <span class="required">*</span></label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $sewa->jam_selesai) }}" required>
                    </div>
                </div>

                <!-- ===== STATUS PEMBAYARAN & STATUS SEWA ===== -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Status Pembayaran <span class="required">*</span></label>
                        <select name="status_pembayaran" required>
                            <option value="belum_bayar" {{ $sewa->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>❌ Belum Bayar</option>
                            <option value="dp" {{ $sewa->status_pembayaran == 'dp' ? 'selected' : '' }}>🔄 DP</option>
                            <option value="lunas" {{ $sewa->status_pembayaran == 'lunas' ? 'selected' : '' }}>✅ Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Sewa <span class="required">*</span></label>
                        <select name="status_sewa" required>
                            <option value="aktif" {{ $sewa->status_sewa == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                            <option value="selesai" {{ $sewa->status_sewa == 'selesai' ? 'selected' : '' }}>⏹️ Selesai</option>
                            <option value="batal" {{ $sewa->status_sewa == 'batal' ? 'selected' : '' }}>🔴 Batal</option>
                        </select>
                    </div>
                </div>

                <!-- TOTAL BIAYA -->
                <div class="form-group">
                    <label>Total Biaya</label>
                    <div id="total_biaya_display" class="total-display">Rp {{ number_format($sewa->total_biaya, 0, ',', '.') }}</div>
                    <input type="hidden" name="total_biaya" id="total_biaya_hidden" value="{{ $sewa->total_biaya }}">
                </div>

                <!-- KETERANGAN -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('keterangan', $sewa->keterangan) }}</textarea>
                </div>

                <!-- TOMBOL -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">💾 Update</button>
                    <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaFasilitas = {
                'Pesanggrahan': 300000,
                'Rumah Banjar': 500000,
                'Pendopo': 500000,
                'Camp Ground Angsana': 500000,
                'Gazebo Besar': 100000,
                'Gazebo Kecil': 100000
            };

            const fasilitasBukitBatu = ['Gazebo Besar', 'Gazebo Kecil'];

            const fasilitasSelect = document.getElementById('fasilitas');
            const hargaInput = document.getElementById('harga_sewa');
            const jumlahInput = document.getElementById('jumlah_unit');
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            const displayTotal = document.getElementById('total_biaya_display');
            const hiddenTotal = document.getElementById('total_biaya_hidden');
            
            const pesanggrahanFields = document.getElementById('pesanggrahan_fields');
            const pendopoFields = document.getElementById('pendopo_fields');
            const gazeboFields = document.getElementById('gazebo_fields');
            const durasiJamPesanggrahan = document.getElementById('durasi_jam_pesanggrahan');
            const durasiJamPendopo = document.getElementById('durasi_jam_pendopo');
            const durasiJamGazebo = document.getElementById('durasi_jam_gazebo');
            const defaultDurasi = document.getElementById('default_durasi');

            function toggleFields() {
                const fasilitas = fasilitasSelect.value;
                
                pesanggrahanFields.style.display = 'none';
                pendopoFields.style.display = 'none';
                gazeboFields.style.display = 'none';
                defaultDurasi.style.display = 'grid';

                if (fasilitas === 'Pesanggrahan') {
                    pesanggrahanFields.style.display = 'block';
                    defaultDurasi.style.display = 'none';
                } else if (fasilitas === 'Pendopo') {
                    pendopoFields.style.display = 'block';
                    defaultDurasi.style.display = 'none';
                } else if (fasilitasBukitBatu.includes(fasilitas)) {
                    gazeboFields.style.display = 'block';
                    defaultDurasi.style.display = 'none';
                }
            }

            function isiHargaOtomatis() {
                const fasilitas = fasilitasSelect.value;
                let harga = 0;
                
                if (fasilitas && typeof hargaFasilitas[fasilitas] === 'number') {
                    harga = hargaFasilitas[fasilitas];
                }
                
                hargaInput.value = harga;
                toggleFields();
                hitungTotal();
            }

            function hitungTotal() {
                const fasilitas = fasilitasSelect.value;
                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = parseInt(jumlahInput.value) || 1;
                let total = 0;

                if (fasilitas === 'Pesanggrahan') {
                    const durasi = parseInt(durasiJamPesanggrahan.value) || 4;
                    total = harga * jumlah * Math.ceil(durasi / 4);
                } else if (fasilitas === 'Pendopo') {
                    const durasi = parseInt(durasiJamPendopo.value) || 4;
                    total = harga * jumlah * Math.ceil(durasi / 4);
                } else if (fasilitasBukitBatu.includes(fasilitas)) {
                    const durasi = parseInt(durasiJamGazebo.value) || 4;
                    total = harga * jumlah * Math.ceil(durasi / 4);
                } else {
                    const mulai = new Date(tanggalMulai.value);
                    const selesai = new Date(tanggalSelesai.value);
                    let hari = 0;
                    if (selesai > mulai) {
                        hari = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24));
                    }
                    if (hari === 0) hari = 1;
                    total = harga * jumlah * hari;
                }
                
                displayTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
                hiddenTotal.value = total;
            }

            fasilitasSelect.addEventListener('change', isiHargaOtomatis);
            durasiJamPesanggrahan.addEventListener('input', hitungTotal);
            durasiJamPendopo.addEventListener('input', hitungTotal);
            durasiJamGazebo.addEventListener('input', hitungTotal);
            jumlahInput.addEventListener('input', hitungTotal);
            tanggalMulai.addEventListener('change', hitungTotal);
            tanggalSelesai.addEventListener('change', hitungTotal);

            isiHargaOtomatis();

            // ===== VALIDASI TANGGAL BARU (BOLEH SAMA) =====
            tanggalMulai.addEventListener('change', function() {
                if (tanggalSelesai.value && tanggalSelesai.value < tanggalMulai.value) {
                    tanggalSelesai.value = '';
                    alert('⚠️ Tanggal Selesai tidak boleh kurang dari Tanggal Mulai!');
                }
            });

            tanggalSelesai.addEventListener('change', function() {
                if (tanggalMulai.value && tanggalSelesai.value < tanggalMulai.value) {
                    alert('⚠️ Tanggal Selesai tidak boleh kurang dari Tanggal Mulai!');
                    tanggalSelesai.value = '';
                }
            });
        });
    </script>
</body>
</html>