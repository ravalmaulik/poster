<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdminMenu extends Model
{
    function subMenu(){
    	return $this->hasMany('App\SuperAdminMenu', "MenuParentId", "id");
    }
}
