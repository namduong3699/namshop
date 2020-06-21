<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;

    protected $talbe = 'slides';

    protected $fillable = [
        'title', 'content', 'button', 'link', 'image', 'folder'
    ];
}
