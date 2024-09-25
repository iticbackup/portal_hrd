<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('portal_office')->create('maintenance_web', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('secret');
            $table->string('status',100);
            $table->string('mode',50)->nullable();
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
        Schema::connection('portal_office')->dropIfExists('maintenance_web');
    }
}
