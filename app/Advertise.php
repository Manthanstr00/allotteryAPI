<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        'image'
    ];
    protected $table = 'al_advertisements';
}
