<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSTP JPN PERAK | Paparan Staff</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8f9fa;
            --primary-blue: #0d47a1;
            --secondary-blue: #1976d2;
            --border-color: #dee2e6;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Inter', sans-serif; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
        }

        .content-wrapper { flex: 1; }

        .navbar { 
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue)); 
            padding: 15px 0; 
        }

        .search-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .table-container {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table thead th {
            background-color: #e3f2fd !important;
            color: #0d47a1 !important;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            padding: 1.2rem 1rem !important;
        }

        .col-merged {
            background-color: #ffffff;
            vertical-align: middle !important;
            border-right: 1px solid #f1f3f5;
            padding: 1.5rem !important;
        }

        .sektor-name {
            font-size: 0.65rem;
            font-weight: 800;
            color: #6c757d;
            text-transform: uppercase;
            display: block;
        }

        .waran-badge {
            background: #f8f9fa;
            color: #1e293b;
            padding: 3px 8px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 0.8rem;
            border: 1px solid #dee2e6;
            display: inline-block;
            margin-top: 5px;
        }

        .label-staff {
            font-size: 0.6rem;
            font-weight: 800;
            color: #94a3b8;
            display: block;
            text-transform: uppercase;
            margin-bottom: 1px;
        }

        .value-objek {
            color: #0d47a1;
            font-weight: 700;
            font-size: 0.8rem;
            display: block;
            margin-bottom: 5px;
        }

        .value-prog {
            color: #4f46e5;
            font-weight: 700;
            font-size: 0.75rem;
            display: block;
            margin-bottom: 5px;
        }

        .vot-pill {
            background: #f1f5f9;
            color: #475569;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .belanja-list {
            text-align: left;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .belanja-item {
            background: #fdfdfd;
            border: 1px solid #edf2f7;
            border-radius: 5px;
            padding: 6px 10px;
            margin-bottom: 4px;
            font-size: 0.7rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .progress { height: 8px; border-radius: 10px; background-color: #e9ecef; }
        .bg-safe { background-color: #10b981 !important; }
        .bg-warning-custom { background-color: #f59e0b !important; }
        .bg-danger-custom { background-color: #ef4444 !important; }

        footer { background-color: #ffffff; border-top: 1px solid #dee2e6; color: #6c757d; padding: 20px 0; }
    </style>
</head>
<body>

<div class="content-wrapper">
    <nav class="navbar navbar-dark shadow-sm mb-4">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logo_sstp.jpeg') }}" alt="Logo SSTP" class="me-3 bg-white p-1" style="height: 45px; border-radius: 5px;">
                <span class="navbar-brand fw-bold mb-0 text-white">
                    SSTP JPN PERAK <span class="d-none d-sm-inline">| SEMAKAN WARAN</span>
                </span>
            </div>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm fw-bold rounded-pill px-3">
                <i class="fas fa-lock me-1"></i> LOGIN ADMIN
            </a>
        </div>
    </nav>

    <div class="container-fluid px-4">
        
        <div class="search-container">
            <div class="row g-3 align-items-end">
                <div class="col-md-7">
                    <form action="{{ url()->current() }}" method="GET">
                        <label class="small fw-bold text-muted mb-1 text-uppercase">Carian Melalui Objek</label>
                        <div class="d-flex gap-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" 
                                       placeholder="Masukkan No. Objek..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm px-4">
                                SEMAK
                            </button>
                            @if(request('search'))
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary" title="Kosongkan Carian">
                                    <i class="fas fa-undo"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-5 text-md-end">
                    <a href="{{ route('warans.export') }}" class="btn btn-success fw-bold shadow-sm px-4">
                        <i class="fas fa-file-excel me-2"></i> MUAT TURUN EXCEL
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-chart-line me-2"></i>Status Peruntukan Semasa
                    </h5>
                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                        <i class="far fa-calendar-alt me-1"></i> Data setakat: {{ date('d/m/Y') }}
                    </span>
                </div>
                
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table align-middle text-center mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Sektor & No. Waran</th>
                                    <th style="width: 25%">Tujuan / Nama Program</th>
                                    <th style="width: 15%">Maklumat Peruntukan</th>
                                    <th style="width: 20%">Butiran Perbelanjaan</th>
                                    <th style="width: 10%">Baki (RM)</th>
                                    <th style="width: 10%">% Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $groupedWarans = $warans->groupBy('no_waran'); @endphp

                                @forelse($groupedWarans as $noWaran => $rows)
                                    @foreach($rows as $index => $waran)
                                    <tr>
                                        @if($index === 0)
                                            <td rowspan="{{ count($rows) }}" class="col-merged">
                                                <span class="sektor-name">{{ $waran->sektor }}</span>
                                                <div class="waran-badge">{{ $waran->no_waran }}</div>
                                            </td>
                                            <td rowspan="{{ count($rows) }}" class="col-merged text-start px-4">
                                                <div class="fw-bold text-dark mb-1" style="font-size: 0.85rem; line-height: 1.3;">
                                                    {{ $waran->tujuan }}
                                                </div>
                                                <small class="text-muted" style="font-size: 0.65rem;">
                                                    <i class="fas fa-user-tie me-1"></i> Pegawai: {{ $waran->pegawai_meja ?? 'SSTP' }}
                                                </small>
                                            </td>
                                        @endif

                                        <td class="py-4 border-start text-start px-3">
                                            <span class="label-staff">OBJEK:</span>
                                            <span class="value-objek">{{ $waran->objek }}</span>

                                            <span class="label-staff">PROG/AKT:</span>
                                            <span class="value-prog">{{ $waran->program_aktiviti }}</span>

                                            <div class="vot-pill">VOT: {{ $waran->vot ?? '-' }}</div>
                                            <div class="text-muted mt-2" style="font-size: 0.6rem; font-weight: 600;">
                                                PERUNTUKAN: RM{{ number_format($waran->peruntukan, 2) }}
                                            </div>
                                        </td>

                                        <td class="px-3 border-start">
                                            <div class="belanja-list">
                                                @forelse($waran->perbelanjaans as $belanja)
                                                    <div class="belanja-item">
                                                        <span class="text-truncate" style="max-width: 150px;">
                                                            <i class="fas fa-caret-right text-primary me-1"></i>{{ $belanja->butiran }}
                                                        </span>
                                                        <span class="text-danger fw-bold">-{{ number_format($belanja->jumlah_keluar, 2) }}</span>
                                                    </div>
                                                @empty
                                                    <div class="text-center py-2">
                                                        <small class="text-muted opacity-50 italic" style="font-size: 0.65rem;">Tiada rekod belanja</small>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </td>

                                        <td class="border-start">
                                            <div class="fw-bold {{ $waran->baki <= 0 ? 'text-danger' : 'text-primary' }}" style="font-size: 0.9rem;">
                                                {{ number_format($waran->baki, 2) }}
                                            </div>
                                            <small class="text-muted" style="font-size: 0.6rem;">Semasa</small>
                                        </td>

                                        <td class="px-3 border-start">
                                            @php
                                                $peratus = ($waran->peruntukan > 0) ? ($waran->jum_belanja / $waran->peruntukan) * 100 : 0;
                                                $barColor = 'bg-safe';
                                                if($peratus > 70) $barColor = 'bg-warning-custom';
                                                if($peratus > 90) $barColor = 'bg-danger-custom';
                                            @endphp
                                            <div class="small fw-bold mb-1" style="font-size: 0.7rem;">{{ number_format($peratus, 1) }}%</div>
                                            <div class="progress shadow-sm">
                                                <div class="progress-bar {{ $barColor }}" role="progressbar" style="width: {{ $peratus }}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-5 text-muted text-center">
                                            <i class="fas fa-search fa-3x mb-3 opacity-25"></i>
                                            <p class="mb-0 fw-bold">Tiada maklumat waran dijumpai.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
     <div class="container text-center">
        <h6 class="fw-bold mb-1">WARAN PERUNTUKAN</h6>
        <p class="text-muted small mb-0">Sektor Sumber Teknologi Pendidikan (SSTP)</p>
        <p class="text-muted" style="font-size: 0.7rem;">JPN Perak &copy; {{ date('Y') }}</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>