<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_travel_order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal_buat');
            $table->string('no_polisi');
            $table->string('driver_id',100);
            $table->time('jam_berangkat_rencana')->nullable();
            $table->time('jam_datang_rencana')->nullable();
            $table->time('jam_berangkat_aktual')->nullable();
            $table->time('jam_datang_aktual')->nullable();
            $table->text('tujuan_rencana');
            $table->text('tujuan_aktual');
            $table->text('keperluan');
            $table->text('ttd_umum')->nullable();
            $table->text('ttd_pemakai')->nullable();
            $table->text('penumpang')->nullable();
            $table->time('security_jam_keluar')->nullable();
            $table->string('security_km_keluar')->nullable();
            $table->string('security_ttd_keluar')->nullable();
            $table->time('security_jam_masuk')->nullable();
            $table->string('security_km_masuk')->nullable();
            $table->string('security_ttd_masuk')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('car_travel_order');
    }
}
