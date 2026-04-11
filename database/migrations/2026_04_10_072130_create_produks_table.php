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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('foto_produk')->nullable();
            $table->decimal('harga', 15, 2);
            $table->integer('stok_awal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('foto_produk');
        });
    }
};
