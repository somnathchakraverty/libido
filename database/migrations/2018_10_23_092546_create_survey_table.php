<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('is_active')->default(0)->comment('0=no 1=yes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('survey_questions', function(Blueprint $table) {
            $table->integer('survey_id')->unsigned()->after('questions');
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('surveys');
    }

}
