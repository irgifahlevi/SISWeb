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
    Schema::create('dokumen_pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->string('foto_dokumen');
        $table->string('nama_dokumen');
        $table->unsignedBigInteger('pendaftaran_id');
        $table->enum('status',['valid', 'invalid'])->nullable();
        $table->text('catatan')->nullable();
        $table->string('created_by')->nullable();
        $table->dateTime('created_at');
        $table->dateTime('updated_at')->nullable();
        $table->tinyInteger('row_status');

        $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
    });

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendaftarans');
    }
};
