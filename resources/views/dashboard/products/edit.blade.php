@extends('dashboard.layouts.app')

@section('content')

    <!-- general form elements -->
    <div class="card card-primary fox-glass2-light">
        <div class="card-header fox-glass3-light">
            <h3 class="card-title">{{__('dashboard.product.create')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" class="create-form" enctype="multipart/form-data" action="{{route('d.product.update')}}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('dashboard.product.name.en')}}</label>
                    <input type="text" name="product_name_en" value="{{$product->product_name_en}}" class="form-control" id="exampleInputEmail1" placeholder="{{__('dashboard.product.name.en')}}">
                    @error('product_name_en')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('dashboard.product.name.ar')}}</label>
                    <input type="text" name="product_name_ar" value="{{$product->product_name_ar}}" class="form-control" id="exampleInputEmail1" placeholder="{{__('dashboard.product.name.ar')}}">
                    @error('product_name_ar')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('dashboard.product.price')}}</label>
                    <input type="text" name="price" class="form-control" value="{{$product->price}}" id="exampleInputEmail1" placeholder="{{__('dashboard.product.price')}}">
                    @error('price')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('dashboard.product.desc.en')}}</label>
                    <textarea rows="4" name="product_desc_en"  class="form-control" id="exampleInputPassword1" placeholder="{{__('dashboard.product.desc.en')}}">{{$product->product_desc_en}}</textarea>
                    @error('product_desc_en')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('dashboard.product.desc.ar')}}</label>
                    <textarea rows="4" name="product_desc_ar" class="form-control" id="exampleInputPassword1" placeholder="{{__('dashboard.product.desc.ar')}}">{{$product->product_desc_ar}}</textarea>
                    @error('product_desc_ar')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label>{{__('dashboard.product.sections')}}</label>




                    <?php
                    $sec_name = 'section_name_' . app()->getLocale();
                    ?>
                    <select class="form-control" onchange="addSection(this.value ,this.options[this.selectedIndex].innerHTML);">
                        <option></option>

                        @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->$sec_name}}</option>
                        @endforeach
                    </select>

                    <div class="sections-inputs m-2 row justify-content-center">
                        @foreach($product->section as $section)

                            <div class="section-input row align-items-center">
                                <input readonly="" class="text-center d-none" type="text" value="2">
                                <span data-oldid="{{$section->id}}" class="m-2 old-section ">{{$section->$sec_name}}</span>
                                <a href="{{route('d.delete.product.section' ,[$section->id ,$product->id] )}}"><i class="fa fa-times"></i></a>
                            </div>

                        @endforeach
                    </div>


                    @error('section0')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="exampleInputFile">{{__('dashboard.product.image.old')}}</label>

                    <div class="row justify-content-center">
                        @foreach($images as $image)
                            <div class=" old-image d-inline-block row justify-content-center align-items-center d-flex col-2 m-2 p-3 border ">
                                <img src="{{asset('img/products/' . $image->image_name)}}" class="img-thumbnail img-lg " alt="">
                                <a href="{{route('d.img.destroy',$image->id)}}" class="btn btn-danger  m-2 "><i class="fa fa-times"></i></a>
                            </div>
                        @endforeach
                    </div>



                    <br>
                    <label for="exampleInputFile">{{__('dashboard.product.image.upload')}}</label>

                    <div class="input-group">
                            <div class="w-100 align-items-center file_input_cont m-1 p-1 border row">
                                <input type="file" onchange="input_apply();" name="image0" class="col-9 inp-file" >
                                <div class="col-3 row align-items-center justify-content-center">
                                    <img src="{{asset('img/products/default.png')}}" class="img-thumbnail img-lg img-galary " alt="">
                                    <button onclick="delete_file_input(0,event);" class="btn btn-danger btn-delete-file-input m-2 ml-4"><i class="fa fa-times"></i></button>
                                </div>
                            </div>

                        @if($errors->any())
                            <ul>
                                @if(!isset($errors->messages()['product_name_en']) || !isset($errors->messages()['product_name_ar']) || !isset($errors->messages()['product_desc_en']) || !isset($errors->messages()['product_desc_ar']))
                                    @foreach($errors->all() as $error)
                                        <li style="list-style: none"><p style="color: #ff1111;" role="alert" >{{$error}}</p></li>
                                    @endforeach
                                @endif
                            </ul>
                        @endif
                    </div>
                    <button class="btn btn-primary float-right m-2 add-input"><i class="fa fa-plus" ></i></button>


                </div>
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary ajax-s">Save</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $('.d-products').addClass('active');

        var form_data = new FormData($('.create-form')[0]);

        form_data.append('aaaaaaa','aaaaaaaa');
        form_data.append('bbbbbbb','aaaaaaaa');
        form_data.append('ccccccc','aaaaaaaa');

        // add input for add image
        var input_number = 1;
        $(".add-input").on('click',function (e){
            e.preventDefault();
            set_file_input_data();
            get_file_input_data();
            var subtraction = document.getElementsByClassName('file_input_cont').length - the_files.length;
            if ( subtraction === 0){
                document.querySelector('.input-group').innerHTML += '<div class="w-100 align-items-center file_input_cont m-1 p-1 border row">\n' +
                    '<input type="file" onchange="input_apply();"  name="image'+ input_number +'" class="col-9 inp-file " >\n' +
                    '<div class="col-3  row align-items-center justify-content-center">' +
                    '<img src="{{asset("img/products/default.png")}}" class="img-thumbnail img-lg img-galary " alt="{{__('dashboard.select.image')}}">'+
                    '<button onclick="delete_file_input('+ input_number +',event);" class="btn btn-delete-file-input btn-danger m-2 ml-4"><i class="fa fa-times"></i></button></div>\n' +
                    '</div>';
                input_number++;
                set_file_input_data();
            }else {
                alert("you should select file at the last input before adding another one !");
            }
        });        // end of add new input file

        var the_files = [];
        function get_file_input_data(){
            var data = [];
            var inputs = document.getElementsByClassName('inp-file');
            for (let i = 0 ;i < inputs.length ;i++){
                if(inputs[i].files.length > 0){
                    console.log(inputs[i].files);
                    data.push(inputs[i].files);
                }
            }
            the_files = data;
        } // end of get input files data

        function set_file_input_data(){
            if(the_files.length !== 0){
                for (let i = 0 ;i < the_files.length ;i++){
                    var inputs = document.getElementsByClassName('inp-file');
                    for (let i = 0 ;i < inputs.length -1 ;i++){
                        inputs[i].files = the_files[i];
                    }
                }
            }
        } // end of set input files data

        function input_apply(){
            set_file_input_data();
            preview();
        } // run get input data

        function preview () {
            var get_imgs = document.getElementsByClassName('img-galary');
            var get_inputs = document.getElementsByClassName('inp-file');
            for( let i = 0;i < get_imgs.length;i++){
                if (get_inputs[i].files && get_inputs[i].files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(get_imgs[i]).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(get_inputs[i].files[0]); // convert to base64 string
                }
            }

        } // end of preview image function

        function delete_file_input(index,event){
            event.preventDefault();
            var file_conts = document.getElementsByClassName('file_input_cont');
            if (file_conts.length > 1){
                $(file_conts[index]).remove();
                the_files.splice(index ,1);
            }
            change_delete_index();
        } // end of delete file input function

        function change_delete_index(){
            var delete_buttons = document.getElementsByClassName('btn-delete-file-input');
            for (let i = 0 ;i < delete_buttons.length ;i++){
                $(delete_buttons[i]).attr('onclick','delete_file_input('+ i +',event);');
            }
        }//   end of change index of delete buttons



        var sections = [];
        var old_sections = document.getElementsByClassName('old-section');
        for (let i = 0 ;i < old_sections.length ;i++){
            sections.push(old_sections[i].getAttribute('data-oldid'));
        }

        function addSection(value ,text){

            if(sections.indexOf(value) === -1){
                sections.push(value);
                $('.sections-inputs').append('<div class="section-input row align-items-center">\n' +
                    '<input readonly class="text-center d-none sec-inpt" type="text" value="'+ value +'">\n' +
                    '<span class="m-2">'+text+'</span>\n' +
                    '<i class="fa fa-times" onclick="$(this).parent().remove();sections.splice(0 ,1);changeSectionInputName();"></i>\n' +
                    '</div>');
                changeSectionInputName();
                console.log(sections);
            }else {
                alert('This Section is added before !!');
            }

        } // end of add section function

        function changeSectionInputName(){
            let secInputs = document.getElementsByClassName('sec-inpt');
            for (let i = 0 ;i < secInputs.length ;i++){
                $(secInputs[i]).attr('name','section' + i);
            }
        }


    </script>
@endsection
