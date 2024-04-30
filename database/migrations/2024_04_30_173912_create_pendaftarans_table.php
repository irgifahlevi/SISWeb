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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran');
            $table->enum('status', ['Pending', 'Success', 'Failed']);
            $table->tinyInteger('is_bayar');
            $table->integer('jumlah_item');
            $table->integer('total_bayar');
            $table->dateTime('tanggal_pendaftaran');
            $table->unsignedBigInteger('info_pendaftaran_id');
            $table->unsignedBigInteger('calon_siswa_id');
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('info_pendaftaran_id')->references('id')->on('info_pendaftarans')->onDelete('cascade');
            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};