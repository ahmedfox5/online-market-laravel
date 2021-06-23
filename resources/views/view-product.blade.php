@extends('layouts.app')

@section('content')
    <?php
        $pro_name = 'product_name_' . app()->getLocale();
        $pro_desc = 'product_desc_' . app()->getLocale();
    ?>

<div class="row align-items-center">
    <div class="col-md p-4">
        <div class="img-slider">
            <img id="slide" src="{{asset('img/products/' . $product->images[0]->image_name )}}" alt="">
        </div>
        <div class="small-slides row justify-content-center">
            <img class="views active" onclick="changeProductImage(this);" src="{{asset('img/products/' . $product->images[0]->image_name)}}" alt="">

            @for($i = 1 ;$i < count($product->images) ;$i++)
                <img class="views" onclick="changeProductImage(this);" src="{{asset('img/products/' . $product->images[$i]->image_name)}}" alt="">
            @endfor
        </div>
    </div>
    <div class="col-md p-5 pro-info ">
        <h4><strong>{{__('main.product.name')}} : </strong> {{$product->$pro_name}} </h4>
        <br>
        <p><strong>{{__('main.product.description')}} : </strong> {{$product->$pro_desc}} </p>
        <br>
        <h1>
            <strong>{{__('main.price')}}: </strong> {{$product->after_discount}}$
            @if($product->discount_present > 0)
                <span style="color: #c7bbbb;text-decoration: line-through;">{{$product->price}}$</span>
                <br>
                <span style="color: #eb2f06">{{$product->discount_present}}%</span>
            @endif
        </h1>
        <?php $liked = 0; ?>
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
        <span style="font-size: 30px ;cursor: pointer" class="mt-3 mb-3 d-inline-block"><i class="far <?php if($liked == 1){echo 'fas';} ?> fa-heart product-love p-icon like{{$product->id}}" data-liked="{{$liked}}" onclick="like(this ,{{$product->id}});" ></i> 999</span>
        <br>
        <h6><strong>{{__('main.available')}} : </strong> 10 </h6>
        <h6><strong>{{__('main.sell.times')}} : </strong> {{$product->number_of_sell}} </h6>
        <div class="row justify-content-center">

            <?php $added = 0;?>
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

            <div class="col-md-8 p-2 pl-0" ><button id="viewAddToCart" data-id="{{$product->id}}" data-added="<?php if($added == 1){echo '1';}else{echo '0';} ?>" class="btn btn-success w-100 p-3">{{__('main.add.to.cart')}} <i class="fa fa-cart-plus <?php if($added == 1){echo 'fa-check';} ?>" ></i></button></div>
            <div class="col-md-4 m-3 m-md-0 row justify-content-center align-items-center qty">
                <span class="minus bg-dark">-</span>
                <input type="number" class="count" name="qty" value="1">
                <span class="plus bg-dark">+</span>
            </div>
        </div>
    </div>
</div>

    <hr>
    <br>


    <!-- start comments -->
    <div class="comment-cont" style="width: 90%">
        <h5>{{__('main.comments.for.product')}}</h5>
        <div class="like1" ><i class="far fa-comment" ></i> <span id="number_of_comments" >{{count($product->comments)}}</span> | <span class="add-comment-i"> {{__('main.write.comment')}} <i class="far fa-edit" ></i></span> </div>
        <br>
        <h4 class="comments-title" >{{__('main.comments')}} <i class="fa fa-angle-down angle-rotate " ></i></h4>
        <div class="the-comments" >

            @foreach($product->comments as $comment)
                <div class="comment">
                    <h5>{{$comment->user->first_name . ' ' . $comment->user->last_name}}</h5>
                    <p class="comment{{$comment->id}}">{{$comment->comment}}</p>
                    @auth
                        @if(auth()->user()->id === $comment->user_id)
                            <div class="comment-controls">
                                <i onclick="showUpdateBox({{$comment->id}});" class="fa fa-edit m-2"></i>
                                <i onclick="removeComment({{$comment->id}} ,this);" class="fa fa-trash-alt m-2"></i>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach



        </div>
    </div>

    <!-- start  add comments -->
    <div class="add-comment-cont">
        <div class="add-comment">
            <button class="closs-add-comment btn btn-danger" ><i class="fa fa-times" ></i></button>
            <h5 class="mt-2">{{__('main.comment')}}</h5>
            <label for="comment">{{__('main.write.comment')}}</label>
            <textarea cols="30" id="comment" name="comment" rows="10" placeholder="comment"></textarea>
            <br>
            <button class="btn btn-success" data-id="{{$product->id}}" id="add_comment" >{{__('add.comment')}}</button>
        </div>
    </div>


    <!-- start  add comments -->
    <div class="update-comment-cont">
        <div class="update-comment">
            <button class="closs-update-comment btn btn-danger" ><i class="fa fa-times" ></i></button>
            <h5 class="mt-2">{{__('main.comment.update')}}</h5>
            <label for="comment_update">{{__('main.update.comment')}}</label>
            <textarea cols="30" id="comment_update" name="comment" rows="10" placeholder="comment"></textarea>
            <br>
            <button class="btn btn-success" onclick="updateComment();" >{{__('main.update')}}</button>
        </div>
    </div>

    <script>
        $('#add_comment').on('click',function (e){
           @auth
               $.ajax({
                   type:'POST',
                   url:'{{route("add.comment")}}',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'user_id':{{auth()->user()->id}},
                       'product_id':$(e.target).attr('data-id'),
                       'comment':$('#comment').val(),
                   },
                   success:function (data){
                       $('.the-comments').append('<div class="comment">\n' +
                           '                    <h5>{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h5>\n' +
                           '                    <p class="comment'+ data.comment_id +'" >'+ $('#comment').val() +'</p>\n' +
                       '                            <div class="comment-controls">\n' +
                       '                                <i onclick="showUpdateBox('+ data.comment_id +');" class="fa fa-edit m-2"></i>\n' +
                       '                                <i onclick="removeComment('+ data.comment_id +' ,this);" class="fa fa-trash-alt m-2"></i>\n' +
                       '                            </div>\n' +
                           '                    </div>');
                       $('#comment').val('');
                       $(e.target).parent().parent().fadeOut();
                       $('#number_of_comments').html(parseInt($('#number_of_comments').html()) + 1);
                   }
               });
           @endauth
            @guest
                alert('sign in first');
            @endguest
        });

    //    remove comment
        function removeComment(id ,ele){
            $.ajax({
               type:'POST',
               url:'{{route('remove.comment')}}',
               data:{
                   '_token' : '{{csrf_token()}}',
                   'id' : id,
               },
               success:function (){
                   $(ele).parent().parent().remove();
                   $('#number_of_comments').html(parseInt($('#number_of_comments').html()) - 1);
               }
            });
        }


    //    update comment
        let update_id = 0;
        function showUpdateBox(id){
            $('.update-comment-cont').fadeIn();
            update_id = id;
            $('#comment_update').val($('.comment' + update_id ).html());
        }
        function updateComment(){
            $.ajax({
               type:'POST',
               url:'{{route('update.comment')}}',
               data:{
                    '_token':'{{csrf_token()}}',
                   'id' : update_id,
                   'comment':$('#comment_update').val(),
               },
                success:function (){
                   $('.comment' + update_id ).html($('#comment_update').val());
                    $('#comment_update').val('');
                    $('.update-comment-cont').fadeOut();
                }
            });
        }


        // input number of products
        $('.count').prop('disabled', true);
        $(document).on('click','.plus',function(){
            $('.count').val(parseInt($('.count').val()) + 1 );
        });
        $(document).on('click','.minus',function(){
            $('.count').val(parseInt($('.count').val()) - 1 );
            if ($('.count').val() == 0) {
                $('.count').val(1);
            }
        });


        // add to cart
        $('#viewAddToCart').on('click',function (event){
           @auth
           if (event.target.getAttribute('data-added') == 1){
               //    remove from cart
               $.ajax({
                   type:'POSt',
                   url:'{{route("delete.from.cart")}}',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'pro_id': event.target.getAttribute('data-id'),
                       'user_id': {{auth()->user()->id}},
                   },
                   success:function (){
                       event.target.setAttribute('data-added' ,'0');
                       let result = parseInt($('.cart-number').html())-1;
                       $('.cart-number').html(result);
                       $('#viewAddToCart i').removeClass('fa-check');
                   }
               });
           } else {
               $.ajax({
                   type:'POSt',
                   url:'{{route("add.to.cart")}}',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'pro_id': event.target.getAttribute('data-id'),
                       'user_id': {{auth()->user()->id}},
                       'quantity': $('.count').val(),
                   },
                   success:function (){
                       event.target.setAttribute('data-added' ,'1');
                       let result = parseInt($('.cart-number').html())+1;
                       $('.cart-number').html(result);
                       $('#viewAddToCart i').addClass('fa-check');
                   }
               });
           }
            @endauth
            @guest
            alert('sign in first!');
            @endguest
        });


    </script>

    <!-- end  add comments -->

    <!-- end comments -->







<script>

    //    product view
    function changeProductImage(ele){
        let views = document.getElementsByClassName('views');
        for (let i = 0 ;i < views.length ;i++){
            $(views[i]).removeClass('active');
        }
        $(ele).addClass('active');
        $('#slide').attr('src' ,$(ele).attr('src'));
    }

</script>

@endsection
