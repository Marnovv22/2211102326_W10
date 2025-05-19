<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Marchell</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #1b1b1b;
            color: #ffffff;
        }
        .center-button {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .add-button {
            padding: 10px 30px;
            font-size: 18px;
        }
        .table-container {
            background-color: #5a5f68;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .modal-content {
            background-color: #5a5f68;
            color: #ffffff;
        }
        .form-control {
            background-color: #f8f9fa;
            color: #000;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .table {
            background-color: #2d2d2d;
            color: #ffffff;
        }
        h2, h5 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Laundry</h2>
    <h5>Marchell Nova Aura - 2211102326</h5>

    <div class="container mt-4">
      <div class="center-button">
        <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#formModal">
            Tambah Transaksi
        </button>
    </div>


        <div class="table-container">
            <h5 class="mb-3">Daftar Transaksi</h5>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laundries as $l)
                        <tr>
                            <td>{{ $l->nama_pelanggan }}</td>
                            <td>{{ $l->jenis_layanan }}</td>
                            <td>{{ $l->berat }} kg</td>
                            <td>Rp {{ number_format($l->harga) }}</td>
                            <td>{{ \Carbon\Carbon::parse($l->tanggal_transaksi)->format('d-m-Y') }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" 
                                        onclick="editData('{{ $l->id }}', '{{ $l->nama_pelanggan }}', '{{ $l->jenis_layanan }}', '{{ $l->berat }}', '{{ $l->tanggal_transaksi }}')">
                                    Edit
                                </button>
                                <a href="/delete/{{ $l->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Data Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="laundryForm" method="POST" action="/store">
                        @csrf
                        <input type="hidden" id="formAction" name="formAction" value="store">
                        <input type="hidden" id="laundryId" name="laundryId" value="">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Layanan</label>
                            <select id="jenis_layanan" name="jenis_layanan" class="form-control" required>
                                <option value="">Pilih Layanan</option>
                                <option value="Cuci Kering">Cuci Kering</option>
                                <option value="Cuci Basah">Cuci Basah</option>
                                <option value="Setrika">Setrika</option>
                                <option value="Cuci + Setrika">Cuci + Setrika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Berat (kg)</label>
                            <input type="number" id="berat" name="berat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editData(id, nama, jenis, berat, tanggal) {
            // Ubah action form
            document.getElementById('laundryForm').action = '/update/' + id;
            document.getElementById('formAction').value = 'update';
            document.getElementById('laundryId').value = id;
            
            // Isi form dengan data
            document.getElementById('nama_pelanggan').value = nama;
            document.getElementById('jenis_layanan').value = jenis;
            document.getElementById('berat').value = berat;
            document.getElementById('tanggal_transaksi').value = tanggal;
            
            // Ubah judul modal
            document.getElementById('formModalLabel').innerText = 'Edit Data Transaksi';
            
            // Tampilkan modal
            var modal = new bootstrap.Modal(document.getElementById('formModal'));
            modal.show();
        }
        
        // Reset form ketika modal ditutup
        document.getElementById('formModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('laundryForm').reset();
            document.getElementById('laundryForm').action = '/store';
            document.getElementById('formAction').value = 'store';
            document.getElementById('formModalLabel').innerText = 'Data Transaksi';
        });
    </script>

</body>
</html>