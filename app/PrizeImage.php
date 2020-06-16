<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrizeImage extends Model
{
    protected $table = "al_prize_images";

    protected $fillable = [
        "prize_id",
        "image"
    ];
}
