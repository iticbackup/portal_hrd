<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjinKeluarMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijin_keluar_masuk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no');
            $table->string('nik');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->string('email');
            $table->text('keperluan');
            $table->string('kendaraan');
            $table->string('kategori_izin');
            $table->time('jam_kerja');
            $table->time('jam_rencana_keluar')->nullable();
            $table->time('jam_datang')->nullable();
            $table->string('kategori_keperluan');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ijin_keluar_masuk_ttd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ijin_keluar_masuk_id');
            $table->string('signature_manager')->nullable();
            $table->dateTime('tgl_signature_manager')->nullable();
            $table->string('signature_personalia')->nullable();
            $table->dateTime('tgl_signature_personalia')->nullable();
            $table->string('signature_kend_satpam')->nullable();
            $table->dateTime('tgl_signature_kend_satpam')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ijin_keluar_masuk');
        Schema::dropIfExists('ijin_keluar_masuk_ttd');
    }
}
