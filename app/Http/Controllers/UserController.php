<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Participants;
use App\Winner;
use App\Contest;

class UserController extends Controller
{
 public function getUsers(){
    return User::all();
 }

 public function getUser($email){
	//  return $email;
    $user = User::where('email',$email)->first();
    return $user;
 }


public function signIn(Request $request){
	$user = User::where('email',$request->email)->first();
	$password = sha1($request->password);

	if(empty($user)){
		return 'USER_NOT_FOUND';
	}
	else{
		if($user->password == $password){
			return 'VALID';
		}else{
			return 'INVALID';
		}
	}
}

 public function createUser(Request $request){

	$user  = User::where('email',$request->email)->first();
	//Check if user already exists
	if(empty($user)){
		 //seperate password and profile image
		$input = $request->except('password','profile_image');
		//Password hassing 
		$password = sha1($request->password);
		$input['password'] = $password;
		//Upload image
		$profileImage = $request->profile_image;

		if($profileImage != null){
			$image_name = 'Profile-'.str_replace(' ','',$request->first_name) .time() .'.'.$profileImage->getClientOriginalExtension();
			$destinationPath = 'Images/User/UserProfiles/';
			$profileImage->move($destinationPath, $image_name);
			$input['profile_image'] = $destinationPath.$image_name;
			if(User::create($input)){
				return 'USER_CREATED';
			}
		}else{
			if(User::create($input)){
				return 'USER_CREATED';
			}
		}
		//if image uploaded
	}else{
		return 'USER_EXIST';
	}
 }

 public function updateUserDetail(Request $request,$id){
    $user = User::findOrFail($id);
    $update = $user->fill($request->all());
    User::update($update);
 }

 public function getUserId($phone){
    $user = User::where('phone',$phone)->first();
    return $user->id;
 }

 public function history($id){
	$history = Participants::with('user','contest','contest.user','contest.winner.user','contest.question','contest.prizes','contest.prizes.delivery','contest.prizes.prizeImages')->where('user_id', $id)->groupBy(['contest_id', 'user_id'])->selectRaw('*, sum(numberOfTickets) as totalTickets')->get();
	return $history;
 }
 
 public function userStats($id){
	$won = Winner::where('user_id',$id)->count();	 
	$participated = Participants::where('user_id',$id)->count();
	$hosted = Contest::where('user_id',$id)->count();
	return response()->json(array(
		'won' => $won,
		'participated' => $participated,
		'hosted' => $hosted,
	));
}
}
