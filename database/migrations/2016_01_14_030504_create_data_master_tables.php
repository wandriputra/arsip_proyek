<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataMasterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('password', 60);
            $table->char('status', 1)->default('A');
            $table->integer('role_user_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('personil_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('personil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->nullable();
            $table->string('nama_personil');
            $table->string('singkatan', 5)->nullable();
            $table->string('email', 200)->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->integer('atasan_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('unit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_unit',200);
            $table->string('singkatan', 5);
            $table->integer('unit_atasan')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('jabatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jabatan');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_role','40');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('actifity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_actifity', 100)->unique();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('jenis_id')->unsigned()->nullable();
            $table->timestamps();
        });

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

        Schema::create('jenis_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jenis',80); //nama_jenis dokumen
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('sub_jenis_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sub',80);
            $table->string('singkatan',10)->nullable();
            $table->integer('actifity_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('approval_dokumen', function (Blueprint $table) {
            $table->increments('id'); 
            $table->date('tanggal_approval');
            $table->string('status', 10);
            $table->integer('dokumen_upload_id')->unsigned()->nullable();
            $table->integer('personil_id')->unsigned()->nullable();
            $table->integer('jenis_approval_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('jenis_approval', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('tag_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_tag');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('status_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_status');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('visibility', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_visibility');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('checklist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_checklist'); //TODO: unique with unit_id
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('unit_dokumen', function (Blueprint $table) {
            $table->integer('sub_jenis_id')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
        });

        Schema::create('tembusan_dokumen', function (Blueprint $table) {
            $table->integer('dokumen_id')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
        });

        Schema::create('dokumen_has_tag', function (Blueprint $table) {
            $table->integer('dokumen_upload_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
        });

        Schema::create('folder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_folder');
            $table->integer('folder_induk')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('jenis_dokumen_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('share_folders', function (Blueprint $table) {
            $table->integer('folder_id')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
        });

        Schema::create('folder_dokumen', function (Blueprint $table) {
            $table->integer('folder_id')->unsigned()->nullable();
            $table->integer('dokumen_id')->unsigned()->nullable();
        });

        Schema::create('checklist_has_activity_jenis', function (Blueprint $table){
            $table->integer('checklist_id')->unsigned()->nullable();
            $table->integer('actifity_id')->unsigned()->nullable();
            $table->integer('sub_jenis_id')->unsigned()->nullable();
        });

        Schema::create('checklist_has_dokumen', function(Blueprint $table){
            $table->integer('checklist_id')->unsigned()->nullable();
            $table->integer('dokumen_id')->unsigned()->nullable();
        });

        Schema::create('dokumen_sap', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_sap', 25)->nullable();
            $table->integer('dokumen_id')->unsigned()->nullable();
            $table->string('type',2)->nullable();
            $table->timestamps();
        });

        Schema::create('jra_dokumens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode',20);
            $table->string('jenis_arsip');
            $table->string('waktu_aktif');
            $table->string('waktu_inaktif');
            $table->string('keterangan');
            $table->char('level');
            $table->integer('kode_induk')->unsigned()->nullable();
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
        Schema::drop(["user",
                "personil",
                "unit",
                "jabatan",
                "role_user",
                "actifity",
                "dokumen",
                "jenis_dokumen",
                "sub_jenis_dokumen",
                "approval_dokumen",
                "jenis_approval",
                "tag_dokumen",
                "status_dokumen",
                "visibility", 
                "checklist",
                "unit_dokumen",
                "tembusan_dokumen",
                "dokumen_has_tag",
                "folder",
                "share_folders",
                "folder_dokumen",
                "checklist_has_activity_jenis",
                "checklist_has_dokumen",
                "dokumen_sap",
                "jra_dokumens" ]);
    }
}
