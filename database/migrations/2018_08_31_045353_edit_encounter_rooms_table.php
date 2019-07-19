<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEncounterRoomsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('encounter_rooms', function(Blueprint $table) {
            $table->integer('how_long')->nullable()->after('encounter_id');
            $table->integer('no_of_orgasam')->nullable()->after('how_long');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
