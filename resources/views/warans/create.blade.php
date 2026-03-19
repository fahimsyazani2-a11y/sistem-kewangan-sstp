<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Waran Berkelompok | SSTP JPN Perak</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Inter', sans-serif; 
            color: #1e293b;
            letter-spacing: -0.01em;
        }

        .card { 
            border: 1px solid var(--border-color); 
            border-radius: 16px; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .card-header { 
            background: #ffffff; 
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 16px 16px 0 0 !important;
        }

        .section-title { 
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border-color);
            margin-left: 1rem;
        }

        .form-label { font-weight: 600; font-size: 0.85rem; color: #475569; }
        
        .form-control { 
            border-radius: 10px; 
            padding: 0.6rem 1rem; 
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .table thead th {
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 12px !important;
        }

        .btn-primary { 
            background-color: var(--primary); 
            border: none; 
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
        }

        .btn-primary:hover { background-color: var(--primary-hover); }

        .btn-success-soft {
            background-color: #dcfce7;
            color: #15803d;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 8px 16px;
        }

        .btn-danger-soft {
            background-color: #fee2e2;
            color: #b91c1c;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
        }

        .bg-readonly { background-color: #f1f5f9 !important; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="col-xl-11 mx-auto">
        <div class="card border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-layer-group me-2 text-primary"></i>Daftar Waran Baru
                </h5>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm fw-bold border">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>
            
            <div class="card-body p-4 p-lg-5">
                <form action="{{ route('warans.store') }}" method="POST">
                    @csrf
                    
                    <div class="section-title">Maklumat Waran </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Sektor</label>
                            <input type="text" name="sektor" class="form-control bg-readonly" value="SEKTOR SUMBER TEKNOLOGI PENDIDIKAN" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pegawai Meja Utama</label>
                            <input type="text" name="pegawai_meja" class="form-control" placeholder="Masukkan Nama Pegawai Meja" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Waran </label>
                            <input type="text" name="no_waran_induk" class="form-control" placeholder="Contoh: 91000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tarikh Terima Waran</label>
                            <input type="date" name="tarikh_terima_waran" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tujuan / Keterangan Belanja</label>
                            <textarea name="tujuan" class="form-control" rows="3" placeholder="Masukkan tujuan utama peruntukan ini..." required></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="section-title mb-0">Pecahan Program / Objek</div>
                        <button type="button" id="addRow" class="btn btn-success-soft">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Pecahan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle border" id="pecahanTable">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 130px;">Vot</th> <th>Program / Aktiviti </th>
                                    <th style="width: 120px;">Objek</th>
                                    <th style="width: 180px;">Peruntukan (RM)</th>
                                    <th style="width: 80px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="waranWrapper">
                                <tr>
                                    <td><input type="text" name="vot[]" class="form-control text-center fw-bold border-primary" placeholder="B63"></td>
                                    <td><input type="text" name="program_aktiviti[]" class="form-control" placeholder="Contoh: 123456" required></td>
                                    <td><input type="text" name="objek[]" class="form-control text-center" placeholder="42000" required></td>
                                    <td><input type="number" step="0.01" name="peruntukan[]" class="form-control text-end fw-bold" placeholder="0.00" required></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-light btn-sm text-muted" disabled><i class="fas fa-lock"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 shadow">
                            <i class="fas fa-save me-2"></i>Simpan Rekod Waran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk tambah baris baru
    document.getElementById('addRow').addEventListener('click', function() {
        const wrapper = document.getElementById('waranWrapper');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="vot[]" class="form-control text-center fw-bold border-primary" placeholder="Vot"></td>
            <td><input type="text" name="program_aktiviti[]" class="form-control" placeholder="Nama program spesifik" required></td>
            <td><input type="text" name="objek[]" class="form-control text-center" placeholder="42000" required></td>
            <td><input type="number" step="0.01" name="peruntukan[]" class="form-control text-end fw-bold" placeholder="0.00" required></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger-soft remove-row">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;
        wrapper.appendChild(newRow);

        // Tambah listener untuk butang delete pada baris baru
        newRow.querySelector('.remove-row').addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>
</body>
</html>