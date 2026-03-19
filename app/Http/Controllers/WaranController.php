<?php

namespace App\Http\Controllers;

use App\Models\Waran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WaransExport;
use Illuminate\Support\Facades\DB;

class WaranController extends Controller
{
    /**
     * DASHBOARD ADMIN
     */
    public function adminDashboard(Request $request)
    {
        $query = Waran::with('perbelanjaans')->tersusun();

        // HANYA CARI GUNA NO. OBJEK
        if ($request->has('search') && $request->search != '') {
            $query->where('objek', 'LIKE', '%' . $request->search . '%');
        }

        $warans = $query->get();
            
        return view('admin.dashboard', compact('warans'));
    }

    /**
     * PAPARAN STAFF (GUEST VIEW)
     */
    public function index(Request $request)
    {
        $query = Waran::with('perbelanjaans')->tersusun();

        // HANYA CARI GUNA NO. OBJEK
        if ($request->has('search') && $request->search != '') {
            $query->where('objek', 'LIKE', '%' . $request->search . '%');
        }

        $warans = $query->get();
            
        return view('staff.index', compact('warans'));
    }

    /**
     * SIMPAN WARAN BERKELOMPOK
     */
    public function store(Request $request)
    {
        $request->validate([
            'sektor' => 'required',
            'no_waran_induk' => 'required',
            'tujuan' => 'required',
            'tarikh_terima_waran' => 'required|date',
            'program_aktiviti.*' => 'required',
            'objek.*' => 'required', 
            'vot.*' => 'nullable', 
            'peruntukan.*' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->program_aktiviti as $key => $value) {
                
                $kodVot = $request->vot[$key];
                $kodObjek = $request->objek[$key];
                $amaunInputBaru = (float) $request->peruntukan[$key];

                $waranTerdahulu = Waran::where('objek', $kodObjek)
                                    ->latest('id')
                                    ->first();

                $bakiBawaHadapan = $waranTerdahulu ? (float) $waranTerdahulu->baki : 0;
                $totalPeruntukan = $bakiBawaHadapan + $amaunInputBaru;

                Waran::create([
                    'sektor'              => $request->sektor, 
                    'pegawai_meja'        => $request->pegawai_meja,
                    'tujuan'              => $request->tujuan, 
                    'no_waran'            => $request->no_waran_induk, 
                    'tarikh_terima_waran' => $request->tarikh_terima_waran,
                    'program_aktiviti'    => $request->program_aktiviti[$key],
                    'objek'               => $kodObjek,
                    'vot'                 => $kodVot,
                    'amaun_fasa'          => $amaunInputBaru,
                    'peruntukan'          => $totalPeruntukan,
                    'jum_belanja'         => 0, 
                    'baki'                => $totalPeruntukan, 
                    'catatan_agihan'      => $waranTerdahulu 
                                            ? "Bawa baki RM" . number_format($bakiBawaHadapan, 2) . " dari Objek $kodObjek" 
                                            : "Agihan Fasa 1",
                ]);
            }
        });

        return redirect()->route('admin.dashboard')->with('success', 'Waran Berjaya Didaftarkan!');
    }

    /**
     * KEMASKINI WARAN
     */
    public function update(Request $request, Waran $waran)
    {
        $request->validate([
            'no_waran' => 'required',
            'peruntukan' => 'required|numeric',
            'amaun_fasa' => 'nullable|numeric',
        ]);

        $total_belanja = $waran->perbelanjaans()->sum('jumlah_keluar');
        $baki_baru = $request->peruntukan - $total_belanja;

        $waran->update([
            'sektor'              => $request->sektor,
            'no_waran'            => $request->no_waran,
            'tujuan'              => $request->tujuan,
            'program_aktiviti'    => $request->program_aktiviti,
            'objek'               => $request->objek,
            'vot'                 => $request->vot,
            'amaun_fasa'          => $request->amaun_fasa ?? $waran->amaun_fasa,
            'peruntukan'          => $request->peruntukan,
            'jum_belanja'         => $total_belanja,
            'baki'                => $baki_baru,
            'tarikh_terima_waran' => $request->tarikh_terima_waran,
            'pegawai_meja'        => $request->pegawai_meja,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data Berjaya Dikemaskini!');
    }

    /**
     * PADAM WARAN
     */
    public function destroy(Waran $waran)
    {
        DB::transaction(function () use ($waran) {
            $waran->perbelanjaans()->delete(); 
            $waran->delete(); 
        });
        
        return redirect()->route('admin.dashboard')->with('success', 'Waran Berjaya Dipadam!');
    }

    public function create()
    {
        return view('warans.create');
    }

    public function edit(Waran $waran)
    {
        return view('warans.edit', compact('waran'));
    }

    public function export() 
    {
        return Excel::download(new WaransExport, 'Laporan_Waran_SSTP_JPN_Perak.xlsx');
    }
}