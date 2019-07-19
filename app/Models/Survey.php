<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Survey extends Model {

    use SoftDeletes;

    protected $table = 'surveys';
    protected $fillable = ['name', 'is_active'];
    protected $appends = ['surveyStatus'];
    
    public function getSurveyStatusAttribute() {
        $status = false;
        if(Auth::user()){
            $surveyQuestion = SurveyQuestion::where("survey_id", "=", $this->id)->whereNull("deleted_at")->count();
            $surveyAnswers = SurveyAnswer::where("user_id", "=", Auth::user()->id)->where("survey_id", "=", $this->id)->whereNull("deleted_at")->count();
            if($surveyAnswers >= $surveyQuestion){
                $status = true;
            }
        }else{
            $status = false;
        }
        return $status;
    }
    
    public function questions(){
        return $this->hasMany(SurveyQuestion::class,"survey_id");
    }
    
    

}

?>