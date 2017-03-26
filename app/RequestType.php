<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    public function serviceChannels(){
        return $this->hasMany('App\ServiceChannel');
    }
}
