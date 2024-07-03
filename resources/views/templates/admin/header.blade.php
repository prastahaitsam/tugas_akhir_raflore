<!DOCTYPE html>
<html lang="en">

<head>
    <title>Raflore - Gift Shop</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/user/images/favicon.jpg" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/admin/css/style.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Master Data</label>
                    </li>
                    <li class="nav-item">
                        <a href="/home" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home</span></a>
                    </li>
                    <?php if (auth()->user()->level == "produksi") { ?>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Pesanan</label>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Transaksi</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="/data-pesanan">Pesanan</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Data</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="/data-produk">Produk</a></li>
                                <li><a href="/data-customer">Customer</a></li>
                                <?php if (auth()->user()->level == "owner") { ?>
                                    <li><a href="/data-user">User</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Transaksi</label>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Transaksi</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="/data-pesanan">Pesanan</a></li>
                                <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">


        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="assets/admin/images/logo.png" alt="" class="logo">
                <img src="assets/admin/images/logo-icon.png" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="assets/admin/images/user/avatar-1.png" class="img-radius" alt="User-Profile-Image">
                                <span>{{ auth()->user()->name }}</span>
                            </div>
                            <ul class="pro-body">
                                <li><a href="#" class="dropdown-item">Profile</a></li>
                                <li><a href="/" class="dropdown-item">Halaman Utama</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a type="submit" class="btn dropdown-item" id="logoutPost">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            @yield ('content')
            <!-- [ Main Content ] end -->
        </div>
    </div>
    @include('templates/admin/footer')