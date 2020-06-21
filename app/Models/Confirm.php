<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Confirm extends Model
{
	use SoftDeletes;

	protected $table="confirm_user";

	public  $timestamps = true;
}

