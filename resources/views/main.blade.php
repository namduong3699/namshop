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
		$('.js-addedCart').on('click', function(event) {
			// alert(1);
			/* Act on the event */
		});
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(e){
				e.preventDefault();
				if($(this).attr('data-show')=='false'){
					$(this).addClass('js-addedCart');
					$(this).attr('data-show',true);
					swal(nameProduct, "Đã thêm vào yêu thích!", "success");
					
					$.ajax({
						url: 'add-to-wishlist/'+$(this).data('id'),
						type: 'get',
						success: function(){
							// console.log($('.wishlist-icon').attr('data-notify'));
							var i=parseInt($('.wishlist-icon').attr('data-notify'))+1;
							$('.wishlist-icon').attr('data-notify', i );
						}
					})
					.done(function(){
						$.ajax({
							url: 'add-wish',
							type: 'get',
							dataType: 'json',
							success: function(data){
								if(isEmpty(data)){
									$('#wish-list').html('<span class="mtext-103 cl2">Không có hàng trong giỏ</span> ');
								}else{
									$('#wish-list').html(' ');
									for(var key in data){
											// console.log(data[key]);
											var html='<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img del-wish" data-id="'+data[key].id+'"><img src="images/'+data[key].options.folder+'/'+data[key].options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="{{ URL::to("product")}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data[key].name+'</a><span class="header-cart-item-info">'+data[key].price.toLocaleString('EN')+' VNĐ </span></div></li>';
											// console.log(html);
											$('#wish-list').append(html);
										}
									}
								}
							}).done(function(){
								$('.del-wish').on('click', function(event) {
									event.preventDefault();
									/* Act on the event */
									var id= $(this).attr('data-id');
									$(this).parent().remove();
									var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
									$('.wishlist-icon').attr('data-notify', i );
									$('.js-addwish-b2').each(function(){
										if($(this).attr('data-id')== id ) {
											$(this).removeClass('js-addedCart');	
											$(this).attr('data-show',false);
										}
									});
									$.ajax({
										url: 'delete-wishlist',
										type: 'get',
										dataType: 'json',
										data: {id: $(this).attr('data-id')},
									})
									.done(function() {
										console.log("success");
									});
									
								});
							});

						});
				}else{
					$(this).removeClass('js-addedCart');	
					$(this).attr('data-show',false);
					swal(nameProduct, "Đã xóa khỏi yêu thích!", "success");
					$.ajax({
						url: 'delete-wishlist',
						type: 'get',
						data: {id: $(this).data('id') },
						success: function(){
							// console.log($('.wishlist-icon').attr('data-notify'));
							var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
							$('.wishlist-icon').attr('data-notify', i );
						}
					}).done(function(){
						$.ajax({
							url: 'add-wish',
							type: 'get',
							dataType: 'json',
							success: function(data){
										// console.log(isEmpty(data));
										if(isEmpty(data)){
											$('#wish-list').html('<span class="mtext-103 cl2">Không có hàng trong giỏ</span> ');
										}else{
											$('#wish-list').html(' ');
											for(var key in data){
											// console.log(data[key]);
											var html='<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img del-wish" data-id="'+data[key].id+'"><img src="images/'+data[key].options.folder+'/'+data[key].options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="{{ URL::to("product")}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data[key].name+'</a><span class="header-cart-item-info">'+data[key].price.toLocaleString('EN')+' VNĐ </span></div></li>';
											// console.log(html);
											$('#wish-list').append(html);
										}
									}
								}
							}).done(function(){
								$('.del-wish').on('click', function(event) {
									event.preventDefault();
									/* Act on the event */
									var id= $(this).attr('data-id');
									$(this).parent().remove();
									var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
									$('.wishlist-icon').attr('data-notify', i );
									$('.js-addwish-b2').each(function(){
										if($(this).attr('data-id')== id ) {
											$(this).removeClass('js-addedCart');	
											$(this).attr('data-show',false);
										}
									});
									$.ajax({
										url: 'delete-wishlist',
										type: 'get',
										dataType: 'json',
										data: {id: $(this).attr('data-id')},
									})
									.done(function() {
										console.log("success");
									});
									
								});
							});
						});
				}
			}
			);
});

function isEmpty(obj) {
	return Object.keys(obj).length === 0;
}
$('.del-wish').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var id= $(this).attr('data-id');
	$(this).parent().remove();
	var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
	$('.wishlist-icon').attr('data-notify', i );

	$('.js-addwish-b2').each(function(){
		if($(this).attr('data-id')== id ) {
			$(this).removeClass('js-addedCart');	
			$(this).attr('data-show',false);
		}
	});

	$.ajax({
		url: 'delete-wishlist',
		type: 'get',
		dataType: 'json',
		data: {id: $(this).attr('data-id')},
	})
	.done(function() {
		console.log("success");
	});

});

$('.js-addwish-detail').each(function(){
	var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

	// $(this).on('click', function(e){
	// 	e.preventDefault();
	// 	swal(nameProduct, "Đã thêm vào danh sách yêu thích!", "success");

	// 	$(this).addClass('js-addedwish-detail');
	// 			// $(this).off('click');
	// });
	$(this).on('click', function(e){
		e.preventDefault();
		if($(this).attr('data-show')=='false'){
			$(this).addClass('js-addedCart');
			$(this).attr('data-show',true);
			swal(nameProduct, "Đã thêm vào yêu thích!", "success");
			
			$.ajax({
				url: 'add-to-wishlist/'+$(this).data('id'),
				type: 'get',
				success: function(){
							// console.log($('.wishlist-icon').attr('data-notify'));
							var i=parseInt($('.wishlist-icon').attr('data-notify'))+1;
							$('.wishlist-icon').attr('data-notify', i );
						}
					})
			.done(function(){
				$.ajax({
					url: 'add-wish',
					type: 'get',
					dataType: 'json',
					success: function(data){
						if(isEmpty(data)){
							$('#wish-list').html('<span class="mtext-103 cl2">Không có hàng trong giỏ</span> ');
						}else{
							$('#wish-list').html(' ');
							for(var key in data){
											// console.log(data[key]);
											var html='<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img del-wish" data-id="'+data[key].id+'"><img src="images/'+data[key].options.folder+'/'+data[key].options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="{{ URL::to("product")}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data[key].name+'</a><span class="header-cart-item-info">'+data[key].price.toLocaleString('EN')+' VNĐ </span></div></li>';
											// console.log(html);
											$('#wish-list').append(html);
										}
									}
								}
							}).done(function(){
								$('.del-wish').on('click', function(event) {
									event.preventDefault();
									/* Act on the event */
									var id= $(this).attr('data-id');
									$(this).parent().remove();
									var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
									$('.wishlist-icon').attr('data-notify', i );
									$('.js-addwish-b2').each(function(){
										if($(this).attr('data-id')== id ) {
											$(this).removeClass('js-addedCart');	
											$(this).attr('data-show',false);
										}
									});
									$.ajax({
										url: 'delete-wishlist',
										type: 'get',
										dataType: 'json',
										data: {id: $(this).attr('data-id')},
									})
									.done(function() {
										console.log("success");
									});
									
								});
							});

						});
		}else{
			$(this).removeClass('js-addedCart');	
			$(this).attr('data-show',false);
			swal(nameProduct, "Đã xóa khỏi yêu thích!", "success");
			$.ajax({
				url: 'delete-wishlist',
				type: 'get',
				data: {id: $(this).data('id') },
				success: function(){
							// console.log($('.wishlist-icon').attr('data-notify'));
							var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
							$('.wishlist-icon').attr('data-notify', i );
						}
					}).done(function(){
						$.ajax({
							url: 'add-wish',
							type: 'get',
							dataType: 'json',
							success: function(data){
										// console.log(isEmpty(data));
										if(isEmpty(data)){
											$('#wish-list').html('<span class="mtext-103 cl2">Không có hàng trong giỏ</span> ');
										}else{
											$('#wish-list').html(' ');
											for(var key in data){
											// console.log(data[key]);
											var html='<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img del-wish" data-id="'+data[key].id+'"><img src="images/'+data[key].options.folder+'/'+data[key].options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="{{ URL::to("product")}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data[key].name+'</a><span class="header-cart-item-info">'+data[key].price.toLocaleString('EN')+' VNĐ </span></div></li>';
											// console.log(html);
											$('#wish-list').append(html);
										}
									}
								}
							}).done(function(){
								$('.del-wish').on('click', function(event) {
									event.preventDefault();
									/* Act on the event */
									var id= $(this).attr('data-id');
									$(this).parent().remove();
									var i=parseInt($('.wishlist-icon').attr('data-notify'))-1;
									$('.wishlist-icon').attr('data-notify', i );
									$('.js-addwish-b2').each(function(){
										if($(this).attr('data-id')== id ) {
											$(this).removeClass('js-addedCart');	
											$(this).attr('data-show',false);
										}
									});
									$.ajax({
										url: 'delete-wishlist',
										type: 'get',
										dataType: 'json',
										data: {id: $(this).attr('data-id')},
									})
									.done(function() {
										console.log("success");
									});
									
								});
							});
						});
				}
			}
			);
});

/*---------------------------------------------*/

$('.js-addcart-detail').each(function(){
	var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
	$(this).on('click', function(){
		var id =$(this).attr('data-id');
		console.log($(this).attr('data-id'));
		qty = $("#num-product").val();
		qty= parseInt(qty);
		color = $('#select-color').val();
		size = $('#select-size').val();
				// console.log(qty);
				// console.log(color);
				// console.log(size);
				var vl= $('#data-notify').attr('data-notify');
				vl = parseInt(vl);
				// console.log(vl);
				$('#show-cart-full').html(' ');
				var total = 0;
				$.ajax({
					url:"{{ URL::to('add-to-cart') }}",
					method:"GET",
					dataType: 'json',
					data:{id:id, qty:qty, size:size, color:color},
					success:function(data) {


						for(var key in data){
								  // console.log(data[key]);
								  let html= '<li class="header-cart-item flex-w flex-t m-b-12"><div class="header-cart-item-img del-cart" data-id="'+data[key].id+'" ><img src="images/'+ data[key].options.folder+'/'+data[key].options.image+'" alt="IMG"></div><div class="header-cart-item-txt p-t-8"><a href="product/"'+data[key].options.id +'" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+data[key].name +'</a><span class="header-cart-item-info">'+data[key].qty +' x '+data[key].price.toLocaleString('EN') +'</span></div></li>';
								  total += data[key].qty*data[key].price;
								  $('#show-cart-full').append(html);
								}
								$( ".update-data-menu" ).load(".update-data-menu" );
								$( ".update-data-icon" ).load(".update-data-icon" );
								$('.data-notify').attr('data-notify', vl+ qty );
								$('.data-label1').attr('data-label1', vl+ qty );
								swal(' ', "Đã thêm vào giỏ hàng !", "success");

							}
						}).always(function(){

							$('.del-cart').on('click', function(event) {
								event.preventDefault();
								/* Act on the event */
								var id= $(this).attr('data-id');
								var qty = $(this).next().children('span').text();
								var vl= $('#data-notify').attr('data-notify');
								vl = parseInt(vl);
									// alert(parseInt(qty));
									$('.data-notify').attr('data-notify', vl- parseInt(qty) );
									$('.data-label1').attr('data-label1', vl- parseInt(qty) );
									$(this).parent().remove();
									$.ajax({
										url: 'delete-cart/' + id,
									})
									.done(function() {
										console.log("success");
									})
								});




							$('.js-show-cart').on('click',function(){
								$('.js-panel-cart').addClass('show-header-cart');
							});
							$.ajax({
								url: 'countprice/',
								type: 'get',
								success: function(data){
									// console.log(data);
								 // $('#totalPrice').text(data + " VNĐ");
								 $('#tuto').text(data + " VNĐ");
								}
							});
				    // $('#tuto').text(total + ' VNĐ');
				    $(this).data('id',' ');
				});

					});


});
$('.del-cart').on('click', function(event) {
	event.preventDefault();
	console.log('Oke');
	/* Act on the event */
	var id= $(this).attr('data-id');
	$('#del-cart-'+id).remove();
	var qty = $(this).next().children('span').text();
	var vl= $('#data-notify').attr('data-notify');
	vl = parseInt(vl);
	// alert(parseInt(qty));
	$('.data-notify').attr('data-notify', vl- parseInt(qty) );
	$('.data-label1').attr('data-label1', vl- parseInt(qty) );
	$(this).parent().remove();
	$.ajax({
		url: 'delete-cart/' + id,
	})
	.done(function() {
		console.log("success");
	})
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

<script lang="javascript">
	var _vc_data = {id : 1925494, secret : 'e71518f885a1c21c9fb77540bc8c6df7'};
	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async=true; 
		ga.defer=true;
		ga.src = '//live.vnpgroup.net/client/tracking.js?id=1925494';
		var s = document.getElementsByTagName('script');
		s[0].parentNode.insertBefore(ga, s[0])
		;})();
	</script>         	

</body>
</html>