<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: AdminServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Admin;

use App\Providers\BaseServiceProvider;
use App\Models\SurveyQuestion;

/**
 * UserServiceProvider class conatains methods for user management
 */
class QuestionServiceProvider extends BaseServiceProvider {

    /**
     * function is used to change Password.
     * @param $data 
     * @return response string
     */
    public static function getQuestions($id) {
        try {
            $data['questions'] = SurveyQuestion::select('id', 'questions')->where('survey_id', $id)
                            ->orderBy('id', 'asc')->get();
            $response = static::responseSuccess(trans('messages.record_listed'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

    public static function addQuestion($data) {
        try {
            SurveyQuestion::create(['questions' => $data['name'], 'survey_id' => $data['survey_id']]);
            $response = static::responseSuccess(trans('messages.apis.user.record_saved'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

    public static function editQuestion($data) {
        try {
            SurveyQuestion::where('id', $data['question_id'])->update(['questions' => $data['name']]);
            $response = static::responseSuccess(trans('messages.apis.user.record_updated'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

}
