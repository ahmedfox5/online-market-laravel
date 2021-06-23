<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>

    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">


    <style>
        .card-outline{
            box-shadow: 0px 0px 10px 5px #00000041;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary fox-glass1-light">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>LOGO</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">{{__('main.welcome')}}</p>

            <form class="mb-3" action="@yield('action')" method="post">
                @csrf

                @yield('content')
            </form>




        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js//adminlte.min.js')}}"></script>
</body>
</html>
