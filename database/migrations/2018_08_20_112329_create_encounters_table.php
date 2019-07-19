<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->tinyInteger('is_protection_used')->default(0)->comment('1=yes 0=no');
            $table->tinyInteger('is_toy_used')->default(0)->comment('1=yes 0=no');
            $table->tinyInteger('is_intoxicant_used')->default(0)->comment('1=yes 0=no');
            $table->tinyInteger('is_lublicant_used')->default(0)->comment('1=yes 0=no');
            $table->tinyInteger('session_type')->default(1)->comment('1=solo 2=single 3=multiple');
            $table->date('encounter_date');
            $table->time('encounter_time');
            $table->integer('no_of_orgasam');
            $table->string('duration');
            $table->text('location');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounters');
    }
}
