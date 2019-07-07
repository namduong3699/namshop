<header class="header-v4"> 	<!-- tat ca cac trang tru trang index -->
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->
		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					
				</div>

				<div class="right-top-bar flex-w h-full">
					@if(isset(Auth::user()->name))
					<a href="{{ URL::to('account') }}" class="flex-c-m trans-04 p-lr-25">
						{{Auth::user()->name}}
					</a>

					<a href="{{ URL::to('logout') }}" class="flex-c-m trans-04 p-lr-25">
						Đăng xuất
					</a>
					@else
					<a href="{{ URL::to('login') }}" class="flex-c-m trans-04 p-lr-25">
						Đăng nhập
					</a>

					<a href="{{ URL::to('register') }}" class="flex-c-m trans-04 p-lr-25">
						Đăng ký
					</a>
					@endif
				</div>
			</div>
		</div>


		<div class="wrap-menu-desktop how-shadow1">
			<nav class="limiter-menu-desktop container">
				
				<!-- Logo desktop -->		
				<a href="{{ URL::to('index') }}" class="logo">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu update-data-menu">
						<li>
							<a href="{{ URL::to('index') }}">Trang chủ</a>
						</li>

						<li  class="@yield('shop')">
							<a href="{{ URL::to('product') }}">Sản phẩm</a>
							<ul class="sub-menu">
								@foreach($catalog as $cata)
								<li><a href="{{ URL::to('product', $cata->id  ) }}">{{ $cata->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li  class="data-label1 label1 @yield('shoping')" data-label1="
						@if(Session('cart'))
						{{Cart::instance('shopping')->count()}}
						@else
						0
						@endif
						">
						<a href="{{ URL::to('shoping-cart') }}">Giỏ hàng</a>
					</li>

					<li class="@yield('about')">
						<a href="{{ URL::to('about') }}">Giới thiệu</a>
					</li>

					<li class="@yield('contact')">
						<a href="{{ URL::to('contact') }}">Liên hệ</a>
					</li>
				</ul>
			</div>	

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<div class="update-data-icon">
					<div class="cart-icon icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="@if(Session('cart')){{Cart::instance('shopping')->count()}} @else
					0 @endif">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>
			

			<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist wishlist-icon" data-notify="{{count(Cart::instance('wishlist')->content())}}">
				<i class="zmdi zmdi-favorite-outline"></i>
			</div>
		</div>
	</nav>
</div>	
</div>

<!-- Header Mobile -->
<div class="wrap-header-mobile">
	<!-- Logo moblie -->		
	<div class="logo-mobile">
		<a href="{{ URL::to('index') }}"><img src="images/icons/logo.png" alt="IMG-LOGO"></a>
	</div>

	<!-- Icon header -->
	<div class="wrap-icon-header flex-w flex-r-m m-r-15">
		<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
			<i class="zmdi zmdi-search"></i>
		</div>

		<div class="cart-icon icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="
			@if(Session('cart'))
			{{Cart::instance('shopping')->count()}}
			@else
			0
			@endif
			">
			<i class="zmdi zmdi-shopping-cart"></i>
		</div>

	<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-wishlist wishlist-icon" data-notify="{{count(Cart::instance('wishlist')->content())}}">
		<i class="zmdi zmdi-favorite-outline"></i>
	</a>
</div>

<!-- Button show menu -->
<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
	<span class="hamburger-box">
		<span class="hamburger-inner"></span>
	</span>
</div>
</div>


<!-- Menu Mobile -->
<div class="menu-mobile">
	<ul class="topbar-mobile">


		<li>
			<div class="right-top-bar flex-w h-full">
				@if(isset(Auth::user()->name))
				<a href="{{ URL::to('account') }}" class="flex-c-m p-lr-10 trans-04">
					{{Auth::user()->name}}
				</a>

				<a href="{{ URL::to('logout') }}" class="flex-c-m p-lr-10 trans-04">
					Đăng xuất
				</a>
				@else
				<a href="{{ URL::to('login') }}" class="flex-c-m p-lr-10 trans-04">
					Đăng nhập
				</a>

				<a href="{{ URL::to('register') }}" class="flex-c-m p-lr-10 trans-04">
					Đăng ký
				</a>
				@endif
			</div>
		</li>
	</ul>

	<ul class="main-menu-m">
		<li>
			<a href="{{ URL::to('index') }}">Trang chủ</a>
		</li>

		<li  class="@yield('shop')">
			<a href="{{ URL::to('product') }}">Sản phẩm</a>
			<ul class="sub-menu-m">
				@foreach($catalog as $cata)
				<li><a href="{{ URL::to('product', $cata->id  ) }}">{{ $cata->name }}</a></li>
				@endforeach
			</ul>
			<span class="arrow-main-menu-m">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</span>
		</li>
		
		<li>
			<a href="{{ URL::to('shoping-cart') }}" class="data-label1 label1 rs1" id="menu-label" data-label1="
			@if(Session('cart'))
			{{Cart::instance('shopping')->count()}}
			@else
			0
			@endif
			">Giỏ hàng</a>
		</li>

		<li class="@yield('about')">
			<a href="{{ URL::to('about') }}">Giới thiệu</a>
		</li>

		<li class="@yield('contact')">
			<a href="{{ URL::to('contact') }}">Liên hệ</a>
		</li>
	</ul>
</div>

<!-- Modal Search -->
<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
	<div class="container-search-header">
		<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
			<img src="images/icons/icon-close2.png" alt="CLOSE">
		</button>

		<form class="wrap-search-header flex-w p-l-15" method="get" action="{{ URL::to('search') }}">
			<button class="flex-c-m trans-04">
				<i class="zmdi zmdi-search"></i>
			</button>
			<input class="plh3" type="text" name="key" placeholder="Tìm kiếm...">
		</form>
	</div>
</div>
</header>