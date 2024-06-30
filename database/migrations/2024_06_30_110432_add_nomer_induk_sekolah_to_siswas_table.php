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
        Schema::table('siswas', function (Blueprint $table) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->bigInteger('nomer_induk_sekolah')->after('no_nisn')->nullable(); // Menambahkan kolom baru
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Menghapus kolom baru 'nomer_induk_sekolah'
            if (Schema::hasColumn('siswas', 'nomer_induk_sekolah')) {
                $table->dropColumn('nomer_induk_sekolah');
            }
        });
    }
};
