<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekod Perbelanjaan | SSTP JPN Perak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .card-header { background: linear-gradient(45deg, #d32f2f, #ef5350); color: white; border-radius: 12px 12px 0 0 !important; }
        .info-box { background-color: #fff3f3; border-left: 5px solid #d32f2f; padding: 15px; border-radius: 8px; }
        .baki-card { background-color: #ffffff; border: 2px solid #dee2e6; border-radius: 10px; padding: 15px; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold text-uppercase"><i class="fas fa-money-bill-wave me-2"></i>REKOD PERBELANJAAN BARU</h5>
                </div>
                <div class="card-body p-4">
                    
                    <div class="info-box mb-4">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted d-block">No. Waran:</small>
                                <strong>{{ $waran->no_waran }}</strong>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted d-block">Objek / Program:</small>
                                <span class="badge bg-danger">OBJ {{ $waran->objek }}</span>
                                <span class="badge bg-dark">{{ $waran->program_aktiviti }}</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-1 small text-muted text-uppercase fw-bold">Tujuan:</p>
                        <p class="mb-0"><strong>{{ $waran->tujuan }}</strong></p>
                    </div>

                    <div class="baki-card text-center mb-4">
                        <small class="text-muted text-uppercase">Baki Semasa untuk Objek Ini</small>
                        <h2 class="{{ $waran->baki < 0 ? 'text-danger' : 'text-primary' }} fw-bold mb-0">
                            RM {{ number_format($waran->baki, 2) }}
                        </h2>
                    </div>

                    <form action="{{ route('perbelanjaan.store') }}" method="POST" id="belanjaForm">
                        @csrf
                        <input type="hidden" name="waran_id" value="{{ $waran->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Butiran Perbelanjaan (Catatan)</label>
                            <input type="text" name="butiran" class="form-control" placeholder="Contoh: Bengkel Keselamatan" required>
                            <small class="text-muted">Masukkan butiran ringkas untuk rujukan laporan.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jumlah Keluar (RM)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold">RM</span>
                                    <input type="number" step="0.01" min="0.01" name="jumlah_keluar" id="jumlah_keluar" class="form-control form-control-lg text-danger fw-bold" placeholder="0.00" required>
                                </div>
                                <div id="warning-baki" class="text-danger small mt-1 d-none font-italic">
                                    ⚠️ Perhatian: Jumlah belanja melebihi baki semasa!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tarikh Belanja</label>
                                <input type="date" name="tarikh_belanja" class="form-control form-control-lg" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 border-top pt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 fw-bold">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            
                            <button type="submit" class="btn btn-danger px-4 fw-bold shadow-sm" id="btnSimpan">
                                <i class="fas fa-save me-1"></i> Simpan & Tolak Baki
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const inputBelanja = document.getElementById('jumlah_keluar');
    const warningBaki = document.getElementById('warning-baki');
    const bakiSemasa = {{ $waran->baki }};
    const form = document.getElementById('belanjaForm');

    inputBelanja.addEventListener('input', function() {
        if (parseFloat(this.value) > bakiSemasa) {
            warningBaki.classList.remove('d-none');
            this.classList.add('is-invalid');
        } else {
            warningBaki.classList.add('d-none');
            this.classList.remove('is-invalid');
        }
    });

    form.addEventListener('submit', function(e) {
        const confirmCheck = confirm('Adakah anda pasti untuk menolak baki waran ini?');
        if (!confirmCheck) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>