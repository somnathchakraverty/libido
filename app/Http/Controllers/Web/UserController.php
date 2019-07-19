<?php

/*
 * Copyright 2017-2018 Appster LLP. 
 * All rights reserved.
 * File: UsersController.php
 * Project : libido
 * CreatedOn: date (19/Feb/2018) 
 */

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ResetPasswordWebRequest;

class UserController extends Controller {

    /** @var  data */
    public function __construct() {
        
    }

    /*
     * Get Reset Password Page
     */

    public function getResetPassword(Request $request) {
        $user = User::where('verification_token', $request->token)->first();
        if ($user) {
            $to_time = strtotime(date('Y-m-d H:i:s'));
            $from_time = strtotime($user->verify_code_validity);
//            $minutes = round(abs($to_time - $from_time) / config('constants.SIXTY'), config('constants.NUMERIC_TWO'));
//            if ($minutes > 1440) {
            if ($to_time > $from_time) {
                return view('expired-verify-email');
            }

            return view('reset-password')->with('token', $request->token);
        }

        return view('expired-verify-email');
    }

    /*
     * Reset Password
     */

    public function postResetPassword(ResetPasswordWebRequest $request) {
        try {
            $user = User::where('verification_token', $request->verifyToken)->first();
            if ($user) {
                $password = $request->password;
                $user->verification_token = null;
                $user->verify_code_validity = null;
                $user->password = \Hash::make($password, ['rounds' => 4]);
                $user->save();
                return view('successfully-changed');
            }
            return view('expired-verify-email');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
