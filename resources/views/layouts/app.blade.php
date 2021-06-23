

{{--@include('layouts.header')--}}


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

    <script src="{{asset('public/js/app.js')}}" ></script>

    <script src="{{asset('js/jquery-3.4.1.js')}}" ></script>


    <style>
        @if(session()->has('mood'))
            @if(session()->get('mood') === 'dark')

                body {
                    color: #dddddd;
                    background-color: #191919!important;
                }

                .cont{
                    background-color: #191919!important;
                    color: #dddddd;
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
                    background-color: #222222;
                    color: #dddddd;
                    font-weight: lighter!important;
                    box-shadow: 0 0 8px 1px #00000080;
                }
                .p-card a{
                    color: #dddddd;
                }
                .discount-presentage{
                    color: #000000;
                }

                .cont-dark{
                    background: #111111!important;
                }

                .the-comments i{
                    color: #aaa;
                }
                .the-comments i:hover{
                    color: #fff;
                }


                .main-footer{
                    background-color: #1d1d1d;
                    color: #dddddd;
                }
                .main-footer .copyrights{
                    background-color: #000000;
                }

                .qty .count{
                    color: #fff;
                }

                /*   search */
                .search-cont{
                    background: #2d2d2d;
                }

                .s-result{
                    background: #1d1d1d;
                    color: #fff;
                }
                .s-result:hover{
                    background: #151515;
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

                form input{
                    background: #222222!important;
                    color: #ffffff!important;
                }

            @endif
        @endif

        form input{
            padding:30px
        }
    </style>


    @yield('styles')

    <livewire:styles>


        </head>

<body style="background: none">





<div class="loading">
    <canvas></canvas>
</div>
<div class="cont" id="app">
    <nav class="nav row align-items-center">
        <button class="buttons-button"><i class="fa fa-align-justify" ></i></button>
        <div class="col-md-2 logo row align-items-center justify-content-center"><a class="decoration-none" href="{{route('home')}}"><h4 class="font-weight-bolder" >L O G O</h4></a></div>
        <div class="col-md-7 buttons row justify-content-center">
            <a id="nav_home" data-turbolinks="false" href="{{route('home')}}">{{__('main.home')}}</a>
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


    @if(isset($slot))
        {{$slot}}
    @endif


    <livewire:scripts >

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














<canvas id="wave" ></canvas>
@yield('content')







{{--@include('layouts.footer')--}}












    <br>
    <!-- footer -->

    <footer class="main-footer" >
        <div class="footer-content row p-3">
            <div class="col-md text-center">
                <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.communication')}}</h5>
                <ul>
                    <li>email@example.com <i class="fa fa-envelope m-2"></i></li>
                    <li> +0201011447799 <i class="fa fa-phone-alt m-2"></i></li>
                    <li>
                        <i class="fab fa-facebook-square m-2"></i>
                        <i class="fab fa-twitter m-2"></i>
                        <i class="fab fa-instagram m-2"></i>
                        <i class="fab fa-youtube m-2"></i>
                    </li>
                </ul>
            </div>
            <div class="col-md text-center">
                <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.account')}}</h5>
                <ul>
                    <li>text text text</li>
                    <li>text text text text text</li>
                    <li>text </li>
                    <li>text text text</li>
                    <li>text text text</li>
                    <li>text text text text text</li>
                    <li>text </li>
                </ul>
            </div>
            <div class="col-md text-center">
                <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.important.links')}}</h5>
                <ul>
                    <li>text text text</li>
                    <li>text text text text text</li>
                    <li>text </li>
                    <li>text text text</li>
                    <li>text text text</li>
                    <li>text text text text text</li>
                    <li>text </li>
                    <li>text text text</li>
                    <li>text text text</li>
                </ul>
            </div>
        </div>
        <div class="copyrights row align-items-center justify-content-center">
            <h6>&copy;{{__('main.copyrights')}}</h6>
        </div>
    </footer>
    <div class="fixed-button" id="goTop"><i class="fa fa-angle-up" ></i></div>


    <div class="fixed-button" id="search">
        <i class="fa fa-search" ></i>
    </div>

    <div class="search-cont">
        <input type="text" placeholder="{{__('main.search')}}" id="search_value">
        <div id="search_result">


        </div>
    </div>


    <div class="fixed-button" id="settingsButton"><i class="fa fa-cog" ></i></div>
    <div id="slideSettings">
        <a data-turbolinks="false" href="{{url('/theme')}}"><i class="fa fa-adjust" ></i></a>
        <a data-turbolinks="false" href="{{app()->getLocale() == 'ar'? route('lang' ,'en'):route('lang' ,'ar')}}"><i class="fa fa-language" ></i></a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>

    <script>

        $('#search_value').on('keyup' ,function (){
            $.ajax({
                type:'POST',
                url:'{{route('home.search')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'value' : $(this).val(),
                },
                success : function (data){
                    $('#search_result').html('');
                    for (let i = 0 ;i < data.result.length ;i++){
                        let name ,desc;
                        if ('{{app()->getLocale()}}' === 'en'){
                            name = data.result[i].product_name_en;
                            desc = data.result[i].product_desc_en;
                        }else if('{{app()->getLocale()}}' === 'ar'){
                            name = data.result[i].product_name_ar;
                            desc = data.result[i].product_desc_ar;
                        }
                        let link = '{{url('/view/')}}/' + data.result[i].id;
                        $('#search_result').append('<a href="'+ link +'">\n' +
                            '            <div class="s-result">\n' +
                            '                <div class="row">\n' +
                            '                    <div class="col-8 row align-items-center">\n' +
                            '                        <div class="pt-3 ">\n' +
                            '                            <h6>  '+ name +'  </h6>\n' +
                            '                            <p>  '+ desc +'  </p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="col-4 row justify-content-center align-items-center">\n' +
                            '                        <img src="{{asset("img/products")}}/' + data.images[i].image_name +' " alt="" class="img-thumbnail img-size-64">\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '        </a>');
                    }
                },
                error(){
                    alert('Error!');
                }
            });
        });


    </script>

    <script src="{{asset('js/popper.js')}}" ></script>
    <script src="{{asset('js/bootstrap.js')}}" ></script>
    <script src="{{asset('js/script.js')}}" ></script>

</body>
</html>


<script>
{{--  wave --}}
var canvas = document.getElementById('wave');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var ctx = canvas.getContext('2d');


var sinAdder = 0;
var frequency = 0.01;



function animate(){
    requestAnimationFrame(animate);

    ctx.beginPath();
    ctx.moveTo(0 ,canvas.height/2);


    for(let i = 0 ;i < canvas.width ;i++){

        var y = canvas.height/2 + 150 + Math.sin(i * frequency + sinAdder * 1.2) * 30;
        ctx.lineTo(i ,y);
        ctx.lineTo(canvas.width ,canvas.height);
        ctx.lineTo(0 ,canvas.height);
        // ctx.lineTo(0 ,canvas.height/2);


    }


    sinAdder+= .1;
    ctx.clearRect(0 ,0 ,canvas.width ,canvas.height);
    ctx.fillStyle = '#2222ff55';
    ctx.fill();

}
// animate();



function like(ele ,id){
    @auth
        if($(ele).attr('data-liked') === '0'){
            $.ajax({
                type:'POST',
                url:'{{route('set.like')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'id': id,
                },
                success:function (){
                    $(ele).toggleClass('fas');
                    $(ele).attr('data-liked' ,1);
                }
            });
        }else {
            $.ajax({
                type:'POST',
                url:'{{route('delete.like')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'id': id,
                },
                success:function (){
                    $(ele).toggleClass('fas');
                    $(ele).attr('data-liked' ,0);
                }
            });
        }
    @endauth
    @guest
        alert('sign In or Join Us');
    @endguest
} ////// end of like function



///////////// shopping cart scripts
function addToCart(ele ,proId){
    @auth
        if ($(ele).attr('data-added') == 0){
            $.ajax({
                type:'POST',
                url:'{{route('add.to.cart')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'pro_id':proId,
                    'user_id':{{auth()->user()->id}},
                },
                success:function (){
                    $(ele).addClass('fa-check');
                    let result = parseInt($('.cart-number').html())+1;
                    $('.cart-number').html(result);
                    $(ele).attr('data-added' ,1);
                },
            });
        }else {
            $.ajax({
                type:'POST',
                url:'{{route('delete.from.cart')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'pro_id':proId,
                    'user_id':{{auth()->user()->id}},
                },
                success:function (){
                    $(ele).removeClass('fa-check');
                    let result = parseInt($('.cart-number').html())-1;
                    $('.cart-number').html(result);
                    $(ele).attr('data-added' ,0);


                    if ($(ele).attr('data-cart')){
                        $(ele).parent().parent().remove();
                        getTotalPrice();
                    }

                },
            });
        }

        function deleteLike(ele ,id){
            $.ajax({
                type:'POST',
                url:'{{route('deleteLikedProduct')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'pro_id': id,
                    'user_id': {{auth()->user()->id}},
                },
                success:function (){
                    $(ele).parent().parent().remove();
                }
            });
        }

    @endauth
    @guest
        alert('sign In or Join Us');
    @endguest
} /// end of add to cart function






$('.carousel').carousel({
    interval: 2000
})

</script>

