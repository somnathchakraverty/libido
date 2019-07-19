<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterPosition extends Model {

    use SoftDeletes;

    protected $table = 'encounter_positions';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function positions() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public static function saveEncounterPosition($data) {
        EncounterPosition::where('encounter_id', $data['encounterId'])->where('room_id', $data['roomId'])->delete();
        //self::deleteEncounterPosition($data);
        foreach ($data['positions'] as $v) {
            $room = new EncounterPosition();
            $room->encounter_id = $data['encounterId'];
            $room->position_id = $v;
            $room->room_id = $data['roomId'];
            $room->save();
        }
    }

    public static function deleteEncounterPosition($data) {
        EncounterPosition::where('encounter_id', $data['encounterId'])->delete();
    }

    public static function deleteParticularPosition($data) {
        EncounterPosition::where('encounter_id', $data['encounterId'])->where('room_id', $data['roomId'])->delete();
    }

}

?>