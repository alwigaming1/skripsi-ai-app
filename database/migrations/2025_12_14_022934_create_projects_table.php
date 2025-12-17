<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // INI KOLOM YANG HILANG TADI:
            $table->string('judul'); 
            
            $table->string('session_id')->nullable();
            
            // Kolom untuk isi skripsi
            $table->longText('bab1_content')->nullable();
            $table->longText('bab2_content')->nullable();
            $table->longText('bab3_content')->nullable();
            $table->longText('bab4_content')->nullable();
            $table->longText('bab5_content')->nullable();
            
            $table->enum('status', ['draft', 'processing', 'completed'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};