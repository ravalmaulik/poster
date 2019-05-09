<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class ClientMenu extends Model
{
    //
    function subMenu(){
    	return $this->hasMany('App\ClientMenu', "MenuParentId", "id");
    }

    function clientAccesses(){
    	return $this->hasMany('App\ClientMenuAccess', "MenuId", "id");
    }
}
