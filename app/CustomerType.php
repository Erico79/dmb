<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $fillable = array(
        'customer_type_name', 'customer_type_code', 'customer_type_status'
    );

    public function masterfile(){
        return $this->hasMany('App\Masterfile');
    }
}
