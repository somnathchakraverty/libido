<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: CheckEmailRequest.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (14/09/2017) 
 */

namespace App\Http\Requests\Users;


use Illuminate\Foundation\Http\FormRequest;


class ResetPasswordWebRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'verifyToken'=>'required',
            'password' => 'required|string|min:6|max:20',
            'passwordConfirmation' => 'required|same:password'
        ];
    }

    public function authorize() {
        return true;
    }

}
