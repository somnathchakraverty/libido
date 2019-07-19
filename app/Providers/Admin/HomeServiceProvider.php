<?php

/*
 * Copyright 2017-2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: AdminServiceProvider.php
 * CodeLibrary/Project: Libido
 * Author:Ashish
 * CreatedOn: date (26/09/2017) 
 */

namespace App\Providers\Admin;

use App\Providers\BaseServiceProvider;
use App\Models\Encounter;
use Auth;
use App\Models\EncounterPosition;
use App\Models\EncounterRoom;

/**
 * UserServiceProvider class conatains methods for user management
 */
class HomeServiceProvider extends BaseServiceProvider {

    public static function homePageDetail($data) {
        $city = $country = $cityName = $countryName = null;
        if (isset($data['city']) && !empty($data['city'])) {
            $city = " and city = '" . $data['city'] . "'";
            $cityName = $data['city'];
        }
        if (isset($data['country']) && !empty($data['country'])) {
            $city = " and country = '" . $data['country'] . "'";
            $countryName=$data['country'];
        }

        $e = Encounter::whereRaw("step = 8 and encounters.user_id != 1 " . $city . $country)->get();
        $encounterCount = $e->count();
        $userCount = Auth::user()->count();
        $avgSession = number_format($encounterCount / $userCount, 2);

        $fav['position'] = EncounterPosition::join('positions', 'positions.id', '=', 'encounter_positions.position_id')
                        ->join('encounters', 'encounters.id', '=', 'encounter_positions.encounter_id')
                        ->whereRaw("step = 8 and encounters.user_id != 1 " . $city . $country)
                        ->selectRaw('count(*) as c,name')
                        ->groupBy('name')
                        ->get()->toArray();
        //dd($fav['position'] );

        $fav['room'] = EncounterRoom::join('rooms', 'rooms.id', '=', 'encounter_rooms.room_id')
                        ->join('encounters', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                        ->whereRaw("step = 8 and encounters.user_id != 1 " . $city . $country)
                        ->selectRaw('count(*) as c,name')
                        ->groupBy('name')
                        ->get()->toArray();

        $totalPosition = EncounterPosition::join('encounters', 'encounters.id', '=', 'encounter_positions.encounter_id')
                ->whereRaw("step = 8 and encounters.user_id != 1 " . $city . $country)
                ->count();
        foreach ($fav['position'] as $k => $f) {
            $percentage = number_format($f['c'] * 100 / $totalPosition, 2);
            $fav['position'][$k]['p'] = $percentage;
        }
        $enc['solo'] = Encounter::getAllLongestWithoutEnc(1, null, $city, $country);
        $enc['partner'] = Encounter::getAllLongestWithoutEnc(2, 3, $city, $country);
        $enc['bestStreak'] = Encounter::getAllUserStreak($city, $country);
        $enc['longestDuration'] = Encounter::getAllLongestDuration($city, $country);
        $enc['longestWithoutIntercourse'] = Encounter::getAllLongestWithoutIntercourse($city, $country);


        $city = Encounter::select('city')->where('step', Encounter::STEP_EIGHT)->whereNotNull('city')->groupBy('city')->get();
        $country = Encounter::select('country')->where('step', Encounter::STEP_EIGHT)->whereNotNull('country')->groupBy('country')->get();

        return ['avgSession' => $avgSession, 'fav' => $fav, 'enc' => $enc, 'city' => $city, 'country' => $country, 'cityName' => $cityName, 'countryName' => $countryName];
    }

}
