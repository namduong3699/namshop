<div class="container">
	<div class="p-t-70">
		<h4 class="ltext-102 cl5 txt-center respon1 p-b-15">
			SẢN PHẨM MỚI
		</h4>
	</div>
	<div class="tab01">

		<!-- Tab panes -->
		<div class="tab-content">
			<!-- - -->
			<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
				<!-- Slide2 -->
				<div class="wrap-slick2">
					<div class="slick2">
						@foreach($new as $item)
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item animated zoomIn wow">
							<div class="block2">
								<div class="block2-pic hov-img0">
									@if ($item->discount != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<a href="{{ URL::to('product-detail', $item->id  ) }}">
										<img src="{{ $item->image_link }}" alt="IMG-PRODUCT">
									</a>

									<a href="{{ URL::to('product/' . $item->id)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
										Xem nhanh
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="{{ URL::to('product-detail', $item->id  ) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{ $item->name }}
										</a>
										<div>
											@if ($item->discount != 0)
											<span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 15px;">
												{{ number_format($item->price) }} VNĐ
											</span>
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
				</div>
			</div>
		</div>
	</div>
</div>