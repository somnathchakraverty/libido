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

class AddToyRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'image' => 'mimes:jpeg,jpg,png|max:2048',
        ];
    }

    /**
     * @return array
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
