<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (14/09/2017) 
 */

namespace App\Http\Requests\Users;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

class UpdateUsernameRequest extends LaravelFormRequest {
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
            'username' => 'required|unique:users',
        ];
    }

    public function authorize() {
        return true;
    }

    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors()->first();
        throw new HttpResponseException(response()->json(['message' => $errors,'status' => false,
            'statusCode' => config('constants.TWO_HUNDRED'),'result' => null
                ], JsonResponse::HTTP_OK)); 
    }

}
