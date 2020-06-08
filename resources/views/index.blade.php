@extends('main')
@section('page')
Trang chủ
@endsection
<!-- Header -->
@section('headerindex')
@include('modules/header')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@include('modules/wishlist')
@endsection

<!-- Slider -->
@section('slider')
@include('modules/slider')
@endsection

<!-- Banner -->
@section('banner')
@include('modules/banner')
@endsection

<!-- Product -->
@section('product_v1')
@include('modules/product_index')
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
