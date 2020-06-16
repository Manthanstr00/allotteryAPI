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
}
