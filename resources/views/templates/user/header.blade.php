<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="assets/user/images/favicon.jpg" type="image/x-icon">

    <title>
        Raflore - Gift Shop
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/user/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="assets/user/css/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="assets/user/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="assets/user/css/responsive.css" rel="stylesheet" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/user/fontawesome/css/all.css">

    <!-- midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-fREZRkfT6qEMF0YP"></script>

    @stack('style')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="/">
                    <span>
                        Raflore
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  ">
                        <li class="nav-item" id="navhome">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item" id="navproduk">
                            <a class="nav-link" href="produk">
                                Produk
                            </a>
                        </li>
                        <li class="nav-item" id="navkeranjang">
                            <a class="nav-link" href="keranjang">
                                Keranjang
                            </a>
                        </li>
                        <li class="nav-item" id="navpesanan">
                            <a class="nav-link" href="pesanan">
                                Pesanan
                            </a>
                        </li>
                    </ul>
                    <div class="user_option">
                        @if ( Str::length(Auth::guard('customer')->user()) > 0 )
                        <div class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                    {{ Auth::guard('customer')->user()->name }}
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <a class="dropdown-item" href="/history-transaksi">History Transaksi</a>
                                <div class="dropdown-divider"></div>
                                <form action="logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @elseif ( Str::length(Auth::guard('user')->user()) > 0 )
                        <div class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                    {{ Auth::guard('user')->user()->name }}
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <a class="dropdown-item" href="/history-transaksi">History Transaksi</a>
                                <div class="dropdown-divider"></div>
                                <form action="logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="login">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>
                                Login
                            </span>
                        </a>
                        @endif
                        <form class="form-inline">
                            <button class="btn nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- end header section -->

        @yield ('content')
        @include('templates/user/footer')