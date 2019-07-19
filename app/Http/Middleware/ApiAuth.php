<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: ApiAuth.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (21/08/2018) 
*/

namespace App\Http\Middleware;
use Closure;

use App\Http\Controllers\BaseController;
use App\Models\User;

class ApiAuth
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \Closure $next            
     * @return mixed
     */
    public function handle ($request, Closure $next)
    {
        $user = User::join('user_devices','users.id', '=', 'user_devices.user_id')
                ->where('user_devices.user_token', '=', $request->header('userToken'))
                ->where('user_devices.device_type', '=', $request->header('deviceType'))
                ->first();
        
        if (!$user) {
            $response['message'] = trans('messages.apis.unauthorised');
            $response['status']= false;
            $response['status_code'] = 401;
            $baseController = new BaseController();
            return $baseController->sendJsonResponse($response);
        }

        \Auth::loginUsingId($user->user_id);
        return $next($request);
    }
}