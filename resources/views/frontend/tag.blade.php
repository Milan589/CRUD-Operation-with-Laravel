@extends('layouts.frontend')
@section('title', $data['tag']->title)
@section('content')
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- breadcrumb-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">Home</a></li>
                                <li aria-current="page" class="breadcrumb-item ">
                                    {{ $data['tag']->title }}
                                </li>
                               
                            </ol>
                        </nav>
                        <div class="box">
                            <h1>{{ $data['tag']->title }}</h1> 
                        </div>
                        @if($data['tag']->products->count() > 0)
                        <div class="row products">
                            @foreach ($data['tag']->products as $product)
                                @php
                                    $image = $product->productImages()->first();
                                @endphp
                                <div class="col-lg-3 col-md-4">
                                    <div class="product">
                                        <div class="flip-container">
                                            <div class="flipper">
                                                        <div class="front"><a href="{{route('frontend.product',$product->slug)}}"><img src=""
                                                            alt="" class="img-fluid"></a></div>
                                                <div class="back"><a href="{{route('frontend.product',$product->slug)}}"><img src=""
                                                            alt="" class="img-fluid"></a></div>
                                            </div>
                                        </div><a href="{{route('frontend.product',$product->slug)}}" class="invisible"><img src=""
                                                alt="" class="img-fluid"></a>
                                        <div class="text">
                                            <h3><a href="detail.html">{{$product->title}}</a></h3>
                                            <p class="price">
                                                <del>Rs. {{$product->price}}</del>Rs. {{$product->price - $product->discount}}
                                            </p>
                                            <p class="buttons">
                                                <a href="{{route('frontend.product',$product->slug)}}" class="btn btn-outline-secondary">View
                                                    detail</a>         
                                            </p>
                                        </div>
                                        <!-- /.text-->
                                        @if ($product->hot_key ==1)                                                  
                                        <div class="ribbon sale">
                                            <div class="theribbon">SALE</div>
                                            <div class="ribbon-background"></div>
                                        </div>
                                        @endif
                                    </div>
                                    <!-- /.product            -->
                                </div>
                            @endforeach
                           
                            <!-- /.products-->

                        </div>
                        @else
                        <div class="alert alert-danger">Product not available</div>
                    @endif
                        <div class="pages">
                            <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i
                                        class="fa fa-chevron-down"></i> Load more</a></p>
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span
                                                aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                    <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span
                                                aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /.col-lg-9-->
                </div>
            </div>
        </div>
    </div>
@endsection
