<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            // Drop unique index supaya satu No Waran boleh ada banyak baris objek
            $table->dropUnique(['no_waran']);
        });
    }

    public function down(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            $table->unique('no_waran');
        });
    }
};