<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'user_id',
        'contest_id',
    ];

    protected $table = 'al_favourite_contests';

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function contest(){
        return $this->belongsTo('App\Contest','contest_id');
    }

}
