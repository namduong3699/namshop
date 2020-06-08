@extends('main')
@section('page')
Về chúng tôi
@endsection
<!-- Header  --> 


@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->

@section('cart')
@include('modules/cart')
@include('modules/wishlist')
@endsection
<!-- Title page -->

@section('title')
@include('modules/title_about')
@endsection
<!-- Content page -->

@section('content')
@include('modules/content_about')
@endsection
<!-- Footer -->

@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('back')
@include('modules/backtotop')
@endsection
