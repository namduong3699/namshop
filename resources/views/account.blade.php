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

	

	
	<form class="bg0 p-t-50 p-b-85" style="margin-top: 100px">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
					<div class="bor10 p-lr-15 p-t-30 p-b-40 m-l-30 m-r-0 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-10 p-l-17">
							Thông tin tài khoản
						</h4>
						<div class="edit-acc p-l-17">
							<i class="fa fa-key" aria-hidden="true"></i> <a {{-- href="#" --}} id="bt-change-pass" style="cursor: pointer;">Đổi mật khẩu</a>	
						</div>
						<div class="edit-acc p-l-17 p-b-30">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <a {{-- href="#" --}}  id="bt-edit-account" style="cursor: pointer;">Sửa thông tin</a>	
						</div>
						
						
						<div class=" col-xl-12 m-lr-auto m-b-25 p-lr-0">
							<div class=" m-lr-0-xl">
								<div class="new-info">
									@if(!isset(Auth::user()->name)))
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
													SĐT: 
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
												<td style="vertical-align: top;"> 
													Địa chỉ:

												</td>
												<td>
													<p>{{$address['xa']}}, {{$address['huyen']}}, {{$address['tinh']}}</p>
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

				<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50" id="car-table">
					{{-- {{dd($history)}} --}}
					<h4 class="mtext-109 cl2 p-b-10 m-t-30 m-b-60" style="border-bottom: 1px solid #eee">
						Lịch sử mua hàng
					</h4>
					@if($history)
					@foreach($history as $key => $hist)
					<table class="trans-info">
						<tr>
							<td>Đơn hàng: <span style="cursor: pointer; color: #a29bfe;">#{{$hist['trans']->id}}</span></td>
							<td>Đặt ngày: {{$hist['trans']->createdat}}</td>
						</tr>
						<tr>
							<td>Tình trạng: @if($hist['trans']->status == 0) chưa giao hàng @else đã giao hàng @endif</td>
							<td>Phương thức thanh toán: {{$hist['trans']->payment_info}} @if($hist['trans']->payment == 'none') (chưa thanh toán) @else (đã thanh toán) @endif</td>
						</tr>
						<tr>
							<td colspan="2">Địa chỉ nhận hàng: {{implode(", ", array_reverse(json_decode($hist['trans']->message, true)))}}</td><td></td>
						</tr>
					</table>
					



					<div class="m-l-0 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart" id="cart">						
							<table class="table-shopping-cart p-b-15">
								<tr class="table_head">
									<th class="column-1">Sản phẩm</th>
									<th class="column-2">Tên sản phẩm</th>
									<th class="column-3">Giá</th>
									<th class="column-3">Kích cỡ</th>
									<th class="column-3">Màu sắc</th>
									<th class="column-4">Số lượng</th>
									<th class="column-5">Tổng cộng</th>
								</tr>
								
								@foreach($hist['info']['order'] as $product)
								{{-- {{dd($product)}} --}}
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1 p-t-40">
											<img src="images/{{ $hist['info']['pro'][$loop->index]->folder }}/{{ $hist['info']['pro'][$loop->index]->image_link }}" alt="IMG">
										</div>
									</td>
									<td class="column-2"> <a href="{{URL::to('product-detail/' .$hist['info']['pro'][$loop->index]->id)}}" style="color: #636e72">{{$hist['info']['pro'][$loop->index]->name}}</a> </td>
									<td class="column-3"> {{number_format($hist['info']['pro'][$loop->index]->price)}} VNĐ</td>
									<td class="column-3">{{ json_decode($product->data, true)['size'] }}</td>
									<td class="column-3">{{ json_decode($product->data, true)['color'] }}</td>
									<td class="column-3">
										{{ $product->count }}
									</td>
									<td class="column-5">{{ number_format($product->amount) }} VNĐ</td>
								</tr>
								@endforeach
								
							</table>
						</div>
						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-l-40 p-lr-15-sm p-r-20 txt-center m-b-70" style="text-align: center;">
							@if(Cart::instance('shopping')->content())
							<b>Tổng cộng:</b> <strong>{{ number_format($hist['trans']->amount) }} VNĐ</strong>
							@else 
							<b>Giỏ hàng rỗng</b>
							@endif
						</div>
					</div>
					@endforeach
					@else
					<h4 class="mtext-109 cl2 p-b-10 m-t-30 m-b-40 p-b-20" style="text-align: center; ">
						Trống
					</h4>
					@endif
				</div>
				
				{{-- ĐỔI THÔNG TIN TÀI KHOẢN --}}
				<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50 dp-none" id="edit-account-tb">
					<h4 class="mtext-109 cl2 p-b-10 p-l-20 m-t-30">
						Vui lòng điền thông tin chính xác
					</h4>
					<form method="get">
						{{ csrf_field() }}
						<table class="m-t-55">
							<tr> 
								<td>
									Họ & tên: 
								</td>
								<td>
									<div class="wrap-input1 w-full p-b-4">
										<input class="input1  plh1 stext-107 cl7" type="text" name="name" value="{{$user->name}}" required="">
										<div class="focus-input1 trans-04"></div>
									</div>
								</td>
							</tr>
							<tr> 
								<td class="p-b-20">
									Số điện thoại: 
								</td>
								<td class="p-b-20">
									<div class="wrap-input1 w-full p-b-4">
										<input class="input1  plh1 stext-107 cl7" type="text" name="phone" value="{{$user->phone}}" required="">
										<div class="focus-input1 trans-04"></div>
									</div>
								</td>
							</tr>
							<tr> 
								<td style="vertical-align: top;"> 
									Địa chỉ:
								</td>
								<td>
									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="thanh_pho" id="thanh_pho" required="">
											<option value="">Tỉnh / Thành phố...</option>
											@foreach($tp as $thanh_pho)
											<option value="{{$thanh_pho->matp}}">{{$thanh_pho->name}}</option>
											@endforeach
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="quan_huyen" id="quan_huyen" required="">
											<option value="">Quận / Huyện...</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="phuong_xa" id="phuong_xa" required="">
											<option value="">Phường / Xã...</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="edit-acc-bt m-r-40 m-b-20 m-t-20" style="width: 30%; float: right;">
							<input type="submit" class="flex-c-m stext-101 size-116 cl0 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" value="Thay đổi" formaction="{{URL::to('editAccount')}}">
						</div>
					</form>
				</div>

				{{-- ĐỔI MẬT KHẨU --}}
				<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50 dp-none" id="change-pass-tb">
					<h4 class="mtext-109 cl2 p-b-10 p-l-20 m-t-30">
						Vui lòng điền thông tin chính xác
					</h4>
					<form method="get">
						{{ csrf_field() }}
						<table class="m-t-55">
							<tr> 
								<td class="p-b-20">
									Mật khẩu cũ:
								</td>
								<td class="p-b-20">
									<div class="wrap-input1 w-full p-b-4">
										<input class="input1  plh1 stext-107 cl7" type="password" name="oldPass" id="oldPass">
										<div class="focus-input1 trans-04"></div>
									</div>
								</td>
							</tr>
							<tr> 
								<td>
									Mật khẩu mới: 
								</td>
								<td>
									<div class="wrap-input1 w-full p-b-4">
										<input class="input1  plh1 stext-107 cl7" type="password" name="newPass1" id="pass1">
										<div class="focus-input1 trans-04"></div>
									</div>
								</td>
							</tr>
							<tr> 
								<td>
									Nhập lại mật khẩu: 
								</td>
								<td>
									<div class="wrap-input1 w-full p-b-4">
										<input class="input1  plh1 stext-107 cl7" type="password" name="newPass2" id="pass2">
										<div class="focus-input1 trans-04"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="edit-acc-bt m-r-40 m-b-20 m-t-20" style="width: 30%; float: right;">
							<div  class="flex-c-m stext-101 size-116 cl0 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" id="change-pass">Thay đổi</div>
						</div>
					</form>
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
		// $(".js-select2").each(function(){
		// 	$(this).select2({
		// 		minimumResultsForSearch: 20,
		// 		dropdownParent: $(this).next('.dropDownSelect2')
		// 	});
		// })
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
			$("#change-pass").click(function(){
				var pass1 = $('#pass1').val();
				var pass2 = $('#pass2').val();
				var oldPass = $('#oldPass').val();
				if(pass1 == '' || pass2 == '' || oldPass == '') swal(' ', "Phải nhập đầy đủ thông tin!", "error");
				else if(pass1.length < 6 || pass2.length < 6) swal(' ', "Mật khẩu phải có ít nhất 6 ký tự!", "error");
				else if(pass1 != pass2) swal(' ', "Nhập lại mật khẩu mới không đúng", "error");
				else 
					$.get('{{ URL::to('editAccount') }}', {'oldPass':oldPass, 'newPass':pass1}, function(data) {
						if(data == 'Mật khẩu sai!') swal(' ', data, "error");
						else swal(' ', data, "success");
					});
			});
			$("#bt-change-pass").click(function(){
				$('#car-table').addClass('dp-none');
				$('#edit-account-tb').addClass('dp-none');
				$('#change-pass-tb').removeClass('dp-none')
			});
			$("#bt-edit-account").click(function(){
				$('#car-table').addClass('dp-none');
				$('#change-pass-tb').addClass('dp-none');
				$('#edit-account-tb').removeClass('dp-none')
			});
		});
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
	vertical-align: top;
}
.wrap-input1 {
	border-bottom: 1px solid #eee !important;
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
.dp-none {
	display: none;
}
</style>

