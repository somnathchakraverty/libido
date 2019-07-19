<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Utilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncounterCondom extends Model {

    use SoftDeletes;

    protected $table = 'encounter_condoms';

//    protected $fillable = ['user_id', 'device_token', 'access_token', 'device_type'];


    public function encounters() {
        return $this->belongsTo(Encounter::class, 'encounter_id', 'id');
    }

    public function condoms() {
        return $this->belongsTo(Condom::class, 'condom_id', 'id')->withTrashed();
    }

    public static function saveEncounterCondom($data) {
        //EncounterCondom::where('encounter_id', $data['encounterId'])->delete();
        self::deleteEncounterCondom($data);
        foreach ($data['condoms'] as $v) {
            $condom = new EncounterCondom();
            $condom->encounter_id = $data['encounterId'];
            $condom->condom_id = $v;
            $condom->save();
        }
    }

    public static function deleteEncounterCondom($data) {
        EncounterCondom::where('encounter_id', $data['encounterId'])->delete();
    }

}

?>