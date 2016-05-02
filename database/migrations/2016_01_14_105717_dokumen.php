<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class dokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_dokumen')->unique();
            $table->string('nama_dokumen');
            $table->string('file_name_pdf');
            $table->string('lokasi_file_pdf');
            $table->string('tag_keterangan');
            $table->integer('sub_jenis_id')->unsigned(); //jenis_dokumen_id
            $table->integer('unit_asal')->unsigned(); //personil
            $table->integer('unit_tujuan')->unsigned()->nullable(); //personil
            $table->integer('visibility_id')->unsigned(); //personil
            $table->integer('created_by')->unsigned(); //user_id
            $table->softDeletes();
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
        Schema::drop('dokumens');
    }
}
