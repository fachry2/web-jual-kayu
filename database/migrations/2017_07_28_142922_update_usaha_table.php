<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usaha', function($table){
            $table->integer('id_provinsi')->after('alamat_usaha');
            $table->string('nama_provinsi')->after('id_provinsi');
            $table->integer('id_kota')->after('nama_provinsi');
            $table->string('nama_kota')->after('id_kota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
