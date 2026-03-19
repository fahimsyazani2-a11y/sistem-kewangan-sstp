<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Waran extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor', 'no_waran', 'tujuan', 'program_aktiviti', 
        'objek', 'vot', 'amaun_fasa', 'peruntukan', 'jum_belanja', 'baki', 
        'tarikh_terima_waran', 'catatan_agihan', 'pegawai_meja'
    ];

    protected $casts = [
        'tarikh_terima_waran' => 'date',
        'amaun_fasa' => 'decimal:2', // Tambah cast untuk ketepatan nilai RM
        'peruntukan' => 'decimal:2',
        'jum_belanja' => 'decimal:2',
        'baki' => 'decimal:2',
    ];

    public function perbelanjaans()
    {
        return $this->hasMany(Perbelanjaan::class, 'waran_id');
    }

    public function getPeratusAttribute()
    {
        if ($this->peruntukan <= 0) return 0;
        // Kita guna peruntukan (jumlah besar) untuk kira peratus belanja
        $peratus = ($this->jum_belanja / $this->peruntukan) * 100;
        return number_format($peratus, 2);
    }

    public function getSenaraiCatatanBelanjaAttribute()
    {
        if ($this->perbelanjaans->isEmpty()) {
            return "Tiada belanja";
        }

        return $this->perbelanjaans->map(function($item, $index) {
            return ($index + 1) . ". " . $item->butiran . " (-RM " . number_format($item->jumlah_keluar, 2) . ")";
        })->implode("\n");
    }

    public function scopeTersusun($query)
    {
        // Biasanya kita nak tengok yang terbaru di atas, 
        // tapi ikut keselesaan kau kalau nak 'asc'
        return $query->orderBy('id', 'desc'); 
    }
}