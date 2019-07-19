<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterRoom extends Model {

    use SoftDeletes;

    protected $table = 'encounter_rooms';

    protected $fillable = ['room_id', 'encounter_id', 'how_long'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    
    public function encounterPosition(){
        return $this->hasMany(EncounterPosition::class,'room_id','id');
    }

    public function encounterOrgasam(){
        return $this->hasMany(EncounterOrgasam::class,'room_id','id');
    }

    public static function saveEncounterRoom($data) {
        //EncounterRoom::where('encounter_id', $data['encounterId'])->delete();
        self::deleteEncounterRoom($data);
        foreach ($data['rooms'] as $v) {
            $room = new EncounterRoom();
            $room->encounter_id = $data['encounterId'];
            $room->room_id = $v;
            $room->save();
        }
    }

    public static function deleteEncounterRoom($data) {
        EncounterRoom::where('encounter_id', $data['encounterId'])->delete();
    }
    
    public static function deleteParticularRoom($data){
        EncounterRoom::where('encounter_id', $data['encounterId'])->where('room_id',$data['roomId'])->delete();
    }

}

?>