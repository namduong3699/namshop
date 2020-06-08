@extends('main')
@section('page')
Sản phẩm
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
<!-- Product -->
@section('product_product')
@include('modules/product_user')
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
<div id="modal">
@include('modules/modal')
</div>
@endsection

@section('js')
<script>
	// $('.js-show-modal1').on('click',function(){
 //        $('.js-modal1').addClass('show-modal1');
 //        alert("hello");
 //        var id= this.id;
 //        var size;
 //        var color;
 //        var quantity;



 //    });
</script>
@endsection