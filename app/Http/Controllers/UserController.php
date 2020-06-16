<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function getUsers(){
    return User::all();
 }

 public function getUser($id){
    $user = User::findOrFail($id)->first();
    return $user;
 }

 public function createUser(Request $request){
        $input = $request->all();
        if(User::create($input)){
            return "success";
        }
 }

 public function updateUserDetail(Request $request,$id){
    $user = User::findOrFail($id);
    $update = $user->fill($request->all());
    if($update){
        return "success";
    }
 }

 public function getUserId($phone){
    $user = User::where('phone',$phone)->first();
    return $user->id;
 }
}
