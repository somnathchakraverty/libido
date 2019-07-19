<?php

/*
 * Copyright 2017-2018 Appster LLP
 * All rights reserved.
 * File: ReportController.php
 * Project: Libido
 * Author: Ashish Ginotra
 * CreatedOn: date (21/08/2018) 
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Providers\Survey\SurveyServiceProvider;
use App\Http\Requests\Surveys\AnswerRequest;
use App\Http\Requests\Surveys\MatchRequest;
use App\Http\Requests\Surveys\DeleteAnswerRequest;
use App\Models\Partner;
use Auth;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\User;
use App\Providers\BaseServiceProvider;

class SurveyController extends BaseController {

    public function surveyList(){
        $response = SurveyServiceProvider::getSurveyList();
        return $this->sendJsonResponse($response);
    }
    public function getQuestion() {
        $response = SurveyServiceProvider::question();
        return $this->sendJsonResponse($response);
    }
    public function getQuestionOfSurvey($surveyId) {
        $response = SurveyServiceProvider::questionOfSurvey($surveyId);
        return $this->sendJsonResponse($response);
    }

    public function postMatchReport(MatchRequest $request) {
        $response = SurveyServiceProvider::matchReport($request->all());
        return $this->sendJsonResponse($response);
    }

    public function postAnswer(AnswerRequest $request) {
        $response = SurveyServiceProvider::answer($request->all());
        return $this->sendJsonResponse($response);
    }

    public function postDeleteProgress(DeleteAnswerRequest $request) {
        $response = SurveyServiceProvider::deleteProgress($request->all());
        return $this->sendJsonResponse($response);
    }

    /**
     * Get Survey reports by partners
     */
    public function postMatchingData(Request $request){
        $surveyId = $request->input('surveyId',false);
        $questionCount = SurveyQuestion::where('survey_id',$surveyId)->count();
        $partnersMap = Partner::where('user_id',Auth::id())->get();
        $partnerIDs = $partnersMap->pluck('mapped_user_id')->toArray();
        $myAnswers = SurveyAnswer::with('question')->where('user_id',Auth::id())
        ->select('id','user_id','question_id','survey_id','answers')
        ->where('survey_id',$surveyId)
        ->orderBy('question_id')->get();
        $userInfo = User::select('id','firstname','lastname','image')->find(Auth::id());
        $data = [
            'myInfo' => $userInfo,
            'myAnswers' => $myAnswers,
            'partners' => []
        ];
        foreach($partnerIDs as $pid){
            $answerCount = SurveyAnswer::where('user_id',$pid)->where('survey_id',$surveyId)->count();
            if($answerCount < $questionCount){
                continue;
            }
            $answers = SurveyAnswer::where('user_id',$pid)
            ->select('id','user_id','question_id','survey_id','answers')
            ->where('survey_id',$surveyId)
            ->orderBy('question_id')->get();
            $partnerInfo = User::select('id','firstname','lastname','image')->find($pid);

            $data['partners'][] = [
                'info' => $partnerInfo,
                'answers' => $answers
            ];

        }
        return $this->sendJsonResponse(BaseServiceProvider::responseSuccess('',$data));
    }
}
