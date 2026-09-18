<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sewa Fasilitas - Tahura</title>
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
                    <h1>🏛️ Sewa Fasilitas Tahura <small>Isi data penyewaan fasilitas</small></h1>
                </div>
                <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <!-- ERROR VALIDASI -->
            @if($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('sewa-fasilitas.store') }}" method="POST" id="formSewa">
                @csrf

                <!-- KODE SEWA -->
                <div class="form-group">
                    <label>Kode Sewa</label>
                    <input type="text" name="kode_sewa" value="{{ $kode_sewa }}" readonly>
                </div>

                <!-- NAMA & TELEPON -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Penyewa <span class="required">*</span></label>
                        <input type="text" name="nama_penyewa" value="{{ old('nama_penyewa') }}" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon <span class="required">*</span></label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan nomor telepon" required>
                    </div>
                </div>

                <!-- FASILITAS & KATEGORI -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Fasilitas <span class="required">*</span></label>
                        <select name="fasilitas" id="fasilitas" required>
                            <option value="">Pilih Fasilitas</option>
                            
                            <!-- ===== MANDIANGIN ===== -->
                            <optgroup label="📍 Mandiangin">
                                <option value="Pesanggrahan" {{ old('fasilitas') == 'Pesanggrahan' ? 'selected' : '' }}>🛖 Pesanggrahan</option>
                                <option value="Rumah Banjar" {{ old('fasilitas') == 'Rumah Banjar' ? 'selected' : '' }}>🏠 Rumah Banjar</option>
                                <option value="Pendopo" {{ old('fasilitas') == 'Pendopo' ? 'selected' : '' }}>🏛️ Pendopo</option>
                                <option value="Camp Ground Angsana" {{ old('fasilitas') == 'Camp Ground Angsana' ? 'selected' : '' }}>⛺ Camp Ground Angsana</option>
                            </optgroup>
                            
                            <!-- ===== BUKIT BATU ===== -->
                            <optgroup label="📍 Bukit Batu">
                                <option value="Gazebo Besar" {{ old('fasilitas') == 'Gazebo Besar' ? 'selected' : '' }}>🌳 Gazebo Besar</option>
                                <option value="Gazebo Kecil" {{ old('fasilitas') == 'Gazebo Kecil' ? 'selected' : '' }}>🌿 Gazebo Kecil</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Sewa <span class="required">*</span></label>
                        <select name="kategori_sewa" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Pernikahan" {{ old('kategori_sewa') == 'Pernikahan' ? 'selected' : '' }}>💍 Pernikahan</option>
                            <option value="Rapat" {{ old('kategori_sewa') == 'Rapat' ? 'selected' : '' }}>📋 Rapat</option>
                            <option value="Acara Adat" {{ old('kategori_sewa') == 'Acara Adat' ? 'selected' : '' }}>🎭 Acara Adat</option>
                            <option value="Konser" {{ old('kategori_sewa') == 'Konser' ? 'selected' : '' }}>🎵 Konser</option>
                            <option value="Pameran" {{ old('kategori_sewa') == 'Pameran' ? 'selected' : '' }}>🖼️ Pameran</option>
                            <option value="Lainnya" {{ old('kategori_sewa') == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                        </select>
                    </div>
                </div>

                <!-- ===== BAGIAN PESANGGRAHAN (DURASI 4 JAM) ===== -->
                <div id="pesanggrahan_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam" id="durasi_jam_pesanggrahan" class="form-control" min="4" step="4" value="{{ old('durasi_jam', 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam. Harga Rp300.000/4 jam.</small>
                        </div>
                    </div>
                </div>

                <!-- ===== BAGIAN PENDOPO (DURASI 4 JAM) ===== -->
                <div id="pendopo_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam" id="durasi_jam_pendopo" class="form-control" min="4" step="4" value="{{ old('durasi_jam', 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam</small>
                        </div>
                    </div>
                </div>

                <!-- ===== BAGIAN GAZEBO (DURASI 4 JAM) ===== -->
                <div id="gazebo_fields" class="field-hidden">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durasi Sewa (Jam) <span class="required">*</span></label>
                            <input type="number" name="durasi_jam" id="durasi_jam_gazebo" class="form-control" min="4" step="4" value="{{ old('durasi_jam', 4) }}">
                            <small style="color: #666; font-size: 12px;">Minimal 4 jam (1 sesi), kelipatan 4 jam</small>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH & HARGA -->
                <div class="form-row" id="default_durasi">
                    <div class="form-group">
                        <label>Jumlah Unit <span class="required">*</span></label>
                        <input type="number" name="jumlah_unit" id="jumlah_unit" value="{{ old('jumlah_unit', 1) }}" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa (per unit) <span class="required">*</span></label>
                        <input type="number" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa') }}" min="0" required readonly>
                        <div class="harga-info">💡 Harga otomatis muncul saat memilih fasilitas</div>
                    </div>
                </div>

                <!-- TANGGAL & JAM -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="required">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai <span class="required">*</span></label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', date('H:i')) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Selesai <span class="required">*</span></label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', date('Y-m-d', strtotime('+1 day'))) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai <span class="required">*</span></label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', date('H:i')) }}" required>
                    </div>
                </div>

                <!-- STATUS & TOTAL -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select name="status_pembayaran">
                            <option value="belum_bayar" {{ old('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="dp" {{ old('status_pembayaran') == 'dp' ? 'selected' : '' }}>DP</option>
                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Biaya</label>
                        <div id="total_biaya_display" class="total-display">Rp 0</div>
                        <input type="hidden" name="total_biaya" id="total_biaya_hidden" value="0">
                    </div>
                </div>

                <!-- KETERANGAN -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                </div>

                <!-- TOMBOL -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                    <a href="{{ route('sewa-fasilitas.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== DATA HARGA FASILITAS =====
            const hargaFasilitas = {
                'Pesanggrahan': 300000,
                'Rumah Banjar': 500000,
                'Pendopo': 500000,
                'Camp Ground Angsana': 500000,
                'Gazebo Besar': 100000,
                'Gazebo Kecil': 100000
            };

            // ===== FASILITAS BUKIT BATU =====
            const fasilitasBukitBatu = ['Gazebo Besar', 'Gazebo Kecil'];

            // ===== AMBIL ELEMEN =====
            const fasilitasSelect = document.getElementById('fasilitas');
            const hargaInput = document.getElementById('harga_sewa');
            const jumlahInput = document.getElementById('jumlah_unit');
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            const displayTotal = document.getElementById('total_biaya_display');
            const hiddenTotal = document.getElementById('total_biaya_hidden');
            
            // PERBAIKAN: Ambil elemen jam
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            
            const pesanggrahanFields = document.getElementById('pesanggrahan_fields');
            const pendopoFields = document.getElementById('pendopo_fields');
            const gazeboFields = document.getElementById('gazebo_fields');
            const durasiJamPesanggrahan = document.getElementById('durasi_jam_pesanggrahan');
            const durasiJamPendopo = document.getElementById('durasi_jam_pendopo');
            const durasiJamGazebo = document.getElementById('durasi_jam_gazebo');
            const defaultDurasi = document.getElementById('default_durasi');

            // ===== FUNGSI: TOGGLE TAMPILAN FIELD KHUSUS =====
            function toggleFields() {
                const fasilitas = fasilitasSelect.value;
                
                // Sembunyikan semua field khusus terlebih dahulu
                pesanggrahanFields.style.display = 'none';
                pesanggrahanFields.classList.add('field-hidden');
                pendopoFields.style.display = 'none';
                pendopoFields.classList.add('field-hidden');
                gazeboFields.style.display = 'none';
                gazeboFields.classList.add('field-hidden');
                defaultDurasi.style.display = 'grid';
                defaultDurasi.classList.remove('field-hidden');

                if (fasilitas === 'Pesanggrahan') {
                    pesanggrahanFields.style.display = 'block';
                    pesanggrahanFields.classList.remove('field-hidden');
                    defaultDurasi.style.display = 'none';
                    defaultDurasi.classList.add('field-hidden');
                } else if (fasilitas === 'Pendopo') {
                    pendopoFields.style.display = 'block';
                    pendopoFields.classList.remove('field-hidden');
                    defaultDurasi.style.display = 'none';
                    defaultDurasi.classList.add('field-hidden');
                } else if (fasilitasBukitBatu.includes(fasilitas)) {
                    gazeboFields.style.display = 'block';
                    gazeboFields.classList.remove('field-hidden');
                    defaultDurasi.style.display = 'none';
                    defaultDurasi.classList.add('field-hidden');
                }
            }

            // ===== FUNGSI: ISI HARGA OTOMATIS =====
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

            // ===== FUNGSI: HITUNG TOTAL BIAYA =====
            function hitungTotal() {
                const fasilitas = fasilitasSelect.value;
                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = parseInt(jumlahInput.value) || 1;
                let total = 0;

                // ===== PESANGGRAHAN (per 4 jam) =====
                if (fasilitas === 'Pesanggrahan') {
                    const durasi = parseInt(durasiJamPesanggrahan.value) || 4;
                    const jumlahSesi = Math.ceil(durasi / 4);
                    total = harga * jumlah * jumlahSesi;
                }
                // ===== PENDOPO (per 4 jam) =====
                else if (fasilitas === 'Pendopo') {
                    const durasi = parseInt(durasiJamPendopo.value) || 4;
                    const jumlahSesi = Math.ceil(durasi / 4);
                    total = harga * jumlah * jumlahSesi;
                }
                // ===== GAZEBO (per 4 jam) =====
                else if (fasilitasBukitBatu.includes(fasilitas)) {
                    const durasi = parseInt(durasiJamGazebo.value) || 4;
                    const jumlahSesi = Math.ceil(durasi / 4);
                    total = harga * jumlah * jumlahSesi;
                }
                // ===== FASILITAS LAIN (per hari, presisi berdasarkan jam) =====
                else {
                    // PERBAIKAN: Gunakan variabel jamMulai dan jamSelesai
                    const mulaiDate = new Date(tanggalMulai.value + 'T' + jamMulai.value);
                    const selesaiDate = new Date(tanggalSelesai.value + 'T' + jamSelesai.value);
                    
                    let hari = 0;
                    
                    // Pastikan tanggal valid
                    if (selesaiDate > mulaiDate) {
                        const diffMs = selesaiDate - mulaiDate; // Selisih dalam milidetik
                        const diffJam = diffMs / (1000 * 60 * 60); // Konversi ke jam
                        
                        // Jika kurang dari 24 jam, hitung 1 hari. Jika lebih, bulatkan ke atas berdasarkan jam.
                        if (diffJam < 24) {
                            hari = 1;
                        } else {
                            hari = Math.ceil(diffJam / 24);
                        }
                    } else {
                        // Jika waktu selesai sama atau lebih kecil dari mulai, minimal 1 hari
                        hari = 1;
                    }
                    
                    total = harga * jumlah * hari;
                }
                
                displayTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
                hiddenTotal.value = total;
            }

            // ===== EVENT LISTENER =====
            fasilitasSelect.addEventListener('change', function() {
                isiHargaOtomatis();
            });
            
            durasiJamPesanggrahan.addEventListener('input', hitungTotal);
            durasiJamPendopo.addEventListener('input', hitungTotal);
            durasiJamGazebo.addEventListener('input', hitungTotal);
            jumlahInput.addEventListener('input', hitungTotal);
            tanggalMulai.addEventListener('change', hitungTotal);
            tanggalSelesai.addEventListener('change', hitungTotal);
            
            // PERBAIKAN: Tambahkan event listener untuk jam
            jamMulai.addEventListener('change', hitungTotal);
            jamSelesai.addEventListener('change', hitungTotal);

            // ===== JALANKAN SAAT PERTAMA KALI LOAD =====
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