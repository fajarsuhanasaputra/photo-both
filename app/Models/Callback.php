<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model {

    use HasFactory;

    protected $guarded = [];

    public function getPayloadAttribute($value) {
        return json_decode($value);
    }
    public function setPayloadAttribute($value){
        $this->attributes['payload'] = json_encode($value);
    }

}
