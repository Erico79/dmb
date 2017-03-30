<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IfmisHeadcode extends Model
{
    protected $fillable = array(
        'head_code_name', 'ifmis_code'
    );

    public function revenueChannel(){
        return $this->hasMany('App\RevenueChannel');
    }
}
