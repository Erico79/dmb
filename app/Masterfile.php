<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterfile extends Model
{
    protected $fillable = array(
        'surname', 'firstname', 'middlename', 'id_passport', 'b_role', 'gender', 'email',
        'customer_type_name', 'reg_date', 'image_path'
    );

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function addressType(){
        return $this->belongsTo('App\AddressType');
    }
}
