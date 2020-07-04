<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Advertise;

class AdvertiseController extends Controller
{
    public function fetchAdvertise(){
        return Advertise::all();
    }

    public function createAdvertise(Request $req){
        Advertise::create($req->all());
        return 'success';
    }
}
