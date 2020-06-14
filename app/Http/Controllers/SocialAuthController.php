<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cart;

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
		$user = Socialite::driver('google')->stateless()->user();
		$tempUser = User::where('email', $user->email)->first();
		// dd($user);
		if($tempUser) {
			Auth::login($tempUser);
			Cart::instance('shopping');
            Cart::instance('shopping')->restore(Auth::user()->id);
            Cart::instance('wishlist');
            Cart::instance('wishlist')->restore(Auth::user()->email);
			return redirect('');
		}
		else {
			$newUser = new User();
			$newUser->name = $user->name;
			$newUser->email = $user->email;
			$newUser->password = Hash::make($user->user['id']);
			$newUser->level = 2;
			$newUser->phone = '';
			$newUser->address = '';
			$newUser->inbag = '';
			$newUser->save();
			Auth::attempt(['email' => $user->email, 'password' => $user->user['id']]);
			return redirect('/');
		}
		return redirect('/');
	}

}
