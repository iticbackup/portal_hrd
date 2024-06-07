<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik');
            $table->string('name');
            $table->string('email');
            $table->string('departemen')->nullable();
            $table->string('bagian')->nullable();
            $table->string('dept_tujuan')->nullable();
            $table->text('keperluan');
            $table->string('no_urut',50);
            $table->dateTime('tgl_input');
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
        Schema::dropIfExists('antrian');
    }
}
