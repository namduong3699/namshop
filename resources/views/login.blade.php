<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
    <base href="{{ asset('') }}public/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/main_login.css">
	<link rel="stylesheet" type="text/css" href="css/util_login.css">
	<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login">
			<div class="background" style="background-image: url('public/images/about-01.jpg'); float: left;">
				<div class="p-l-55 p-r-55 p-t-65 p-b-54">
					
				</div>
			</div> 
			<div class="container-login100" style="float: right;">
				<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
					<form action="{{url('login')}}" method="POST" class="login100-form validate-form">
						<span class="login100-form-title p-b-49">
							Đăng nhập
						</span>
						
						@if($errors->has('errorlogin'))
						<div class="alert alert-danger">
							<strong style="display: block; text-align: center; color: #e74c3c; margin-bottom: 20px;">{{$errors->first('errorlogin')}}</strong>
						</div>
						@endif


						<div class="wrap-input100 validate-input m-b-23" data-validate = "Tên đăng nhập không được để trống">
							<span class="label-input100">Email</span>
							<input class="input100" type="email" name="email" placeholder="Nhập vào tên đăng nhập">
							<span class="focus-input100" data-symbol="&#xf206;"></span>
						</div>
						@if($errors->has('email'))
						<p style="color: red"><b>{{$errors->first('email')}}</b></p>
						@endif

						<div class="wrap-input100 validate-input" data-validate="Mật khẩu không được để trống">
							<span class="label-input100">Mật khẩu</span>
							<input class="input100" type="password" name="password" placeholder="Nhập vào mật khẩu">
							<span class="focus-input100" data-symbol="&#xf190;"></span>
						</div>
						@if($errors->has('password'))
						<p style="color: red"><b>{{$errors->first('password')}}</b></p>
						@endif

						<div class="text-right p-t-8 p-b-31">
							<a href="{{URL::to('resetpassword')}}">
								Quên mật khẩu
							</a>
						</div>

						<div class="container-login100-form-btn">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								{!! csrf_field() !!}
								<button class="login100-form-btn" style="letter-spacing: 1.5px">
									Đăng nhập
								</button>
							</div>
						</div>

						<div class="txt1 text-center p-t-54 p-b-20">
							<span>
								Đăng nhập bằng 
							</span>
						</div>

						<div class="flex-c-m">
							{{-- <a href="{{ URL::to('auth/facebook') }}" class="login100-social-item bg1">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="login100-social-item bg2">
								<i class="fa fa-twitter"></i>
							</a> --}}

							{{-- <a href="{{ URL::to('auth/google') }}" class="login100-social-item bg3" style="text-decoration: none">
								<i class="fa fa-google"></i>
							</a> --}}
							<a href="{{ URL::to('auth/google') }}" class="login-bt bg3">
								<i class="fa fa-google"></i>oogle
							</a>
						</div>

						<div class="flex-col-c p-t-130">
							<span class="txt1 p-b-17">
								Nếu bạn chưa có tài khoản
							</span>

							<a href="{{ URL::to('register') }}" class="txt2">
								Đăng ký
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>




</body>
</html>
