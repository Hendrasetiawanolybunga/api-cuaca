<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Peran
        Schema::create('peran', function (Blueprint $table) {
            $table->id('peran_id');
            $table->string('peran_nama')->unique();
            $table->timestamps();
        });

        // Pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('pengguna_id');
            $table->string('pengguna_peran');
            $table->string('pengguna_nama');
            $table->string('pengguna_email')->unique();
            $table->string('pengguna_password');
            $table->string('pengguna_lokasi');
            $table->rememberToken();
            $table->unsignedBigInteger('peran_id');
            $table->foreign('peran_id')->references('peran_id')->on('peran')->onDelete('cascade');
            $table->timestamps();
        });

        // Kebun
        Schema::create('kebun', function (Blueprint $table) {
            $table->id('kebun_id');
            $table->string('kebun_nama');
            $table->string('kebun_lokasi');
            $table->unsignedBigInteger('pengguna_id');
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });

        // Musim Tanam
        Schema::create('musim_tanam', function (Blueprint $table) {
            $table->id('mt_id');
            $table->date('mt_tanggal_tanam');
            $table->date('mt_tanggal_panen');
            $table->string('mt_komoditas');
            $table->unsignedBigInteger('kebun_id');
            $table->foreign('kebun_id')->references('kebun_id')->on('kebun')->onDelete('cascade');
            $table->timestamps();
        });

        // Pestisida
        Schema::create('pestisida', function (Blueprint $table) {
            $table->id('pestisida_id');
            $table->date('pestisida_tanggal_pakai');
            $table->string('pestisida_jenis');
            $table->string('pestisida_dosis_pakai');
            $table->unsignedBigInteger('mt_id');
            $table->foreign('mt_id')->references('mt_id')->on('musim_tanam')->onDelete('cascade');
            $table->timestamps();
        });

        // Pupuk
        Schema::create('pupuk', function (Blueprint $table) {
            $table->id('pupuk_id');
            $table->date('pupuk_tanggal_pakai');
            $table->string('pupuk_jenis');
            $table->string('pupuk_jumlah_pakai');
            $table->unsignedBigInteger('mt_id');
            $table->foreign('mt_id')->references('mt_id')->on('musim_tanam')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pupuk');
        Schema::dropIfExists('pestisida');
        Schema::dropIfExists('musim_tanam');
        Schema::dropIfExists('kebun');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('peran');
    }
};