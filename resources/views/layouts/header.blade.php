<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>this is the title of LOGO site</title>
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset('main.css')}}">
    <link rel="stylesheet" href="{{asset('mobile.css')}}">

    <script src="{{asset('js/jquery-3.4.1.js')}}" ></script>

    <style>
        @if(session()->has('mood'))
            @if(session()->get('mood') === 'dark') --}}

                body {
                    color: #ffffff;
                    background-color: #222222!important;
                }

                .cont{
                    background-color: #222222!important;
                    color: #ffffff;
                }

                .nav{
                    background-color: #2d2d2d;
                    color: #ffffff;
                }
                .logo a ,.nav a ,.nav button{
                    color: #fff!important;
                }

                .nav .user .user-slide-controll{
                    background-color: #2d2d2d;
                }
                .nav .user .user-slide-controll li:hover{
                    background-color: #1d1d1d;
                }

                @media (max-width: 767px) {
                    .nav .buttons{
                        background-color: #3d3d3d;
                    }
                }

                .p-card{
                    background-color: #111111;
                    color: #fff;
                    font-weight: lighter!important;
                    box-shadow: 0 0 8px 1px #00000080;
                }
                .p-card a{
                   color: #ffffff;
                }
                .discount-presentage{
                    color: #000000;
                }

                .main-footer{
                    background-color: #1d1d1d;
                    color: #fff;
                }
                .main-footer .copyrights{
                    background-color: #000000;
                }

                .qty .count{
                    color: #fff;
                }

             /*   search */
            .search-cont{
                background: #3d3d3d;
            }

            .s-result{
                background: #2d2d2d;
                color: #fff;
            }
            .s-result:hover{
                background: #1d1d1d;
                color: #fff;
            }

            .pro-info{
                color: #fff;
            }
            .pro-info strong{
                color: #fff;
            }
            .pro-info .qty .count{
                color: #fff;
                background: none;
            }

            .comment-cont{
                background: #2d2d2d;
            }
            .add-comment{
                background: #1d1d1d;
            }
            .update-comment {
                background: #1d1d1d ;
            }
            .update-comment textarea ,#comment  {
                color: #fff;
            }

            .setting-item .edit{
                color: #fff;
            }


             @endif


@endif
</style>


    @yield('styles')

    <livewire:styles>
</head>

<body style="background: none">
<div class="loading">
    <canvas></canvas>
</div>
<div class="cont">
    <nav class="nav row align-items-center">
        <button class="buttons-button"><i class="fa fa-align-justify" ></i></button>
        <div class="col-md-2 logo row align-items-center justify-content-center"><a class="decoration-none" href="{{route('home')}}"><h4 class="font-weight-bolder" >L O G O</h4></a></div>
        <div class="col-md-7 buttons row justify-content-center">
            <a id="nav_home" href="{{route('home')}}">{{__('main.home')}}</a>
            <a id="nav_products" href="{{route('all.products')}}">{{__('main.products')}}</a>
            <a id="nav_sections" href="#">{{__('main.sections')}}</a>
            <a id="nav_communication" href="#">{{__('main.communication')}}</a>

        </div>
        <div class="col-md-3 user justify-content-center row align-items-center">

            @guest
                <a href="{{route('login')}}" class="offset-1 login-btn  "  style="color: #000;padding: 10px;text-decoration: none;border-radius: 5px;box-sizing: border-box;">{{__('home.login')}}</a>
                <a href="{{route('register')}}" class="offset-1 button-hover" style="color: #fff; padding: 10px;text-decoration: none;border-radius: 5px ;box-sizing: border-box;">{{__('home.join.us')}}</a>
            @endguest

            @auth

                <button id="listToggler" >
                    {{auth()->user()->first_name}}
                    <img style="border-radius: 50%" src="{{asset('img/users/' . auth()->user()->img_name)}}" alt="">
                </button>



                <a href="{{route('cart',auth()->user()->id)}}" class="nav-cart"> <span class="cart-number">{{count(auth()->user()->cart)}}</span> <i class="fa fa-shopping-cart" ></i></a>

                <div class="user-drop-home p-0 user-slide-controll ">
                    <ul>
                        <li><i class="far fa-envelope"></i> {{__('dashboard.email')}} :  {{auth()->user()->email}}</li>
                        <a href="{{route('accountSettings')}}"><li><i class="fa fa-cog"></i> {{__('dashboard.account.settings')}} </li></a>
                        <a href="{{route('likes' ,auth()->user()->id)}}"><li><i class="far fa-heart"></i> {{__('dashboard.likes') }}</li></a>
                        <a href="{{url('/logout')}}"><li><i class="fa fa-sign-out-alt"></i> {{__('dashboard.log.out')}} </li></a>
                    </ul>
                </div>
            @endauth




        </div>
    </nav>

    <script>

        /* $('.user-slide-controll').fadeToggle();$(this).toggleClass('user-info-active'); */
        var mouseInList = false ,oppend = false;


        window.addEventListener('click' ,function(){
            if( oppend && !mouseInList ){
                $('.user-slide-controll').fadeOut();
                $('#listToggler').removeClass('user-info-active');
                oppend = false;
            }
        });

        $('.user-slide-controll').on('mouseover' ,function(){
            mouseInList = true;
        });

        $('.user-slide-controll').on('mouseout' ,function(){
            mouseInList = false;
        });

        $('#listToggler').on('click', function (){
           setTimeout(()=>{
               oppend = !oppend;
           } ,1);
            $('.user-slide-controll').fadeToggle();
            $(this).toggleClass('user-info-active');
        });



    </script>
