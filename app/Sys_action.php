<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sys_action extends Model
{
   public function roles(){
       return $this->belongsToMany('App\Role');
   }
}

