<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;

class Advertiser extends Model {

    protected $table = 'advertiser_icons';

    protected $fillable = ['name','image'];



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