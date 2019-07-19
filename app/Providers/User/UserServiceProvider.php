<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UserServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\BaseServiceProvider;
use App\Models\UserDevice;
use Config;
use Mail;
use Utilities;
use Auth;
use App\Jobs\Emailer;
use App\Models\UserDetail;
use App\Models\Partner;

/**
 * UserServiceProvider class conatains methods for user management
 */
class UserServiceProvider extends BaseServiceProvider {

    function __construct() {
        
    }

    /*
     * Sign Up
     */

    public static function signUp($data) {
        $data['token'] = static::sendVerificationEmail($data['email']);
        $result = User::saveUser($data);
        UserDevice::saveUserDevice($result->id, $data);

        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId($result->id));
    }

    /*
     * Send verification email
     */

    public static function sendVerificationEmail($email) {

        $tokenHash = substr(uniqid() . time(), -16);

        $mailData = [
            'data' => ['url' => url('/api/email-verification') . '?token=' . $tokenHash]
        ];

        Mail::send('emails.verification-email', $mailData, function($message) use($email) {
            $message->to($email)->subject(trans('messages.apis.account_verify_mail'));

            $message->from(config('constants.ADMIN_EMAIL'), config('constants.ORG_NAME'));
        });
        return $tokenHash;
    }

    /*
     * Login a user
     */

    public static function login($data) {

        $user = User::where('role', User::ROLE_APPUSER)
                ->where('email', '=', $data['email'])
                ->first();

        if (!$user) {
            return static::responseError(trans('messages.apis.user.account_not_exist'));
        }

        if ($user->is_active == 0) {
            return static::responseError(trans('messages.apis.user.not_activated'));
        }

        if (Hash::check($data['password'], $user->password)) {
//            UserDevice::saveUserDevice($user->id, $data);
//            $u = User::getUserViaId($user->id);
//            $user->save();
            $d = UserDevice::saveUserDevice($user->id, $data);
            $user->userToken = "$d->user_token";
            //echo $d->user_token;exit;
            //$u = User::getUserViaId($user->id);
            //$user->save();

            return static::responseSuccess(trans('messages.apis.user.logged_in'), $user);
        }
        return static::responseError(trans('messages.apis.user.credential_not_matched'));
    }

    /*
     * Complete Profile Step 1
     */

    public static function completeProfileStep1($data) {
        $user = User::find(Auth::user()->id);
        if (isset($data['image']) && !empty($data['image'])) {
            $fileName = Utilities::saveAwsImage($data['image']);
            $user->image = $fileName;
            Partner::where('mapped_user_id', Auth::user()->id)->update(['image' => $fileName]);
        }
        $user->firstname = $data['firstName'];
        $user->lastname = $data['lastName'];

        if (!isset($data['isEdited'])) {
            $user->profile_step = User::STEP_ONE;
        }
        $user->save();
        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId($user->id));
    }

    /*
     * Complete Profile Step 1
     */

    public static function completeProfileStep2($data) {
        $user = User::find(Auth::user()->id);
        $user->dob = $data['dob'];
        $user->gender = $data['gender'];
        $user->relationship_status = $data['relationship'];
        if (!isset($data['isEdited'])) {
            $user->profile_step = User::STEP_TWO;
        }
        $user->save();
        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId($user->id));
    }

    /*
     * Complete Profile Step 1
     */

    public static function completeProfileStep3($data) {
        $user = User::find(Auth::user()->id);
        $user->height = $data['height'];
        $user->weight = $data['weight'];
        $user->birth_control = $data['birthControl'];
        if (!isset($data['isEdited'])) {
            $user->profile_step = User::STEP_THREE;
        }
        $user->save();
        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId($user->id));
    }

    /*
     * Change user's password
     */

    public static function changePassword($data) {
        if (Hash::check($data['oldPassword'], Auth::user()->password)) {
            User::where('id', Auth::user()->id)
                    ->update(['password' => Hash::make($data['password'], ['rounds' => 4])]);
            return static::responseSuccess(trans('messages.apis.user.password_changed'), User::getUserViaId(Auth::user()->id));
        }
        return static::responseError(trans('messages.apis.user.old_not_correct'));
    }

    /*
     * Logout a user
     */

    public static function logout() {
        UserDevice::where('user_id', Auth::user()->id)->delete();
        return static::responseSuccess(trans('messages.apis.user.logout'));
    }

    /*
     * Get Profile
     */

    public static function getProfile() {
        //echo Auth::user()->id;exit;

        $user = User::where('id', Auth::user()->id)->first();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $user);
    }

    /*
     * Forgot Password
     */

    public static function forgotPassword($data) {
        $userEmail = User::where([['email', '=', $data['email']], ['is_active', '=', User::IS_ACTIVATED], ['role', '=', User::ROLE_APPUSER]])
                ->first();
        if ($userEmail) {
            $r = static::forgotPasswordMail($userEmail);
            $userEmail->verification_token = $r['token'];
            $userEmail->verify_code_validity = $r['oneDay'];
            $userEmail->save();
            return static::responseSuccess(trans('messages.apis.user.verification_mail_send'));
        }

        return static::responseError(trans('messages.apis.user.neither_reg_nor_verified'));
    }

    /*
     * Forgot Password Mail
     */

    public static function forgotPasswordMail($userEmail) {

        $Oneday = date("Y-m-d H:i:s", time() + 86400);
        $tokenHash = substr(uniqid() . time(), -16);

        $customerName = ucwords($userEmail->firstname . ' ' . $userEmail->lastname);
        $subject = trans('messages.apis.user.forgot_password');
        $emailData = ['email' => $userEmail->email, 'name' => $customerName, 'subject' => $subject, 'link' => url('/user/reset-password') . '?token=' . $tokenHash, 'org_name' => config('constants.ORG_NAME')];
        $arrData = ['emailTemplate' => 'emails.forgot-password', 'emailData' => $emailData];
        Emailer::dispatch($arrData);

        return ['oneDay' => $Oneday, 'token' => $tokenHash];
    }

    /*
     * Reset Password
     */

    public static function resetPassword($data) {
        $user = User::find($data['userId']);
        if ($user) {
            $user->password = Hash::make($data['password'], ['rounds' => 4]);
            $user->verification_token = null;
            $user->verify_code_validity = null;
            $user->save();
            return static::responseSuccess(trans('messages.apis.user.password_changed'));
        }
        return static::responseError(trans('messages.apis.user.user_not_found'));
    }

    /*
     * Update Username
     */

    public static function updateUsername($data) {
        User::where('id', Auth::user()->id)->update(['username' => $data['username']]);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId(Auth::user()->id));
    }

    /*
     * USer details via username
     */

    public static function userDetailUsername($data) {
        $user = User::where('username', $data['username'])->first();
        if ($user) {
            return static::responseSuccess(trans('messages.apis.user.record_fetched'), $user);
        }
        return static::responseError('Record not found.');
    }

    /*
     * Terms
     */

    public static function terms() {
        $terms = 'Terms and Conditions. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lacus mi, condimentum non congue id, egestas non lectus. Fusce ante ipsum, tincidunt vitae diam et, pellentesque porta lectus. Nulla vitae ornare mi. In vitae eros vel urna lobortis rhoncus. Sed in cursus nulla, sed convallis massa. Proin ut dolor a ex blandit volutpat a ac enim. Duis ipsum quam, molestie non vulputate vel, malesuada vehicula lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam tristique pretium nisi vitae mattis. Phasellus euismod augue in mauris elementum mollis. Donec luctus magna ac enim consectetur pharetra. Etiam ac libero eget erat pellentesque rhoncus. Cras sed rhoncus odio.';
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $terms);
    }

    /*
     * Policy
     */

    public static function policy() {
        $terms = 'Privacy Policy. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lacus mi, condimentum non congue id, egestas non lectus. Fusce ante ipsum, tincidunt vitae diam et, pellentesque porta lectus. Nulla vitae ornare mi. In vitae eros vel urna lobortis rhoncus. Sed in cursus nulla, sed convallis massa. Proin ut dolor a ex blandit volutpat a ac enim. Duis ipsum quam, molestie non vulputate vel, malesuada vehicula lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam tristique pretium nisi vitae mattis. Phasellus euismod augue in mauris elementum mollis. Donec luctus magna ac enim consectetur pharetra. Etiam ac libero eget erat pellentesque rhoncus. Cras sed rhoncus odio.';
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $terms);
    }

    /*
     * touch id enabled
     */

    public static function touchId($data) {
        User::where('id', Auth::user()->id)->update(['is_touch_id_enable' => $data['touchId']]);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), User::getUserViaId(Auth::user()->id));
    }

}
