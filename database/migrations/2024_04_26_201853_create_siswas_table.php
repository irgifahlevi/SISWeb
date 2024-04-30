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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_lengkap', 100);
            $table->bigInteger('nik');
            $table->bigInteger('no_kk');
            $table->bigInteger('no_nisn')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam'])->default('Islam');
            $table->text('alamat')->nullable();
            $table->string('kelurahan', 20)->nullable();
            $table->string('kecamatan', 20)->nullable();
            $table->string('kota', 20)->nullable();
            $table->integer('kode_pos')->nullable();
            $table->string('tempat_tinggal', 20)->nullable();
            $table->smallInteger('tahun_masuk');
            $table->integer('nis_lokal');
            $table->tinyInteger('anak_ke');
            $table->tinyInteger('jumlah_saudara');
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
