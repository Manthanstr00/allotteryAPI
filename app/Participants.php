<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $fillable = [];

    protected $table = 'al_contest_participants';
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function contest(){
        return $this->belongsTo('App\Contest','contest_id');
    }
}
