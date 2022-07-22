@extends('layouts.frontend')
@section('title', $data['product']->meta_title)
@section('content')
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- breadcrumb-->
                        <nav aria-label="breadcrumb">
                          @include('backend.includes.flash')
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $data['product']->category->title }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('frontend.subcategory', $data['product']->subcategory->slug) }}">{{ $data['product']->subcategory->title }}</a>
                                </li>
                                <li aria-current="page" class="breadcrumb-item active">{{ $data['product']->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-12 order-1 order-lg-2">
                        <form action="{{ route('frontend.cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $data['product']->id }}">
                            <input type="hidden" name="slug" value="{{ $data['product']->slug }}">
                            <input type="hidden" name="name" value="{{ $data['product']->title }}">
                            <input type="hidden" name="price" value="{{ $data['product']->price - $data['product']->discount }}">
                            <input type="hidden" name="weight" value="1">

                            <div id="productMain" class="row">
                                @php
                                    $images = $data['product']->productImages()->get();
                                @endphp
                                <div class="col-md-6">
                                    <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                                        @foreach ($images as $image)
                                            <div class="item"> <img src="{{ asset('images/products/' . $image->name) }}"
                                                    alt="" class="img-fluid"></div>
                                        @endforeach

                                    </div>

                                    <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                    <!-- /.ribbon-->

                                    <div class="ribbon new">
                                        <div class="theribbon">NEW</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                    <!-- /.ribbon-->
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <h1 class="text-center">{{ $data['product']->title }}</h1>
                                        <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product
                                                details, material &amp; care and sizing</a></p>
                                        @foreach ($data['product']->productOptions as $productOption)
                                            @php($options = explode(',', $productOption->attribute_value))
                                            <p class="goToDescription">
                                                {{ $productOption->option->title }}:
                                                <select name="options[]">
                                                    @foreach ($options as $option)
                                                        <option value="">Select {{ $productOption->option->title }}
                                                        </option>
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach

                                                </select>
                                                <a href="#details" class="scroll-to">
                                                </a>
                                            </p>
                                        @endforeach
                                        <p class="price">Rs.{{ $data['product']->price - $data['product']->discount }}</p>
                                        <p class="price"><del>Rs.{{ $data['product']->price }} </del></p>
                                        <p class="text-center">Tag:
                                            @foreach ($data['product']->tags as $tag)
                                                <a href="{{ route('frontend.tag', $tag->slug) }}"
                                                    class="btn btn-info">{{ $tag->title }}</a>
                                            @endforeach
                                        </p>
                                        <p class="text-center">
                                            <select name="qty" id="qty">
                                                <option value="">Select quantity</option>
                                                @for ($i = 1; $i < $data['product']->stock; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </p>
                                        <p class="text-center buttons">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart"></i> Add to cart</button>
                                        </p>
                                    </div>
                                    <div data-slider-id="1" class="owl-thumbs">
                                        <button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt=""
                                                class="img-fluid"></button>
                                        <button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt=""
                                                class="img-fluid"></button>
                                        <button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt=""
                                                class="img-fluid"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="details" class="box">
                            <p></p>
                            <h4>Product details</h4>
                            <p>{{ $data['product']->description }}</p>
                            <hr>
                            <div class="social">
                                <h4>Show it to your friends</h4>
                                <p><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a><a
                                        href="#" class="external gplus"><i class="fa fa-google-plus"></i></a><a
                                        href="#" class="external twitter"><i class="fa fa-twitter"></i></a><a
                                        href="#" class="email"><i class="fa fa-envelope"></i></a></p>
                            </div>
                        </div>
                        <div class="row same-height-row">
                            <div class="col-md-3 col-sm-6">
                                <div class="box same-height">
                                    <h3>You may also like these products</h3>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="product same-height">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front"><a href="detail.html"><img src="img/product2.jpg"
                                                        alt="" class="img-fluid"></a></div>
                                            <div class="back"><a href="detail.html"><img src="img/product2_2.jpg"
                                                        alt="" class="img-fluid"></a></div>
                                        </div>
                                    </div><a href="detail.html" class="invisible"><img src="img/product2.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="text">
                                        <h3>Fur coat</h3>
                                        <p class="price">$143</p>
                                    </div>
                                </div>
                                <!-- /.product-->
                            </div>

                        </div>
                    </div>
                    <!-- /.col-md-9-->
                </div>
            </div>
        </div>
    </div>
@endsection
