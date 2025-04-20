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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('level_id')->index(); // indexing untuk Foreignkey 
            $table->string("username", 20)->unique(); // unique untuk memastikan tidak ada username yang sama 
            $table->string('nama', 100);
            $table->string("password");
            $table->timestamps();
            // Mendefinisikan Foreign Key pada kolom level id mengacu pada kolom level id di tabel m level 
            $table->foreign('level_id')->references('level_id')->on('m_level');
        });

        Schema::create('useri', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('level_id')->index;
            $table->string('username', 20)->unique();
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();
            $table->foreign('level_id')->references('level_id')->on('m_level');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_user', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('useri');

        Schema::table('m_user', function (Blueprint $table) {
            $table->dropColumn('foto_profil');
        });
    }
};
