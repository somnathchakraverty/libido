<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterToysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounter_toys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('toy_id')->unsigned();
            $table->integer('encounter_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('toy_id')->references('id')->on('toys')->onDelete('cascade');
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
        Schema::dropIfExists('encounter_toys');
    }
}
