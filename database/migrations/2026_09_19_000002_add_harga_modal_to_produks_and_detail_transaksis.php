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
        Schema::table('produks', function (Blueprint $table) {
            $table->decimal('harga_modal', 15, 2)->default(0)->after('foto_produk');
        });

        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->decimal('harga_modal', 15, 2)->default(0)->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('harga_modal');
        });

        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->dropColumn('harga_modal');
        });
    }
};
