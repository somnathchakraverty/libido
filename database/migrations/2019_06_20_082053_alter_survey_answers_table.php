<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('survey_answers', 'survey_id')) {            
            Schema::table('survey_answers', function (Illuminate\Database\Schema\Blueprint $table) {
                $table->integer('survey_id')
                    ->after('question_id')
                    ->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('survey_answers', 'survey_id')) {            
            Schema::table('survey_answers', function (Blueprint $table) {
                $table->dropColumn('survey_id');           
            });
        }
    }
}
