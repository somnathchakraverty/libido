<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEncounterPartnersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('encounter_partners', function(Blueprint $table) {
            $table->integer('no_of_orgasams')->default(0)->change();
            $table->tinyInteger('is_protection_used')->default(0)->comment('0=no 1=yes')->after('no_of_orgasams');
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
