<style>
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
@media (max-width: 1030px) {
	.category {
		width: 100%;
	}
	.product-list {
		width: 100%;
	}
}
.removeWish {
	color: #eb4d4b;
}
.addWish {
	color: #a4b0be;
}

</style>


<div class="bg0 m-t-23 p-b-140">
	<div class="container">
		<div class="p-t-25 category">
			<h4 class="mtext-112 cl2 p-b-35">
				Danh mục
			</h4>

			<ul>
				<li class="bor18">
					<a href="{{URL::to('product')}}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
						Tất cả
					</a>
				</li>

				@foreach($catalog as $cata)
				<li class="bor18"><a class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4" href="{{ URL::to('product', $cata->id  ) }}">{{ $cata->name }}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="product-list">
			<div class="flex-w flex-sb-m p-b-15">
				<h4 class="mtext-112 cl2 p-b-20 p-t-25">
					Có tất cả <strong style="color: red">{{$product->total()}}</strong> sản phẩm
				</h4>
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Lọc
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Tìm kiếm
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
						<form method="get" action="{{ URL::to('search') }}" style="width: 100%;">
							<input class="mtext-107 cl2 size-114 plh2 p-r-15" name="key" type="text" placeholder="Tìm kiếm" id="search-pro">
						</form>
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sắp xếp theo
							</div>

							<ul>
								<li class="p-b-6">
									<a href="{{ URL::to('product') }}" class="filter-link stext-106 trans-04">
										Mặc định
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/moi-nhat') }}" class="filter-link stext-106 trans-04 {{-- filter-link-active --}}">
										Mới nhất
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/thap-len-cao') }}" class="filter-link stext-106 trans-04">
										Giá: thấp đến cao
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/cao-xuong-thap') }}" class="filter-link stext-106 trans-04">
										Giá: cao xuống thấp
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Giá
							</div>

							<ul>
								<li class="p-b-6">
									<a href="{{ URL::to('product') }}" class="filter-link stext-106 trans-04 {{-- filter-link-active --}}">
										Tất cả
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/0-50') }}" class="filter-link stext-106 trans-04">
										0 - 50.000VNĐ
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/50-100') }}" class="filter-link stext-106 trans-04">
										50.000 - 100.000VNĐ
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/100-150') }}" class="filter-link stext-106 trans-04">
										100.000 - 150.000VNĐ
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/150-200') }}" class="filter-link stext-106 trans-04">
										150.000 - 200.000VNĐ
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{ URL::to('filter/200') }}" class="filter-link stext-106 trans-04">
										Trên 200.000VNĐ
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Thẻ
							</div>

							<div class="flex-w p-t-4 m-r--5">
								@foreach($catalog as $cata)
								<a href="{{ URL::to('product', $cata->id  ) }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									{{$cata->name}}
								</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row isotope-grid">				
				@foreach($product as $item)
				<div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item women animated zoomIn wow">
					<div class="block2">
						<div class="block2-pic hov-img0">
							@if ($item->discount != 0)
							<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
							@endif
							<a href="{{ URL::to('product-detail', $item->id  ) }}">
								<img src="{{ $item->image_link }}" alt="IMG-PRODUCT">
							</a>
							{{-- <img src="{{ $item->image_link }}" alt="IMG-PRODUCT"> --}}

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 js-show-info" id="{{ $item->id }}">
								Xem nhanh
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="{{ URL::to('product-detail', $item->id  ) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"">
									{{ $item->name }}
								</a>
								<div>
									@if ($item->discount != 0)
									<span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 15px;">
										{{ number_format($item->price) }} VNĐ</span>
										<span class="stext-105 cl3">
											<strong style="color: #e74c3c;">
												{{ number_format($item->price * (100-$item->discount) / 100) }} VNĐ
											</strong>
										</span>
										@else
										<span class="stext-105 cl3">
											{{ number_format($item->price) }} VNĐ
										</span>
										@endif	
									</div>
								</div>

								{{-- <div class="block2-txt-child2 flex-r p-t-3">
									@if(Cart::instance('wishlist')->search(function($cartItem, $rowId) use($item) {return $cartItem->id == $item->id;})->first() !== null)
									<a href="#" class="btn-addwish-b2 dis-block pos-relative" onclick="delWish('{{$item->rowId}}')" id="{{ $item->id }}">
										<i class="fa fa-heart-o removeWish" aria-hidden="true"></i>
									</a>
									@else
										<a href="{{ URL::to('add-to-wishlist' , $item->id) }}" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" id="{{ $item->id }}">
											<i class="fa fa-heart-o addWish" aria-hidden="true"></i>
										</a>
									@endif

								</div> --}}

								<div class="block2-txt-child2 flex-r p-t-3">

										@if(Cart::instance('wishlist')->search(function($cartItem, $rowId) use($item) {return $cartItem->id == $item->id;})->first() !== null)
										<i class="fa fa-heart" aria-hidden="true" style="color: #eb4d4b; font-size: 18px"></i>
										@else
										<a href="{{ URL::to('add-to-wishlist' , $item->id) }}" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" id="{{ $item->id }}">
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

				<!-- Load more -->
				<div class="flex-c-m flex-w w-full p-t-38">
					{!! $product -> render() !!}
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>

	</div>



	<script src="js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	<script src="js/jquery.min.js"></script>
	<script>
			// $(document).ready(function(){
			// 	$('.addWish').click(function() {
			// 		$(this).addClass('removeWish');
			// 		$(this).removeClass('addWish');
			// 		$(this).parent().removeClass('js-addwish-b2');
			// 	});
			// });
			// $(document).ready(function(){
			// 	$('.removeWish').click(function() {
			// 		$(this).addClass('addWish');
			// 		$(this).parent().addClass('js-addwish-b2');
			// 		$(this).removeClass('removeWish');
			// 	});
			// });
			$(document).ready(function(){
			//Modal
			$('.js-show-modal1').click(function(){
				// $('.js-modal1').addClass('show-modal1');
				var id= this.id;
				$.ajax({
					url:"{{ URL::to('modal') }}",
					method:"GET",
					data:{id:id},
					success:function(data) {
						$('.js-modal1').html(data);
						$('.js-modal1').addClass('show-modal1');
						console.log(data);
					}
				});
				// $('.js-modal1').addClass('show-modal1');
			});

			
		});
	</script>
