<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: ApiRequest.php
 * CodeLibrary/Project: Ezybin
 * Author:Ashish
 * CreatedOn: date (18/09/2018)
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ApiRequest {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \Closure $next            
     * @return mixed
     */
    public function handle($request, Closure $next) {

        return $next($request);
    }
    
     public function terminate($request)
    {
      Log::info('requests', [
            'request' => $request->all(),
            'userToken' => $request->header('userToken'),
            'deviceType' => $request->header('deviceType'),
            
        ]);
    }

}
