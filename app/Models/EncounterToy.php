<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterToy extends Model {

    use SoftDeletes;

    protected $table = 'encounter_toys';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function toys() {
        return $this->belongsTo(Toy::class, 'toy_id', 'id')->withTrashed();
    }

    public static function saveEncounterToy($data) {
        //EncounterToy::where('encounter_id', $data['encounterId'])->delete();
        self::deleteEncounterToy($data);
        foreach ($data['toys'] as $v) {
            $toy = new EncounterToy();
            $toy->encounter_id = $data['encounterId'];
            $toy->toy_id = $v;
            $toy->save();
        }
    }

    public static function deleteEncounterToy($data) {
        EncounterToy::where('encounter_id', $data['encounterId'])->delete();
    }

}

?>