<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UserServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Survey;

use App\Providers\BaseServiceProvider;
use Auth;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\Survey;
use App\Models\Encounter;

/**
 * ReportServiceProvider class conatains methods for user management
 */
class SurveyServiceProvider extends BaseServiceProvider {

    function __construct() {
        
    }

    /**
     * List of Surveys
     */
    public static function getSurveyList(){
        
        $surveys = Survey::where('is_active', 1)->whereHas('questions')->get();
        
        return static::responseSuccess(trans('messages.apis.user.record_fetched'),$surveys);
    }

    /*
     * Get Qustions
     */

    public static function question() {
        $survey = Survey::join('survey_questions', 'surveys.id', '=', 'survey_questions.survey_id')
                        ->join('survey_answers', 'survey_questions.id', '=', 'survey_answers.question_id')
                        ->where('is_active', 1)->where('survey_answers.user_id', Auth::user()->id)->whereNull('survey_answers.deleted_at')->whereNull('survey_questions.deleted_at')->get();
        //dd($survey);
        $encounter = Encounter::where('user_id', Auth::user()->id)->first();
        if (!$survey->isEmpty() || !$encounter) {
            return static::responseSuccess(trans('messages.apis.user.record_fetched'));
        }

        $question = SurveyQuestion::all();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $question);
    }

    /**
     * Get Questions of a survey
     */
    public static function questionOfSurvey($surveyId) {
        // $survey = Survey::join('survey_questions', 'surveys.id', '=', 'survey_questions.survey_id')
        //                 ->join('survey_answers', 'survey_questions.id', '=', 'survey_answers.question_id')
        //                 ->where('is_active', 1)
        //                 ->where('survey_questions.survey_id',$surveyId)
        //                 ->where('survey_answers.user_id', Auth::user()->id)
        //                 ->whereNull('survey_answers.deleted_at')
        //                 ->whereNull('survey_questions.deleted_at')
        //                 ->get();
        //var_dump($survey->isEmpty()); exit;
        $encounter = Encounter::where('user_id', Auth::user()->id)->first();
        //if (!$survey->isEmpty() || !$encounter) { 
        if (!$encounter) {
            return static::responseSuccess(trans('messages.apis.user.record_fetched'));
        }

        // $question = SurveyQuestion::all();
        $question = SurveyQuestion::with(['userAnswer' => function($q){
            return $q->where('user_id',Auth::id());
        }])
        ->where('survey_id',$surveyId)
        ->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $question);
    }

    

    /*
     * Answer
     */

    public static function answer($data) {
        $s = SurveyAnswer::where('user_id', Auth::user()->id)->where('question_id', $data['questionId'])->first();
        if ($s) {
            $surveyDetails = SurveyQuestion::whereNull('deleted_at')->where('id', $data['questionId'])->first();
            $data['surveyId'] = $surveyDetails->survey_id;
            $answer = SurveyAnswer::where('id', $s->id)->update(['answers' => $data['answer']]);
        }else{
            $surveyDetails = SurveyQuestion::whereNull('deleted_at')->where('id', $data['questionId'])->first();
            $data['surveyId'] = $surveyDetails->survey_id;
            $answer = SurveyAnswer::saveAnswer($data);
        }
        
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $answer);
    }

    /*
     * Get match report
     */

    public static function matchReport($data) {
        $selfData = SurveyAnswer::join('survey_questions', 'survey_questions.id', '=', 'survey_answers.question_id')
                ->where('user_id', Auth::user()->id)
                ->get();
        $partnerData = SurveyAnswer::join('survey_questions', 'survey_questions.id', '=', 'survey_answers.question_id')
                ->where('user_id', $data['partnerId'])
                ->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), ['self' => $selfData, 'partner' => $partnerData]);
    }
    
    public static function deleteProgress($data){
        $selfData = SurveyAnswer::where([ 'survey_id' => $data['surveyId'], 'user_id' => Auth::user()->id ])->delete();
        return static::responseSuccess(trans('messages.apis.user.record_deleted'));
    }

}
