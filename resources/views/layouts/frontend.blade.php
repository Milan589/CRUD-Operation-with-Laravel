<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/favicon.png') }}">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <!-- navbar-->
    <header class="header mb-5">
        <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-right">
                        <ul class="menu list-inline mb-0">
                            @if (auth()->user() != null && auth()->user()->role->name =='customer')
                            <li class="list-inline-item"><a href="#" data-toggle="modal"
                                data-target="#login-modal"></a></li>
                            @endif
                           
                            <li class="list-inline-item"><a
                                    href="{{ route('frontend.customer.register') }}">Register</a></li>
                            <li class="list-inline-item"><a href="contact.html">Contact</a></li>
                            <li class="list-inline-item"><a href="#">Recently viewed</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true"
                class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Customer login</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="customer-orders.html" method="post">
                                <div class="form-group">
                                    <input id="email-modal" type="text" placeholder="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input id="password-modal" type="password" placeholder="password"
                                        class="form-control">
                                </div>
                                <p class="text-center">
                                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                                </p>
                            </form>
                            <p class="text-center text-muted">Not registered yet?</p>
                            <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>!
                                It is easy and done in 1 minute and gives you access to special discounts and much more!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** TOP BAR END ***-->


        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container"><a href="{{ route('frontend.home') }}" class="navbar-brand home"><img
                        src="{{ asset('assets/frontend/img/logo.png') }}" alt="Obaju logo"
                        class="d-none d-md-inline-block"><img src="{{ asset('assets/frontend/img/logo-small.png') }}"
                        alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to
                        homepage</span></a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target="#navigation"
                        class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle
                            navigation</span><i class="fa fa-align-justify"></i></button>
                    <button type="button" data-toggle="collapse" data-target="#search"
                        class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i
                            class="fa fa-search"></i></button><a href="basket.html"
                        class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
                </div>
                <div id="navigation" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
                        @foreach ($menu_categories as $category)
                            @if ($category->activeSubcategories->count() > 0)
                                <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown"
                                        data-hover="dropdown" data-delay="200"
                                        class="dropdown-toggle nav-link">{{ $category->title }}<b
                                            class="caret"></b></a>
                                    <ul class="dropdown-menu megamenu">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-3">
                                                    <ul class="list-unstyled mb-3">
                                                        @foreach ($category->activeSubcategories as $subcategory)
                                                            <li class="nav-item"><a
                                                                    href="{{ route('frontend.subcategory', $subcategory->slug) }}"
                                                                    class="nav-link"> {{ $subcategory->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="navbar-buttons d-flex justify-content-end">
                        <!-- /.nav-collapse-->
                        <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse"
                            href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span
                                class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                        <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a
                                href="{{ route('frontend.cart.list') }}" class="btn btn-primary navbar-btn"><i
                                    class="fa fa-shopping-cart"></i><span>{{ $carts->count() }} items in
                                    cart</span></a></div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="search" class="collapse">
            <div class="container">
                <form role="search" class="ml-auto">
                    <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    @yield('content')
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Pages</h4>
                    <ul class="list-unstyled">
                        <li><a href="text.html">About us</a></li>
                        <li><a href="text.html">Terms and conditions</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                    </ul>
                    <hr>
                    <h4 class="mb-3">User section</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        <li><a href="{{ route('frontend.customer.register') }}">Regiter</a></li>
                    </ul>
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Top categories</h4>
                    <h5>Men</h5>
                    <ul class="list-unstyled">
                        <li><a href="category.html">T-shirts</a></li>
                        <li><a href="category.html">Shirts</a></li>
                        <li><a href="category.html">Accessories</a></li>
                    </ul>
                    <h5>Ladies</h5>
                    <ul class="list-unstyled">
                        <li><a href="category.html">T-shirts</a></li>
                        <li><a href="category.html">Skirts</a></li>
                        <li><a href="category.html">Pants</a></li>
                        <li><a href="category.html">Accessories</a></li>
                    </ul>
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Where to find us</h4>
                    <p><strong>Obaju Ltd.</strong><br>13/25 New Avenue<br>New Heaven<br>45Y
                        73J<br>England<br><strong>Great Britain</strong></p><a href="contact.html">Go to contact
                        page</a>
                    <hr class="d-block d-md-none">
                </div>
                <!-- /.col-lg-3-->
                <div class="col-lg-3 col-md-6">
                    <h4 class="mb-3">Get the news</h4>
                    <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                        turpis egestas.</p>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control"><span class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary">Subscribe!</button></span>
                        </div>
                        <!-- /input-group-->
                    </form>
                    <hr>
                    <h4 class="mb-3">Stay in touch</h4>
                    <p class="social"><a href="#" class="facebook external"><i
                                class="fa fa-facebook"></i></a><a href="#" class="twitter external"><i
                                class="fa fa-twitter"></i></a><a href="#" class="instagram external"><i
                                class="fa fa-instagram"></i></a><a href="#" class="gplus external"><i
                                class="fa fa-google-plus"></i></a><a href="#" class="email external"><i
                                class="fa fa-envelope"></i></a></p>
                </div>
                <!-- /.col-lg-3-->
            </div>
            <!-- /.row-->
        </div>
        <!-- /.container-->
    </div>
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->


    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-center text-lg-left">©2019 Your name goes here.</p>
                </div>
                <div class="col-lg-6">
                    <p class="text-center text-lg-right">Template design by <a
                            href="https://bootstrapious.com/">Bootstrapious</a>
                        <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- *** COPYRIGHT END ***-->
    <!-- JavaScript files-->
    <script src="{{ asset('assets/frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/front.js') }}"></script>
</body>

</html>
