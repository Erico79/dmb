<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    protected $fillable = array(
        'address_type_name', 'address_type_code', 'address_type_status'
    );

    public function masterfile(){
        return $this->hasMany('App\Masterfile');
    }
}
