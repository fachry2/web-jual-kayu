<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_produk', function(Blueprint $table) {
            $table->increments('id');
            $table->string('kategori');
        });

        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_usaha');
            $table->unsignedInteger('id_kategori');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->string('ukuran');
            $table->integer('berat');
            $table->string('satuan_berat');
            $table->int('stok');
            $table->string('deskripsi');
            $table->string('foto');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_kategori')
            ->references('id')
            ->on('kategori_produk')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_usaha')
            ->references('id')
            ->on('usaha')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('foto_produk', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_produk');
            $table->string('foto');
            $table->foreign('id_produk')
            ->references('id')
            ->on('produks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_produk');
        Schema::dropIfExists('jenis_kayu_produk');
        Schema::dropIfExists('produks');
        Schema::dropIfExists('kategori_produk');
        Schema::dropIfExists('jenis_furniture');
    }
}
