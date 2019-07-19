<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SurveyQuestion extends Model {
use SoftDeletes;
    protected $table = 'survey_questions';

    protected $fillable = ['questions','survey_id'];

    public function userAnswer(){
        return $this->hasOne(SurveyAnswer::class,'question_id');

    }
    public function answers(){
        return $this->hasMany(SurveyAnswer::class,'question_id');
    }

}

?>