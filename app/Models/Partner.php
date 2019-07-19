<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use DB;
class Partner extends Model {

    protected $table = 'partners';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mappedUsers() {
        return $this->belongsTo(User::class, 'mapped_user_id', 'id');
    }

    public function encounterPartner() {
        return $this->hasMany(EncounterPartner::class, 'encounter_id', 'id');
    }

    public function getImageAttribute($value) {

        if (!empty($value)) {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $value;
            return url('/uploads/' . $value);
        } else {
            return '';
        }
    }

    public static function savePartner($data) {
        $partner = new Partner();

        if (isset($data['image']) && !empty($data['image'])) {
            $fileName = Utilities::saveAwsImage($data['image']);
            $partner->image = $fileName;
        }

        if (isset($data['mappedUserId']) && !empty($data['mappedUserId'])) {
            $partner->mapped_user_id = $data['mappedUserId'];
            $user = DB::table('users')->where('id', $data['mappedUserId'])->first();
            $partner->image = $user->image;
        }

        $partner->user_id = Auth::user()->id;
        $partner->name = $data['name'];
        $partner->age = $data['age'];
        $partner->gender = $data['gender'];
        $partner->save();
        return $partner;
    }

}

?>