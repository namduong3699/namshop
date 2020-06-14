<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';

	public $timestamps = true;

	protected $fillable = [
		'name', 'count', 'size', 'color', 'price', 'discount', 'folder', 'image_link', 'image_list', 'description'
	];

	public function catalog()
	{
		return $this->belongsTo(Catalog::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class);
	}
}
