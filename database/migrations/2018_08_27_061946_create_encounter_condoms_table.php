<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterCondomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounter_condoms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condom_id')->unsigned();
            $table->integer('encounter_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('condom_id')->references('id')->on('condoms')->onDelete('cascade');
            $table->foreign('encounter_id')->references('id')->on('encounters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounter_condoms');
    }
}
