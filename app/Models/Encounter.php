<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Encounter extends Model {

    use SoftDeletes;

    protected $table = 'encounters';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];

    const STEP_ONE = 1;
    const STEP_TWO = 2;
    const STEP_THREE = 3;
    const STEP_FOUR = 4;
    const STEP_FIVE = 5;
    const STEP_SIX = 6;
    const STEP_SEVEN = 7;
    const STEP_EIGHT = 8;

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id')->with(['FavouriteRooms', 'FavouritePositions']);
    }

    public function tags() {
        return $this->belongsTo(User::class, 'tag_id', 'id');
    }

    public function encounterPartner() {
        return $this->hasMany(EncounterPartner::class, 'encounter_id', 'id')->with(['partners']);
    }

    public function encounterCondom() {
        return $this->hasMany(EncounterCondom::class, 'encounter_id', 'id')->with(['condoms']);
    }

    public function encounterOrgasam() {
        return $this->hasMany(EncounterOrgasam::class, 'encounter_id', 'id');
    }

    public function encounterPosition() {
        return $this->hasMany(EncounterPosition::class, 'encounter_id', 'id')->with(['positions']);
    }

    public function encounterRoom() {
        return $this->hasMany(EncounterRoom::class, 'encounter_id', 'id')->with(['rooms']);
    }

    public function encounterToy() {
        return $this->hasMany(EncounterToy::class, 'encounter_id', 'id')->with(['toys']);
    }

    public static function saveStepOne($data) {
        if (isset($data['encounterId']) && !empty($data['encounterId'])) {
            $encounter = Encounter::find($data['encounterId']);
        } else {
            $encounter = new Encounter();
        }

        if (isset($data['location']) && !empty($data['location'])) {
            $encounter->location = $data['location'];
        }
        $encounter->user_id = Auth::user()->id;
        $encounter->session_type = $data['sessionType'];
        $actDate = $data['date'] . ' ' . $data['time'];
//        $encounter->encounter_date = date('Y-m-d', strtotime($actDate) - $data['offset']);
//        $encounter->encounter_time = date('H:i:s', strtotime($data['time']) - $data['offset']);
        $encounter->encounter_date = $data['date'];
        $encounter->encounter_time = $data['time'];
        $encounter->timezone = $data['timezone'];
        $encounter->offset = $data['offset'];
        $encounter->city = $data['city'];
        $encounter->country = $data['country'];
        if ($data['isEdited'] == 0 || $data['isEdited'] == 2) {
            $encounter->step = Encounter::STEP_ONE;
        }
        $encounter->save();
        return $encounter;
    }

    public static function updateStep($data) {
        return Encounter::where('id', $data['encounterId'])->update(['step' => $data['step']]);
    }

    public static function getUserStreak($key = null, $key2 = null) {
//        $currentMonth = date('m');
//        $encounter = Encounter::where('user_id', Auth::user()->id)
//                ->whereRaw('MONTH(encounter_date) = ?', [$currentMonth])
//                ->whereRaw('year(encounter_date) = ?', array(date('Y')))
//                ->get();
        $encounter = DB::select("SELECT MAX(streak_count) AS number from ( SELECT COUNT(*) streak_count FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE user_id = " . Auth::user()->id . " and encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8 " . $key . "  " . $key2 . " ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r GROUP BY gn ) t ");
        if ($encounter) {
            if ($encounter[0]->number != null) {
                return $encounter[0]->number;
            }

            return 0;
        }
    }

    public static function getAllUserStreak($city, $country) {
        $encounter = DB::select("SELECT MAX(streak_count) AS number from ( SELECT COUNT(*) streak_count FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE  encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8  and encounters.user_id != 1 " . $city . $country . " ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r GROUP BY gn ) t ");
        if ($encounter) {
            if ($encounter[0]->number != null) {
                return $encounter[0]->number;
            }

            return 0;
        }
    }

    public static function getLongestDuration($key = null, $key2 = null) {
        $encounterList = Encounter::leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                ->where('user_id', Auth::user()->id)//->where('step', Encounter::STEP_EIGHT)
                ->whereRaw("step = 8 " . $key . ' and encounter_partners.deleted_at is null ' . $key2)
                ->pluck('encounters.id');

        $e = EncounterRoom::selectRaw('sum(how_long) as sum')
                        ->whereIn('encounter_id', $encounterList)->groupBy('encounter_id')
                        ->orderBy('sum', 'desc')->first();
        if ($e) {
            return $e->sum;
        } else {
            return 0;
        }
    }

    public static function getAllLongestDuration($city, $country) {
        $encounterList = Encounter::leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                ->whereRaw("step = 8  and encounters.user_id != 1 " . $city . $country . " and encounter_partners.deleted_at is null")
                ->pluck('encounters.id');

        $e = EncounterRoom::selectRaw('sum(how_long) as sum')
                        ->whereIn('encounter_id', $encounterList)->groupBy('encounter_id')
                        ->orderBy('sum', 'desc')->first();
        if ($e) {
            return $e->sum;
        } else {
            return 0;
        }
    }

    public static function longestDiffernce($array, $d) {
        $signUpDate = Auth::user()->created_at->format('Y-m-d');
        $firstEncounterDate = Encounter::where('user_id', Auth::user()->id)->where('step', Encounter::STEP_EIGHT)
                        ->orderBy('encounter_date', 'ASC')->first();
        //dd($firstEncounterDate->encounter_date);
        if ($d == 'month') {
            $monthDate = date('Y-m') . '-01';
            if ($firstEncounterDate) {
                $firstEDate = $firstEncounterDate->encounter_date;

                if ((strtotime($monthDate) >= strtotime($signUpDate)) && strtotime($monthDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $monthDate);
                } else if ((strtotime($monthDate) >= strtotime($signUpDate)) && strtotime($monthDate) <= strtotime($firstEDate)) {
                    array_unshift($array, $monthDate);
                } else if ((strtotime($monthDate) <= strtotime($signUpDate)) && strtotime($monthDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $monthDate);
                } else if ((strtotime($monthDate) <= strtotime($signUpDate)) && strtotime($monthDate) <= strtotime($firstEDate)) {
                    if (strtotime($firstEDate) <= strtotime($signUpDate)) {
                        array_unshift($array, $firstEDate);
                    } else {
                        array_unshift($array, $signUpDate);
                    }
                }
            } else {
                if (strtotime($signUpDate) >= strtotime($monthDate)) {
                    array_unshift($array, $signUpDate);
                } else {
                    array_unshift($array, $monthDate);
                }
            }
        }
        if ($d == 'year') {
            $yearDate = date('Y') . '-01-01';
            if ($firstEncounterDate) {
                $firstEDate = $firstEncounterDate->encounter_date;

                if ((strtotime($yearDate) >= strtotime($signUpDate)) && strtotime($yearDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $yearDate);
                } else if ((strtotime($yearDate) >= strtotime($signUpDate)) && strtotime($yearDate) <= strtotime($firstEDate)) {
                    array_unshift($array, $yearDate);
                } else if ((strtotime($yearDate) <= strtotime($signUpDate)) && strtotime($yearDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $yearDate);
                } else if ((strtotime($yearDate) <= strtotime($signUpDate)) && strtotime($yearDate) <= strtotime($firstEDate)) {
                    if (strtotime($firstEDate) <= strtotime($signUpDate)) {
                        array_unshift($array, $firstEDate);
                    } else {
                        array_unshift($array, $signUpDate);
                    }
                }
            } else {

                if (strtotime($signUpDate) >= strtotime($yearDate)) {
                    array_unshift($array, $signUpDate);
                } else {
                    array_unshift($array, $yearDate);
                }
            }
        }

        if ($d == 'quarter') {
            $offset = (date('n') % 3) - 1;
            $start = new \DateTime("first day of -$offset month midnight");

            $quarterDate = $start->format('Y-m-d');
            if ($firstEncounterDate) {
                $firstEDate = $firstEncounterDate->encounter_date;

                if ((strtotime($quarterDate) >= strtotime($signUpDate)) && strtotime($quarterDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $quarterDate);
                } else if ((strtotime($quarterDate) >= strtotime($signUpDate)) && strtotime($quarterDate) <= strtotime($firstEDate)) {
                    array_unshift($array, $quarterDate);
                } else if ((strtotime($quarterDate) <= strtotime($signUpDate)) && strtotime($quarterDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $quarterDate);
                } else if ((strtotime($quarterDate) <= strtotime($signUpDate)) && strtotime($quarterDate) <= strtotime($firstEDate)) {
                    if (strtotime($firstEDate) <= strtotime($signUpDate)) {
                        array_unshift($array, $firstEDate);
                    } else {
                        array_unshift($array, $signUpDate);
                    }
                }
            } else {

                if (strtotime($signUpDate) >= strtotime($quarterDate)) {
                    array_unshift($array, $signUpDate);
                } else {
                    array_unshift($array, $quarterDate);
                }
            }
        }
        if ($d == 'week') {
            $currentDay = date('d');
            $floorDate = floor($currentDay / 7.1);
            //dd($floorDate);
            if ($floorDate == 0) {
                $weekDate = date('Y-m') . '-01';
            }
            if ($floorDate == 1) {
                $weekDate = date('Y-m') . '-08';
            }
            if ($floorDate == 2) {
                $weekDate = date('Y-m') . '-15';
            }
            if ($floorDate == 3) {
                $weekDate = date('Y-m') . '-22';
            }
            if ($floorDate == 4) {
                $weekDate = date('Y-m') . '-29';
            }


            if ($firstEncounterDate) {
                $firstEDate = $firstEncounterDate->encounter_date;

                if ((strtotime($weekDate) >= strtotime($signUpDate)) && strtotime($weekDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $weekDate);
                } else if ((strtotime($weekDate) >= strtotime($signUpDate)) && strtotime($weekDate) <= strtotime($firstEDate)) {
                    array_unshift($array, $weekDate);
                } else if ((strtotime($weekDate) <= strtotime($signUpDate)) && strtotime($weekDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $weekDate);
                } else if ((strtotime($weekDate) <= strtotime($signUpDate)) && strtotime($weekDate) <= strtotime($firstEDate)) {
                    if (strtotime($firstEDate) <= strtotime($signUpDate)) {
                        array_unshift($array, $firstEDate);
                    } else {
                        array_unshift($array, $signUpDate);
                    }
                }
            } else {

                if (strtotime($signUpDate) >= strtotime($weekDate)) {
                    array_unshift($array, $signUpDate);
                } else {
                    array_unshift($array, $weekDate);
                }
            }
        }
        if ($d == null) {
            if ($firstEncounterDate) {
                $firstEDate = $firstEncounterDate->encounter_date;
                if (strtotime($signUpDate) >= strtotime($firstEDate)) {
                    array_unshift($array, $firstEDate);
                } else {
                    array_unshift($array, $signUpDate);
                }
            } else {
                array_unshift($array, $signUpDate);
            }
        }

        array_push($array, date('Y-m-d'));

        $maxDiff = 0;
        $maxStart = NULL;
        $maxEnd = NULL;

        for ($i = 1; $i <= count($array); $i++) {
            if (isset($array[$i])) {
                $diff = (strtotime($array[$i]) - strtotime($array[$i - 1])) / (60 * 60 * 24);

                if ($diff > $maxDiff) {
                    $maxDiff = $diff;
                    $maxStart = $array[$i - 1];
                    $maxEnd = $array[$i];
                }
            }
        }
        return $maxDiff;
    }

    public static function getLongestWithoutEncounter($key = null, $key2 = null, $d = null) {
        $array1 = DB::select("SELECT MIN(encounter_date) as start_date  FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE user_id = " . Auth::user()->id . " and encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8 " . $key . "  " . $key2 . " ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r GROUP BY gn ");

        $array = array_map(function($a) {
            return $a->start_date;
        }, $array1);

        $endDate = end($array);
        $currentDate = date('Y-m-d');

        $arr = DB::select("SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE user_id = " . Auth::user()->id . " and encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8 " . $key . "  " . $key2 . " and (encounter_date BETWEEN '" . $endDate . "' AND '" . $currentDate . "') ORDER BY encounter_date");
        $array2 = array_map(function($a) {
            return $a->encounter_date;
        }, $arr);

        $b = array_merge($array, $array2);


        return self::longestDiffernce($b, $d);
    }

    public static function getAllLongestWithoutEnc($s1, $s2 = null, $city, $country) {
        //dd($sessionType);

        if ($s2 == null) {
            $val = $s1;
        } else {
            $val = $s1 . ',' . $s2;
        }
        $array1 = DB::select("SELECT MIN(encounter_date) as start_date  FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE session_type IN (" . $val . ") and encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8 and encounters.user_id != 1 " . $city . $country . "  ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r GROUP BY gn ");

        $array = array_map(function($a) {
            return $a->start_date;
        }, $array1);

        $endDate = end($array);
        $currentDate = date('Y-m-d');

        $arr = DB::select("SELECT Distinct encounter_date FROM encounters left join encounter_partners on encounters.id=encounter_partners.encounter_id WHERE session_type IN (" . $val . ") and encounter_partners.deleted_at is null and encounters.deleted_at is null and step = 8 and encounters.user_id != 1 " . $city . $country . "  and (encounter_date BETWEEN '" . $endDate . "' AND '" . $currentDate . "') ORDER BY encounter_date");
        $array2 = array_map(function($a) {
            return $a->encounter_date;
        }, $arr);

        $b = array_merge($array, $array2);

        $d = null;
        return self::longestDiffernce($b, $d);
    }

    public static function getLongestWithoutIntercourse($key = null, $key2 = null, $d = null) {
        $r = Encounter::leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                        ->selectRaw('Distinct (encounter_date)')
                        ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_partners.deleted_at')
                        ->where('encounters.is_intercourse', 1)
                        ->whereRaw("step='8'  " . $key . "  " . $key2)
                        ->groupBy('encounter_date')
                        ->get()->toArray();
        $array = array_map(function($a) {
            return $a['encounter_date'];
        }, $r);

        return self::longestDiffernce($array, $d);
    }

    public static function getAllLongestWithoutIntercourse($city, $country) {
        $r = Encounter::leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                        ->selectRaw('Distinct (encounter_date)')
                        ->wherenull('encounter_partners.deleted_at')
                        ->where('encounters.is_intercourse', 1)
                        ->whereRaw("step='8'  and encounters.user_id != 1 " . $city . $country . "  ")
                        ->groupBy('encounter_date')
                        ->get()->toArray();
        $array = array_map(function($a) {
            return $a['encounter_date'];
        }, $r);
        $d = null;
        return self::longestDiffernce($array, $d);
    }

    public static function getPercentage($numerator, $denominator) {
        if ($numerator > 0) {
            $final = $numerator * 100 / $denominator;
            if ($final > 100) {
                $final = 100;
            }
            return number_format($final, 2);
        }
        return 0;
    }

    public static function getPercentageActual($numerator, $denominator) {
        if ($numerator > 0) {
            $final = $numerator * 100 / $denominator;
            return number_format($final, 2);
        }
        return 0;
    }

    public static function getAchivementDetails() {
        $encounter = Encounter::where('user_id', Auth::user()->id)->where('step', Encounter::STEP_EIGHT)
                ->with(['encounterToy', 'encounterPosition', 'encounterRoom'])
                ->orderBy('encounter_date', 'ASC')
                ->get();

        $newTimeArray = [];
        $newTimeArray1 = [];
        $newTimeArray2 = [];
        $newTimeArray3 = [];
        $newTimeArray4 = [];
        $newTimeArray5 = [];
        $newTimeArray6 = [];
        $newTimeArray7 = [];

        foreach ($encounter as $e) {
//            $newTime = date('H:i:s', strtotime($e->encounter_time) + $e->offset);
            $newTime = $e->encounter_time;

            if (($newTime > "23:00:00" && $newTime <= "23:59:59") || ($newTime >= "00:00:00" && $newTime < "01:00:00")) {
                $newTimeArray[] = $newTime;
            }
            if ($newTime > "05:00:00" && $newTime < "09:00:00") {
                $newTimeArray1[] = $newTime;
            }
            if ($newTime > "14:00:00" && $newTime < "17:00:00") {
                $newTimeArray2[] = $newTime;
            }
            if ($e->encounterToy->count() > 0) {
                $newTimeArray3[] = $newTime;
            }
            if ($e->encounterRoom->count() > 1 && $e->encounterPosition->count() > 3) {
                $newTimeArray4[] = $newTime;
            }

            foreach ($e->encounterRoom as $r) {
                if ($r->rooms->is_outside == 1) {
                    $newTimeArray6[] = $newTime;
                }
            }

            $achiveEnc = Encounter::where('encounter_date', '>', $e->encounter_date)->where('user_id', Auth::user()->id)->where('step', Encounter::STEP_EIGHT)
                    ->orderBy('encounter_date', 'ASC')
                    ->limit('29')
                    ->get();

            if ($achiveEnc->count() > 28) {

                $diff = date_diff(date_create($e->encounter_date), date_create($achiveEnc->last()->encounter_date));
                if ($diff->d < 31) {
                    $newTimeArray5[] = $newTime;
                }
            }

            $oldDate = $e->encounter_date . ' ' . $e->encounter_time;
            $timeStamp = strtotime($oldDate);
            $weekday = date('N', $timeStamp);


            if ($weekday == 6 || $weekday == 7) {
                $weekEndNumber = date("W", $timeStamp);
                $newTimeArray7[$weekEndNumber][] = $newTime;
            }
        }

        return ['newTimeArray' => $newTimeArray, 'newTimeArray1' => $newTimeArray1, 'newTimeArray2' => $newTimeArray2, 'newTimeArray3' => $newTimeArray3, 'newTimeArray4' => $newTimeArray4, 'newTimeArray5' => $newTimeArray5, 'newTimeArray6' => $newTimeArray6, 'newTimeArray7' => $newTimeArray7, 'encounter' => $encounter];
    }

    public static function achivementCount() {

        $result = self::getAchivementDetails();

        $encounter = $result['encounter'];

        $achive8 = 0;
        if ($encounter->count() > 49) {
            $achive8 = $encounter->count() * 2;
        }

        $enc = DB::select("select encounter_date from encounters WHERE user_id = " . Auth::user()->id . " and deleted_at is null and step = 8 group by encounter_date having count(*)>2");

        $achive9 = 0;
        if (count($enc) > 0) {
            $achive9 = (count($enc)) * 100;
        }

        $lastValue = [];
        $count = array_map('count', $result['newTimeArray7']);
        foreach ($count as $c) {
            if ($c >= 5) {
                $lastValue[] = $c;
            }
        }
        //dd(count($lastValue));
        $achive10 = count($lastValue) * 100;


        $achive1 = self::getPercentageActual(count($result['newTimeArray']), 5);
        $achive2 = self::getPercentageActual(count($result['newTimeArray1']), 6);
        $achive3 = self::getPercentageActual(count($result['newTimeArray2']), 1);
        $achive4 = self::getPercentageActual(count($result['newTimeArray3']), 10);
        $achive5 = self::getPercentageActual(count($result['newTimeArray4']), 1);
        $achive6 = self::getPercentageActual(count($result['newTimeArray5']), 1);
        $achive7 = self::getPercentageActual(count($result['newTimeArray6']), 2);
//        $achive10 = self::getPercentageActual(count($result['newTimeArray7']), 5);
        return [['value' => $achive1, 'name' => 'Late_Night_Delight', 'desc' => 'late night delight. Enter an encounter 5 times after 11pm and before 1am'], ['value' => $achive2, 'name' => 'Good_Morning_Sunshine', 'desc' => 'good morning sunshine: enter 6 morning sessions between 5am-9am'], ['value' => $achive3, 'name' => 'Midday_Madness', 'desc' => 'midday madness: enter an encounter between 2pm-5pm'], ['value' => $achive4, 'name' => 'Titillating_Toys', 'desc' => 'record 10 encounters having a toy involved'], ['value' => $achive5, 'name' => 'Explorer', 'desc' => 'record an encounter that involves more than two rooms and 4 positions'], ['value' => $achive6, 'name' => '30_Not_Out', 'desc' => 'the 30 day challenge: record 30 encounters ( in 30 days )'], ['value' => $achive7, 'name' => 'Horticulturist', 'desc' => 'record 2 sessions that involves being outside of a house environment'], ['value' => $achive8, 'name' => 'Half_Century', 'desc' => 'record 50 sessions'], ['value' => $achive9, 'name' => 'Going_for_Gold', 'desc' => 'record more than 3 encounters in one day'], ['value' => $achive10, 'name' => 'At_it_like_Rabbits', 'desc' => 'record 5 or more sessions in one weekend']];
    }

    public static function achivement() {

        $result = self::getAchivementDetails();

        $encounter = $result['encounter'];

        $achive8 = 0;
        if ($encounter->count() > 49) {
            $achive8 = 100.00;
        }

        $enc = DB::select("select count(*) as c from encounters WHERE user_id = " . Auth::user()->id . " and deleted_at is null and step = 8 and encounter_date in (select encounter_date from encounters WHERE user_id = " . Auth::user()->id . " and deleted_at is null and step = 8 group by encounter_date having count(*)>2)");
        if (isset($enc[0]) && !empty($enc[0])) {
            if ($enc[0]->c == 0) {
                $achive9 = 0;
            } else {
                $achive9 = 100.00;
            }
        }

        $count = array_map('count', $result['newTimeArray7']);
        arsort($count);


        $achive1 = self::getPercentage(count($result['newTimeArray']), 5);
        $achive2 = self::getPercentage(count($result['newTimeArray1']), 6);
        $achive3 = self::getPercentage(count($result['newTimeArray2']), 1);
        $achive4 = self::getPercentage(count($result['newTimeArray3']), 10);
        $achive5 = self::getPercentage(count($result['newTimeArray4']), 1);
        $achive6 = self::getPercentage(count($result['newTimeArray5']), 1);
        $achive7 = self::getPercentage(count($result['newTimeArray6']), 2);
        $achive10 = self::getPercentage(reset($count), 5);
        return [['value' => $achive1, 'name' => 'Late_Night_Delight', 'desc' => 'late night delight. Enter an encounter 5 times after 11pm and before 1am'], ['value' => $achive2, 'name' => 'Good_Morning_Sunshine', 'desc' => 'good morning sunshine: enter 6 morning sessions between 5am-9am'], ['value' => $achive3, 'name' => 'Midday_Madness', 'desc' => 'midday madness: enter an encounter between 2pm-5pm'], ['value' => $achive4, 'name' => 'Titillating_Toys', 'desc' => 'record 10 encounters having a toy involved'], ['value' => $achive5, 'name' => 'Explorer', 'desc' => 'record an encounter that involves more than two rooms and 4 positions'], ['value' => $achive6, 'name' => '30_Not_Out', 'desc' => 'the 30 day challenge: record 30 encounters ( in 30 days )'], ['value' => $achive7, 'name' => 'Horticulturist', 'desc' => 'record 2 sessions that involves being outside of a house environment'], ['value' => $achive8, 'name' => 'Half_Century', 'desc' => 'record 50 sessions'], ['value' => $achive9, 'name' => 'Going_for_Gold', 'desc' => 'record more than 3 encounters in one day'], ['value' => $achive10, 'name' => 'At_it_like_Rabbits', 'desc' => 'record 5 or more sessions in one weekend']];
    }

    public static function duration($key = null, $key2 = null) {
        if ($key2 == null) {
            $duration = DB::table('encounters')
                            ->leftjoin('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->selectRaw("count(DISTINCT(encounters.id)) as totalEncounter, SUM(CASE WHEN encounters.is_intercourse = 1 THEN 1 ELSE 0 END) AS totalIntercourse ,sum(how_long) as duration,sum(encounter_rooms.no_of_orgasam) as orgasam,(DATEDIFF(encounter_date, (select date(now()) - interval day(now()) day + interval 1 day) ) DIV 7)+1 as week ")
                            ->whereRaw("user_id= " . Auth::user()->id . " and encounters.deleted_at is null  and encounter_rooms.deleted_at is null and step='8'  " . $key . "  " . $key2)
                            ->groupBy('week')->get();
        } else {
            $duration = DB::table('encounters')
                            ->leftjoin('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                            ->selectRaw("count(DISTINCT(encounters.id)) as totalEncounter, SUM(CASE WHEN encounters.is_intercourse = 1 THEN 1 ELSE 0 END) AS totalIntercourse ,sum(how_long) as duration,sum(encounter_rooms.no_of_orgasam) as orgasam,(DATEDIFF(encounter_date, (select date(now()) - interval day(now()) day + interval 1 day) ) DIV 7)+1 as week ")
                            ->whereRaw("user_id= " . Auth::user()->id . " and encounters.deleted_at is null and encounter_partners.deleted_at is null and encounter_rooms.deleted_at is null and step='8'  " . $key . "  " . $key2)
                            ->groupBy('week')->get();
        }
        $arr = ['totalEncounter' => 0, 'duration' => 0, 'orgasam' => 0, 'totalIntercourse' => 0];
        return self::weekArrangement($duration, $arr);
    }

    public static function weekArrangement($duration, $arr) {
        $group = [1, 2, 3, 4, 5];
        $finalDuration = [];
        $array = [];

        foreach ($duration as $d) {
            if (in_array($d->week, $group)) {
                $finalDuration[] = $d;
                $array[] = $d->week;
            }
        }

        foreach ($group as $g) {
            if (!in_array($g, $array)) {
                $arr['week'] = $g;
                array_push($finalDuration, $arr);
            }
        }
        $j = json_encode($finalDuration);
        $k = json_decode($j);
        usort($k, function($a, $b) {
            return strcmp($a->week, $b->week);
        });

        return $k;
    }

    public static function favPosition($key = null, $key2 = null) {
        if ($key2 == null) {
            return Encounter::join('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                            ->join('positions', 'encounter_positions.position_id', '=', 'positions.id')
                            ->selectRaw('count(position_id) as count, position_id,positions.name')
                            ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_positions.deleted_at')
                            ->whereRaw("step='8'  " . $key . "  " . $key2)
                            ->groupBy('position_id')
                            ->get();
        } else {
            return Encounter::join('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                            ->join('positions', 'encounter_positions.position_id', '=', 'positions.id')
                            ->leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                            ->selectRaw('count(position_id) as count, position_id,positions.name')
                            ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_positions.deleted_at')->wherenull('encounter_partners.deleted_at')
                            ->whereRaw("step='8'  " . $key . "  " . $key2)
                            ->groupBy('position_id')
                            ->get();
        }
    }

    public static function favRoom($key = null, $key2 = null) {
        if ($key2 == null) {
            return Encounter::join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->join('rooms', 'encounter_rooms.room_id', '=', 'rooms.id')
                            ->selectRaw('count(room_id) as count, room_id,rooms.name')
                            ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_rooms.deleted_at')
                            ->whereRaw("step='8'  " . $key . "  " . $key2)
                            ->groupBy('room_id')
                            ->get();
        } else {
            return Encounter::join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->join('rooms', 'encounter_rooms.room_id', '=', 'rooms.id')
                            ->leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                            ->selectRaw('count(room_id) as count, room_id,rooms.name')
                            ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_rooms.deleted_at')->wherenull('encounter_partners.deleted_at')
                            ->whereRaw("step='8'  " . $key . "  " . $key2)
                            ->groupBy('room_id')
                            ->get();
        }
    }

    public static function favTime($key = null, $key2 = null) {

        if ($key2 == null) {
            $result = Encounter::selectRaw('HOUR(encounter_time) AS h, COUNT(*) as c')
                    ->where('encounters.user_id', Auth::user()->id)
                    ->whereRaw("step='8'  " . $key . "  " . $key2)
                    ->groupBy('h')
                    ->get();
        } else {
            $result = Encounter::leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                    ->selectRaw('HOUR(encounter_time) AS h, COUNT(*) as c')
                    ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_partners.deleted_at')
                    ->whereRaw("step='8'  " . $key . "  " . $key2)
                    ->groupBy('h')
                    ->get();
        }

        $final = ['night' => 0, 'morning' => 0, 'afternoon' => 0, 'evening' => 0];
        foreach ($result as $r) {
            if (($r['h'] >= 22 && $r['h'] <= 23) || ($r['h'] >= 0 && $r['h'] < 5)) {
                $final['night'] += $r['c'];
            }
            if ($r['h'] >= 5 && $r['h'] < 12) {
                $final['morning'] += $r['c'];
            }
            if ($r['h'] >= 12 && $r['h'] < 18) {
                $final['afternoon'] += $r['c'];
            }
            if ($r['h'] >= 18 && $r['h'] < 22) {
                $final['evening'] += $r['c'];
            }
        }

        return $final;
    }

    public static function sessionPerPartner($key = null, $key2 = null, $key3 = null, $key4 = null) {
        if ($key3 == null) {
            $duration = DB::table('encounters')
                            ->join('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                            ->join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->join('partners', 'partners.id', '=', 'encounter_partners.partner_id')
                            //->leftjoin('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                            ->selectRaw("sum(encounter_rooms.no_of_orgasam) as orgasm,sum(how_long) as duration,partners.name as name,partners.id as partnerId,count(DISTINCT(encounters.id)) as totalEncounter,(DATEDIFF(encounter_date, (select date(now()) - interval day(now()) day + interval 1 day) ) DIV 7)+1 as week")
                            ->whereRaw("encounters.user_id= " . Auth::user()->id . " and encounters.deleted_at is null and encounter_partners.deleted_at is null and encounter_rooms.deleted_at is null  and step='8' " . $key . "  " . $key2 . "  " . $key3 . "  " . $key4)
                            ->groupBy('week', 'name', 'partnerId')->get();
        } else {
            $duration = DB::table('encounters')
                            ->join('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                            ->join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                            ->join('partners', 'partners.id', '=', 'encounter_partners.partner_id')
                            ->leftjoin('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                            ->selectRaw("sum(encounter_rooms.no_of_orgasam) as orgasm,sum(how_long) as duration,partners.name as name,partners.id as partnerId,count(DISTINCT(encounters.id)) as totalEncounter,(DATEDIFF(encounter_date, (select date(now()) - interval day(now()) day + interval 1 day) ) DIV 7)+1 as week")
                            ->whereRaw("encounters.user_id= " . Auth::user()->id . " and encounters.deleted_at is null and encounter_partners.deleted_at is null and encounter_rooms.deleted_at is null and encounter_positions.deleted_at is null and step='8' " . $key . "  " . $key2 . "  " . $key3 . "  " . $key4)
                            ->groupBy('week', 'name', 'partnerId')->get();
        }
        $arr = ['totalEncounter' => 0, 'name' => null, 'partnerId' => 0, 'duration' => 0, 'orgasm' => 0];
        $k = self::weekArrangement($duration, $arr);
//        dd($k);
        $result = [];
        foreach ($k as $element) {
            $result[$element->week]['partnerId' . $element->partnerId] = $element;
        }
        return $result;
    }

    public static function daySincePosition($key = null) {
        if ($key == null) {
            $encounter = Encounter::join('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                    ->join('positions', 'positions.id', '=', 'encounter_positions.position_id')
                    ->selectRaw('DATEDIFF(CURDATE(), MAX(encounters.encounter_date)) AS days,encounter_positions.position_id as positionId,positions.name')
                    ->where('encounters.user_id', Auth::user()->id)->where('step', Encounter::STEP_EIGHT)->wherenull('encounter_positions.deleted_at')
                    ->groupBy('positionId')
                    ->get();
        } else {
            $encounter = Encounter::join('encounter_positions', 'encounters.id', '=', 'encounter_positions.encounter_id')
                    ->join('positions', 'positions.id', '=', 'encounter_positions.position_id')
                    ->leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                    ->selectRaw('DATEDIFF(CURDATE(), MAX(encounters.encounter_date)) AS days,encounter_positions.position_id as positionId,positions.name')
                    ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_partners.deleted_at')->wherenull('encounter_positions.deleted_at')
                    ->whereRaw("step='8'  " . $key)
                    ->groupBy('positionId')
                    ->get();
        }
        return $encounter;
    }

    public static function daySinceRoom($key = null) {
        if ($key == null) {
            $encounter = Encounter::join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                    ->join('rooms', 'rooms.id', '=', 'encounter_rooms.room_id')
                    ->selectRaw('DATEDIFF(CURDATE(), MAX(encounters.encounter_date)) AS days,encounter_rooms.room_id as roomId,rooms.name')
                    ->where('encounters.user_id', Auth::user()->id)->where('step', Encounter::STEP_EIGHT)->wherenull('encounter_rooms.deleted_at')
                    ->groupBy('roomId')
                    ->get();
        } else {
            $encounter = Encounter::join('encounter_rooms', 'encounters.id', '=', 'encounter_rooms.encounter_id')
                    ->join('rooms', 'rooms.id', '=', 'encounter_rooms.room_id')
                    ->leftjoin('encounter_partners', 'encounters.id', '=', 'encounter_partners.encounter_id')
                    ->selectRaw('DATEDIFF(CURDATE(), MAX(encounters.encounter_date)) AS days,encounter_rooms.room_id as roomId,rooms.name')
                    ->where('encounters.user_id', Auth::user()->id)->wherenull('encounter_rooms.deleted_at')
                    ->wherenull('encounter_partners.deleted_at')->whereRaw("step='8'  " . $key)
                    ->groupBy('roomId')
                    ->get();
        }
        return $encounter;
    }

}

?>