<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>BitBoi</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets') }}/painel/images/favicon-32x32.png" type="image/png" />
    <!-- Vector CSS -->
    <link href="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!--plugins-->
    <link href="{{ asset('assets') }}/painel/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/painel/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/painel/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <!-- <link href="{{ asset('assets') }}/painel/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('assets') }}/painel/js/pace.min.js"></script> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/painel/css/app.css" />

    <script src="{{ asset('assets') }}/painel/js/jquery.min.js"></script>

    <style>
        .form-row {
            margin-top: 5px;
        }
    </style>

</head>

<body class="bg-theme bg-theme7">
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <h4 class="logo-text">
                    <img src="{{ asset('assets') }}/img/logo2.png" class="logo-icon" alt="">
                </h4>
                <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
                </a>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li class="menu-label">Menu</li>
                <li>
                    <a href="{{ url('client') }}">
                        <div class="parent-icon"><i class="bx bx-home-alt"></i>
                        </div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>

                <li>
                    <a href="{{ url('client/meu_plano') }}">
                        <div class="parent-icon"> <i class="bx bx-cart"></i>
                        </div>
                        <div class="menu-title">Compras</div>
                    </a>
                </li>
                {{--
                --}}

                <li>
                    <a href="{{ url('client/meus_dados') }}">
                        <div class="parent-icon"> <i class="bx bxs-user-account"></i>
                        </div>
                        <div class="menu-title">Meus Dados</div>
                    </a>
                </li>

                <li>
                    <a href="{{ url('client/logout') }}">
                        <div class="parent-icon"><i class="bx bx-power-off"></i>
                        </div>
                        <div class="menu-title">Sair</div>
                    </a>
                </li>

            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar-wrapper-->
        <!--header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="left-topbar d-flex align-items-center">
                    <a href="javascript:;" class="toggle-btn">
                        <i class="bx bx-menu"></i>
                    </a>
                </div>
                <div class="flex-grow-1 search-bar">
                    <div class="input-group">

                    </div>
                </div>
                <div class="right-topbar ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item search-btn-mobile">
                            <a class="nav-link position-relative" href="javascript:;"> <i class="bx bx-search vertical-align-middle"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-lg">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-toggle="dropdown"> <i class="bx bx-bell vertical-align-middle"></i>
                                <span class="msg-count">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <h6 class="msg-header-title">0</h6>
                                        <p class="msg-header-subtitle">Notificações</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">

                                    <!-- 

                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="media align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="msg-name">New Customers<span class="msg-time float-right">14 Sec
                                                ago</span></h6>
                                                <p class="msg-info">5 new user registered</p>
                                            </div>
                                        </div>
                                    </a>
                                -->

                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer"></div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-user-profile">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
                                <div class="media user-box align-items-center">
                                    <div class="media-body user-info">
                                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                                        <p class="designattion mb-0">On-line</p>
                                    </div>
                                    <img src="{{ asset('assets') }}/img/avata.png" class="user-img" alt="user avatar">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('client/meus_dados') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                                <div class="dropdown-divider mb-0"></div> <a class="dropdown-item" href="{{ url('client/logout') }}"><i class="bx bx-power-off"></i><span>Sair</span></a>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!--end header-->
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content" style="min-height: 90vh;">

                    @include('commons.alerts')

                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <div class='row'>
                                    <div class="col-md-6">
                                        <h4 class="mb-0"> @yield('title') </h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @yield('actions')
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page-wrapper-->
        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <!--footer -->
        <div class="footer">
            <p class="mb-0">BitBoi@2022- All rights reserved.</a>
            </p>
        </div>
        <!-- end footer -->
    </div>

    <script src="<?php echo asset('assets'); ?>/js/jquery.mask.js"></script>
    <script>
        $('.moeda').mask("#.##0,00", {
            reverse: true
        });
        $('.data').mask("00/00/0000");
        $('.fone').mask("(99) 9 9999-9999", {
            clearIfNotMatch: true
        });
        $('.cpf').mask("000.000.000-00", {
            clearIfNotMatch: true
        });
        $('.cnpj').mask("00.000.000/0000-00", {
            clearIfNotMatch: true
        });
        $('.voucher').mask("AAAA-AAAA-AAAA");
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{ asset('assets') }}/painel/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/painel/js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('assets') }}/painel/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!-- Vector map JavaScript -->
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
    <script src="{{ asset('assets') }}/painel/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="{{ asset('assets') }}/painel/js/index.js"></script>
    <!-- App JS -->
    <script src="{{ asset('assets') }}/painel/js/app.js"></script>
    <script>
        new PerfectScrollbar('.dashboard-social-list');
        new PerfectScrollbar('.dashboard-top-countries');
    </script>
</body>

</html>