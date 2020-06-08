<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
	protected $table="catalog";
	public  $timestamps =false;
	public function product() {
		return $this->hasMany('App/Product', 'catalog_id', 'id');
    }
}
