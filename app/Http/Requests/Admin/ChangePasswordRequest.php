<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: ChangePasswordRequest.php
 * CodeLibrary/Project: Libido
 * Author:saqib
 * CreatedOn: date (12/09/2017) 
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'oldPassword' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|different:oldPassword|same:password'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'password_confirmation.required'=>'Confirm Password field is required',
            'oldPassword.required'=>'Current Password field is required',
            'password.required'=>'New Password field is required',
            'password_confirmation.different'=>'Confirm Password and Current Password should not be same',
            'password_confirmation.same'=>'New Password and Confirm Password should be same',
            'password.confirmed' => 'Confirm Password does not match New Password',
            'password.different' => 'New Password should be different from Current password',
            'password.regex' => trans('messages.password_regex')
            ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
