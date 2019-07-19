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
use App\Providers\Encounter\EncounterServiceProvider;
use App\Http\Requests\Encounters\AddEncounterStepOneRequest;
use App\Http\Requests\Encounters\AddEncounterStepTwoRequest;
use App\Http\Requests\Encounters\AddPartnerRequest;
use App\Http\Requests\Encounters\AddEncounterStepThreeRequest;
use App\Http\Requests\Encounters\AddEncounterStepFourRequest;
use App\Http\Requests\Encounters\AddEncounterStepFiveRequest;
use App\Http\Requests\Encounters\AddEncounterStepSixRequest;
use App\Http\Requests\Encounters\AddEncounterStepSevenRequest;
use App\Http\Requests\Encounters\AddRoomRequest;
use App\Http\Requests\Encounters\AddPositionRequest;
use App\Http\Requests\Encounters\DeleteEncounterRequest;
use App\Http\Requests\Encounters\DeleteRoomRequest;
use App\Http\Requests\Encounters\LongTermRelationRequest;
use App\Http\Requests\Encounters\RemovePartnerRequest;
use App\Http\Requests\Encounters\FavRoomRequest;
use App\Http\Requests\Encounters\FavPositionRequest;

class EncounterController extends BaseController {
    /*
     * Add Encounter Step 1
     */

    public function addEncounterStep1(AddEncounterStepOneRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep1($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Partners List
     */

    public function getPartnerList() {
        $response = EncounterServiceProvider::getPartnerList();
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Partner
     */

    public function addPartner(AddPartnerRequest $request) {
        $response = EncounterServiceProvider::addPartner($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 2
     */

    public function addEncounterStep2(AddEncounterStepTwoRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep2($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 3
     */

    public function addEncounterStep3(AddEncounterStepThreeRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep3($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 4
     */

    public function addEncounterStep4(AddEncounterStepFourRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep4($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 5
     */

    public function addEncounterStep5(AddEncounterStepFiveRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep5($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 6
     */

    public function addEncounterStep6(AddEncounterStepSixRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep6($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 7
     */

    public function addEncounterStep7(AddEncounterStepSevenRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep7($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Encounter Step 8
     */

    public function addEncounterStep8(DeleteEncounterRequest $request) {
        $response = EncounterServiceProvider::addEncounterStep8($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Protection List
     */

    public function getProtectionList() {
        $response = EncounterServiceProvider::getProtectionList();
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Toy List
     */

    public function getToyList() {
        $response = EncounterServiceProvider::getToyList();
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Room List
     */

    public function getRoomList() {
        $response = EncounterServiceProvider::getRoomList();
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Position List
     */

    public function getPositionList() {
        $response = EncounterServiceProvider::getPositionList();
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Room
     */

    public function addRoom(AddRoomRequest $request) {
        $response = EncounterServiceProvider::addRoom($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Position
     */

    public function addPosition(AddPositionRequest $request) {
        $response = EncounterServiceProvider::addPosition($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Delete Encounter
     */

    public function deleteEncounter(DeleteEncounterRequest $request) {
        $response = EncounterServiceProvider::deleteEncounter($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Delete Partner Flow
     */

    public function deletePartnerFlow(DeleteEncounterRequest $request) {
        $response = EncounterServiceProvider::deletePartnerFlow($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Delete Room
     */

    public function deleteRoom(DeleteRoomRequest $request) {
        $response = EncounterServiceProvider::deleteRoom($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Encounter List
     */

    public function getEncounterList(Request $request) {
        $response = EncounterServiceProvider::encounterList($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Get single encounter
     */

    public function getSingleEncounter($id) {
        $response = EncounterServiceProvider::singleEncounter($id);
        return $this->sendJsonResponse($response);
    }

    /*
     * Add Long Term Relationship
     */

    public function addLongTerm(LongTermRelationRequest $request) {
        $response = EncounterServiceProvider::addLongTerm($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Remove Long Term Relationship
     */

    public function removeLongTerm(LongTermRelationRequest $request) {
        $response = EncounterServiceProvider::removeLongTerm($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Remove PArtner
     */

    public function removePartner(RemovePartnerRequest $request) {
        $response = EncounterServiceProvider::removePartner($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Favourite Room
     */

    public function favRoom(FavRoomRequest $request) {
        $response = EncounterServiceProvider::favRoom($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Favourite Position
     */

    public function favPosition(FavPositionRequest $request) {
        $response = EncounterServiceProvider::favPosition($request->all());
        return $this->sendJsonResponse($response);
    }

    /*
     * Get Filter
     */

    public function getFilter() {
        $response = EncounterServiceProvider::filter();
        return $this->sendJsonResponse($response);
    }

}
