<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IfmisSubcode extends Model
{
    protected $fillable = array(
        'subcode_name', 'ifmis_headcode_id', 'ifmis_subcode'
    );

    public function revenueChannel(){
        return $this->hasMany('App\RevenueChannel');
    }
}
