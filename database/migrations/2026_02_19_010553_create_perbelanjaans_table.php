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
    Schema::create('perbelanjaans', function (Blueprint $table) {
        $table->id();
        // Ini hubungkan perbelanjaan dengan waran tertentu
        $table->foreignId('waran_id')->constrained('warans')->onDelete('cascade');
        $table->string('butiran');           // Contoh: Beli Kertas A4
        $table->decimal('jumlah_keluar', 15, 2);
        $table->date('tarikh_belanja');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbelanjaans');
    }
};
