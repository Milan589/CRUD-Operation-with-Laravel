@extends('layouts.frontend')
@section('title','Cart List')

@section('content')
<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
              </ol>
            </nav>
          </div>
          <div id="basket" class="col-lg-12">
            <div class="box">
              @include('backend.includes.flash')
              <form action="{{route('frontend.cart.update')}}" method="post">
                @csrf
                <h1>Shopping cart</h1>
                <p class="text-muted">You currently have {{$carts->count()}} item(s) in your cart.</p>
                <div class="table-responsive">
            
                  <table class="table">
                
                    <thead>
                      <tr>
                        <th colspan="2">Product</th>
                        <th>Quantity</th>
                        <th>Unit price</th>                    
                        <th colspan="2">Total</th>
                      </tr> 
                    </thead>
                    <tbody>
                      @if(count($carts) > 0)
                      @php
                        $total = 0;
                      @endphp
                        @foreach ($carts as $index => $cart)
                        @php
                             $product= \App\Models\Backend\Product::find($cart->id);
                             $image = $product->productImages()->first();
                              $total += $cart->qty* $cart->price;
                        @endphp
                        <input type="hidden" name="row_id[]" value="{{$index}}">
                      <tr>
                        <td><a href="#"><img src="" alt="brand"></a></td>
                        <td><a href="#">{{$cart->name}}</a></td>
                        <td>
                          <input type="number" name="qty[]" min="1" value="{{$cart->qty}}"  class="form-control">
                        </td>
                        <td>{{$cart->price}}</td>
                        
                        <td>{{$cart->qty*$cart->price}}</td>
                        <td><a href="#"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                      @endforeach
                      @else
                        <tr>
                          <td colspan="6">Cart is empty</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5">Total</th>
                        <th colspan="2">Rs. {{$total}}</th>
                      </tr>
                    </tfoot>
                  </table>
             
                </div>
                <!-- /.table-responsive-->
                <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                  <div class="left"><a href="{{route('frontend.home')}}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                  <div class="right"> 
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Update cart</button>
                    @if (auth()->user() != null && auth()->user()->role->name =='customer')
                    <a href="{{route('frontend.checkout')}}" type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
                   
                    @else 
                    <span class="text-info">Please <a href="{{route('frontend.customer.login')}}">Login</a>to ckeckout</span>
                    @endif
                  </div> 
                </div>
              </form>
            </div>
            <!-- /.box-->
          </div>
          <!-- /.col-lg-9-->
          <!-- /.col-md-3-->
        </div>
      </div>
    </div>
  </div>
@endsection
