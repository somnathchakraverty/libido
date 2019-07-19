<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;
use Utilities;
use Auth;

class User extends Model {

    protected $table = 'users';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['password'];

//    protected $appends = ['image_name'];

    const ROLE_ADMIN = 1;
    const ROLE_APPUSER = 2;
    const IS_DEACTIVATED = 0;
    const IS_ACTIVATED = 1;
    const STEP_ONE = 1;
    const STEP_TWO = 2;
    const STEP_THREE = 3;

    public function FavouriteRooms() {
        return $this->hasMany(FavouriteRoom::class, 'user_id', 'id');
    }

    public function FavouritePositions() {
        return $this->hasMany(FavouritePosition::class, 'user_id', 'id');
    }

    /*
     * Save User Details
     */

    public static function saveUser($data) {
        $user = new User();
        $user->email = $data['email'];
        $user->role = $data['userType'];
        $user->verification_token = $data['token'];
        $user->password = Hash::make($data['password'], ['rounds' => 4]);
        $user->save();
        return $user;
    }

    /*
     * Get user via id
     */

    public static function getUserViaId($userId) {
        return User::leftjoin('user_devices', 'user_devices.user_id', '=', 'users.id')
                        ->select('users.*', 'user_devices.user_token')
                        ->where('users.id', $userId)->first();
    }



    public function getImageAttribute($value) {

        if (!empty($value)) {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $value;
            return url('/uploads/' . $value);
        } else {
            return '';
        }
    }

}

?>