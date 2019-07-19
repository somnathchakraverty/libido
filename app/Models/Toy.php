<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;
class Toy extends Model {
use SoftDeletes;
    protected $table = 'toys';

    protected $fillable = ['name','image'];



    public function getImageAttribute($value) {

        if (!empty($value)) {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $value;
            return url('/uploads/' . $value);
        } else {
            // return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/dummy_image.jpg';
            return url('/uploads/dummy_image.jpg');
        }
    }

}

?>