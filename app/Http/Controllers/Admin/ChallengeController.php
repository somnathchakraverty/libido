<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use DB;
use App\Models\User;

class ChallengeController extends BaseController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request) {
        $month=null;
        if (isset($request->month) && !empty($request->month)) {
            $month = " and MONTH(encounter_date) = ".$request->month." and YEAR(encounter_date) = ".$request->year;
        }
        $soloCount = DB::select("SELECT count(*) as c from ( SELECT MIN(encounter_date) start_date, MAX(encounter_date) end_date, COUNT(*) streak_count FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT * FROM encounters WHERE step = 8  and encounters.user_id != 1 and session_type=1 " . $month . " ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r group by gn) fn WHERE streak_count > 6 ");
        $partnerCount = DB::select("SELECT count(*) as c from ( SELECT MIN(encounter_date) start_date, MAX(encounter_date) end_date, COUNT(*) streak_count FROM ( SELECT q.*, @g := @g + COALESCE(DATEDIFF(encounter_date, @p) <> 1, 0) gn, @p := encounter_date FROM ( SELECT * FROM encounters WHERE step = 8  and encounters.user_id != 1 and session_type IN (2,3) " . $month . " ORDER BY encounter_date ) q CROSS JOIN ( SELECT @g := 0, @p := NULL ) i ) r group by gn) fn WHERE streak_count > 6 ");
        $totalUser = User::count();
        $soloPercentage = number_format($soloCount[0]->c * 100 / $totalUser, 2);
        $partnerPercentage = number_format($partnerCount[0]->c * 100 / $totalUser, 2);

        return view('admin.challenge')->with(['soloPer' => $soloPercentage, 'partPer' => $partnerPercentage]);
    }

}
