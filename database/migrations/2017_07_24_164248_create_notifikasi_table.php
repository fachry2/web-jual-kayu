<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_usaha');
            $table->string('judul_notif');
            $table->string('pesan', 255);
            $table->integer('read')->default(0);
            $table->timestamps();

            $table->foreign('id_usaha')
            ->references('id')
            ->on('usaha')
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
        Schema::dropIfExists('notifikasi');
    }
}
