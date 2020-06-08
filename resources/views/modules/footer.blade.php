<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Danh mục
				</h4>

				@if(count($catalog) > 8)
				<ul style="width: 50%; float: left;">
					@foreach($catalog as $cata)
					@if($loop->index <= count($catalog)/2)
					<li><a href="{{ URL::to('product', $cata->id  ) }}" class="stext-107 cl7 hov-cl1 trans-04">{{ $cata->name }}</a></li>
					@endif
					@endforeach
				</ul>
				<ul style="width: 50%; float: left;">
					@foreach($catalog as $cata)
					@if($loop->index >= count($catalog)/2)
					<li><a href="{{ URL::to('product', $cata->id  ) }}" class="stext-107 cl7 hov-cl1 trans-04">{{ $cata->name }}</a></li>
					@endif
					@endforeach
				</ul>
				@else
				<ul>
					@foreach($catalog as $cata)
					<li><a href="{{ URL::to('product', $cata->id  ) }}" class="stext-107 cl7 hov-cl1 trans-04">{{ $cata->name }}</a></li>
					@endforeach
				</ul>
				@endif

			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Tìm hiểu thêm
				</h4>

				<ul>
					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							Thanh toán
						</a>
					</li>

					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							Đặt hàng
						</a>
					</li>

					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							Gửi hàng
						</a>
					</li>

					<li class="p-b-10">
						<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
							Câu hỏi thường gặp
						</a>
					</li>
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Liên hệ
				</h4>

				<p class="stext-107 cl7 size-201">
					Nếu bạn có bất kỳ câu hỏi nào vui lòng liên hệ chúng tôi theo địa chỉ XXX, Đông Anh, Hà Nội (+84)36 871 5447
				</p>

				<div class="p-t-27">
					<a href="https://www.facebook.com/Duong.Nam.3699" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-facebook"></i>
					</a>

					<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-instagram"></i>
					</a>

					<a href="https://github.com/namduong3699" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-github"></i>
					</a>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Cần tư vấn
				</h4>

				<form method="get" action="{{URL::to('needContact')}}">
					<div class="wrap-input1 w-full p-b-4">
						<input class="input1 bg-none plh1 stext-107 cl7" type="email" name="email" placeholder="Vui lòng nhập Email">
						<div class="focus-input1 trans-04"></div>
					</div>

					<div class="p-t-18">
						<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
							Đăng ký
						</button>
					</div>
				</form>
			</div>
		</div>

		<div class="p-t-40">
			<p class="stext-107 cl6 txt-center">
				<!-- Dương Hoài Nam - Nguyễn Thế Nam -->
			</p>
		</div>
	</div>
</footer>

