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
            // Kita tambah kolum ni lepas kolum baki supaya susunan cantik
            $table->text('catatan_agihan')->nullable()->after('baki');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            // Kalau kita buat rollback, dia akan buang kolum ni
            $table->dropColumn('catatan_agihan');
        });
    }
};