<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{

    protected $table = 'al_winners';

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function contest(){
        return $this->belongsTo('App\Contest','contest_id');
    }

    
}
