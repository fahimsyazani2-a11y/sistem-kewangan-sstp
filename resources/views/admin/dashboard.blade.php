<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSTP JPN PERAK | Admin Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f4f7fa;
            --primary: #2563eb;
            --accent: #3b82f6;
            --purple: #6366f1;
            --dark: #0f172a;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .search-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            margin-top: -20px;
        }

        .table-container {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .table thead th {
            background-color: #f8fafc !important;
            color: #64748b !important;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 1.2rem !important;
            letter-spacing: 0.5px;
        }

        .col-merged {
            background-color: #ffffff;
            vertical-align: middle !important;
            border-right: 1px solid #f8fafc;
        }

        .sektor-tag {
            background: #eff6ff;
            color: #2563eb;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 10px;
            border: 1px solid #dbeafe;
        }

        .waran-text {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0;
        }

        .vot-tag {
            background: #f8fafc;
            color: #475569;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .objek-label {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--primary);
            display: block;
            margin-bottom: 2px;
        }

        .prog-label {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--purple);
            display: block;
            margin-bottom: 2px;
        }

        .label-mini {
            font-size: 0.6rem;
            font-weight: 800;
            color: #94a3b8;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fasa-box {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 12px;
            margin: 8px auto;
            max-width: 200px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        .baki-pill {
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pos { background: #dcfce7; color: #166534; }
        .status-neg { background: #fee2e2; color: #991b1b; }

        .btn-action {
            width: 36px; height: 36px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 10px; transition: all 0.2s;
            border: none; margin: 0 2px;
        }
        .btn-add { background: #2563eb; color: white; }
        .btn-edit { background: #f59e0b; color: white; }
        .btn-del { background: #ef4444; color: white; }
        .btn-action:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); color: white; }

        .belanja-item {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 0.75rem; background: #f8fafc;
            padding: 8px 12px; border-radius: 8px;
            margin-bottom: 6px; border: 1px solid #f1f5f9;
        }
        .belanja-action-link {
            color: #94a3b8; margin-left: 8px; transition: 0.2s;
            background: none; border: none; padding: 0;
        }
        .belanja-action-link:hover { color: #f59e0b; }
        .btn-delete-belanja:hover { color: #ef4444 !important; }

        footer {
            background: white; border-top: 1px solid var(--border-color);
            padding: 2rem 0; margin-top: auto;
        }
    </style>
</head>
<body>

<div class="admin-header">
    <div class="container-fluid d-flex justify-content-between align-items-center px-4">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo_sstp.jpeg') }}" height="50" class="me-3 rounded shadow-sm">
            <div>
                <h5 class="fw-bold mb-0">ADMIN DASHBOARD</h5>
                <small class="text-primary fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">SSTP JPN PERAK</small>
            </div>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('warans.export') }}" class="btn btn-outline-success btn-sm rounded-pill px-4 fw-bold">
                <i class="fas fa-file-excel me-2"></i> EXCEL
            </a>
            <a href="{{ route('warans.create') }}" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold shadow">
                <i class="fas fa-plus-circle me-2"></i> TAMBAH WARAN
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm rounded-pill px-4 fw-bold border">LOGOUT</button>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="search-card p-2">
                <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-0 shadow-none" 
                               placeholder="Cari No. Objek..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">CARI</button>
                </form>
            </div>
            
            @if(request('search'))
                <div class="mt-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-link text-decoration-none text-muted small fw-bold">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Senarai Penuh
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mt-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container mt-5">
        <div class="table-responsive">
            <table class="table align-middle mb-0 text-center">
                <thead>
                    <tr>
                        <th style="width: 15%">Sektor & No. Waran</th>
                        <th style="width: 20%">Butiran Program</th>
                        <th style="width: 18%">Maklumat Kewangan</th>
                        <th style="width: 12%">Baki Semasa</th>
                        <th style="width: 22%">Perbelanjaan</th>
                        <th style="width: 13%">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $groupedWarans = $warans->groupBy('no_waran'); @endphp

                    @forelse($groupedWarans as $noWaran => $rows)
                        @foreach($rows as $index => $waran)
                        <tr>
                            @if($index === 0)
                                <td rowspan="{{ count($rows) }}" class="col-merged px-4">
                                    <span class="sektor-tag">{{ $waran->sektor }}</span>
                                    <div class="waran-text">{{ $waran->no_waran }}</div>
                                    <div class="text-muted small mt-1">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $waran->tarikh_terima_waran ? \Carbon\Carbon::parse($waran->tarikh_terima_waran)->format('d/m/Y') : '-' }}
                                    </div>
                                </td>
                                <td rowspan="{{ count($rows) }}" class="col-merged text-start px-4">
                                    <div class="fw-bold text-dark mb-1" style="font-size: 0.85rem;">{{ $waran->tujuan }}</div>
                                    <div class="d-flex align-items-center gap-2" style="font-size: 0.7rem;">
                                        <i class="fas fa-user-circle text-primary"></i>
                                        <span class="fw-semibold text-muted">{{ $waran->pegawai_meja ?? 'SSTP' }}</span>
                                    </div>
                                </td>
                            @endif

                            <td class="py-4 border-start bg-white">
                                <div class="mb-2">
                                    <span class="label-mini">OBJEK:</span>
                                    <strong class="objek-label">{{ $waran->objek }}</strong>
                                </div>

                                <div class="mb-2">
                                    <span class="label-mini">PROG/AKT:</span>
                                    <strong class="prog-label">{{ $waran->program_aktiviti }}</strong>
                                </div>

                                <div class="vot-tag mb-2">VOT: {{ $waran->vot ?? '-' }}</div>
                                
                                <div class="fasa-box">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="text-muted fw-bold" style="font-size: 0.6rem;">AGIHAN</span>
                                        <span class="fw-bold">RM {{ number_format($waran->amaun_fasa, 2) }}</span>
                                    </div>
                                    <div style="border-top: 1px solid #f1f5f9; margin: 6px 0;"></div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-primary fw-bold" style="font-size: 0.6rem;">TOTAL</span>
                                        <span class="fw-bold text-primary">RM {{ number_format($waran->peruntukan, 2) }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="bg-white">
                                <div class="baki-pill {{ $waran->baki < 0 ? 'status-neg' : 'status-pos' }}">
                                    @if($waran->baki < 0) <i class="fas fa-exclamation-triangle"></i> @else <i class="fas fa-wallet"></i> @endif
                                    RM {{ number_format($waran->baki, 2) }}
                                </div>
                            </td>

                            <td class="px-3 text-start bg-white">
                                @forelse($waran->perbelanjaans as $belanja)
                                    <div class="belanja-item">
                                        <div class="text-truncate" style="max-width: 130px;">
                                            <i class="fas fa-tag text-muted me-1"></i>{{ $belanja->butiran }}
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="text-danger fw-bold">-{{ number_format($belanja->jumlah_keluar, 2) }}</span>
                                            
                                            <a href="{{ route('perbelanjaan.edit', $belanja->id) }}" class="belanja-action-link" title="Edit Belanja">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('perbelanjaan.destroy', $belanja->id) }}" method="POST" onsubmit="return confirm('Padam rekod belanja ini?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="belanja-action-link btn-delete-belanja" title="Padam Belanja">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-2 opacity-50 small italic">Tiada rekod belanja</div>
                                @endforelse
                            </td>

                            <td class="bg-white">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('perbelanjaan.create', ['waran_id' => $waran->id]) }}" class="btn-action btn-add" title="Tambah Belanja">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ route('warans.edit', $waran->id) }}" class="btn-action btn-edit" title="Edit Waran">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('warans.destroy', $waran->id) }}" method="POST" onsubmit="return confirm('Padam rekod waran ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-del" title="Padam Waran"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-muted">
                                <p class="fw-bold">Tiada data dijumpai.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

</body>
</html>