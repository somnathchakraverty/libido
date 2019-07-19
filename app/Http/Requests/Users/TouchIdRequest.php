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

class TouchIdRequest extends LaravelFormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'touchId' => 'required|integer',
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

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors()->first();
        throw new HttpResponseException(response()->json(['message' => $errors,'status' => false,
            'statusCode' => config('constants.TWO_HUNDRED'),'result' => null
                ], JsonResponse::HTTP_OK)); 
    }

}   

//
//use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Http\JsonResponse;
//use Utilities;
//use App\Providers\BaseServiceProvider;
//
//class SignUpRequest extends FormRequest {
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//
//    /**
//     * Get the validation rules that apply to the request.
//     *
//     * @return array
//     */
//    public function rules() {
//
//        return [
//            'email' => 'required|email|unique:users',
//            'password' => 'required|string|min:6',
//            'userType' => 'in:2|required',
//                //'deviceType' => 'integer|required'
//        ];
//    }
//
//    public function authorize() {
//        return true;
//    }
//    
//    public function failedValidation(Validator $validator){
//        $messages = $validator->errors()->first();
//        return (new BaseServiceProvider())->responseError($messages);
//    }
//
//    public function formatErrors(Validator $validator) {
//        //return 'aaaaaa';
//        $messages = $validator->errors()->first();
//        return (new BaseServiceProvider())->responseError($messages);
//    }
//
//    public function response(array $errors) {
//        //return 'ssss';
//        return new JsonResponse($errors, config('constants.NUMERIC_TWO_HUNDRED'));
//    }
//
////    public function formatErrors(Validator $validator) {
////        $messages = $validator->errors()->first();
////        return Utilities::responseError($messages, config('constants.TWO_HUNDRED'));
////    }
////
////    public function response(array $errors) {
////        return new JsonResponse($errors, config('constants.TWO_HUNDRED'));
////    }
//
//}
