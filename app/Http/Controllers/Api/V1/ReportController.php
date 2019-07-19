<?php

/*
 * Copyright 2017-2018 Appster LLP
 * All rights reserved.
 * File: ReportController.php
 * Project: Libido
 * Author: Ashish Ginotra
 * CreatedOn: date (21/08/2018) 
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Providers\Report\ReportServiceProvider;
use App\Http\Requests\Reports\StreakRequest;

class ReportController extends BaseController {

    public function getRecord() {
        $response = ReportServiceProvider::record();
        return $this->sendJsonResponse($response);
    }

    public function getStats() {
        $response = ReportServiceProvider::stats();
        return $this->sendJsonResponse($response);
    }

    public function postStreak(StreakRequest $request) {
        $response = ReportServiceProvider::streak($request->all());
        return $this->sendJsonResponse($response);
    }

    public function getAchievement() {
        $response = ReportServiceProvider::achievement();
        return $this->sendJsonResponse($response);
    }

    public function postAverage(StreakRequest $request) {
        $response = ReportServiceProvider::average($request->all());
        return $this->sendJsonResponse($response);
    }

    public function postFavourite(StreakRequest $request) {
        $response = ReportServiceProvider::favourite($request->all());
        return $this->sendJsonResponse($response);
    }

    public function postSession(StreakRequest $request) {
        $response = ReportServiceProvider::session($request->all());
        return $this->sendJsonResponse($response);
    }

    public function postDaySince(Request $request) {
        $response = ReportServiceProvider::daySince($request->all());
        return $this->sendJsonResponse($response);
    }

}
