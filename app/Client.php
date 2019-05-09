<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Client extends Authenticatable
{
	use SoftDeletes;
	protected $softDelete = true;
	// protected $hidden = ['password'];
}
