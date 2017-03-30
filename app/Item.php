<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function auctions(){
        $this->hasMany('App\Auction');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function subCategory(){
        return $this->belongsTo('App\SubCategory');
    }
    public function stockTransaction(){
        return $this->belongsTo('App\StockTransaction');
    }
}
