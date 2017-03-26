<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceChannel extends Model
{
    protected $fillable = array(
        'revenue_channel_id', 'service_option', 'option_code', 'price', 'parent_id',
        'service_option_type', 'request_type_id', 'status', 'currency_id'
    );

    public function revenueChannel(){
        return $this->belongsTo('App\RevenueChannel');
    }

    public function requestType(){
        return $this->belongsTo('App\RequestType');
    }

    public function bidPackages(){
        return $this->hasMany('App\BidPackage');
    }
}
