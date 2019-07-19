<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEncountersTable1 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('encounters', function(Blueprint $table) {
            $table->string('timezone')->nullable()->after('step');
            $table->string('offset')->nullable()->after('timezone');
            $table->integer('is_intercourse')->default(0)->comment('0=no 1=yes')->after('step');
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
