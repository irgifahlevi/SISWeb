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
        Schema::create('request_tokens', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['tagihan_siswa', 'pendaftaran_siswa']);
            $table->unsignedBigInteger('tagihan_siswa_id')->nullable();
            $table->unsignedBigInteger('pendaftaran_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('tagihan_siswa_id')->references('id')->on('tagihan_siswas')->onDelete('cascade');
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_tokens');
    }
};
