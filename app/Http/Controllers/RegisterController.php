<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tinh;
use App\Huyen;
use App\Xa;
class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function huyen ($id) {
        $huyen = Huyen::where('matp','=',$id)->get();
        $huyen= json_encode($huyen);
        echo $huyen;
    }
    public function xa ($id) {
        $xa = Xa::where('maqh','=',$id)->get();
        $xa= json_encode($xa);
        echo $xa;
    }
    public function getRegister () {

        return view('register',['tinh'=>Tinh::all(),'huyen'=>Huyen::where('matp',1)->get(),'xa'=>Xa::where('maqh',1)->get()]);
    }
    public function postRegister(Request $request) {
        $rules = [
            'name'          => 'required|regex:/^[\pL\s\-]+$/u|min:6',
            'password'      => 'required|min:6',
            're_password'   => 'required|min:6',
            'phone'         => 'required',
            'email'         => 'required|email'
        ];
        $messages = [
            'email.required'    => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min'      => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'name.required'     => 'Không được để trống',
            're_password.required'      => 'Không được để trống',
            'phone.required'        => 'Không được để trống',
            'name.alpha'        => 'Tên chỉ được chứa chữ cái',
            'name.min'              => 'Tên chứa ít nhất 6 ký tự'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $email = $request->input('email');
            $password = $request->input('password');
            $user= User::where('email','=',$email)->get();
            if(!empty($user->id)) {
                $errors = new MessageBag(['errorComfirmEmail' => 'Email đã được sử dụng']);
                return redirect('/register')->withInput()->withErrors($errors);
            }
            // return $user;
            // if(!$user){
            //     $errors = new MessageBag(['errorComfirmEmail' => 'Email đã được sử dụng']);
            //     return redirect('/register')->withInput()->withErrors($errors);
            // }
            $user = new User();
            $user->name = $request->name;
            $user->email=$request->email;
            $user->password= Hash::make($request->password);
            $user->phone= $request->phone;
            $tinh = Tinh::where('matp', $request->tinh)->first()->name;
            $huyen = Huyen::where('maqh', $request->huyen)->first()->name;
            $xa = Xa::where('xaid', $request->xa)->first()->name;
            $user->address = ['tinh' => $tinh, 'huyen' => $huyen, 'xa' => $xa];
            $user->address = json_encode($user->address);
            $user->save();
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->intended('/');
                } else {
                    $errors = new MessageBag(['errorlogin' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
}
