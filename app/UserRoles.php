<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $fillable = array(
        'role_name', 'role_code', 'role_status'
    );

    public function masterfile(){
        return $this->hasMany('App\Masterfile');
    }
}
