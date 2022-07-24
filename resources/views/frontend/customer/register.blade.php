@extends('layouts.frontend')
@section('title', 'Customer Register')

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
                                <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-12">
                        <div class="box">
                            <h1>New account</h1>
                            @include('backend.includes.flash') 
                            <p class="lead">Not our registered customer yet?</p>
                            <p>With registration with us new world of fashion, fantastic discounts and much more opens to
                                you! The whole process will not take you more than a minute!</p>
                            <p class="text-muted">If you have any questions, please feel free to <a
                                    href="contact.html">contact us</a>, our customer service center is working for you 24/7.
                            </p>
                            <hr>
                            <form action="{{ route('frontend.customer.doregister')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" type="text" class="form-control">
                                    @error('name')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="text" class="form-control">
                                    @error('email')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="perm_address">Permanent Address</label>
                                    <input id="perm_address" name="perm_address" type="text" class="form-control">
                                    @error('perm_address')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="temp_address">Temporary Address</label>
                                    <input id="temp_address" name="temp_address" type="text" class="form-control">
                                    @error('temp_address')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shipping_address">Shipping Address</label>
                                    <input id="shipping_address" name="shipping_address" type="text"
                                        class="form-control">
                                    @error('shipping_address')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">User Image</label>
                                    <input id="image" name="image" type="file" class="form-control">
                                    @error('image')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Contact</label>
                                    <input id="phone" name="phone" type="text" class="form-control">
                                    @error('phone')
                                        <span class="text-danger">
                                           {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i>
                                        Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
