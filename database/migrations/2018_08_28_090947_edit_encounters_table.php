<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEncountersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('encounters', function(Blueprint $table) {
            // $table->integer('step')->default(0)->after('location');
            $table->integer('tag_id')->unsigned()->nullable()->change();
            $table->integer('no_of_orgasam')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->text('location')->nullable()->change();
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
