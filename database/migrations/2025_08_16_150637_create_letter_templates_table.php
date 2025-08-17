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
            $table->unsignedBigInteger('letter_type_id');
            $table->string('nama_surat');
            $table->string('kode_seri');
            $table->string('kode_unit');
            $table->string('kode_arsip');
            $table->string('perihal');
            $table->string('tujuan_nama');
            $table->string('tujuan_lokasi');
            $table->text('konten');
            $table->unsignedBigInteger('forward_to');
            $table->enum('status', ['Draft', 'Active', 'Archived'])->default('Draft');
            $table->timestamps();

            $table->foreign('forward_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('letter_type_id')->references('id')->on('letter_types')->onDelete('cascade');
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
