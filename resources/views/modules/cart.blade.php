<div class="wrap-header-cart js-panel-cart">
	<div class="s-full js-hide-cart"></div>
	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			<span class="mtext-103 cl2">
				Giỏ hàng 
			</span>

			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>

		<div class="header-cart-content flex-w js-pscroll">
			<ul class="header-cart-wrapitem w-full">
				@if(isset($cart))
				@foreach(Cart::instance('shopping')->content() as $item)
				<li class="header-cart-item flex-w flex-t m-b-12">
					<div class="header-cart-item-img">
						<img src="{!! $item->options->image !!}" alt="IMG">
					</div>

					<div class="header-cart-item-txt p-t-8">
						<a href="{{ URL::to('product/' . $item->id)}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							{!! $item->name !!}
						</a>

						<span class="header-cart-item-info">
							{!! $item->qty !!} x {!! number_format($item->price, 0, ",", ".") !!}
						</span>
					</div>
				</li>
				@endforeach
				@else 
				<span class="mtext-103 cl2">
					Không có hàng trong giỏ
				</span>
				@endif


			</ul>

			<div class="w-full">
				<div class="header-cart-total w-full p-tb-40">
					<table width="250px;">
						<tr>
							<td>Số lượng:</td>
							<td>
								<span style="color: red;"><b>
									@if(isset($cart))
									{{Cart::count()}}
									@else
									0 
									@endif
								</b></span><br/>
							</td>
						</tr>
						<tr> 
							<td>Tổng cộng:</td>
							<td>
								<span style="color: red;"><b>
									@if(isset($cart))
									{{Cart::subTotal(0, ',')}}  VNĐ
									@else
									0 VNĐ
									@endif
								</b></span>
							</td>
						</tr>
					</table>

					

					
				</div>
				<div class="header-cart-buttons flex-w w-full">
					<a href="{{ URL::to('shoping-cart') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
						Xem chi tiết
					</a>

					<a href="{{ URL::to('shoping-cart') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
						Đặt hàng
					</a>
				</div>
			</div>
		</div>
	</div>
</div>