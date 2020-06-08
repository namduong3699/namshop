@extends('main')
@section('page')
Bài viết
@endsection
<!-- Header -->
@section('header')
@include('modules/header_all')
@endsection
<!-- Cart -->
@section('cart')
@include('modules/cart')
@endsection
<!-- breadcrumb -->
@section('breadcrumb_detail')
@include('modules/breadcrumb')
@endsection
<!-- Content page -->
@section('content')
@include('modules/content_blog_detail')
@endsection
<!-- Footer -->
@section('footer')
@include('modules/footer')
@endsection
<!-- Back to top -->
@section('footer')
@include('modules/backtotop')
@endsection