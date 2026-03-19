<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSTP JPN PERAK | Edit Perbelanjaan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f4f7fa;
            --primary: #2563eb;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #334155;
        }

        .edit-card {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-top: 2rem;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            border-color: var(--primary);
        }

        .btn-update {
            background: var(--primary);
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            border: none;
            transition: all 0.2s;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            color: white;
        }

        .info-box {
            background: #eff6ff;
            border-radius: 15px;
            padding: 1rem;
            border: 1px solid #dbeafe;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted fw-bold small">
                    <i class="fas fa-arrow-left me-1"></i> KEMBALI KE DASHBOARD
                </a>
            </div>

            <div class="edit-card">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Kemaskini Belanja</h4>
                        <small class="text-muted">SSTP JPN PERAK</small>
                    </div>
                </div>

                <div class="info-box">
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="text-muted d-block small-text">NO. WARAN</small>
                            <span class="fw-bold">{{ $waran->no_waran }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block small-text">NO. OBJEK</small>
                            <span class="fw-bold text-primary">{{ $waran->objek }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('perbelanjaan.update', $belanja->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tarikh Belanja</label>
                        <input type="date" name="tarikh_belanja" class="form-control" value="{{ $belanja->tarikh_belanja }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Butiran Perbelanjaan</label>
                        <input type="text" name="butiran" class="form-control" placeholder="Masukkan butiran..." value="{{ $belanja->butiran }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Amaun (RM)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">RM</span>
                            <input type="number" name="jumlah_keluar" step="0.01" class="form-control border-start-0" 
                                   value="{{ $belanja->jumlah_keluar }}" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-update w-100">
                        <i class="fas fa-save me-2"></i> KEMASKINI REKOD
                    </button>
                </form>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small">Sistem akan mengira semula baki objek secara automatik.</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>