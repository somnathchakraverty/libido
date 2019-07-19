<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UserServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish Ginotra
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Report;

use App\Providers\BaseServiceProvider;
use Auth;
use App\Models\Encounter;

/**
 * ReportServiceProvider class conatains methods for user management
 */
class ReportServiceProvider extends BaseServiceProvider {

    function __construct() {
        
    }

    /*
     * Get Record
     */

    public static function record() {

        $streak = Encounter::getUserStreak();
        $longDuration = Encounter::getLongestDuration();
        $longWithoutEncounter = Encounter::getLongestWithoutEncounter();
        $longWithoutIntercourse = Encounter::getLongestWithoutIntercourse();
        $achive = Encounter::achivement();
        $finalDuration = Encounter::duration("and MONTH(encounter_date) = MONTH(CURRENT_DATE())");

        $result['streak'] = $streak;
        $result['longestDuration'] = $longDuration;
        $result['longestWithoutEncounter'] = $longWithoutEncounter;
        $result['longestWithoutIntercourse'] = $longWithoutIntercourse;
        $result['achivement'] = $achive;
        $result['stats'] = $finalDuration;
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    /*
     * Get Stats
     */

    public static function stats() {
        $key = "and MONTH(encounter_date) = MONTH(CURRENT_DATE())";
        $favPosition = Encounter::favPosition($key);
        $favRoom = Encounter::favRoom($key);
        $favTime = Encounter::favTime($key);
        //dd($favTime);
        $sessionPerPartner = Encounter::sessionPerPartner($key);
        $daySincePosition = Encounter::daySincePosition();
        $daySinceRoom = Encounter::daySinceRoom();

        $result['favPosition'] = $favPosition;
        $result['favRoom'] = $favRoom;
        $result['favTime'] = $favTime;
        $result['sesPerPartner'] = $sessionPerPartner;
        $result['daySincePosition'] = $daySincePosition;
        $result['daySinceRoom'] = $daySinceRoom;
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    /*
     * Get Streak
     */

    public static function streak($data) {
        $k = self::getKey($data);

        $streak = Encounter::getUserStreak($k['key'], $k['key2']);
        $longDuration = Encounter::getLongestDuration($k['key'], $k['key2']);
        $longWithoutEncounter = Encounter::getLongestWithoutEncounter($k['key'], $k['key2'], $data['key']);
        $longWithoutIntercourse = Encounter::getLongestWithoutIntercourse($k['key'], $k['key2'], $data['key']);

        $result['streak'] = $streak;
        $result['longestDuration'] = $longDuration;
        $result['longestWithoutEncounter'] = $longWithoutEncounter;
        $result['longestWithoutIntercourse'] = $longWithoutIntercourse;


        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    public static function getKey($data) {
        if ($data['key'] == 'month') {
            $key = "and MONTH(encounter_date) = MONTH(CURRENT_DATE())";
        }
        if ($data['key'] == 'year') {
            $key = "AND YEAR(encounter_date) = YEAR(CURRENT_DATE())";
        }
        if ($data['key'] == 'week') {
            $key = "and YEARWEEK(encounter_date)=YEARWEEK(NOW())";
        }
        if ($data['key'] == 'quarter') {
            $key = "and QUARTER(encounter_date)=QUARTER(CURRENT_DATE())";
        }
        if ($data['key'] == 'daily') {
            $key = "and DATE(encounter_date) = DATE(CURDATE())";
        }

        $key2 = null;
        if (isset($data['partnerId']) && !empty($data['partnerId'])) {
            $key2 = "and encounter_partners.partner_id=" . $data['partnerId'];
        }
        return ['key' => $key, 'key2' => $key2];
    }

    /*
     * Get Average
     */

    public static function average($data) {
        $k = self::getKey($data);

        $finalDuration = Encounter::duration($k['key'], $k['key2']);

        //$result['stats'] = $finalDuration;
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $finalDuration);
    }

    /*
     * Get Favourite
     */

    public static function favourite($data) {
        $k = self::getKey($data);

        $position = Encounter::favPosition($k['key'], $k['key2']);
        $room = Encounter::favRoom($k['key'], $k['key2']);
        $time = Encounter::favTime($k['key'], $k['key2']);

        $result['favPosition'] = $position;
        $result['favRoom'] = $room;
        $result['favTime'] = $time;
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

    /*
     * Get Session
     */

    public static function session($data) {
        $k = self::getKey($data);

        $key3 = null;
        if (isset($data['positionId']) && !empty($data['positionId'])) {
            $key3 = "and encounter_positions.position_id=" . $data['positionId'];
        }
        $key4 = null;
        if (isset($data['roomId']) && !empty($data['roomId'])) {
            $key4 = "and encounter_rooms.room_id=" . $data['roomId'];
        }

        $session = Encounter::sessionPerPartner($k['key'], $k['key2'], $key3, $key4);
        //$result['sesPerPartner'] = $session;
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $session);
    }

    public static function achievement() {
        $achive = Encounter::achivementCount();
        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $achive);
    }

    public static function daySince($data) {
        $key = null;
        if (isset($data['partnerId']) && !empty($data['partnerId'])) {
            $key = "and encounter_partners.partner_id=" . $data['partnerId'];
        }

        $result['daySincePosition'] = Encounter::daySincePosition($key);
        $result['daySinceRoom'] = Encounter::daySinceRoom($key);

        return static::responseSuccess(trans('messages.apis.user.record_fetched'), $result);
    }

}
