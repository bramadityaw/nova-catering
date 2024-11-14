<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id(); // Kolom id utama dengan auto-increment
            $table->foreignId('paket_id') // Menggunakan paket_id yang benar
                  ->constrained('paket') // Menghubungkan dengan tabel paket
                  ->onDelete('cascade');
            $table->foreignId('satuan_id') // Menggunakan satuan_id yang benar
                  ->constrained('satuan') // Menghubungkan dengan tabel satuan
                  ->onDelete('cascade');
            $table->string('nama'); // Kolom nama yang bisa disesuaikan
            $table->integer('quantity')->default(1); // Kolom quantity dengan nilai default
            $table->timestamps();
            
            // Menambahkan unique constraint pada kombinasi paket_id dan satuan_id
            $table->unique(['paket_id', 'satuan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};

