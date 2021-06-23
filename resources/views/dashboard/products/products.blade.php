    @extends('dashboard.layouts.app')

@section('content')
    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light">

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="{{route('d.newProduct')}}" class="btn btn-sm btn-primary float-left">{{__('dashboard.product.create')}}</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right">{{__('dashboard.product.all')}}</a>
        </div>


        <div class="card-header border-transparent">
            <h3 class="card-title">{{__('dashboard.products')}}</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">

            <div class="row">
                <div class="col-11">
                    <input type="text" class="form-control m-2 "  id="dProducsSearch" placeholder="Search">
                </div>
                <div class="col-1 p-1">
                    <div class="spinner-border mt-2" id="searchSpinner" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table m-0" >
                    <thead>
                    <tr>
                        <th>{{__('dashboard.product.name')}}</th>
                        <th>{{__('dashboard.product.desc')}}</th>
                        @if(auth()->user()->job === 1)<th>{{__('dashboard.product.user')}}</th>@endif
                        <th>{{__('dashboard.product.price')}}</th>
                        <th>{{__('dashboard.discount')}}</th>
                        <th>{{__('dashboard.product.img')}}</th>
                        <th>{{__('dashboard.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                        <?php
                            $product_name = 'product_name_' . app()->getLocale();
                            $product_desc = 'product_desc_' . app()->getLocale();
                            $user = auth()->user();
                        ?>

                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->$product_name}}</td>
                                <td>{{$product->$product_desc}}</td>
                                @if(auth()->user()->job === 1)
                                    <th>
                                        {{$product->user->first_name . ' ' . $product->user->last_name}}
                                        <img src="{{asset('img/users/' . $product->user->img_name)}}" style="width: 60px;height: 60px" class=" img-circle m-2" alt="">
                                    </th>
                                @endif
                                <td id="price{{$product->id}}" >{{$product->after_discount}}</td>
                                <td id="present{{$product->id}}" >{{$product->discount_present . '%'}}</td>
                                <td>
                                    @foreach($images as $image)
                                        @if($image->product_id == $product->id)
                                            <img src="{{asset('img/products/' . $image->image_name)}}" class="img-thumbnail" alt="">
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <?php $name = 'product_name_' . app()->getLocale(); ?>
                                    <a href="{{route('d.product.edit' ,$product->id)}}"><button class="btn btn-sm btn-success m-1">{{__('dashboard.edit')}}</button></a>
                                    <button onclick="show_discount_form({{$product->id}} , '{{$product->$name}}' ,'{{$product->discount_present}}')" class="btn btn-sm btn-secondary m-1">{{__('dashboard.discount')}}</button>
                                    <button onclick="alert_delete('{{route('d.destroy',$product->id)}}');" class="btn btn-sm btn-danger m-1">{{__('dashboard.delete')}}</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>

        <!-- /.card-footer -->
    </div>

    <form id="edit_user_job" method="post" class="p-3" >

        <div class="cont">
            <h6 class="text-center">{{__('dashboard.user.edit.job') . ' '}} <span id="pro_name" ></span></h6>

            <div class="m-3">
                <!-- radio -->
                <div class="form-group clearfix">
                    <lable>{{__('dashboard.discount.present')}}</lable>
                    <br>
                    <input type="text" name="present" class="mt-2 p-2" placeholder="0%">
                </div>

            </div>
            <button type="submit" class="btn ml-3 btn-primary ajax-edit-pro">{{__('dashboard.save')}}</button>
        </div>

        <div class="ajax-success">Successful :)</div>

    </form>

@endsection
@section('script')
    <script>
        $('.d-products').addClass('active');
        $('.pagination').parent().addClass('pagination-father');
        $('.pagination .page-link').addClass('fox-glass2-light');
    //    end of pagination


    //
        var product_id ;
        function show_discount_form(id ,name ,present){
            $('#pro_name').html(name);
            $('#edit_user_job').fadeIn();
            $('.ajax-success').hide();
            product_id = id;
        }

        $(".ajax-edit-pro").on('click',function (event){
            event.preventDefault();
            $.ajax({
                type:'POST',
                url:'{{route('discount')}}',
                data:{
                  '_token':'{{csrf_token()}}',
                  'present':$('input[name=present]').val(),
                  'id':product_id,
                },
                success:function (data){
                    $('.ajax-success').fadeIn();
                    $('#edit_user_job').delay(1000).fadeOut();
                    $('#price'+product_id).html(data.new_price);
                    $('#present'+product_id).html(data.present + "%");
                },
                error:function (){
                    alert('Error!!');
                }
            });
        });


    //    products search
        let searchSpinner = $('#searchSpinner').hide();
        searchSpinner.hide();
        $('#dProducsSearch').on('keyup' ,function(e){
            searchSpinner.show();
            $.ajax({
               method : "POST",
               url : "{{route('d.search')}}",
               data : {
                   "_token" : "{{csrf_token()}}",
                   "value" : e.target.value,
               },
                success : function (data){
                   if (data.success){
                       let tBody = document.getElementById("tbody");
                       tBody.innerHTML = "";
                       if(data.products){
                           for(let i = 0 ; i < data.products.length ;i++){
                               let locale = "{{app()->getLocale()}}" ,product_name = "" ,product_description = "";
                               if(locale === "ar"){
                                   product_name = data.products[i].product_name_ar;
                                   product_description = data.products[i].product_desc_ar;
                               }else if(locale === "en"){
                                   product_name = data.products[i].product_name_en;
                                   product_description = data.products[i].product_desc_en;
                               }
                               tBody.innerHTML += "<tr>\n" +
                                   "                                <td>" + product_name + "</td>\n" +
                                   "                                <td>" + product_description + "</td>\n" +
                                   "                                @if(auth()->user()->job === 1)\n" +
                                   "                                    <th>\n" +
                                   "                                        "+ data.products[i].user.first_name + ' ' + data.products[i].user.last_name +" \n" +
                                   "                                        <img src=\"{{asset('img/users/')}}/"+ data.products[i].user.img_name +"\" style=\"width: 60px;height: 60px\" class=\" img-circle m-2\" alt=\"\">\n" +
                                   "                                    </th>\n" +
                                   "                                @endif\n" +
                                   "                                <td id=\"price"+ data.products[i].id +"\" >"+ data.products[i].after_discount +"</td>\n" +
                                   "                                <td id=\"present"+ data.products[i].id +"\" >"+ data.products[i].discount_present +" %</td>\n" +
                                   "                                <td>\n" +
                                   "                                    <img src=\"{{asset('img/products/')}}/"+ data.products[i].images[0].image_name +"\" class=\"img-thumbnail\" alt=\"\">\n" +
                                   "                                </td>\n" +
                                   "                                <td>\n" +
                                   "                                    <a href='{{route('d.product.edit' ,'')}}/ "+ data.products[i].id +"'><button class=\"btn btn-sm btn-success m-1\">{{__('dashboard.edit')}}</button></a>\n" +
                                   "                                    <button onclick=\"show_discount_form("+ data.products[i].id +" , '"+ product_name +"' ,'"+ data.products[i].descount_present +"')\" class=\"btn btn-sm btn-secondary m-1\">{{__('dashboard.discount')}}</button>\n" +
                                   "                                    <button onclick=\"alert_delete('{{route('d.destroy','')}}/"+ data.products[i].id +"');\" class=\"btn btn-sm btn-danger m-1\">{{__('dashboard.delete')}}</button>\n" +
                                   "                                </td>\n" +
                                   "                            </tr>";
                           }
                       }
                       searchSpinner.hide();
                   }
                }
            });
        });

    </script>
@endsection


