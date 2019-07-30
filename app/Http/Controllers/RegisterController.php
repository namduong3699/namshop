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
use App\Confirm;
use Mail;
use App\Mail\CheckEmail;
use App\Mail\CheckEmailReset;

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
            'name'          => 'required|min:1',
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
            'name.min'              => 'Tên chứa ít nhất 3 ký tự'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $email = $request->input('email');
            $password = $request->input('password');
            $user= User::where('email','=',$email)->get();
            if(count($user)) {
                $errors = new MessageBag(['errorComfirmEmail' => 'Email đã được sử dụng']);
                return redirect('/register')->withInput()->withErrors($errors);
            }
            if($request->password!=$request->re_password){
                $err = new MessageBag(['errorPassword' => 'Mật khẩu không khớp']);
                return redirect('/register')->withInput()->withErrors($err);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email=$request->email;
            $user->password= Hash::make($password);
            $user->phone= $request->phone;
            $address = array('tinh' => $request->tinh, 'huyen' => $request->huyen,'xa' => $request->xa);
            $user->address= json_encode($address);  
            $user->save();

            $code = new Confirm();
            $code->user_id= $user->id;
            $code_confirm= str_random(50);
            $code->status=0;
            $code->code= $code_confirm;

            $code->save();

            Mail::to($request->email)->send(new CheckEmail($code_confirm, $user->name));

            return redirect('/confirm');
            // return redirect()->back();
            // if (Auth::attempt(['email' => $email, 'password' => $password])) {
            //  return redirect()->intended('/');
            //  } else {
            //      $errors = new MessageBag(['errorlogin' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
            //  return redirect()->back()->withInput()->withErrors($errors);
            // }
        }
    }

    public function postReset(Request $request){
        $email = $request->email;
        $codeUser=User::where('email', $email)->get();
        if(count($codeUser)!=0){
            $codeUser=  $codeUser[0];
            // echo '<pre>';
            // echo var_dump($codeUser);
            // echo '</pre>';
            $code = new Confirm();
            $code->user_id= $codeUser->id;
            $code_confirm= str_random(50);
            $code->status=1;
            $code->code= $code_confirm;

            $code->save();

            Mail::to($request->email)->send(new CheckEmailReset($code_confirm, $codeUser->name));
            // Mail::send('confirm_code_reset', ['code' => $code_confirm,'name'=> $codeUser['name']], function($message){
            //     $message->from('admin@gmail.com', 'Cozastore');
            //     $message->to($email, 'Cozastore')->subject('Visitor Feedback!');
            // });
            return redirect('/confirm');
         }else{
            $errorComfirmEmail = new MessageBag(['errorComfirmEmail' => 'Không tìm thấy tài khoản!']);
            return redirect('resetpassword')->withInput()->withErrors($errorComfirmEmail);
        }

    }
    public function passwordForget(Request $request)
    {
        // echo '<pre>';
        // echo var_dump($request->id);
        // echo var_dump($request->password);
        // echo var_dump($request->re_password);
        // echo '</pre>';
        $rules = [
            
            'password'      => 'required|min:6',
            're_password'   => 'required|min:6',
        
        ];
        $messages = [
            
            'password.required' => 'Mật khẩu không được để trống',
            'password.min'      => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            're_password.required'      => 'Không được để trống',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            if($request->password!=$request->re_password){
                    $err = new MessageBag(['errorPassword' => 'Mật khẩu không khớp']);
                    return redirect()->back()->withErrors($err);
                }
            $co= Confirm::where('code',$request->code)->get();

            if(count($co)!=0){
            $co=$co[0];
            $user= User::find($request->id);
            $user->password= Hash::make($request->password);
            $user->save();
            $coC= Confirm::find($co['id']);
            $coC->delete();
            }
        return redirect('/login');
        }
    }

    public function confirmUser($code)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time= time();
        $codeUser= Confirm::where('code',$code)->get();

        if(count($codeUser)!=0){

            // $codeUser=  $codeUser[0]['attributes'];
            // dd($codeUser[0]);
            $timeCreate=strtotime($codeUser[0]->createat);
            
            if($time - $timeCreate > 6000){
                // echo 'quá thời gian';
                // echo '<pre>';
                // echo var_dump(date('d/m/Y - H:i:s',$time));
                // echo var_dump($time-$timeCreate);
                // echo var_dump($codeUser);
                // echo var_dump($codeUser['id']);
                // echo '</pre>';
                // if($codeUser[0]->status==0){
                //     $user= User::find($codeUser[0]->user_id);
                //     $user->level=2;
                //     $user->save();
                //     return redirect('/login');
                // }
                return redrirect('/');
            }
            else{
                if($codeUser[0]->status==0){
                    $user= User::find($codeUser[0]->user_id);
                    $user->level=2;
                    $user->save();
                    $co= Confirm::find($codeUser[0]->id);
                    $co->delete();
                    return redirect('/login');
                }
                if($codeUser[0]->status==1){
                    $user= User::find($codeUser[0]->user_id);
                    // $co= Confirm::find($codeUser['id']);
                    // $co->delete();    
                    return view('reset_password_input',['id'=>$user->id,'code'=>$code]);
                }
            }


        }else{
            return redirect('/');
        }
    }
}
