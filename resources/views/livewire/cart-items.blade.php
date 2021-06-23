<div>


    <?php
        $pro_name = 'product_name_' . app()->getLocale();
        $pro_desc = 'product_desc_' . app()->getLocale();
    ?>

    <h2 class="m-4 text-center">{{__('main.shopping.cart')}}</h2>

    <div class="container" >

        <div class="cards-cont  row justify-content-center">

            <?php $counter = 0 ;?>

            @if($products)

                    @foreach($products as $product)


                        <div class="m-3 p-card">
                            <div class="card-img-cont">
                                <img src="{{asset('img/products/'. $product->images[0]->image_name)}}" alt="">
                            </div>
                            <div class="p-card-info p-2 product{{$product->id}} w-100">
                                @if($product->discount_present > 0)
                                    <span class="discount-presentage" >{{$product->discount_present}}%</span>
                                @endif
                                <a href="{{route('view.product' ,$product->id)}}"><p>{{$product->$pro_name}}</p></a>
                                <h5>price: <span class="pro-price">{{$product->after_discount}}</span>$
                                    @if($product->discount_present > 0)
                                        <span class="ml-2">{{$product->price}}$</span>
                                    @endif
                                </h5>
                                <div class="m-3 m-md-0 row justify-content-center align-items-center qty">
{{--                                    <span onclick="minus({{$quantities_ids[$counter][0]}});" class="minus bg-dark">-</span>--}}
                                    <span wire:click="minus({{$quantities_ids[$counter][0]}})" class="minus bg-dark">-</span>
                                    <input style="background: none" type="number" class="count" name="qty" value="{{$quantities_ids[$counter][1]}}">
{{--                                    <span onclick="plus({{$quantities_ids[$counter][0]}});" class="plus bg-dark">+</span>--}}
                                    <span wire:click="plus({{$quantities_ids[$counter][0]}})" class="plus bg-dark">+</span>
                                </div>

{{--                                <i class="far btn btn-danger w-100 m-0 mt-2 fa-trash-alt product-love p-icon like{{$product->id}}" data-cart="1" data-added="1" onclick="addToCart(this ,{{$product->id}});"  ></i>--}}
                                <i class="far btn btn-danger w-100 m-0 mt-2 fa-trash-alt product-love p-icon like{{$product->id}}" data-cart="1" data-added="1" wire:click="removeItem({{auth()->user()->id}}, {{$product->id}})"  onclick="changeNavCartNumber();" ></i>

                            </div>
                        </div>

                        <?php $counter ++; ?>
                    @endforeach

                @else

                <h6 class="text-center p-4" >No items at the cart !</h6>

            @endif


        </div>


    </div>

        @if($totalPrice)
            <br>
            <div class="p-3 row cont-dark m-auto container" style="background: #F2DDDD;border-radius: 10px" >
                <h1 style="color: #888" class="col-md-8 m-2">{{__('main.total.cost')}} : <span style="color: #00C851" >{{$totalPrice}}$</span></h1>
                <button wire:click="makeOrder" class="btn btn-primary m-2 col-md-3 row justify-content-center align-items-center">{{__('main.make.order')}}</button>
            </div>
        @endif


    <script>

{{--      change number of elements at the cart at the navbar     --}}
        function changeNavCartNumber(){
            let result = parseInt($('.cart-number').html()) - 1;
            $('.cart-number').html(result);
        }

    </script>


</div>
