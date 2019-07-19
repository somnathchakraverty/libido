<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: AdminServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Pushpendra Sengar
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Admin;
use App\Providers\BaseServiceProvider;
use App\Providers\User\UserServiceProvider;

/**
 * UserServiceProvider class conatains methods for user management
 */
class AdminServiceProvider extends BaseServiceProvider {


    /**
     * function is used to change Password.
     * @param $data 
     * @return response string
     */
    public static function changePassword($data) {
        try {
            $response = UserServiceProvider::changePassword($data);
        } catch (\Exception $e) {
            static::setExceptionError($e);
            $response = static::responseError(trans('messages.exception_msg'));
        }
        return $response;
    }

}
