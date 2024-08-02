<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir'); // Corrected to tanggal_lahir
            $table->string('jenis_kelamin'); // Using 'L' and 'P'
            $table->string('alamat');
            $table->integer('kelas');
            $table->string('jurusan')->nullable();
            $table->string('prestasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
