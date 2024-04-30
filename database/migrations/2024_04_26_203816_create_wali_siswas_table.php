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
        Schema::create('wali_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->bigInteger('nik');
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('hubungan_status', ['Ayah', 'Ibu', 'Kakak', 'Kakek', 'Nenek']);
            $table->string('pekerjaan');
            $table->string('penghasilan');
            $table->enum('pendidikan', ['Tidak sekolah', 'SD', 'SLTP', 'SLTA', 'S1', 'S2']);
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->unsignedBigInteger('siswa_id');
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_siswas');
    }
};
