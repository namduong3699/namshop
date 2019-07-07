@extends('main')
@section('page')
Search
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

@section('content')

<style>
.page-item.active .page-link {
    background-color: #57606f;
    border-color: #57606f;
}
.page-link {
    color: #1e90ff;
}
.ribbon-wrapper {
    width:60px;
    height:60px;
    overflow:hidden;
    position:absolute;
    top:-3px;
    right:-3px
    
}
.ribbon {
    color:#fff;
    text-align:center;
    -webkit-transform:rotate(45deg);
    -moz-transform:rotate(45deg);
    -ms-transform:rotate(45deg);
    -o-transform:rotate(45deg);
    position:relative;
    padding:4px 0;
    left:1px;
    top:4px;
    width:80px;
    text-transform:uppercase;
    background-color:#3a5c83;
    z-index: 99;
}

.ribbon:before,.ribbon:after {
    content:"";
    border-top:3px solid #6e8900;
    border-left:3px solid transparent;
    border-right:3px solid transparent;
    position:absolute;
    bottom:-3px
}

.ribbon:before {
    left:0
}

.ribbon:after {
    right:0
}

.ribbon.sale {
    background-color:#f90
}
.result {
    font-size: 24px;
    margin: 40px 0px 25px;
    text-align: center;
}
</style>


<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="result">
            @if($product->total() == 0)
            <div>
                Hmm, không tìm thấy gì như vậy cả..<br/>
                <img src="images/saucer.png" alt="" width="40%" height="auto" class="p-t-30">
            </div>
            @else
            Tìm thấy <strong style="color: red">{{$product->total()}}</strong> sản phẩm
            @endif
        </div>
        <div class="row isotope-grid">
            @foreach($product as $item)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women animated flipInY wow">
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        @if ($item->discount != 0)
                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                        @endif
                        <img src="{{ $item->image_link }}" alt="IMG-PRODUCT">

                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 js-show-info">
                            Xem nhanh
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ URL::to('product-detail', $item->id  ) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $item->name }}
                            </a>
                            <div>
                                @if ($item->discount != 0)
                                <span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 15px;">
                                    {{ number_format($item->price) }} VNĐ</span>
                                    <span class="stext-105 cl3">
                                        <strong style="color: #e74c3c;">
                                            {{ number_format($item->price * (100-$item->discount) / 100) }} VNĐ
                                        </strong>
                                    </span>
                                    @else
                                    <span class="stext-105 cl3">
                                        {{ number_format($item->price) }} VNĐ
                                    </span>
                                    @endif  
                                </div>
                            </div>

                            {{-- <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-38">
                {!! $product -> links(); !!}
            </div>
        </div>
    </div>






    @endsection

    <!-- Footer -->
    @section('footer')
    @include('modules/footer')
    @endsection
    