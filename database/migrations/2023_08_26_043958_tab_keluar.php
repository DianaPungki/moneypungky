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
        Schema::create('tab_keluar', function (Blueprint $table) {
            $table->uuid('id_keluar')->primary();
            $table->string('nama_keluar');
            $table->string('jumlah_keluar');

            $table->string('id_bank');
            $table->foreign('id_bank')->references('id_bank')->on('bank')->onDelete('cascade')->onUpdate('cascade');

            $table->string('id_kat');
            $table->foreign('id_kat')->references('id_kat')->on('kategori')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tab_keluar');
    }
};
