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
            // Kita tambah column 'vot' selepas column 'objek'
            // nullable() bermaksud boleh dikosongkan jika tiada maklumat
            $table->string('vot')->nullable()->after('objek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warans', function (Blueprint $table) {
            // Ini untuk buang column vot jika kita undo migration ni
            $table->dropColumn('vot');
        });
    }
};