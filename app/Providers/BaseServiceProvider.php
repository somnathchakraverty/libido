<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: BaseServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (21/07/2017) 
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Twilio;

/**
 * BaseServiceProvider works as a base class for all user defined providers
 */
class BaseServiceProvider extends ServiceProvider {

    /**
     * Description : For all successful response.
     * @param type $message
     * @param type $data
     * @return array
     */
    public static function responseSuccess($message = '', $data = array(), $statusCode = Response::HTTP_OK) {
        $response = array(
            'status' => true,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => (object) $data,
        );

        return $response;
    }

    /**
     * Description : For all error response.
     * @param type $message
     * @param type $data
     * @return array
     */
    public static function responseError($message = '', $data = array(),$statusCode = Response::HTTP_OK) {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => null,
        );
        return $response;
    }

    public static function customResponse($message = '', $statusCode = '') {
        $response = array(
            'status' => false,
            'status_code' => 200,
            'response_code' => $statusCode,
            'message' => $message,
            'result' => null
        );
        return $response;
    }

    /**
     * Description : For Log all error response.
     * @param type Exception
     * */
    public static function setExceptionError(\Exception $e) {

        Log::error("There is some exception in " . $e->getFile() . " on line no: " . $e->getLine() . " Message: " . $e->getMessage());
    }

    /*
     * Send msg through twilio
     */

    public static function sendTwilioMessage($mob, $message) {
        try {
            Twilio::message($mob, $message);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /*
     * Genrate passcode
     */

    public static function generatePasscode() {
        return mt_rand(config('constants.ONE_THOUSAND'), config('constants.FOUR_NINE'));
    }

}
