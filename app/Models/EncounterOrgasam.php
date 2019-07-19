<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterOrgasam extends Model {

    use SoftDeletes;

    protected $table = 'encounter_orgasams';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function partners() {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public static function saveEncounterOrgasam($data) {
        EncounterOrgasam::where('encounter_id', $data['encounterId'])->where('room_id', $data['roomId'])->delete();
        //self::deleteEncounterOrgasam($data);
        foreach ($data['partners'] as $k => $v) {
            $room = new EncounterOrgasam();
            $room->encounter_id = $data['encounterId'];
            $room->partner_id = $k;
            $room->no_of_orgasams = $v;
            $room->room_id = $data['roomId'];
            $room->save();
        }
    }

    public static function deleteEncounterOrgasam($data) {
        EncounterOrgasam::where('encounter_id', $data['encounterId'])->delete();
    }

    public static function deleteParticularOrgasam($data) {
        EncounterOrgasam::where('encounter_id', $data['encounterId'])->where('room_id', $data['roomId'])->delete();
    }

}

?>