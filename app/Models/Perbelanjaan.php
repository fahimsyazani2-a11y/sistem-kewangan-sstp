<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbelanjaan extends Model
{
    use HasFactory;

    /**
     * Field yang dibenarkan untuk simpanan (Mass Assignment)
     */
    protected $fillable = [
        'waran_id', 
        'butiran', 
        'jumlah_keluar', 
        'tarikh_belanja'
    ];

    /**
     * Casting data supaya Laravel tahu jenis data
     */
    protected $casts = [
        'tarikh_belanja' => 'date',
        'jumlah_keluar' => 'decimal:2',
    ];

    /**
     * Hubungan (Inverse): Rekod belanja ini milik satu Waran
     */
    public function waran()
    {
        return $this->belongsTo(Waran::class);
    }
}