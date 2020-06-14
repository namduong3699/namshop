<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $talbe = 'slides';

    protected $fillable = [
        'title', 'content', 'button', 'link', 'image', 'folder'
    ];
}
