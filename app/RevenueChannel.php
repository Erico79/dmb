<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueChannel extends Model
{
    protected $fillable = array(
        'revenue_channel_name', 'revenue_channel_code', 'ifmis_headcode_id', 'ifmis_subcode_id', 'revenue_channel_status'
    );

    public function ifmisHeadcode(){
        return $this->belongsTo('App\IfmisHeadcode');
    }

    public function ifmisSubcode(){
        return $this->belongsTo('App\IfmisSubcode');
    }

    public function serviceChannels(){
        return $this->hasMany('App\ServiceChannel');
    }
}
