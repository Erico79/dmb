<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = array(
        'item_id', 'auto_rollover', 'reserve_price', 'bid_cost', 'refresh_rate', 'buy_now_option',
        'buy_now_price', 'start_date', 'status', 'end_date'
    );

    public function item(){
        return $this->belongsTo('App\Item');
    }
}
