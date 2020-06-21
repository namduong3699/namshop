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
                    <form method="POST" id="signup-form" class="signup-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h2 class="form-title">Lấy lại tài khoản</h2>

                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                        </div>
                        @if($errors->has('email'))
                        <p style="color: red"><b>{{$errors->first('email')}}</b></p>
                        @endif
                        @if($errors->has('errorComfirmEmail'))
                        <p style="color: red"><b>{{$errors->first('errorComfirmEmail')}}</b></p>
                        @endif
                        </div>
                        <div class="form-group" >
                            <input style="margin-top: 80px;" type="submit" name="submit" id="submit" class="form-submit" value="Lấy lại mật khẩu"/>
                        </div>
                    </form>
                    <p class="loginhere" style="margin-top: 15px">
                        <a href="{{ URL::to('login') }}" class="loginhere-link">Đăng nhập</a>
                        <a href="{{ URL::to('register') }}" style="margin-left: 16px;" class="loginhere-link">Đăng ký</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- <script src="js/register_main.js"></script> -->
    <script>
        $(document).ready(function() {
            $( "#tinh" ).change(function() {
              $.ajax({
                  url: '/thongtin/huyen/'+ $(this).val(),
                  type: 'get',
                  dataType:'json',
                  success: function(data){
                    $('#huyen').html(' ');
                    data.forEach(function(e){
                     $('#huyen').append('<option value="'+e.maqh+'">'+e.name+'</option>');
                 });
                    $.ajax({
                      url: '/thongtin/xa/'+ data[0].maqh,
                      type: 'get',
                      dataType:'json',
                      success: function(data){
                        $('#xa').html(' ');
                        data.forEach(function(e){
                         $('#xa').append('<option value="'+e.maqh+'">'+e.name+'</option>');
                     });
                    }
                });
                }
            });
          });
            $( "#huyen" ).change(function() {
              $.ajax({
                  url: '/thongtin/xa/'+ $(this).val(),
                  type: 'get',
                  dataType:'json',
                  success: function(data){
                    $('#xa').html(' ');
                    data.forEach(function(e){
                     $('#xa').append('<option value="'+e.maqh+'">'+e.name+'</option>');
                 });
                }
            });
          });
        });
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>