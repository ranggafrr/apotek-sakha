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
        Schema::create('master_barang', function (Blueprint $table) {
            $table->string("kode_barang", 50)->primary();
            $table->string("nama_barang", 50);
            $table->string("satuan", 50);
            $table->bigInteger("stok")->nullable()->default(0);
            $table->bigInteger("harga_beli")->nullable()->default(0);
            $table->bigInteger("harga_jual")->nullable()->default(0);
            $table->string("created_by", 50)->nullable();
            $table->string("updated_by", 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_barang');
    }
};
