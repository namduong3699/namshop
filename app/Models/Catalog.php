<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
	use SoftDeletes;

	protected $table="catalogs";

	public  $timestamps =true;

	protected $fillable = [
		'name', 'count'
	];

	public function products() {
		return $this->hasMany(Product::class);
    }
}
