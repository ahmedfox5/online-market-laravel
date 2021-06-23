<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard for {{env('APP_NAME')}} </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("css/OverlayScrollbars.min.css")}}">

    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div id="img_zoom">
    <i class="fa fa-times"></i>
    <img src="" alt="">
</div>
<div class="fox-alert btn-danger">
    <p>{{__('main.want.delete')}}</p>
    <div >
        <a href="" class="delete-url"><button class="btn btn-warning">{{__('main.yes')}}</button></a>
        <button class="btn alert-cancel btn-info">{{__('main.no')}}</button>
    </div>
</div>
@if(isset($alert))
    @if($alert == 'success')
        <div class="fox-alert btn-success">Success :)</div>
    @elseif($alert == 'error')
        <div class="fox-alert btn-danger">Error :(</div>
    @endif
@endif

<div class="blur-cont">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand dashboard-nav navbar-white navbar-light fox-glass1-light f-glass1-cont-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item user-nav-info d-none d-sm-inline-block">
                    <!-- Sidebar user panel (optional) -->
                    <div onclick="$('.user-drop').fadeToggle();" class="user-panel d-flex">
                        <div class="image">
                            <img src="{{asset('img/users/' . auth()->user()->img_name)}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a class="d-block">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</a>
                        </div>
                    </div>
                    <div class="user-drop">
                        <ul>
                            <li><i class="far fa-envelope"></i> {{__('dashboard.email')}} :  {{auth()->user()->email}}</li>
                            <li><a style="color: #000!important;" href="{{route('accountSettings')}}"><i class="fa fa-cog"></i> {{__('dashboard.account.settings')}} </a></li>
                            <li><a style="color: #000!important;" href="{{route('likes' ,auth()->user()->id)}}"><i class="far fa-heart"></i> {{__('dashboard.likes') }}</a></li>
                            <li><a style="color: #000!important;" href="{{url('/logout')}}"><i class="fa fa-sign-out-alt"></i> {{__('dashboard.log.out')}} </a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4 fox-glass1-light f-glass1-cont-light">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link fox-glass2-light">
                <img src="{{asset('dist/img/avatar.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">logo</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{route('d.home')}}" class="nav-link d-home">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                    {{--                                <span class="right badge badge-danger">New</span>--}}
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link d-orders">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    {{__('dashboard.orders')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/dashboard/products')}}" class="nav-link d-products">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    {{__('dashboard.products')}}
                                </p>
                            </a>
                        </li>


                        @if(auth()->user()->job === 1 )

                            <li class="nav-item">
                                <a href="{{route('d.users')}}" class="nav-link d-users">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        {{__('dashboard.users')}}
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('d.sections')}}" class="nav-link d-sections">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        {{__('dashboard.sections')}}
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('slider')}}" class="nav-link d-home-slider">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>
                                        {{__('dashboard.home.slider')}}
                                    </p>
                                </a>
                            </li>

                        @endif



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper fox-glass1-light">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

            @yield('content')



            <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->


    </div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>


<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('js/jquery.mousewheel.js')}}"></script>
{{--<script src="{{asset('js/raphael.min.js')}}"></script>--}}
{{--<script src="{{asset('js/jquery.mapael.min.js')}}"></script>--}}
<script src="{{asset('js/usa_states.min.js')}}"></script>
@yield('script')
<script>
    window.onscroll = function (){
        if(window.scrollY >= 6){
            $(".dashboard-nav").addClass('f-glass2-cont-light');
        }else {
            $(".dashboard-nav").removeClass('f-glass2-cont-light');
        }
    }

    function alert_delete(url){
        $('.fox-alert').addClass('alert-show').css({'left':'1%'});
        $('.delete-url').attr('href',url);
    }
    $('.alert-cancel').on('click',function (){
        $('.fox-alert').animate({"left":"-100%",'display':'none'}).removeClass('alert-show');
    });



//    image preview

    function readURL(input ,viewer) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(viewer).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



//    image zoom
    $('#img_zoom i').on('click',function (){
       $(this).parent().fadeOut();
    });

    $('.img-thumbnail').on('click' ,function (){
        $('#img_zoom').fadeIn();
        $('#img_zoom img').attr('src' ,$(this).attr('src'));
    });

</script>
</body>
</html>
