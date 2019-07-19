<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;

class Room extends Model {

    protected $table = 'rooms';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];

    public function FavouriteRooms() {
        return $this->hasMany(FavouriteRoom::class, 'room_id', 'id');
    }

    public function encounterOrgasam() {
        return $this->hasMany(EncounterOrgasam::class, 'room_id', 'id');
    }

    public function encounterPosition() {
        return $this->hasMany(EncounterPosition::class, 'room_id', 'id');
    }

    public function getImageAttribute($value) {

        if (!empty($value)) {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $value;
            return url('/uploads/' . $value);
        } else {
            return '';
        }
    }

    public static function saveRoom($data) {
        $room = new Room();
        $room->name = $data['name'];
        $room->user_id = Auth::user()->id;
        $room->save();
        return $room;
    }

}

?>