<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserDevice extends Model {


    protected $table = 'user_devices';
    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];

    const IS_IOS=1;
    const IS_ANDROID=2;

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function saveUserDevice($userId, $data) {
        UserDevice::where('user_id', $userId)->delete();
        $userDevice = new UserDevice();
        $userDevice->user_id = $userId;
        $userDevice->device_type = $data['deviceType'];
        if(isset($data['deviceToken']) && !empty($data['deviceToken'])){
           $userDevice->device_token = $data['deviceToken'];
        }
        
        $userDevice->user_token = bcrypt($userId . time());
        
        $userDevice->save();
        return $userDevice;
    }
    
}

?>