@extends('main')
@section('page')
Tài khoản
@endsection

<!-- Header -->
@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@include('modules/wishlist')
@endsection

@section('content')

<body class="animsition">

	

	<!-- Shoping Cart -->
	<form class="bg0 p-t-50 p-b-85" style="margin-top: 100px">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					{{-- <div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="info">
							@if(!isset($user->name)))
							<div style='text-align:center'><h1>Bạn chưa đăng nhập</h1></div>
							@else

							<div class="img-info">
								<i class="fa fa-user-circle-o" aria-hidden="true"></i>
								<h1>Thông tin tài khoản</h1>
							</div>
							<div class="table-info">
								<table>
									<tr> 
										<td>
											Họ và tên: 
										</td>
										<td>
											{{$user->name}}
										</td>
									</tr>
									<tr> 
										<td>
											Số điện thoại: 
										</td>
										<td>
											{{$user->phone}}
										</td>
									</tr>
									<tr> 
										<td>
											Email:
										</td>
										<td>
											{{$user->email}}
										</td>
									</tr>
									<tr> 
										<td> 
											Địa chỉ:

										</td>
										<td>
											<p>{{$address['tinh']}}, {{$address['huyen']}}, {{$address['xa']}}</p>
										</td>
									</tr>
								</table>
							</div>
							@endif
						</div>
					</div> --}}
				</div>	
			</div>

			<div class="row">

				<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
					<div class="bor10 p-lr-15 p-t-30 p-b-40 m-l-30 m-r-0 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-10 p-l-17">
							Thông tin tài khoản
						</h4>
						<div class="edit-acc p-l-17">
							<i class="fa fa-key" aria-hidden="true"></i> <a href="">Đổi mật khẩu</a>	
						</div>
						<div class="edit-acc p-l-17 p-b-30">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <a href="">Sửa thông tin</a>	
						</div>
						
						
						<div class=" col-xl-12 m-lr-auto m-b-25 p-lr-0">
							<div class=" m-lr-0-xl">
								<div class="new-info">
									@if(!isset($user->name)))
									<div style='text-align:center'><h1>Bạn chưa đăng nhập</h1></div>
									@else
									

									<div class="new-table-info">
										<table>
											<tr> 
												<td>
													Họ & tên: 
												</td>
												<td>
													{{$user->name}}
												</td>
											</tr>
											<tr> 
												<td>
													Số điện thoại: 
												</td>
												<td>
													{{$user->phone}}
												</td>
											</tr>
											<tr> 
												<td>
													Email:
												</td>
												<td>
													{{$user->email}}
												</td>
											</tr>
											<tr> 
												<td> 
													Địa chỉ:

												</td>
												<td>
													<p>{{$address['tinh']}}, {{$address['huyen']}}, {{$address['xa']}}</p>
												</td>
											</tr>
										</table>
									</div>
									@endif
								</div>
							</div>
						</div>	
					</div>
				</div> 
				<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
					<div class="m-l-0 m-r--38 m-lr-0-xl">
						<form action="{{URL::to('editAccount')}}" method="get">
						{{ csrf_field() }}
						Họ và tên:
						<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name">
						</form>
					</div>
				</div>
			</div>
		</div>
	</form>




	



	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

@endsection

<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection

<style>
.info {
	border: 1px solid #57606f;
	overflow: hidden;
	background-color: #f1f2f6 !important;
}
.img-info {
	float: left;
	width: 40%;
	/*height: 100%;*/
	padding: 40px 15px;
	text-align: center;
	background-color: #353b48;
	font-weight: bold;
	color: #fff;
}
.img-info i {
	font-size: 175px;
}
.img-info h1 {
	font-size: 28px;
	padding-top: 60px;
}
.table-info {
	float: left;
	width: 60%;
	padding: 15px;
	background-color: #f1f2f6 !important;
}
table {
	width: 90%;
	margin: 0 auto;
	font-size: 16px;
}
table tr {
	line-height: 3em;
}
table tr td:first-child {
	font-weight: bold;
	width: 35%;
}
@media (max-width: 600px) {
	.img-info {
		float: none;
		width: 100%;
	}
	.img-info h1 {
		padding-top: 15px;
	}
	.table-info {
		float: none;
		font-size: 12px;
		width: 100%;
	}

	table tr td:first-child {
		width: 45%;
	}
	.img-info i {
		font-size: 125px;
	}
}

</style>

