@extends('layouts.app')

@section('content')

    <script>
        $('#nav_home').addClass('nav-active');
    </script>
    <!-- head slider  -->
    <section class="header-slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php  $first_active = 0;  ?>
                @for($i = 0 ;$i < count($slides) ;$i++)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$first_active}}" class="<?php if ($first_active == 0){ echo 'active';} ?>"></li>
                    <?php  $first_active += 1 ;  ?>
                @endfor
            </ol>
            <div class="carousel-inner">

                <?php $first_active_slide = 0; ?>
                @foreach($slides as $slide)
                    <div class="carousel-item <?php  if ($first_active_slide == 0){echo 'active';$first_active_slide = 1;}  ?>">
                        <img src="" data-name="{{$slide->image_name}}" class=" img-slide d-block w-100" alt="...">
                    </div>
                @endforeach

                <script>
                    function sliderImgs(){
                        let imgs = document.getElementsByClassName('img-slide');
                        if (window.innerWidth >= 700){
                            for (let i = 0 ; i < imgs.length ;i++){
                                imgs[i].src = 'img/slides/' + $(imgs[i]).attr("data-name");
                            }
                        }else {
                            for (let i = 0 ; i < imgs.length ;i++){
                                imgs[i].src = 'img/slides/mobile/' + $(imgs[i]).attr("data-name");
                            }
                        }
                    }
                    sliderImgs();
                    addEventListener('resize' ,sliderImgs);
                </script>

            </div>
        </div>
    </section>

    <br>


    <!-- products -->
    <h3 class="text-center">{{__('main.products')}}</h3>

    <!-- best seller -->
    <div class="container pl-5">
        <h5>{{__('main.best.seller')}}</h5>
    </div>
    <section class="bestseller">

        <div class="row">
            <div class="best1 col-md" >
                <div class="best12 mb-2 row">
                    <div class="best121 p-1 m-1 best col">
                        <img src="{{asset('img/products/' . $best_products[1]->images[0]->image_name)}}" alt="">
                        <a href="{{route('view.product' ,$best_products[1]->id)}}"><button>View..</button></a>
                    </div>
                    <div class="best122 p-1 m-1 best col">
                        <img src="{{asset('img/products/' . $best_products[2]->images[0]->image_name)}}" alt="">
                        <a href="{{route('view.product' ,$best_products[2]->id)}}"><button>View..</button></a>
                    </div>
                </div>
                <div class="best12 mt-1 row">
                    <div class="best121 p-1 m-1 best col">
                        <img src="{{asset('img/products/' . $best_products[3]->images[0]->image_name)}}" alt="">
                        <a href="{{route('view.product' ,$best_products[3]->id)}}"><button>View..</button></a>
                    </div>
                    <div class="best122 p-1 m-1 best col">
                        <img src="{{asset('img/products/' . $best_products[4]->images[0]->image_name)}}" alt="">
                        <a href="{{route('view.product' ,$best_products[4]->id)}}"><button>View..</button></a>
                    </div>
                </div>
            </div>


            <div class="best2 mt-2 m-1 best col-md order-1" >
                <img src="{{asset('img/products/' . $best_products[0]->images[0]->image_name)}}" alt="">
                <a href="{{route('view.product' ,$best_products[0]->id)}}"><button>View..</button></a>
            </div>
        </div>
        <a class="decoration-none offset-2" href="#"><button class="main-button" >More</button></a>
    </section>

    <?php
        $counter = 0 ;$liked = 0 ;$added = 0;
        $sec_name = 'section_name_' . app()->getLocale();
        $pro_name = 'product_name_' . app()->getLocale();
        $pro_desc = 'product_desc_' . app()->getLocale();
    ?>


    <br/>

    <!-- section 1 -->
    <h3 class="p-2 text-center ">Sections</h3>

    @foreach($sections as $section)


        <section class=" section1 mt-3 pl-2 pr-2">
            <h5 >{{$section->$sec_name}}</h5>

            @if($section->section_image)
                <div class="s-best1 s-best">
                    <a  href="{{route('products.section' ,$section->id)}}"><img style="max-height:350px" src="{{asset('img/sections/' . $section->section_image)}}" alt=""></a>
                </div>
            @endif



            {{-- <div class="cards-cont row justify-content-center">

                <?php
                    $counter = 0 ;$liked = 0 ;$added = 0;
                    $sec_name = 'section_name_' . app()->getLocale();
                    $pro_name = 'product_name_' . app()->getLocale();
                    $pro_desc = 'product_desc_' . app()->getLocale();
                ?>
                @foreach($section->product as $product)
                        <?php $counter++; ?>
                    @if($counter < 9)

                        <div class="m-3 p-card">
                            <div class="card-img-cont">
                                <img src="img/products/{{$product->images[0]->image_name}}" alt="">
                            </div>
                            <div class="p-card-info p-2 w-100">
                                @if($product->discount_present > 0)
                                    <span class="discount-presentage" >{{$product->discount_present}}%</span>
                                @endif
                                    <a href="{{route('view.product' ,$product->id)}}"><p>{{$product->$pro_name}}</p></a>
                                <h5>{{__('main.price')}}    : <span>{{$product->after_discount}}$</span>
                                    @if($product->discount_present > 0)
                                        <span class="ml-2">{{$product->price}}$</span>
                                    @endif
                                </h5>

                                    @auth
                                        @foreach(auth()->user()->likes as $like)
                                            @if($like->product_id == $product->id)
                                                <?php $liked = 1;?>
                                                @break
                                            @else
                                                <?php $liked = 0;?>
                                            @endif
                                        @endforeach
                                    @endauth

                                    @auth
                                        @foreach(auth()->user()->cart as $pro)
                                            @if($pro->product_id == $product->id)
                                                <?php $added = 1;?>
                                                @break
                                            @else
                                                <?php $added = 0;?>
                                            @endif
                                        @endforeach
                                    @endauth

                                <span class="d-inline-block"><i class="far <?php if($liked == 1){echo 'fas';} ?> fa-heart product-love p-icon like{{$product->id}}" data-liked="{{$liked}}" onclick="like(this ,{{$product->id}});" ></i> 999</span>
                                <span class="float-right d-inline-block">{{$product->number_of_sell}} <i class="fa <?php if($added == 0){echo 'fa-cart-plus';}else{echo 'fa-check';} ?>   add-to-cart p-icon p-icon-2" data-added="{{$added}}" onclick="addToCart(this ,{{$product->id}});" ></i></span>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div> --}}

            {{-- <a class="decoration-none offset-2" href="#"><button class="main-button" >More</button></a> --}}
        </section>
        <br/>
    @endforeach




     <!-- suggestions -->

     <section class="container  mt-3 pl-5 pr-5">
        <h5>{{__('main.suggestions')}}</h5>

        <div class="cards-cont row justify-content-center">

            @foreach($suggestions as $product)
                <?php $counter++; ?>
                @if($counter < 9)

                    <div class="m-3 p-card">
                        <div class="card-img-cont">
                            <img src="img/products/{{$product->images[0]->image_name}}" alt="">
                        </div>
                        <div class="p-card-info p-2 w-100">
                            @if($product->discount_present > 0)
                                <span class="discount-presentage" >{{$product->discount_present}}%</span>
                            @endif
                                <a href="{{route('view.product' ,$product->id)}}"><p>{{$product->$pro_name}}</p></a>
                            <h5>{{__('main.price')}}: <span>{{$product->after_discount}}$</span>
                                @if($product->discount_present > 0)
                                    <span class="ml-2">{{$product->price}}$</span>
                                @endif
                            </h5>

                            @auth
                                @foreach(auth()->user()->likes as $like)
                                    @if($like->product_id == $product->id)
                                        <?php $liked = 1;?>
                                        @break
                                    @else
                                        <?php $liked = 0;?>
                                    @endif
                                @endforeach
                            @endauth

                            @auth
                                @foreach(auth()->user()->cart as $pro)
                                    @if($pro->product_id == $product->id)
                                        <?php $added = 1;?>
                                        @break
                                    @else
                                        <?php $added = 0;?>
                                    @endif
                                @endforeach
                            @endauth

                            <span class="d-inline-block"><i class="far <?php if($liked == 1){echo 'fas';} ?> fa-heart product-love p-icon like{{$product->id}}" data-liked="{{$liked}}" onclick="like(this ,{{$product->id}});" ></i> 999</span>
                            <span class="float-right d-inline-block">{{$product->number_of_sell}} <i class="fa <?php if($added == 0){echo 'fa-cart-plus';}else{echo 'fa-check';} ?>   add-to-cart p-icon p-icon-2" data-added="{{$added}}" onclick="addToCart(this ,{{$product->id}});" ></i></span>
                        </div>
                    </div>
                @endif
            @endforeach


        </div>

        <a class="decoration-none offset-2" href="#"><button class="main-button" >More</button></a>
    </section>



@endsection


