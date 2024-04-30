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
        Schema::create('biaya_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biaya');
            $table->integer('nominal_biaya');
            $table->unsignedBigInteger('info_pendaftaran_id');
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('info_pendaftaran_id')->references('id')->on('info_pendaftarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_pendaftarans');
    }
};
