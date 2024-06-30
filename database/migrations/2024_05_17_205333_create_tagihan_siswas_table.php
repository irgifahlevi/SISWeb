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
        Schema::create('tagihan_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_tagihan')->unique();
            $table->string('kode_tagihan')->unique();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_tagihan');
            $table->date('tanggal_dibuat');
            $table->date('jatuh_tempo');
            $table->enum('kategori_tagihan', ['spp', 'iuran', 'uas', 'uts', 'kursus', 'buku']);
            $table->integer('nominal_tagihan');
            $table->enum('status', ['belum_dibayar', 'dibayar', 'dibatalkan', 'waiting', 'Failed', 'Expired'])->default('belum_dibayar');
            $table->string('jenis_pembayaran')->nullable();
            $table->string('token_tagihan')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_siswas');
    }
};
