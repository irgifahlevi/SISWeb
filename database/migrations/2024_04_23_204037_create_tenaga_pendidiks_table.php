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
        Schema::create('tenaga_pendidiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->bigInteger('nip')->nullable();
            $table->bigInteger('no_nuptk')->nullable();
            $table->string('mapel', 50)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_pendidiks');
    }
};
