<!DOCTYPE html>
<html lang="en">
<head>
    <base href=" {{ asset('') }}public/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style_register.css">
</head>
<body style="background-image: url('images/registerBG.jpg');">

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h2 class="form-title">Tạo tài khoản</h2>

                        @if($errors->has('errorlogin'))
                        <div class="alert alert-danger">
                            <strong style="display: block; text-align: center;">{{$errors->first('errorlogin')}}</strong>
                        </div>
                        @endif

                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Tên của bạn"/>
                        </div>
                        @if($errors->has('name'))
                        <p style="color: red"><b>{{$errors->first('name')}}</b></p>
                        @endif
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                        </div>
                        @if($errors->has('email'))
                        <p style="color: red"><b>{{$errors->first('email')}}</b></p>
                        @endif
                        @if($errors->has('errorComfirmEmail'))
                        <p style="color: red"><b>{{$errors->first('errorComfirmEmail')}}</b></p>
                        @endif
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        @if($errors->has('password'))
                        <p style="color: red"><b>{{$errors->first('password')}}</b></p>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-input" name="phone" id="phone" placeholder="Số điện thoại"/>
                        </div>
                        @if($errors->has('phone'))
                        <p style="color: red"><b>{{$errors->first('phone')}}</b></p>
                        @endif
                        <div class="form-group">
                            <select name="tinh" id="thanh_pho"  class="form-input">
                                @foreach($tinh as $value)
                                <option value="{{$value->matp}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="huyen" id="quan_huyen" class="form-input">
                                @foreach($huyen as $value)
                                <option value="{{$value->maqh}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="xa" id="phuong_xa" class="form-input">
                                @foreach($xa as $value)
                                <option value="{{$value->xaid}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>




                        <div class="form-group" >
                            <input style="margin-top: 80px;" type="submit" name="submit" id="submit" class="form-submit" value="Đăng ký"/>
                        </div>
                    </form>
                    <p class="loginhere" style="margin-top: 15px">
                        Nếu bạn đã có tài khoản? <a href="{{ URL::to('login') }}" class="loginhere-link">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- <script src="js/register_main.js"></script> -->
    <script>
        $(document).ready(function(){
            $("#thanh_pho").change(function(){
                var matp = $(this).val();
                $.get('{{ URL::to('getInfo') }}', {'matp':matp}, function(data) {
                    $( "#quan_huyen" ).html(data);
                });
            });
            $("#quan_huyen").change(function(){
                var maqh = $(this).val();
                $.get('{{ URL::to('getInfo') }}', {'maqh':maqh}, function(data) {
                    $( "#phuong_xa" ).html(data);
                });
            });
        });
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>