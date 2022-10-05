<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use  Illuminate\Auth\Passwords;

class FaceBookController extends Controller{
	/**
	* Login Using Facebook
	*/
	public function loginUsingFacebook()
	{
		return Socialite::driver('facebook')->redirect();
	}
	public function callbackFromFacebook(){
		$data = Socialite::driver('facebook')->user();

		$user = User:: where('email', $data->email)->first();
		if ($user) {
			Auth::login($user, true);
			return redirect()->route('welcome');
		} else{
			$user = new User();
			$user->name = $data->name;
			$user->email = $data->email;
			$password = Hash::make("123456");
			$user->password = $password;
			$user->save();
			Auth::login($user, true);
			return redirect()->route('welcome');
		}
		// dd($user);
		
		// $check = Auth::attempt($user);
		// $feilds['email'] = $user->email;
		// $feilds['password'] = $user->password;
		// $check = Auth::login($user);
		// $attempt = Auth::attempt(['email' => $user->email, 'password' => $user->password]);
		// return redirect()->route('welcome');
		// dd($user);
		// if (!$user) {
		// 	$user = new User();
		// 	$user->name = $data->name;
		// 	$user->email = $data->email;
		// 	$password = Hash::make("123456");
		// 	$user->password = $password;
		// 	$user->save();
		// }
	}
}