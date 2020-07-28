<?php

namespace App\Http\Controllers;
use App\Contest;
use App\Prize;
use App\PrizeImage;
use App\Winner;
use App\Favourite;
use Illuminate\Http\Request;

class ContestController extends Controller
{

  public function getContests(){
    return Contest::with('user','question','prizes','prizes.delivery','prizes.prizeImages','favourite')->with(['favourite' => function ($query){
      $query->where('user_id', 15);   
  }])->get();
  }

  public function hostContest(Request $req){
          //  Store contest details excepts prizes List
          $contest = $req->except('prizes');
          //  Store prize details
          $prizes = $req->prizes;
          //  Insert only contest details in contest table
          Contest::create($contest);
          //  Get latest contest record and store id in $contestId
          $latestContest = Contest::orderBy('id','desc')->first();
          $contestId = $latestContest->id;
          //  Insert prize details by looping
          foreach ($prizes as $prize) {
              //  Add contest id for prize object
              $prize['contest_id'] = $contestId;
              // Insert Prize details in contest prize table
              Prize::create($prize);
              //  Get latest prize record and store prize id in $prizeId
              $latestPrize = Prize::orderBy('id','desc')->first();
              $prizeId = $latestPrize->id;            
              //  Insert prize images by looping
              foreach ($prize['prize_images'] as $image) {
                  //  Ad prize id in prize object
                  $image['prize_id'] = $prizeId;
                  //  Insert Images in prize image table
                  PrizeImage::create($image);
                  //  return succes if data is added
              }
          }
          return "success";
      }

      public function endedContest(){
        return Contest::where('ended',"1")->with('user','question','prizes','prizes.delivery','prizes.prizeImages')->get();
      }

      public function pass($data){
        return $data;
      }

      public function liveContest($user_id){
        // return $user_id;
        return Contest::where('ended',"0")
        ->orderBy('id', 'DESC')
        ->with('user','question','prizes','prizes.delivery','prizes.prizeImages','favourite')
        ->with(['favourite' => function ($query) use ($user_id){
          $query->where('user_id', $user_id);   
      }])->get();
      }

      public function liveGrandContests(){
        return Contest::where(['ended'=>'0','contest_type'=>'grand'])->orderBy('id', 'DESC')->with('user','question','prizes','prizes.delivery','prizes.prizeImages')->get();
      }

      public function contestWinner($contestId){
        return Winner::with('user')->where('contest_id',$contestId)->first();
      }

      public function contestWinners(){
        return Winner::with('user','contest','contest.user','contest.prizes','contest.question','contest.prizes.delivery','contest.prizes.prizeImages')->get();
      }

} 
