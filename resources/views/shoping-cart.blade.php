@extends('main')
@section('page')	
Mua hàng
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

@endsection
<!-- Shoping Cart -->
@section('shoping_cart')
@include('modules/shoping-cart')
@endsection
<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection