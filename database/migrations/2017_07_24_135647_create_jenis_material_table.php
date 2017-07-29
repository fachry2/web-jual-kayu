<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material', 100);
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('produk_material_select', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('id_produk');
            $table->unsignedInteger('id_material');

            $table->foreign('id_produk')
            ->references('id')
            ->on('produks')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_material')
            ->references('id')
            ->on('jenis_material')
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
        Schema::dropIfExists('produk_material_select');
        Schema::dropIfExists('jenis_material');
    }
}
