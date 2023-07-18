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
        Schema::create('rincian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uraian_id')->constrained('uraian')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pagu_id')->constrained('pagu')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_barang');
            $table->integer('volume');
            $table->integer('harga_satuan');
            $table->string('satuan');
            $table->integer('total');
            $table->enum('status', ['diterima', 'ditolak', 'revisi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian');
    }
};
