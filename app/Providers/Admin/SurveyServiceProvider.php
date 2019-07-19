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
use App\Models\Survey;

/**
 * UserServiceProvider class conatains methods for user management
 */
class SurveyServiceProvider extends BaseServiceProvider {

    /**
     * function is used to change Password.
     * @param $data 
     * @return response string
     */
    public static function getSurveys() {
        try {
            $data['surveys'] = Survey::select('id', 'name','is_active')
                            ->orderBy('id', 'asc')->get();
            $response = static::responseSuccess(trans('messages.record_listed'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

    public static function addSurvey($data) {
        try {
            Survey::create(['name' => $data['name'],'is_active'=>0]);
            $response = static::responseSuccess(trans('messages.apis.user.record_saved'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

}
