<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				Sản phẩm cùng loại
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				@foreach($relatePro as $relate)
				<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							@if ($relate->discount != 0)
							<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
							@endif
							<a href="{{ URL::to('product-detail', $relate->id  ) }}">
									<img src="{{ $relate->image_link }}" alt="IMG-PRODUCT">
								</a>
							

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								Xem nhanh
							</a>
						</div>
						{{-- {{dd(Cart::instance('shopping')->content())}} --}}
						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="{{ URL::to('product-detail', $relate->id  ) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{ $relate->name }}
								</a>

								<div>
									<div>
										@if ($relate->discount != 0)
										<span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 15px;">
											{{ number_format($relate->price) }} VNĐ</span>
											<span class="stext-105 cl3">
												<strong style="color: #e74c3c;">
													{{ number_format($relate->price * (100-$relate->discount) / 100) }} VNĐ
												</strong>
											</span>
											@else
											<span class="stext-105 cl3">
												{{ number_format($relate->price) }} VNĐ
											</span>
											@endif	
										</div>
									</div>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">

									@if(Cart::instance('wishlist')->search(function($cartItem, $rowId) use($relate) {return $cartItem->id == $relate->id;})->first() !== null)
									<i class="fa fa-heart" aria-hidden="true" style="color: #eb4d4b; font-size: 18px"></i>
									@else
									<a href="{{ URL::to('add-to-wishlist' , $relate->id) }}" class="btn-addwish-b2 dis-block pos-relative" id="{{ $relate->id }}">
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
									</a>
									@endif
									
								</div>
							</div>
						</div>
					</div>
					@endforeach


				</div>
			</div>
		</div>
	</section>

	<style>
	.ribbon-wrapper {
		z-index: 99;
		width:60px;
		height:60px;
		overflow:hidden;
		position:absolute;
		top:-3px;
		right:-3px
	}
	.ribbon {
		color:#fff;
		text-align:center;
		-webkit-transform:rotate(45deg);
		-moz-transform:rotate(45deg);
		-ms-transform:rotate(45deg);
		-o-transform:rotate(45deg);
		position:relative;
		padding:4px 0;
		left:1px;
		top:4px;
		width:80px;
		text-transform:uppercase;
		background-color:#3a5c83
	}

	.ribbon:before,.ribbon:after {
		content:"";
		border-top:3px solid #6e8900;
		border-left:3px solid transparent;
		border-right:3px solid transparent;
		position:absolute;
		bottom:-3px
	}

	.ribbon:before {
		left:0
	}

	.ribbon:after {
		right:0
	}

	.ribbon.sale {
		background-color:#f90
	}

	.cart-icon {
		font-size: 24px;
		color: #747d8c;
	}
	.category {
		float: left;
		width: 20%;
		margin-right: 30px;
	}
	.product-list {
		float: left;
		width: 77%;
	}
</style>