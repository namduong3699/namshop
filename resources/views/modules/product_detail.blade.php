<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-7 p-b-30">
				<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>
						<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

						<div class="slick3 gallery-lb">
							<?php
							$list = $product->image_list;
							$list= json_decode($list, true);
							?>
							@foreach($list as $image)
							<div class="item-slick3" data-thumb="images/{{$product->folder}}/{{$image}}">
								<div class="wrap-pic-w pos-relative">
									<img src="images/{{$product->folder}}/{{$image}}" alt="IMG-PRODUCT">

									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/{{$product->folder}}/{{$image}}">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-5 p-b-30">
				<div class="p-r-50 p-t-5 p-lr-0-lg">
					<h4 class="mtext-105 cl2 js-name-detail p-b-14" style="font-size: 32px;">
						{{ $product->name }}
					</h4>

					<span class="mtext-106 cl2">
						Giá: &nbsp;
						@if ($product->discount != 0)
						<strong id="price" style="text-decoration: line-through; margin-right: 15px;">
							{{ number_format($product->price) }} VNĐ
						</strong>
						<strong id="price" style="color: #eb4d4b">
							{{ number_format($product->price * (100-$product->discount) / 100) }} VNĐ
						</strong>
						@else
						<strong id="price">
							{{ number_format($product->price) }} VNĐ
						</strong>
						@endif


					</span>

					<p class="stext-102 cl3 p-t-23">
						Trạng thái: &nbsp;<strong id="quantity">
							@if($product->count > 0)
							Còn hàng
							@else
							Hết hàng
							@endif
						</strong>
						@if($inWish === true)
						<button class="btn-addwish-b2 fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100 js-addedCart" data-id="{{ $product->id }}" data-tooltip="Thêm vào danh sách yêu thích" style="float: right;">
							<img class="icon-heart1 dis-block trans-04 " src="images/icons/icon-heart-01.png" alt="ICON">
							<img class="icon-heart2 dis-block trans-04 ab-t-l" style="left: auto;" src="images/icons/icon-heart-02.png" alt="ICON">
							<i class="fa fa-heart" aria-hidden="true" style="color: #eb4d4b; font-size: 18px"></i>
						</button>
						@else
						<button class="btn-addwish-b2 fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-id="{{ $product->id }}" data-tooltip="Thêm vào danh sách yêu thích" style="float: right;">
							<img class="icon-heart1 dis-block trans-04 " src="images/icons/icon-heart-01.png" alt="ICON">
							<img class="icon-heart2 dis-block trans-04 ab-t-l" style="left: auto;" src="images/icons/icon-heart-02.png" alt="ICON">
							<i class="fa fa-heart hide-wish" aria-hidden="true" style="color: #eb4d4b; font-size: 18px"></i>
						</button>
						@endif
						{{-- {{dd(Cart::instance('wishlist')->content()->search($product->rowId))}} --}}
						{{-- {{dd(Cart::instance('wishlist')->content()->search((string)$product->id))}} --}}
					</p>

					<!--  -->
					<div class="p-t-33">
						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6">
								Kích cỡ
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">

									<select class="js-select2" name="time" id="select-size">
										@foreach( $product->size as $key => $size )
										<option value="{{$key}}"> {{$size}} </option>
										@endforeach
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6">
								Màu sắc
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" id="select-color" name="pro-color">
										@foreach( $product->color as $key => $color )
										<option value="{{$key}}" > {{$color}} </option>
										@endforeach
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-204 flex-w flex-m respon6-next">
								<div class="wrap-num-product flex-w m-r-20 m-tb-10">
									<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-minus"></i>
									</div>

									<input id="num-product" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

									<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-plus"></i>
									</div>
								</div>
								<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" data-id="{{$product->id}}" @if($product->count <= 0) disabled @endif>
									Thêm vào giỏ hàng
								</button>
							</div>
						</div>
					</div>

					<!--  -->
					<div class="flex-w flex-m p-t-10 p-l-30 respon7" style="width: 100%; overflow: hidden;">

						<div class="fb-like m-t-25" data-href="http://localhost/namshop/product-detail/1" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>


					</div>
				</div>
			</div>
		</div>

		<div class="bor10 m-t-50 p-t-43 p-b-40">
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link " data-toggle="tab" href="#description" role="tab">Mô tả sản phẩm</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông số</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">Đánh giá</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-43">
					<!-- - -->
					<div class="tab-pane fade" id="description" role="tabpanel">
						<div class="how-pos2 p-lr-15-md">
							<p class="stext-102 cl6">
								{{ $product->description }}
							</p>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="information" role="tabpanel">
						<div class="row">
							<div class="col-sm-5 col-md-4 col-lg-6 m-lr-auto">
								<ul class="p-lr-28 p-lr-15-sm">
									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205" >
											Màu sắc
										</span>

										<span class="stext-102 cl6 size-206">
											{{implode(', ', $product->color)}}
										</span>
									</li>

									<li class="flex-w flex-t p-b-7">
										<span class="stext-102 cl3 size-205">
											Kích cỡ
										</span>

										<span class="stext-102 cl6 size-206">
											{{implode(',', $product->size)}}
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Review -->
					<div class="tab-pane fade show active" id="reviews" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<div class="p-b-30 m-lr-15-sm">
									<!-- Review -->
									@foreach($comment as $cmt)
									<div class="flex-w flex-t p-b-68">
										<div class="wrap-pic-s size-109 of-hidden m-r-18 m-t-6">
											<i class="fa fa-user-circle" aria-hidden="true" style="font-size: 48px"></i>
										</div>

										<div class="size-207">
											<div class="flex-w flex-sb-m">
												<span class="mtext-107 cl2 p-r-20">
													{{$cmt->user_name}}
												</span>

												<span class="fs-18 cl11">
													@for($i = 0; $i < $cmt->rate; $i++)
													<i class="zmdi zmdi-star"></i>
													@endfor

												</span>
											</div>
											<span class="stext-102 cl6 p-b-15">
												{{$cmt->created_at}}
											</span>

											<p class="stext-102 cl6">
												{{$cmt->content}}
											</p>
										</div>
									</div>
									@endforeach



									<!-- Add review -->
									@if(isset(Auth::user()->name))
									<form class="w-full" method="post" action="{{URL::to('comment')}}">
										{{ csrf_field() }}

										<h5 class="mtext-108 cl2 p-b-7">
											Thêm bình luận
										</h5>

										<p class="stext-102 cl6">
											Hãy viết cảm nhận về sản phẩm của bạn tại đây
										</p>

										<div class="flex-w flex-m p-t-50 p-b-23">
											<span class="stext-102 cl3 m-r-16">
												Đánh giá
											</span>

											<span class="wrap-rating fs-18 cl11 pointer">
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<input class="dis-none" type="number" name="rating">
											</span>
										</div>

										<div class="row p-b-25">
											<div class="col-12 p-b-5">
												<label class="stext-102 cl3" for="review">Bình luận</label>
												<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
											</div>

											{{-- <div class="col-sm-6 p-b-5">
												<label class="stext-102 cl3" for="name">Name</label>
												<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
											</div>

											<div class="col-sm-6 p-b-5">
												<label class="stext-102 cl3" for="email">Email</label>
												<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
											</div> --}}
											<input type="hidden" name="pro_id" value="{{$product->id}}">
										</div>

										<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
											Gửi
										</button>
									</form>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		<span class="stext-107 cl6 p-lr-25">
			Tên sản phẩm: {{$product->name}}
		</span>

		<span class="stext-107 cl6 p-lr-25">
			Danh mục: {{$catalogPro->name}}
		</span>
	</div>

	<div id="fb-root" style="width: 100%"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=506280463204349&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</section>