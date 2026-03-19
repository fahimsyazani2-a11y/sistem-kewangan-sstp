<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waran;
use App\Models\Perbelanjaan;

class PerbelanjaanController extends Controller
{
    // 1. Papar Borang Tambah Belanja
    public function create($waran_id)
    {
        $waran = Waran::findOrFail($waran_id);
        return view('perbelanjaan.create', compact('waran'));
    }

    // 2. Simpan Data Belanja & Kemaskini Baki Waran
    public function store(Request $request)
    {
        $request->validate([
            'waran_id' => 'required|exists:warans,id',
            'butiran' => 'required|string|max:255',
            'jumlah_keluar' => 'required|numeric|min:0.01',
            'tarikh_belanja' => 'required|date',
        ]);

        $belanja = new Perbelanjaan();
        $belanja->waran_id = $request->waran_id;
        $belanja->butiran = $request->butiran;
        $belanja->jumlah_keluar = $request->jumlah_keluar;
        $belanja->tarikh_belanja = $request->tarikh_belanja;
        $belanja->save();

        $this->updateWaranBalance($request->waran_id);

        return redirect()->route('admin.dashboard')->with('success', 'Perbelanjaan berjaya direkodkan!');
    }

    // 3. Papar Borang Edit Belanja
    public function edit($id)
    {
        $belanja = Perbelanjaan::findOrFail($id);
        $waran = $belanja->waran;
        return view('perbelanjaan.edit', compact('belanja', 'waran'));
    }

    // 4. Kemaskini Rekod Belanja & Kira Semula Baki
    public function update(Request $request, $id)
    {
        $request->validate([
            'butiran' => 'required|string|max:255',
            'jumlah_keluar' => 'required|numeric|min:0.01',
            'tarikh_belanja' => 'required|date',
        ]);

        $belanja = Perbelanjaan::findOrFail($id);
        $belanja->update([
            'butiran' => $request->butiran,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tarikh_belanja' => $request->tarikh_belanja,
        ]);

        $this->updateWaranBalance($belanja->waran_id);

        return redirect()->route('admin.dashboard')->with('success', 'Rekod perbelanjaan berjaya dikemaskini!');
    }

    // 5. Padam Rekod Belanja & Kemaskini Baki (Fungsi Baru)
    public function destroy($id)
    {
        $belanja = Perbelanjaan::findOrFail($id);
        $waran_id = $belanja->waran_id;
        
        $belanja->delete();

        // Kira semula baki selepas rekod dipadam
        $this->updateWaranBalance($waran_id);

        return redirect()->route('admin.dashboard')->with('success', 'Rekod perbelanjaan berjaya dipadam!');
    }

    // Fungsi helper supaya tak ulang kod pengiraan baki
    private function updateWaranBalance($waran_id)
    {
        $waran = Waran::find($waran_id);
        $total_belanja_terkini = $waran->perbelanjaans()->sum('jumlah_keluar');
        
        $waran->update([
            'jum_belanja' => $total_belanja_terkini,
            'baki' => $waran->peruntukan - $total_belanja_terkini,
        ]);
    }
}