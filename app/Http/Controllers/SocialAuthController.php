<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
	public function redirect($social)
	{
		return Socialite::driver($social)->redirect();
	}

	public function callback($social)
	{
		$user = SocialAccountService::createOrGetUser(Socialite::driver($social)->stateless()->user(), $social);
		auth()->login($user);

		return redirect()->to('index');
	}


	//Facebook
	public function redirectFB()
	{
		return Socialite::driver('facebook')->redirect();   
	}   

	public function callbackFB()
	{
        // Sau khi xác thực Facebook chuyển hướng về đây cùng với một token
        // Các xử lý liên quan đến đăng nhập bằng mạng xã hội cũng đưa vào đây. 
        $user = Socialite::driver('facebook')->user();  
	}

	//Google
	public function redirectGG()
	{
		return Socialite::driver('google')->stateless()->redirect();   
	}   

	public function callbackGG()
	{
        // Sau khi xác thực Google chuyển hướng về đây cùng với một token
        // Các xử lý liên quan đến đăng nhập bằng mạng xã hội cũng đưa vào đây. 
   		$request->session()->put('state',Str::random(40));
        $user = Socialite::driver('google')->stateless()->user();
        auth()->login($user);
        dd($user);
        return view('index');  
	}

}
