<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavouriteRoom extends Model {

    use SoftDeletes;

    protected $table = 'favourite_rooms';
    protected $fillable = ['room_id', 'user_id', 'is_favourite'];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public static function saveFavouriteRoom($data) {
        $r = FavouriteRoom::where('user_id', Auth::user()->id)->where('room_id', $data['roomId'])->first();
        if ($r) {
            $room = $r;
        } else {
            $room = new FavouriteRoom();
        }

        $room->is_favourite = $data['isFavourite'];
        $room->user_id = Auth::user()->id;
        $room->room_id = $data['roomId'];
        $room->save();
    }

}

?>