<?php

/*
 * Copyright 2017-2018 Appster LLP
 * All rights reserved.
 * File: UserController.php
 * Project: Libido
 * Author: Ashish Ginotra
 * CreatedOn: date (21/08/2018) 
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Providers\User\UserServiceProvider;
use App\Http\Requests\Users\SignUpRequest;
use App\Models\User;
use App\Http\Requests\Users\SignInRequest;
use App\Http\Requests\Users\ForgotPasswordRequest;
use App\Http\Requests\Users\ResetPasswordRequest;
use App\Http\Requests\Users\CompleteProfileStepOneRequest;
use App\Http\Requests\Users\CompleteProfileStepTwoRequest;
use App\Http\Requests\Users\CompleteProfileStepThreeRequest;
use App\Http\Requests\Users\UpdateUsernameRequest;
use App\Http\Requests\Users\UserDetailUsernameRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\TouchIdRequest;
use Log;
use App\Models\Advertiser;
class UserController extends BaseController {
    /*
     * Sign up 
     */

    public function signUp(SignUpRequest $request) {
        $data = $request->all();
        $data['deviceType'] = $request->header('deviceType');
        $response = UserServiceProvider::signUp($data);
        return $this->sendJsonResponse($response);
    }

    /*
     * Email verification
     */

    public function emailVerification(Request $request) {
        $user = User::where('verification_token', $request->token)->first();
        if ($user) {
            $user->verification_token = null;
            $user->is_verified = 1;
            $user->save();
            return view('verify-email');
        }
        return view('expired-verify-email');
    }

    /*
     * Login
     */

    public function login(SignInRequest $request) {
        $data = $request->all();
        $data['deviceType'] = $request->header('deviceType');
        $response = UserServiceProvider::login($data);
        return $this->sendJsonResponse($response);
    }

    /*
     * Forgot Password
     */

    public function forgotPassword(ForgotPasswordRequest $request) {
        $response = UserServiceProvider::forgotPassword($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Reset Password
     */

    public function resetPassword(ResetPasswordRequest $request) {
        $response = UserServiceProvider::resetPassword($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Complete Profile Step1
     */

    public function completeProfileStep1(CompleteProfileStepOneRequest $request) {
        Log::info('data');
        Log::info($request->all());
        $response = UserServiceProvider::completeProfileStep1($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Complete Profile Step2
     */

    public function completeProfileStep2(CompleteProfileStepTwoRequest $request) {
        $response = UserServiceProvider::completeProfileStep2($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Complete Profile Step3
     */

    public function completeProfileStep3(CompleteProfileStepThreeRequest $request) {
        $response = UserServiceProvider::completeProfileStep3($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Logout
     */

    public function logout(Request $request) {
        $response = UserServiceProvider::logout();
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Profile
     */

    public function getProfile(Request $request) {
        $response = UserServiceProvider::getProfile();
        return $this->sendJsonResponse($response);
    }

    /*
     * Update UserName
     */

    public function updateUsername(UpdateUsernameRequest $request) {
        $response = UserServiceProvider::updateUsername($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * User details via username
     */

    public function getUserDetailUsername(UserDetailUsernameRequest $request) {
        $response = UserServiceProvider::userDetailUsername($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Change Password
     */

    public function postChangePassword(ChangePasswordRequest $request) {
        $response = UserServiceProvider::changePassword($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Terms Condition
     */

    public function termsCondition() {
        $response = UserServiceProvider::terms();
        return $this->sendJsonResponse($response);
    }

    /*
     * Privacy Policy
     */

    public function privacyPolicy() {
        $response = UserServiceProvider::policy();
        return $this->sendJsonResponse($response);
    }

    /*
     * Check for touch id
     */

    public function postTouchId(TouchIdRequest $request) {
        $response = UserServiceProvider::touchId($request->all());
        return $this->sendJsonResponse($response);
    }

    public function advertiserIcon(){
        return Advertiser::all();
    }
}
