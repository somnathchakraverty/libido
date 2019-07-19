<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: EncounterServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Encounter;

use App\Providers\BaseServiceProvider;
use App\Models\Encounter;
use Auth;
use App\Models\Partner;
use App\Models\EncounterPartner;
use App\Models\Condom;
use App\Models\EncounterCondom;
use App\Models\Toy;
use App\Models\EncounterToy;
use App\Models\Room;
use App\Models\EncounterRoom;
use App\Models\Position;
use App\Models\EncounterPosition;
use App\Models\EncounterOrgasam;
use DB;
use App\Models\FavouriteRoom;
use App\Models\FavouritePosition;

/**
 * UserServiceProvider class conatains methods for user management
 */
class EncounterServiceProvider extends BaseServiceProvider {
    /*
     * Add Encounter Step 1
     */

    public static function addEncounterStep1($data) {
        $encounter = Encounter::saveStepOne($data);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($encounter->id));
    }

    /*
     * Add Encounter Step 2
     */

    public static function addEncounterStep2($data) {
        $encounter = EncounterPartner::saveEncounterPartner($data);
        $data['step'] = Encounter::STEP_TWO;
        if ($data['isEdited'] == 0 || $data['isEdited'] == 2) {
            Encounter::updateStep($data);
        }
        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 3
     */

    public static function addEncounterStep3($data) {
        if ($data['isEdited'] == 0 || $data['isEdited'] == 2) {
            Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_THREE, 'is_protection_used' => $data['isProtectionUsed']]);
        } else {
            Encounter::where('id', $data['encounterId'])->update(['is_protection_used' => $data['isProtectionUsed']]);
        }

        if ($data['isProtectionUsed'] == 1) {
            if (isset($data['partners']) && !empty($data['partners'])) {
                EncounterPartner::updateEncounterPartner($data);
            }
            EncounterCondom::saveEncounterCondom($data);
        } else {
            EncounterCondom::deleteEncounterCondom($data);
            EncounterPartner::where('encounter_id', $data['encounterId'])->update(['is_protection_used' => 0]);
        }

        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 4
     */

    public static function addEncounterStep4($data) {
        if ($data['isEdited'] == 0 || $data['isEdited'] == 2) {
            Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_FOUR, 'is_toy_used' => $data['isToyUsed'], 'is_lublicant_used' => $data['isLubricationUsed'], 'is_intoxicant_used' => $data['isIntoxicantUsed'], 'is_intercourse' => $data['isIntercourse']]);
        } else {
            Encounter::where('id', $data['encounterId'])->update(['is_toy_used' => $data['isToyUsed'], 'is_lublicant_used' => $data['isLubricationUsed'], 'is_intoxicant_used' => $data['isIntoxicantUsed'], 'is_intercourse' => $data['isIntercourse']]);
        }

        if ($data['isToyUsed'] == 1) {
            EncounterToy::saveEncounterToy($data);
        } else {
            EncounterToy::deleteEncounterToy($data);
        }

        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 5
     */

    public static function addEncounterStep5($data) {
        Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_FIVE]);
        EncounterRoom::saveEncounterRoom($data);

        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 6
     */

    public static function addEncounterStep6($data) {
        if ($data['isEdited'] == 0 || $data['isEdited'] == 2) {
            Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_SIX]);
        }
        EncounterRoom::where('room_id', $data['roomId'])->where('encounter_id', $data['encounterId'])->delete();
        EncounterRoom::create(['room_id' => $data['roomId'], 'encounter_id' => $data['encounterId'], 'how_long' => $data['howLong']]);
        //EncounterRoom::where('room_id', $data['roomId'])->where('encounter_id', $data['encounterId'])->update(['how_long' => $data['howLong']]);
        EncounterPosition::saveEncounterPosition($data);

        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 7
     */

    public static function addEncounterStep7($data) {
        if ($data['isEdited'] == 0) {
            Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_SEVEN]);
        }
        if ($data['isEdited'] == 2) {
            Encounter::where('id', $data['encounterId'])->update(['step' => Encounter::STEP_EIGHT]);
        }
        EncounterRoom::where('room_id', $data['roomId'])->where('encounter_id', $data['encounterId'])->update(['no_of_orgasam' => $data['orgasam']]);
        if (isset($data['partners']) && !empty($data['partners'])) {
            EncounterOrgasam::saveEncounterOrgasam($data);
        }
        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Add Encounter Step 8
     */

    public static function addEncounterStep8($data) {
        $data['step'] = Encounter::STEP_EIGHT;
        Encounter::updateStep($data);

        return static::responseSuccess(trans('messages.apis.user.record_saved'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Get Partner List
     */

    public static function getPartnerList() {
        $partner = Partner::where('user_id', Auth::user()->id)->where('is_removed', 0)->with('mappedUsers')->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $partner);
    }

    /*
     * Get Protection List
     */

    public static function getProtectionList() {
        $protection = Condom::all();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $protection);
    }

    /*
     * Get Toy List
     */

    public static function getToyList() {
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), Toy::all());
    }

    /*
     * Get Rooms List
     */

    public static function getRoomList() {
        $room = Room::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $room);
    }

    /*
     * Get Rooms List
     */

    public static function getPositionList() {
        $position = Position::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $position);
    }

    public static function filter() {
        $result['position'] = Position::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get();
        $result['room'] = Room::where('user_id', Auth::user()->id)->orWhere('user_id', null)->get();
        $result['partner'] = Partner::where('user_id', Auth::user()->id)->where('is_removed', 0)->with('mappedUsers')->get();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    /*
     * Add Partner
     */

    public static function addPartner($data) {
        $username = null;
        if (isset($data['mappedUserId']) && !empty($data['mappedUserId'])) {
            $u = \App\Models\User::where('id', $data['mappedUserId'])->first();
            $username = $u->username;
            if ($data['mappedUserId'] == Auth::user()->id) {
                return static::responseError(trans('messages.apis.user.cannot_add_self'));
            }

            $par = Partner::where('user_id', Auth::user()->id)->where('mapped_user_id', $data['mappedUserId'])->where('is_removed', 1)->first();
            if ($par) {
                $par->is_removed = 0;
                $par->save();
                $par->username = $username;
                //$partner->isLongTermRelation = 0;
                return static::responseSuccess(trans('messages.apis.user.record_saved'), $par);
            }

            $p = Partner::where('user_id', Auth::user()->id)->where('mapped_user_id', $data['mappedUserId'])->first();
            if ($p) {
                return static::responseError('Partner already exist.');
            }
        }
        $partner = Partner::savePartner($data);

        $partner->username = $username;
        $partner->isLongTermRelation = 0;
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $partner);
    }

    /*
     * Add Room
     */

    public static function addRoom($data) {
        $room = Room::saveRoom($data);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $room);
    }

    /*
     * Add Position
     */

    public static function addPosition($data) {
        $position = Position::savePosition($data);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $position);
    }

    /*
     * Delete Encounter
     */

    public static function deleteEncounter($data) {
        Encounter::where('id', $data['encounterId'])->delete();
        return static::responseSuccess(trans('messages.apis.user.record_deleted'));
    }

    /*
     * Delete Partner Flow
     */

    public static function deletePartnerFlow($data) {
        Encounter::where('id', $data['encounterId'])->update(['is_protection_used' => 0, 'is_toy_used' => 0, 'is_intoxicant_used' => 0, 'is_lublicant_used' => 0, 'step' => Encounter::STEP_ONE]);
        EncounterPartner::deleteEncounterPartner($data);
        EncounterCondom::deleteEncounterCondom($data);
        EncounterToy::deleteEncounterToy($data);
        EncounterRoom::deleteEncounterRoom($data);
        EncounterPosition::deleteEncounterPosition($data);
        EncounterOrgasam::deleteEncounterOrgasam($data);
        return static::responseSuccess(trans('messages.apis.user.record_deleted'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Delete Room 
     */

    public static function deleteRoom($data) {
        EncounterRoom::deleteParticularRoom($data);
        EncounterPosition::deleteParticularPosition($data);
        EncounterOrgasam::deleteParticularOrgasam($data);

        return static::responseSuccess(trans('messages.apis.user.record_deleted'), self::getSingleEncounter($data['encounterId']));
    }

    /*
     * Get encounter list
     */

    public static function encounterList($data) {
        if (isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 10;
        }

        if (isset($data['offset']) && !empty($data['offset'])) {
            $offset = $data['offset'];
        } else {
            $offset = 0;
        }
        $finalArray = [];
        $encounter = Encounter::where('encounters.user_id', Auth::user()->id)
                        ->where('encounters.step', Encounter::STEP_EIGHT)
                        ->with(['encounterPartner', 'encounterCondom', 'encounterRoom', 'encounterToy'])
                        ->orderBy('encounters.encounter_date', 'DESC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get()->toArray();

        foreach ($encounter as $e) {
            $roomArray = [];
            foreach ($e['encounter_room'] as $room) {

                $favRoom = FavouriteRoom::where('room_id', $room['room_id'])->where('user_id', Auth::user()->id)->first();
                if ($favRoom) {
                    $fav = $favRoom->is_favourite;
                } else {
                    $fav = 0;
                }

                $room['rooms']['is_favourite'] = $fav;
                $room['encounter_orgasam'] = EncounterOrgasam::where('encounter_id', $room['encounter_id'])->where('room_id', $room['room_id'])->with(['partners'])->get();
                $room['encounter_position'] = EncounterPosition::where('encounter_id', $room['encounter_id'])->where('room_id', $room['room_id'])->with(['positions'])->get();

                foreach ($room['encounter_position'] as $k => $pos) {
                    $favPos = FavouritePosition::where('position_id', $pos->position_id)->where('user_id', Auth::user()->id)->first();
                    if ($favPos) {
                        $f = $favPos->is_favourite;
                    } else {
                        $f = 0;
                    }
                    $room['encounter_position'][$k]->positions->is_favourite = $f;
                }
                //dd($room['encounter_position']);
                $roomArray[] = $room;
            }
            $e['encounter_room'] = $roomArray;
            $e['duration'] = EncounterRoom::where('encounter_id', $e['id'])->sum('how_long');
            $finalArray[] = $e;
        }

        $result = collect($finalArray)->groupBy(['encounter_date']);
        //dd($result);

        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    /*
     * Single Encounter
     */

    public static function singleEncounter($id) {

        $e = Encounter::where('encounters.id', $id)
                ->with(['encounterPartner', 'encounterCondom', 'encounterRoom', 'encounterToy'])
                ->first();
        if ($e) {
            $encounter = self::getSingleEncounter($id);
            return static::responseSuccess(trans('messages.apis.user.record_fetched'), $encounter);
        }
        return static::responseSuccess(trans('messages.apis.user.record_not_fount'));
    }

//    public static function getSingleEncounter($id) {
//        $encounter = Encounter::where('encounters.id', $id)
//                ->with(['encounterPartner', 'encounterCondom', 'encounterRoom', 'encounterToy'])
//                ->first();
//
//        $encounter->duration = EncounterRoom::where('encounter_id', $id)->sum('how_long');
//
//        if (isset($encounter->encounterRoom)) {
//            foreach ($encounter->encounterRoom as $room) {
//
//                $favRoom = FavouriteRoom::where('room_id', $room->room_id)->where('user_id', Auth::user()->id)->first();
//                if ($favRoom) {
//                    $fav = $favRoom->is_favourite;
//                } else {
//                    $fav = 0;
//                }
//
//                $room->rooms->is_favourite = $fav;
//
//                $room->encounterOrgasam = EncounterOrgasam::where('encounter_id', $room->encounter_id)->where('room_id', $room->room_id)->with(['partners'])->get();
//                $room->encounterPosition = EncounterPosition::where('encounter_id', $room->encounter_id)->where('room_id', $room->room_id)->with(['positions'])->get();
//
//                foreach ($room->encounterPosition as $k => $pos) {
//                    //dd($room->encounterPosition[$k]->positions);
//                    $favPos = FavouritePosition::where('position_id', $pos->position_id)->where('user_id', Auth::user()->id)->first();
//                    if ($favPos) {
//                        $f = $favPos->is_favourite;
//                    } else {
//                        $f = 0;
//                    }
//                    $room->encounterPosition[$k]->positions->is_favourite = $f;
//                }
//            }
//        }
//
//
//        return $encounter;
//    }
    public static function getSingleEncounter($id) {
        $userId = Auth::user()->id;
        $encounter = Encounter::where('encounters.id', $id)
                ->with(['encounterPartner', 'encounterCondom', 'encounterRoom', 'encounterRoom.rooms.FavouriteRooms', 'encounterToy', 'encounterRoom.rooms.encounterOrgasam' => function($q) use ($id) {
                        return $q->where('encounter_id', $id)->with(['partners']);
                    }, 'encounterRoom.rooms.encounterPosition' => function($q) use ($id, $userId) {
                        return $q->where('encounter_id', $id)->with(['positions', 'positions.FavouritePositions' => function($q1) use($userId) {
                                        return $q1->where('user_id', $userId);
                                    }]);
                    }])
                ->first();


        $encounter->duration = EncounterRoom::where('encounter_id', $id)->sum('how_long');
        return $encounter;
    }

    /*
     * long term
     */

    public static function addLongTerm($data) {
//        $p = Partner::where('user_id', Auth::user()->id)->where('is_long_term_relation', 1)->first();
//        if ($p) {
//            return static::responseError('messages.apis.user.already_exist.');
//        }
        Partner::where('user_id', Auth::user()->id)->where('is_long_term_relation', 1)->update(['is_long_term_relation' => 0]);
        Partner::where('user_id', Auth::user()->id)->where('id', $data['partnerId'])->update(['is_long_term_relation' => 1]);
        return static::responseSuccess(trans('messages.apis.user.record_saved'));
    }

    public static function removeLongTerm($data) {
        Partner::where('user_id', Auth::user()->id)->where('id', $data['partnerId'])->update(['is_long_term_relation' => 0]);
        return static::responseSuccess(trans('messages.apis.user.record_saved'));
    }

    public static function removePartner($data) {
        Partner::where('user_id', Auth::user()->id)->where('id', $data['partnerId'])->update(['is_removed' => 1]);
        return static::responseSuccess(trans('messages.apis.user.record_deleted'));
    }

    public static function favRoom($data) {
        $room = FavouriteRoom::saveFavouriteRoom($data);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $room);
    }

    public static function favPosition($data) {
        $position = FavouritePosition::saveFavouritePosition($data);
        return static::responseSuccess(trans('messages.apis.user.record_saved'), $position);
    }

}
