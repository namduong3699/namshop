<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
	protected $table="catalogs";

	public  $timestamps =true;

	protected $fillable = [
		'name', 'count'
	];

	public function products() {
		return $this->hasMany(Product::class);
    }
}
