<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{

    protected $fillable = [
        "prize_id",
        "contest_id",
        "name",
        "description",
        "delivery_id",
    ];
    protected $table = "al_contest_prizes";

    public function prizeImages(){
        return $this->hasMany('App\PrizeImage','prize_id');
    }

    public function delivery(){
        return $this->belongsTo('App\Delivery','delivery_id');
    }
}
