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
        Schema::create('info_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gelombang');
            $table->mediumText('deskripsi')->nullable();
            $table->enum('gelombang', ['I', 'II', 'III', 'IV', 'V']);
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('info_pendaftarans');
    }
};
