<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    protected $fillable = [
        'contest_id'
    ];

    protected $table = 'al_trending_contest';

    public function contest(){
        return $this->belongsTo('App\Contest','contest_id');
    }
    
}
