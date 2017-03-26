<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = array(
        'masterfile_id', 'token_balance'
    );

    public function masterfile(){
        return $this->hasMany('App\Masterfile');
    }
}
