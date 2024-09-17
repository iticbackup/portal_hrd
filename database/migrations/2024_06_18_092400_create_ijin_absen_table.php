<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjinAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijin_absen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no');
            $table->string('nik');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->string('email');
            $table->string('hari',100);
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
            $table->string('kategori_izin',5);
            $table->string('selama',10);
            $table->text('keperluan');
            $table->string('saksi_1');
            $table->string('saksi_2');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('ijin_absen_ttd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ijin_absen_id');
            $table->string('signature_manager')->nullable();
            $table->dateTime('tgl_signature_manager')->nullable();
            $table->string('signature_bersangkutan')->nullable();
            $table->dateTime('tgl_signature_bersangkutan')->nullable();
            $table->string('signature_saksi_1')->nullable();
            $table->dateTime('tgl_signature_saksi_1')->nullable();
            $table->string('signature_saksi_2')->nullable();
            $table->dateTime('tgl_signature_saksi_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('ijin_absen_attachment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ijin_absen_id');
            $table->text('attachment_written_letter')->nullable();
            $table->text('ttd_written_letter')->nullable();
            $table->text('attachment')->nullable();
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
        Schema::dropIfExists('ijin_absen');
        Schema::dropIfExists('ijin_absen_ttd');
        Schema::dropIfExists('ijin_absen_attachment');
    }
}
