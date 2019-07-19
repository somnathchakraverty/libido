<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class SurveyAnswer extends Model {

    protected $table = 'survey_answers';

    public static function saveAnswer($data) {
        $answer = new SurveyAnswer();
        $answer->question_id = $data['questionId'];
        $answer->answers = $data['answer'];
        $answer->survey_id = $data['surveyId'];
        $answer->user_id = Auth::user()->id;
        $answer->save();
        return $answer;
    }
    
    public function question(){
        return $this->belongsTo(SurveyQuestion::class,'question_id');
    }

}

?>