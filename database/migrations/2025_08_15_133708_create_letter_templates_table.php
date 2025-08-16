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
        Schema::create('letter_templates', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('nama_surat');
            $table->string('kode_seri');
            $table->string('kode_unit');
            $table->string('kode_arsip');
            $table->string('tujuan_nama');
            $table->string('tujuan_lokasi');
            $table->text('konten');
            $table->unsignedBigInteger('requires_kaprodi')->nullable();
            $table->unsignedBigInteger('requires_ketua_jurusan')->nullable();
            $table->enum('status', ['Draft', 'Active', 'Archived'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_templates');
    }
};
