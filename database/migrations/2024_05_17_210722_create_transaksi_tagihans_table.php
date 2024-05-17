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
        Schema::create('transaksi_tagihans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_transaksi')->unique();
            $table->unsignedBigInteger('tagihan_siswa_id');
            $table->unsignedBigInteger('siswa_id');
            $table->tinyInteger('is_bayar');
            $table->string('waktu_transaksi');
            $table->string('waktu_pembayaran');
            $table->integer('total_pembayaran');
            $table->string('channel_pembayaran')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('tagihan_siswa_id')->references('id')->on('tagihan_siswas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_tagihans');
    }
};
