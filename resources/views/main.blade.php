<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>@yield('page')</title>
	<style>
	.powerby {
		display: none;
	}
</style>
	
	@include('modules/head')
</head>
<body class="animsition">
	
	<!-- Header index -->
	@yield('headerindex')
	<!-- Header -->
	@yield('header')
	<!-- Cart -->
	@yield('cart')
	<!-- breadcrumb detail -->
	@yield('breadcrumb_detail')

	<!-- Title page -->
	@yield('title')
	
	<!-- Content page -->
	@yield('content')

	<!-- Product of product -->
	@yield('product_product')
	<!-- breadcrumb -->
	@yield('breadcrumb')
	<!-- Product Detail -->
	@yield('product')
	<!-- Related Products -->
	@yield('related')
	<!-- Shoping Cart -->
	@yield('shoping_cart')
	<!-- Slider -->
	@yield('slider')
	<!-- Banner -->
	@yield('banner')
	<!-- Product -->
	@yield('product_v1')
	<!-- Map -->
	@yield('map')
	<!-- Footer -->
	@yield('footer')
	<!-- Back to top -->
	@yield('back')
	<!-- Modal1 -->
	@yield('modal')
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
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		function delWish(rowId){
		$.get('{{ URL::to('delete-wishlist') }}', {'rowId':rowId}, function(data, textStatus, xhr) {
			qty = parseInt( $('.wishlist-icon').attr('data-notify') ) - 1;
			$( ".header-wishlist-content" ).load(" .header-wishlist-content");
			$('.wishlist-icon').attr('data-notify', qty);
			$( ".isotope-grid" ).load(" .isotope-grid");
			$( ".tab-content" ).load(" .tab-content");
		});
	}

		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$.get('add-to-wishlist/' + id, {}, function(data, textStatus, xhr) {
				// qty = parseInt($('.wishlist-icon').attr('data-notify'));		
				// $( ".header-cart-content" ).load(" .header-cart-content");
				$( ".header-wishlist-content" ).load(" .header-wishlist-content");
				$( ".isotope-grid" ).load(" .isotope-grid");
				// qty = $('.header-wishlist-content').attr('data-count');
				qty = parseInt($('#wishQty').text()) + 1;
				console.log(qty);
				$('.wishlist-icon').attr('data-notify', qty);

			});
			
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "đã được thêm vào danh sách yêu thích!", "success");
				$(this).addClass('js-addedCart');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "đã được thêm vào danh sách yêu thích!", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			var id = this.id;
			qty = $("#num-product").val();
			color = $('#pro-color').val();
			size = $('#pro-size').val();
			$(this).on('click', function(){
				$.ajax({
					url:"{{ URL::to('add-to-cart') }}",
					method:"GET",
					data:{id:id, qty:qty, size:size, color:color},
					success:function(data) {
						qty = parseInt($('.cart-icon').attr('data-notify'));
						$( ".update-data-menu" ).load(" .update-data-menu" );
						$('.cart-icon').attr('data-notify', qty + 1);
						$( ".header-cart-content" ).load(" .header-cart-content");
						swal(nameProduct, "đã được thêm vào giỏ hàng !", "success");
					}
				});
				
			});

		});

	</script>
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
	@yield('js')
	<script src="js/main.js"></script>

<script lang="javascript">var _vc_data = {id : 1925494, secret : 'e71518f885a1c21c9fb77540bc8c6df7'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//live.vnpgroup.net/client/tracking.js?id=1925494';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script>         	

</body>
</html>