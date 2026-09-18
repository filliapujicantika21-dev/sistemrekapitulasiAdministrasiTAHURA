<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking Glamping - Tahura</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4f8; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px; }
        .card-header h1 { color: #5d3a1a; font-size: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { border-color: #5d3a1a; outline: none; }
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
                <h1>⛺ Tambah Booking Glamping</h1>
                <a href="{{ route('glamping.index') }}" class="btn btn-secondary">← Kembali</a>
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

            <form action="{{ route('glamping.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Kode Booking</label>
                    <input type="text" name="kode_booking" value="{{ $kode_booking }}" readonly>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Tamu *</label>
                        <input type="text" name="nama_tamu" value="{{ old('nama_tamu') }}" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon *</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nomor Identitas *</label>
                        <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tipe Tenda *</label>
                        <select name="tipe_tenda" id="tipe_tenda" required>
                            <option value="">Pilih</option>
                            <option value="Standar" {{ old('tipe_tenda') == 'Standar' ? 'selected' : '' }}>Standar (Rp 500.000)</option>
                            <option value="Deluxe" {{ old('tipe_tenda') == 'Deluxe' ? 'selected' : '' }}>Deluxe (Rp 750.000)</option>
                            <option value="Family" {{ old('tipe_tenda') == 'Family' ? 'selected' : '' }}>Family (Rp 1.000.000)</option>
                            <option value="VIP" {{ old('tipe_tenda') == 'VIP' ? 'selected' : '' }}>VIP (Rp 1.500.000)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Tenda *</label>
                        <input type="number" name="jumlah_tenda" id="jumlah_tenda" value="{{ old('jumlah_tenda', 1) }}" min="1" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jumlah Orang *</label>
                        <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', 2) }}" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Harga / Malam</label>
                        <input type="number" name="harga_per_malam" id="harga_per_malam" value="{{ old('harga_per_malam') }}" min="0" readonly style="background:#f8f9fa;">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Check-in *</label>
                        <input type="date" name="tanggal_checkin" id="tanggal_checkin" value="{{ old('tanggal_checkin', date('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Check-out *</label>
                        <input type="date" name="tanggal_checkout" id="tanggal_checkout" value="{{ old('tanggal_checkout', date('Y-m-d', strtotime('+1 day'))) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Fasilitas Tambahan</label>
                        <select name="fasilitas_tambahan">
                            <option value="">Tidak Ada</option>
                            <option value="Campfire" {{ old('fasilitas_tambahan') == 'Campfire' ? 'selected' : '' }}>Campfire (+Rp 150.000)</option>
                            <option value="BBQ Set" {{ old('fasilitas_tambahan') == 'BBQ Set' ? 'selected' : '' }}>BBQ Set (+Rp 200.000)</option>
                            <option value="Snorkeling Gear" {{ old('fasilitas_tambahan') == 'Snorkeling Gear' ? 'selected' : '' }}>Snorkeling Gear (+Rp 100.000)</option>
                            <option value="Tour Guide" {{ old('fasilitas_tambahan') == 'Tour Guide' ? 'selected' : '' }}>Tour Guide (+Rp 250.000)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select name="status_pembayaran">
                            <option value="belum_bayar" {{ old('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="dp" {{ old('status_pembayaran') == 'dp' ? 'selected' : '' }}>DP</option>
                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Total Harga</label>
                    <input type="text" id="total_harga_display" value="Rp 0" readonly style="background:#f8f9fa; font-weight:bold; font-size:16px;">
                    <input type="hidden" name="total_harga" id="total_harga_hidden" value="0">
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" rows="3">{{ old('catatan') }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                    <a href="{{ route('glamping.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeTenda = document.getElementById('tipe_tenda');
            const hargaPerMalam = document.getElementById('harga_per_malam');
            const jumlahTenda = document.getElementById('jumlah_tenda');
            const checkinInput = document.getElementById('tanggal_checkin');
            const checkoutInput = document.getElementById('tanggal_checkout');
            const displayTotal = document.getElementById('total_harga_display');
            const hiddenTotal = document.getElementById('total_harga_hidden');

            const hargaTenda = {
                'Standar': 500000,
                'Deluxe': 750000,
                'Family': 1000000,
                'VIP': 1500000
            };

            function hitungTotal() {
                const tipe = tipeTenda.value;
                const harga = hargaTenda[tipe] || 0;
                hargaPerMalam.value = harga;

                const jumlah = parseInt(jumlahTenda.value) || 1;
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);

                let total = 0;
                if (checkin && checkout && checkout > checkin) {
                    const diffTime = Math.abs(checkout - checkin);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    total = (harga * diffDays) * jumlah;
                }

                displayTotal.value = 'Rp ' + total.toLocaleString('id-ID');
                hiddenTotal.value = total;
            }

            tipeTenda.addEventListener('change', hitungTotal);
            jumlahTenda.addEventListener('input', hitungTotal);
            checkinInput.addEventListener('change', hitungTotal);
            checkoutInput.addEventListener('change', hitungTotal);
            hitungTotal();
        });
    </script>
</body>
</html>