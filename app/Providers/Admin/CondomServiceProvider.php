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
use App\Models\Condom;

/**
 * UserServiceProvider class conatains methods for user management
 */
class CondomServiceProvider extends BaseServiceProvider {

    /**
     * function is used to change Password.
     * @param $data 
     * @return response string
     */
    public static function getCondoms() {
        try {
            $data['condoms'] = Condom::select('id', 'name')
                            ->orderBy('id', 'asc')->get();
            $response = static::responseSuccess(trans('messages.record_listed'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

    public static function addCondom($data) {
        try {
            Condom::create(['name' => $data['name']]);
            $response = static::responseSuccess(trans('messages.apis.user.record_saved'), $data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

}
