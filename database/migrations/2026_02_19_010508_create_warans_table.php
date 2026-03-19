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
        Schema::create('warans', function (Blueprint $table) {
            $table->id();
            // Default kepada sektor yang awak mahu
            $table->string('sektor')->default('SEKTOR SUMBER TEKNOLOGI PENDIDIKAN'); 
            $table->string('no_waran')->unique();
            $table->text('tujuan');
            $table->string('program_aktiviti')->nullable();
            $table->string('objek')->nullable();
            $table->decimal('peruntukan', 15, 2);
            $table->decimal('jum_belanja', 15, 2)->default(0);
            $table->decimal('baki', 15, 2);
            
            // Kolum Tarikh & Catatan untuk Excel
            $table->date('tarikh_terima_waran')->nullable(); 
            $table->text('catatan_agihan')->nullable(); 
            
            $table->string('pegawai_meja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warans');
    }
};