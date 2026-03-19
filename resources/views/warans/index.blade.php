<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kewangan SSTP | Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .table { font-size: 0.8rem; vertical-align: middle; }
        
        thead th { 
            background-color: #0d47a1 !important; 
            color: #ffffff !important; 
            text-transform: uppercase;
            font-weight: 600;
            padding: 12px 8px !important;
            border: 1px solid #0a3d8d !important;
        }

        .table-hover tbody tr:hover { background-color: #e3f2fd; transition: 0.2s; }

        .catatan-list { text-align: left; padding-left: 15px; margin-bottom: 0; list-style-type: decimal; }
        .catatan-item { margin-bottom: 6px; border-bottom: 1px solid #eee; padding-bottom: 4px; }
        .catatan-item:last-child { border-bottom: none; }

        .baki-bahaya { background-color: #ffebee !important; color: #d32f2f !important; font-weight: bold; }
        .text-baki-merah { color: #d32f2f; font-weight: bold; }
        
        .btn-belanja { 
            background-color: #ef5350; 
            color: white; 
            font-weight: bold; 
            border: none;
            padding: 4px 10px;
            font-size: 0.75rem;
            border-radius: 4px;
        }
        .btn-belanja:hover { background-color: #c62828; color: white; transform: translateY(-1px); }
        
        .card { border-radius: 12px; overflow: hidden; }
        .bg-header-custom { background: linear-gradient(90deg, #1565c0, #1976d2); color: white; padding: 20px; border-radius: 12px; }
        .date-badge { font-size: 0.65rem; background-color: #e3f2fd; color: #0d47a1; padding: 2px 6px; border-radius: 4px; border: 1px solid #bbdefb; }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <div class="bg-header-custom shadow-sm mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0"><i class="fas fa-university me-2"></i>SSTP JPN PERAK</h2>
            <p class="mb-0 opacity-75 small">Sistem Pengurusan Kewangan, Waran & Perbelanjaan</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('warans.export') }}" class="btn btn-success fw-bold shadow-sm px-3">
                <i class="fas fa-file-excel me-1"></i> EXPORT EXCEL
            </a>
            <a href="{{ route('warans.create') }}" class="btn btn-light fw-bold shadow-sm px-3">
                <i class="fas fa-plus-circle me-1 text-success"></i> TAMBAH WARAN BARU
            </a>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">SEKTOR</th>
                            <th style="width: 10%">NO. WARAN / TERIMA</th>
                            <th style="width: 15%">TUJUAN</th>
                            <th style="width: 6%">PROG/ AKTIVITI</th>
                            <th style="width: 5%">OBJEK</th>
                            <th style="width: 9%">PERUNTUKAN (RM)</th>
                            <th style="width: 9%">JUM. BELANJA (RM)</th>
                            <th style="width: 9%">BAKI (RM)</th>
                            <th style="width: 4%">%</th>
                            <th style="width: 20%">CATATAN PERBELANJAAN</th>
                            <th style="width: 8%">PEGAWAI MEJA</th>
                            <th style="width: 5%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warans as $waran)
                        <tr>
                            <td class="small fw-bold text-secondary">{{ $waran->sektor }}</td>
                            
                            <td class="fw-bold">
                                <span class="text-dark d-block mb-1">{{ $waran->no_waran }}</span>
                                <span class="date-badge">
                                    <i class="far fa-calendar-check me-1"></i>
                                    {{ $waran->tarikh_terima_waran ? $waran->tarikh_terima_waran->format('d/m/Y') : 'Tiada Tarikh' }}
                                </span>
                            </td>

                            <td class="text-start small" style="line-height: 1.4;">{{ $waran->tujuan }}</td>
                            <td class="text-primary fw-bold">{{ $waran->program_aktiviti }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $waran->objek }}</span></td>
                            <td class="fw-bold text-dark">{{ number_format($waran->peruntukan, 2) }}</td>
                            <td class="text-primary">{{ number_format($waran->jum_belanja, 2) }}</td>
                            
                            <td class="{{ $waran->baki < 0 ? 'baki-bahaya' : 'text-baki-merah' }}">
                                RM {{ number_format($waran->baki, 2) }}
                                @if($waran->baki < 0)
                                    <br><span class="badge bg-danger p-1" style="font-size: 0.6rem;">BAKI TIDAK CUKUP!</span>
                                @endif
                            </td>
                            
                            <td class="small fw-bold {{ ($waran->peruntukan > 0 && ($waran->jum_belanja / $waran->peruntukan) > 0.9) ? 'text-danger' : '' }}">
                                {{ number_format($waran->peratus, 2) }}%
                            </td>

                            <td class="text-start bg-light-50">
                                @if($waran->perbelanjaans->isNotEmpty())
                                    <ol class="catatan-list small">
                                        @foreach($waran->perbelanjaans as $belanja)
                                            <li class="catatan-item">
                                                <div class="fw-bold text-dark">{{ $belanja->butiran }}</div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-danger fw-bold">- RM{{ number_format($belanja->jumlah_keluar, 2) }}</span>
                                                    <span class="text-muted italic" style="font-size: 0.7rem;">
                                                        {{ \Carbon\Carbon::parse($belanja->tarikh_belanja)->format('d/m/y') }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="text-center py-2">
                                        <span class="badge bg-secondary opacity-50 fw-normal" style="font-size: 0.65rem;">Tiada Rekod Belanja</span>
                                    </div>
                                @endif
                            </td>

                            <td class="small fw-bold">{{ $waran->pegawai_meja }}</td>
                            
                            <td>
                                <a href="{{ route('perbelanjaan.create', $waran->id) }}" class="btn btn-belanja shadow-sm">
                                    <i class="fas fa-minus-circle me-1"></i> BELANJA
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                                <span class="text-muted">Tiada data waran dijumpai. Sila tambah waran baru.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>