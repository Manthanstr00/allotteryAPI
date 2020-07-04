<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShowcaseImage;

class ShowcaseImageController extends Controller
{
    public function fetchShowcaseImage(){
        return ShowcaseImage::all();
    }

    public function addShowcaseImage(Request $req){
        ShowcaseImage::create($req->all());
        return 'success';
    }
}
