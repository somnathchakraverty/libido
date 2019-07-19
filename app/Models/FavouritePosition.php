<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavouritePosition extends Model {

    use SoftDeletes;

    protected $table = 'favourite_positions';
    protected $fillable = ['position_id', 'user_id', 'is_favourite'];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function positions() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public static function saveFavouritePosition($data) {
        $p = FavouritePosition::where('user_id', Auth::user()->id)->where('position_id', $data['positionId'])->first();
        if ($p) {
            $position = $p;
        } else {
            $position = new FavouritePosition();
        }

        $position->is_favourite = $data['isFavourite'];
        $position->user_id = Auth::user()->id;
        $position->position_id = $data['positionId'];
        $position->save();
    }

}

?>