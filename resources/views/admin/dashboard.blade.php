<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSTP JPN PERAK | Admin Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8fafc;
            --primary: #2563eb;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            font-size: 0.85rem; 
            color: #475569;
        }

        .container-fluid { padding: 0 40px !important; }

        .admin-header {
            background: white;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .btn-custom {
            font-weight: 700;
            font-size: 0.75rem;
            border-radius: 20px;
            padding: 8px 20px;
            text-transform: uppercase;
        }

        .search-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            max-width: 650px;
            margin: 0 auto 30px auto;
            display: flex;
            align-items: center;
            padding: 4px 6px 4px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .search-card input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.9rem;
            background: transparent;
        }

        .btn-cari {
            background: #1e293b;
            color: white;
            border-radius: 25px;
            padding: 7px 35px;
            font-weight: 800;
            border: none;
        }

        .table-container {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .table thead th {
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 15px !important;
            border: none;
        }

        .sektor-tag {
            background: #eff6ff;
            color: #3b82f6;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 10px;
            border: 1px solid #dbeafe;
        }

        .waran-text {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .label-mini {
            font-size: 0.55rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            display: block;
        }

        .val-blue { color: #3b82f6; font-weight: 700; font-size: 0.85rem; }
        .val-purple { color: #6366f1; font-weight: 700; font-size: 0.85rem; }

        .fasa-box {
            border: 1px solid #f1f5f9;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
            margin-top: 10px;
            max-width: 180px;
            margin-left: auto;
            margin-right: auto;
        }

        .baki-pill {
            background: var(--success-bg);
            color: var(--success-text);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white !important;
            text-decoration: none;
            font-size: 0.8rem;
            border: none;
            margin: 0 2px;
        }

        .btn-add { background: #3b82f6; }
        .btn-edit { background: #f59e0b; }
        .btn-delete { background: #ef4444; }

        .belanja-item {
            font-size: 0.75rem;
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 6px;
            border: 1px solid #f1f5f9;
            transition: all 0.2s;
        }
        
        .belanja-item:hover {
            border-color: #cbd5e1;
            background: #f1f5f9;
        }

        .td-merged {
            vertical-align: middle !important;
            border-right: 1px solid var(--border-color) !important;
        }

        .btn-mini-action {
            padding: 2px 5px;
            font-size: 0.7rem;
            border-radius: 4px;
            text-decoration: none;
            background: transparent;
            border: none;
        }
    </style>
</head>
<body>

<div class="admin-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo_sstp.jpeg') }}" height="45">
            <div>
                <h5 class="fw-800 mb-0">ADMIN DASHBOARD</h5>
                <span class="text-primary fw-bold" style="font-size: 0.7rem;">SSTP JPN PERAK</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('warans.export') }}" class="btn btn-outline-success btn-custom"><i class="fas fa-file-excel me-1"></i> Excel</a>
            <a href="{{ route('warans.create') }}" class="btn btn-primary btn-custom shadow-sm"><i class="fas fa-plus me-1"></i> Tambah Waran</a>
            <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-light btn-custom border">Logout</button></form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="search-card">
        <i class="fas fa-search text-muted me-2"></i>
        <input type="text" id="liveSearchInput" placeholder="Cari No. Objek atau Program Aktiviti...">
        <button class="btn-cari">CARI</button>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="table-container">
        <table class="table align-middle mb-0 text-center">
            <thead>
                <tr>
                    <th style="width: 15%">Sektor & No. Waran</th>
                    <th style="width: 20%">Butiran Program</th>
                    <th style="width: 20%">Maklumat Kewangan</th>
                    <th style="width: 15%">Baki Semasa</th>
                    <th style="width: 20%">Perbelanjaan (Item)</th>
                    <th style="width: 10%">Tindakan Waran</th>
                </tr>
            </thead>
            <tbody id="waranTableBody">
                @php
                    $groupedWarans = $warans->groupBy(function($item) {
                        return $item->no_waran . '___' . $item->tujuan;
                    });
                @endphp

                @forelse($groupedWarans as $key => $items)
                    @foreach($items as $index => $waran)
                        @php
                            $bakiSemasa = (float)$waran->peruntukan - $waran->perbelanjaans->sum('jumlah_keluar');
                        @endphp
                        
                        <tr class="waran-row">
                            @if($index === 0)
                                <td class="bg-white border-bottom py-4 td-merged" rowspan="{{ count($items) }}">
                                    <span class="sektor-tag">SSTP JPN PERAK</span>
                                    <div class="waran-text">{{ $waran->no_waran }}</div>
                                    <div class="small text-muted fw-bold">
                                        <i class="far fa-calendar me-1"></i> {{ $waran->created_at->format('d/m/Y') }}
                                    </div>
                                </td>

                                <td class="bg-white border-bottom text-start px-4 td-merged" rowspan="{{ count($items) }}">
                                    <div class="fw-bold text-dark mb-2" style="line-height: 1.4;">{{ $waran->tujuan }}</div>
                                    <div class="text-primary fw-bold small">
                                        <i class="fas fa-user-circle me-1"></i> {{ $waran->pegawai_meja ?? 'ADMIN' }}
                                    </div>
                                </td>
                            @endif

                            <td class="bg-white border-bottom py-3">
                                <div class="mb-2">
                                    <span class="label-mini">OBJEK:</span>
                                    <span class="val-blue search-target-objek">{{ $waran->objek }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="label-mini">PROG/AKT:</span>
                                    <span class="val-purple search-target-prog">{{ $waran->program_aktiviti }}</span>
                                </div>
                                <div class="badge bg-light text-dark border fw-bold mb-2" style="font-size: 0.65rem;">VOT: {{ $waran->vot ?? 'B63' }}</div>
                                
                                <div class="fasa-box text-start">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="label-mini">AGIHAN</span>
                                        <span class="fw-bold">RM {{ number_format($waran->amaun_fasa, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-top pt-1">
                                        <span class="label-mini text-primary">TOTAL</span>
                                        <span class="fw-bold text-primary">RM {{ number_format($waran->peruntukan, 2) }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="bg-white border-bottom">
                                <div class="baki-pill {{ $bakiSemasa < 0 ? 'bg-danger text-white' : '' }}">
                                    <i class="fas fa-wallet"></i> RM {{ number_format($bakiSemasa, 2) }}
                                </div>
                            </td>

                            <td class="bg-white border-bottom px-3 text-start">
                                @forelse($waran->perbelanjaans as $belanja)
                                    <div class="belanja-item d-flex justify-content-between align-items-center">
                                        <div style="flex: 1;">
                                            <span class="fw-bold d-block text-dark">{{ $belanja->butiran }}</span>
                                            <span class="text-danger fw-bold" style="font-size: 0.7rem;">-RM {{ number_format($belanja->jumlah_keluar, 2) }}</span>
                                        </div>
                                        
                                        <div class="d-flex gap-1 ms-2">
                                            <a href="{{ route('perbelanjaan.edit', $belanja->id) }}" class="btn-mini-action text-warning" title="Edit Belanja">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            
                                            <form action="{{ route('perbelanjaan.destroy', $belanja->id) }}" method="POST" onsubmit="return confirm('Hapus rekod belanja ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-mini-action text-danger" title="Padam Belanja">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <span class="text-muted small italic">Tiada rekod belanja</span>
                                @endforelse
                            </td>

                            <td class="bg-white border-bottom">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('perbelanjaan.create', ['waran_id' => $waran->id]) }}" class="btn-action btn-add" title="Tambah Belanja"><i class="fas fa-plus"></i></a>
                                    <a href="{{ route('warans.edit', $waran->id) }}" class="btn-action btn-edit" title="Edit Waran"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('warans.destroy', $waran->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn-action btn-delete" onclick="return confirm('Hapus rekod waran ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr><td colspan="6" class="py-5 text-muted">Data tidak dijumpai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('liveSearchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('.waran-row');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchValue) ? "" : "none";
        });
    });
</script>

</body>
</html>