<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIklanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iklan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_umkm')->constrained('umkm', 'id');
            $table->foreignId('kategori_iklan')->constrained('kategori', 'id');
            $table->integer('gaji');
            $table->string('judul_iklan');
            $table->string('banner');
            $table->string('kota_lokasi');
            $table->string('alamat');
            $table->string('durasi');
            $table->string('shortdesc');
            $table->boolean('is_available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iklan');
    }
}
