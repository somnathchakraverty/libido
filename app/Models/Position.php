<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;

class Position extends Model {

    protected $table = 'positions';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];

    public function FavouritePositions() {
        return $this->hasMany(FavouritePosition::class, 'position_id', 'id');
    }


    public function getImageAttribute($value) {

        if (!empty($value)) {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $value;
            return url('/uploads/' . $value);
        } else {
            return '';
        }
    }

    public static function savePosition($data) {
        $position = new Position();
        $position->name = $data['name'];
        $position->user_id = Auth::user()->id;
        $position->save();
        return $position;
    }

}

?>