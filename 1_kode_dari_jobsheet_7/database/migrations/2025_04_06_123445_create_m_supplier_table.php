<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('kode_supplier', 20)->unique();
            $table->string('nama_supplier', 100);
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_supplier');
    }
};
