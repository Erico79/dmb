<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidPackage extends Model
{
    protected $fillable = array(
        'service_channel_id', 'package_name', 'no_of_tockens', 'price', 'item_id'
    );

    public function service(){
        return $this->belongsTo('App\ServiceChannel');
    }
}
