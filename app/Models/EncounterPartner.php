<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterPartner extends Model {

    use SoftDeletes;

    protected $table = 'encounter_partners';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function partners() {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public static function saveEncounterPartner($data) {
//        EncounterPartner::where('encounter_id', $data['encounterId'])->delete();
        self::deleteEncounterPartner($data);
        foreach ($data['partner'] as $k => $v) {
            $partner = new EncounterPartner();
            $partner->encounter_id = $data['encounterId'];
            $partner->partner_id = $k;
            $partner->is_initiated = $v;
            $partner->save();
        }
    }

    public static function updateEncounterPartner($data) {
        foreach ($data['partners'] as $v) {
            EncounterPartner::where('encounter_id', $data['encounterId'])->where('partner_id', $v)->update(['is_protection_used' => 1]);
        }
    }
    
    public static function deleteEncounterPartner($data){
        EncounterPartner::where('encounter_id', $data['encounterId'])->delete();
    }

}

?>