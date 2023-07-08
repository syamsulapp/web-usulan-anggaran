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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('usurname');
            $table->string('password');
<<<<<<< Updated upstream
=======
            $table->string('tipe');
            $table->string('bagian');
            $table->string('surat_keterangan');
            $table->string('role');
            $table->enum('is_active', ['yes', 'no']);
>>>>>>> Stashed changes
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
