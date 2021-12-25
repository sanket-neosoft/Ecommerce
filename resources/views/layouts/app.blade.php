<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Commerce') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    @yield('head')
</head>

<body class="hold-transition {{ empty(Auth::user()) ? 'layout-top-nav' : 'sidebar-mini layout-fixed layout-navbar-fixed' }}">
    <!-- Site wrapper -->
    <div class="wrapper">
        @guest
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="https://uilogos.co/img/logomark/towers.png" alt="AdminLTE Logo" class="brand-image" style="filter: invert(85%)">
                    <span class="brand-text font-weight-light">E-Commerce</span>
                </a>
            </div>
        </nav>
        <!-- /.navbar -->
        @else
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog mr-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="logout();"><i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="https://uilogos.co/img/logomark/towers.png" alt="Logo" class="brand-image" style="filter: invert(85%)">
                <span class="brand-text font-weight-light">E-Commerce</span>
            </a>
        </aside>
        @endguest
        <main class="content-wrapper">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Custom JS -->
    <script>
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>
    @yield('script')
</body>

</html>