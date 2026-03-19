<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            // Kita tambah amaun_fasa untuk simpan input asal user
            // Kita letak selepas tarikh_terima_waran
            $table->decimal('amaun_fasa', 15, 2)->after('tarikh_terima_waran')->default(0);
            
            // Tambah juga kolum catatan_agihan kalau kau belum buat sebelum ni
            if (!Schema::hasColumn('warans', 'catatan_agihan')) {
                $table->string('catatan_agihan')->nullable()->after('baki');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            $table->dropColumn(['amaun_fasa', 'catatan_agihan']);
        });
    }
};