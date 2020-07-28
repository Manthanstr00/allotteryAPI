<?php

namespace App\Http\Controllers;
use App\Contest;
use App\Delivery;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function hostedContests(){
        $contests = Contest::paginate(10);
        return view('admin.hosted', compact('contests'));
    }

    public function hostContest(){
        $delivery = Delivery::all();
        return view('admin.host',compact('delivery'));
    }

    public function trendingContests(){
        $contests = Contest::paginate(10);
        return view('admin.hosted', compact('contests'));
    }
    
}
