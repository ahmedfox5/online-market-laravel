

@extends('layouts.app')

@section('content')


    <?php
    $pro_name = 'product_name_' . app()->getLocale();
    $added = 0;
    ?>

    <h2 class="m-4 text-center">{{$section_name}}</h2>

    <div class="container" >

        <div class="cards-cont  row justify-content-center">

            <?php $counter = 0 ;$liked = 0 ;$added = 0 ?>
            @foreach($products as $product)


                <div class="m-3 p-card">
                    <div class="card-img-cont">
                        <img src="{{asset('img/products/' . $product->images[0]->image_name)}}" alt="">
                    </div>
                    <div class="p-card-info p-2 w-100">
                        @if($product->discount_present > 0)
                            <span class="discount-presentage" >{{$product->discount_present}}%</span>
                        @endif
                        <p>{{$product->$pro_name}}</p>
                        <h5>price: <span>{{$product->after_discount}}$</span>
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

            @endforeach







            <script>



            </script>

        </div>

    </div>

@endsection

