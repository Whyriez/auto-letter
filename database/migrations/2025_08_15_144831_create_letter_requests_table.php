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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Mahasiswa
            $table->foreignId('letter_template_id')->constrained('letter_templates')->onDelete('cascade');
            $table->enum('status', ['pending', 'rejected', 'completed'])->default('pending');
            $table->string('unique_code')->unique();
            $table->string('final_document_path')->nullable();
            $table->string('blockchain_hash')->nullable()->index();
            $table->string('blockchain_tx_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
