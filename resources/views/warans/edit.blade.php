<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Waran | SSTP JPN Perak</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --bg-body: #f8fafc;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Inter', sans-serif; 
            color: #1e293b;
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

        .btn-primary { 
            background-color: var(--primary); 
            border: none; 
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2 text-warning"></i>KEMASKINI MAKLUMAT WARAN</h5>
            </div>
            <div class="card-body p-4 p-lg-5">
                
                <form action="{{ route('warans.update', $waran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="section-title">Maklumat Utama</div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Sektor</label>
                            <input type="text" name="sektor" class="form-control" value="{{ $waran->sektor }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Waran</label>
                            <input type="text" name="no_waran" class="form-control" value="{{ $waran->no_waran }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pegawai Meja</label>
                            <input type="text" name="pegawai_meja" class="form-control" value="{{ $waran->pegawai_meja }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tujuan / Nama Program (Induk)</label>
                            <textarea name="tujuan" class="form-control" rows="2" required>{{ $waran->tujuan }}</textarea>
                        </div>
                    </div>

                    <div class="section-title">Perincian Pecahan</div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Program / Aktiviti</label>
                            <input type="text" name="program_aktiviti" class="form-control" value="{{ $waran->program_aktiviti }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kod Objek</label>
                            <input type="text" name="objek" class="form-control" value="{{ $waran->objek }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tarikh Terima Waran</label>
                            <input type="date" name="tarikh_terima_waran" class="form-control" value="{{ $waran->tarikh_terima_waran->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Peruntukan (RM)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">RM</span>
                                <input type="number" step="0.01" name="peruntukan" class="form-control fw-bold text-primary" value="{{ $waran->peruntukan }}" required>
                            </div>
                            <small class="text-muted mt-2 d-block small">Nota: Baki akan dikira semula secara automatik berdasarkan jumlah belanja sedia ada.</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4 mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light px-4 fw-bold border">BATAL</a>
                        <button type="submit" class="btn btn-primary shadow">
                            <i class="fas fa-save me-2"></i>KEMASKINI DATA
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>