<div class="wrap-header-cart js-panel-wishlist">
	<div class="s-full js-hide-wishlist"></div>
	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			<span class="mtext-103 cl2">
				Danh sách yêu thích
			</span>

			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wishlist">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>

		<div class="header-wishlist-content flex-w js-pscroll">
			<div style="display: none;" id="wishQty">{{count(Cart::instance('wishlist')->content())}}</div>
			<ul id="wish-list" class="header-cart-wrapitem w-full wish-list">
				 {{-- {{dd(empty(Cart::instance('wishlist')->content()))}} --}}
				@if(count(Cart::instance('wishlist')->content()))
				@foreach(Cart::instance('wishlist')->content() as $item)
				<li class="header-cart-item flex-w flex-t m-b-12">
					<div class="header-cart-item-img del-wish" data-id='{{$item->id}}'>
						<img src="images/{!! $item->options->folder !!}/{!! $item->options->image !!}" alt="IMG">
					</div>

					<div class="header-cart-item-txt p-t-8">
						<a href="{{ URL::to('product/' . $item->id)}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							{!! $item->name !!}
						</a>

						<span class="header-cart-item-info">
							{!! number_format($item->price, 0, ",", ".") !!}
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


		</div>
	</div>
</div>