<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = array(
        'county', 'town', 'masterfile_id', 'postal_code', 'postal_address', 'postal_code', 'address_type_name', 'ward', 'street', 'building', 'phone'
    );

    public function masterfile(){
        return $this->hasMany('App\Masterfile');
    }
}
