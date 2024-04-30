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
        Schema::create('profile_pendidiks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('no_telepon', 20)->nullable();
            $table->unsignedBigInteger('tenaga_pendidik_id');
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->string('pendidikan')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Khonghucu', 'Katolik']);
            $table->text('alamat')->nullable();
            $table->string('kelurahan', 20)->nullable();
            $table->string('kecamatan', 20)->nullable();
            $table->string('kota', 20)->nullable();
            $table->integer('kode_pos')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->tinyInteger('row_status');

            $table->foreign('tenaga_pendidik_id')->references('id')->on('tenaga_pendidiks')->onDelete('cascade');
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_pendidiks');
    }
};
