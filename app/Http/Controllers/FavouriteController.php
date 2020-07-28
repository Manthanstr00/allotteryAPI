<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;

class FavouriteController extends Controller
{
    public function favouriteContests($id){
        $favourite = Favourite::with(
            'user',
            'contest',
            'contest.user',
            'contest.winner.user',
            'contest.question',
            'contest.prizes',
            'contest.prizes.delivery',
            'contest.prizes.prizeImages'
        )->where('user_id',$id)->get();
        return $favourite;
    }

    public function addFavourite(Request $request){
        $fav = Favourite::where(['contest_id'=>$request->contest_id, 'user_id'=>$request->user_id])->first();
        if($fav == null){
            if(Favourite::create($request->all())){
                return 'success';
            }
        }else{
            return "FAVOURITE_EXIST";
        }
    }   

    public function removeFavourite($contest_id,$user_id){
        return Favourite::where(['contest_id'=>$contest_id, 'user_id'=>$user_id])->delete();
    }

    

}
