<!DOCTYPE html>
<html lang="en">
<head>
    <base href=" {{ asset('') }}public/">
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu</title>

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
                    <form method="POST" action="{{url('password_reset')}}" id="signup-form" class="signup-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h2 class="form-title">Nhập mật khẩu</h2>

                      	<input type="hidden" name="id" value="{{$id}}">
                      	<input type="hidden" name="code" value="{{$code}}">

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
                        @if($errors->has('errorPassword'))
                        <p style="color: red"><b>{{$errors->first('errorPassword')}}</b></p>
                        @endif
                        <div class="form-group" >
                            <input style="margin-top: 80px;" type="submit" name="submit" id="submit" class="form-submit" value="Xác nhận"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- <script src="js/register_main.js"></script> -->
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>