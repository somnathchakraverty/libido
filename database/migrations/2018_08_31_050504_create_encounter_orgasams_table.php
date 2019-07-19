<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterOrgasamsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('encounter_orgasams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('encounter_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->integer('no_of_orgasams');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('encounter_id')->references('id')->on('encounters')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('encounter_orgasams');
    }

}
