@extends('main')
@section('page')
Thông tin sản phẩm
@endsection
<!-- Header -->
@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@include('modules/wishlist')
@endsection
<!-- breadcrumb -->
@section('breadcrumb')
@include('modules/breadcrumb')
@endsection
<!-- Product Detail -->
@section('product')
@include('modules/product_detail')
@endsection
<!-- Related Products -->
@section('related')
@include('modules/relate_products')
@endsection
<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection
<!-- Modal1 -->
@section('modal')
@include('modules/modal')
@endsection

@section('js')
<script>
	$('.slick3-dots li').each(function(index, el) {
		$(el).attr('data-slick-index',index);
	});
</script>
@endsection