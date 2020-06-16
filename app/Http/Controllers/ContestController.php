<?php

namespace App\Http\Controllers;
use App\Contest;
use App\Prize;
use App\PrizeImage;
use App\Winner;
use Illuminate\Http\Request;

class ContestController extends Controller
{
  public function getContests(){
    return Contest::with('prizes','prizes.prizeImages')->get();
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
        return Contest::where('ended',"1")->with('prizes','prizes.prizeImages')->get();
      }

      public function liveContest(){
        return Contest::where('ended',"0")->with('prizes','prizes.prizeImages')->get();
      }

      public function contestWinner(){
        return Winner::with('user','contest','contest.prizes','contest.prizes.prizeImages')->get();
      }


      public function enterContest(){
        
      }
}
