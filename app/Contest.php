<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{

    protected $fillable = [
        "user_id",
        "tickets",
        "currency",
        "pricePerTicket",
        "question_id",
        "publishing_type",
        "endDateTime",
        "ended",
    ];
    protected $table = "al_contests";

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function prizes(){
        return $this->hasMany('App\Prize','contest_id');
    }
    
    public function question(){
        return $this->belongsTo('App\Question','question_id');
    }

    public function winner(){
        return $this->hasOne('App\Winner', 'contest_id');
    }

    public function favourite()
    {
        return $this->hasMany('App\Favourite', 'contest_id');
    }
}
