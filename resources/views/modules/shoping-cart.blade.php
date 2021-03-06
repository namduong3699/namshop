<form class="bg0 p-t-75 p-b-85">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
				<div class="m-l-0 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart" id="cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Sản phẩm</th>
								<th class="column-2">Tên sản phẩm</th>
								<th class="column-3">Giá</th>
								<th class="column-3">Kích cỡ</th>
								<th class="column-3">Màu sắc</th>
								<th class="column-4">Số lượng</th>
								<th class="column-5">Tổng cộng</th>
							</tr>

							@if(Cart::content())
							@foreach(Cart::instance('shopping')->content() as $product)
							
							<tr class="table_row" id="del-cart-{{$product->id}}">
								<td class="column-1">
									<div class="how-itemcart1">
										<img src="images/{{ $product->options->folder }}/{{ $product->options->image }}" alt="IMG">
									</div>
								</td>
								<td class="column-2">{{ $product->name }}</td>
								<td class="column-3">{{ number_format($product->price) }} VNĐ</td>
								<td class="column-3">{{ $product->options->nameSize }}</td>

								<td class="column-3">{{ $product->options->nameColor }}</td>
								<td class="column-4">
									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" >
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product num-product" type="number" name="num-product1" data-id="{{$product->rowId}}" value="{{ $product->qty }}">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
								</td>
								<td class="column-5">{{ number_format($product->qty * $product->price)}} VNĐ</td>
							</tr>
							@endforeach
							@endif

						</table>
					</div>

					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm flex-center">
						{{-- <div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Mã giảm giá">

							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								Áp dụng
							</div>
						</div> --}}

						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" id="update">
							Cập nhật giỏ hàng
						</div>
					</div>
				</div>
			</div>
			{{-- http://localhost/namshop/shoping-cart?num-product1=11&coupon=&_token=qzFvo0YrzoDHBTpxflDbhU6WA25Ky3Vxs8xaPFUu&name-client=&phone-number=&thanh_pho=T%E1%BB%89nh+%2F+Th%C3%A0nh+ph%E1%BB%91...&quan_huyen=Qu%E1%BA%ADn+%2F+Huy%E1%BB%87n...&phuong_xa=Ph%C6%B0%E1%BB%9Dng+%2F+X%C3%A3...&address=&ship=COD --}}

			<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-30 m-r-0 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Giao hàng
					</h4>
					<form action="{{URL::to('checkout')}}" method="get">
						{{ csrf_field() }}


						<div class="flex-w flex-t bor12 p-t-15 p-b-30">

							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Lưu ý:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									Vui lòng kiểm tra kỹ thông tin cá nhân trước khi đặt hàng
								</p>
							</div>

							<div class="p-t-15" style="width: 100%">

								<div class="bor8 bg0 m-b-12 m-t-20">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name_client" placeholder="Họ và tên" required="Không được bỏ trống" @if(Auth::check())value="{{$user->name}}"@endif>
								</div>

								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone_number" placeholder="Số điện thoại" required="Không được bỏ trống" @if(Auth::check())value="{{$user->phone}}"@endif">
								</div>

								<div class="bor8 bg0 m-b-12 m-t-20">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" placeholder="Email" required="Không được bỏ trống" @if(Auth::check())value="{{$user->email}}"@endif">
								</div>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select required class="js-select2" name="thanh_pho" id="thanh_pho" >
										<option value="">Tỉnh / Thành phố...</option>
										@foreach($tp as $thanh_pho)
										<option value="{{$thanh_pho->matp}}">{{$thanh_pho->name}}</option>
										@endforeach
									</select>
									<div class="dropDownSelect2"></div>
								</div>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select class="js-select2" name="quan_huyen" id="quan_huyen" required="Không được bỏ trống">
										<option value="">Quận / Huyện...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>

								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select class="js-select2" name="phuong_xa" id="phuong_xa" required="Không được bỏ trống"> 
										<option value="">Phường / Xã...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>

								<div class="bor8 bg0">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Chi tiết" required="Không được bỏ trống">
								</div>
								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-22 m-t-9">
									<select class="js-select2" name="ship" id="thanh_pho">
										<option value="COD">Thanh toán khi nhận hàng</option>
										<option value="PAY">Thanh toán trực tuyến</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Tổng cộng:
								</span>
							</div>

							<div class="size-209 p-t-1" id="total-Money">
								<span class="mtext-110 cl2" id="totalPrice">
									@if(Cart::content())
									{{ Cart::subtotal(0) }} VNĐ
									@else
									0 VNĐ
									@endif
								</span>
							</div>
						</div>
						<input type="submit" class="flex-c-m stext-101 size-116 cl0 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer button-checkout" value="Xác nhận đặt hàng">
						{{-- <input type="submit"  value="Xác nhận đặt hàng"> --}}
						
					</form>
					

					{{-- <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=namduong3699@gmail.com&product_name=Cozastore&price={{ Cart::subtotal(0, '', '') }}&return_url=http://localhost/namshop/shoping-cart&comments=Thanh toán đơn hàng"><img src="https://www.nganluong.vn/css/newhome/img/button/pay-lg.png"border="0" /></a> --}}
				</div>
			</div> 
		</div>
	</div>
</form>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
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
	function updateCart(rowId, qty, val){
		$.get('{{ URL::to('add-to-cart/add') }}', {'rowId':rowId,'qty':qty}, function(data, textStatus, xhr) {
			totalQty = parseInt( $('.cart-icon').attr('data-notify') ) + parseInt(val);
			$( "#cart" ).load(" #cart" );
			$( "#total-Money" ).load(" #total-Money");
			$( ".header-cart-content" ).load(" .header-cart-content");
			$('.cart-icon').attr('data-notify', totalQty);
			$('.data-label1').attr('data-label1', totalQty);
		});
	}
</script>
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
	$('#update').on('click', function(event) {
		event.preventDefault();
		var total=0;
		var totalPrice=0;
		$('#show-cart-full').html(' ');
		$('.num-product').each(function(index, el) {
			// console.log($(el).val());
			// console.log($(el).data('id'));
				// $.get('{{ URL::to('add-to-cart/add') }}', {'rowId':$(el).data('id'),'qty':$(el).val()}, function(data, textStatus, xhr) {
				// 		total+= parseInt($(el).val());
				// 		console.log(total);
				// 	});
				if($(el).val() == 0) $(el).parent().parent().parent().remove();

				$.ajax({
					url: '{{ URL::to('add-to-cart/add') }}',
					type: 'get',
					dataType:'json',
					async:false,
					data: {'rowId':$(el).data('id'),'qty':$(el).val()},
					success: function(data){
						// console.log(data);
						let html= '<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img"><img src="images/'+ data.options.folder+'/'+data.options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="product/"'+data.options.id +'" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data.name +'</a><span class="header-cart-item-info">'+data.qty +' x '+data.price +'</span></div></li>';

						$('#show-cart-full').append(html);
						totalPrice+=parseInt($(el).parent().parent().prev().prev().prev().text()) * parseInt($(el).val());
						total+= parseInt($(el).val());
						// console.log(total);

						$(el).parent().parent().next().text(parseInt($(el).parent().parent().prev().prev().prev().text()) * parseInt($(el).val())+ ' VNĐ');	
					}
				})
				.always(function() {
					
					$('.data-notify').attr('data-notify', total);
					$('.data-label1').attr('data-label1', total);
					swal('', "Đã cập nhật giỏ hàng !", "success");
					console.log("complete");
					// console.log(totalPrice);
					// $('#totalPrice').text(totalPrice + " VNĐ");
					$.ajax({
							url: 'countprice/',
							type: 'get',
							success: function(data){
								console.log(data);
								 $('#totalPrice').text(data + " VNĐ");
								 $('#tuto').text(data + " VNĐ");
							}
						});
				});
				
		});

		
		
		
		
	});
	// function updateCart(rowId, qty, val){
	// 	$.get('{{ URL::to('add-to-cart/add') }}', {'rowId':rowId,'qty':qty}, function(data, textStatus, xhr) {
	// 		totalQty = parseInt( $('.cart-icon').attr('data-notify') ) + parseInt(val);
	// 		$( "#cart" ).load(" #cart" );
	// 		$( "#total-Money" ).load(" #total-Money");
	// 		$( ".header-cart-content" ).load(" .header-cart-content");
	// 		$('.cart-icon').attr('data-notify', totalQty);
	// 		$('.data-label1').attr('data-label1', totalQty);
	// 	});
	// }
</script>

