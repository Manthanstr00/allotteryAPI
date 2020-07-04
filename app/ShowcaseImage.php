<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowcaseImage extends Model
{
    protected $fillable = [
        'image'
    ];

    protected $table = 'al_showcase_images';
}
