<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('paket', function (Blueprint $table) {
//             $table->dropColumn('item_id');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('paket', function (Blueprint $table) {
//             $table->foreignId('item_id')->constrained('satuan');
//         });
//     }
// };


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cek jika kolom item_id ada sebelum menghapusnya
        Schema::table('paket', function (Blueprint $table) {
            if (Schema::hasColumn('paket', 'item_id')) {
                $table->dropColumn('item_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menambahkan kembali kolom item_id jika diperlukan
        Schema::table('paket', function (Blueprint $table) {
            $table->foreignId('item_id')
                  ->nullable()  // Menambahkan nullable jika kolom sebelumnya boleh null
                  ->constrained('satuan')
                  ->onDelete('cascade');  // Menambahkan cascading delete jika diperlukan
        });
    }
};
