<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trending;

class TrendingController extends Controller
{
    public function trendingContests(){
        return Trending::with(
            'contest',
            'contest.user',
            'contest.winner.user',
            'contest.question',
            'contest.prizes',
            'contest.prizes.delivery',
            'contest.prizes.prizeImages'
        )->get();
    }

    public function addTrending(Request $request){
        $trendingContest = Trending::where('contest_id',$request->contest_id)->first();
        if($trendingContest == null){
           if(Trending::create($request->all())){
               return 'success';
           }
        }else{
            return "RECORD_EXIST";
        } 
    }

    public function removeTrending($id){
        if(Trending::where('contest_id',$id)->delete()){
            return 'success';
        }else{
            return "no record found";
        }
    }
}
