@extends('dashboard.layouts.app')

@section('content')

    <!-- general form elements -->
    <div class="card card-primary fox-glass2-light">
        <div class="card-header fox-glass3-light">
            <h3 class="card-title">{{__('dashboard.slider.create')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" class="create-form" enctype="multipart/form-data" action="{{route('slider.store')}}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="exampleInputFile">{{__('dashboard.slide.image.upload')}}</label>


                    <div class="input-group">
                        <h6>PC</h6>
                        <div class="w-100 align-items-center file_input_cont m-1 p-1 border row">
                            <input type="file" name="image" class="col-9 " id="inp_file" >
                            <div class="col-3 row align-items-center justify-content-center">
                                <img src="{{asset('img/products/default.png')}}" class="img-thumbnail img-lg " id="img_view" alt="">
                            </div>
                        </div>
                            @error('image')
                                <li style="list-style: none"><p style="color: #ff1111;" role="alert" >{{$message}}</p></li>
                            @enderror
                    </div>

                    <div class="input-group">
                        <h6>Mobile</h6>
                        <div class="w-100 align-items-center file_input_cont m-1 p-1 border row">
                            <input type="file" name="image2" class="col-9 " id="inp_file2" >
                            <div class="col-3 row align-items-center justify-content-center">
                                <img src="{{asset('img/products/default.png')}}" class="img-thumbnail img-lg " id="img_view2" alt="">
                            </div>
                        </div>
                        @error('image2')
                        <li style="list-style: none"><p style="color: #ff1111;" role="alert" >{{$message}}</p></li>
                        @enderror
                    </div>

                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary ajax-s">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $('.d-home-slider').addClass('active');



        $("#inp_file").on('change',function() {
            readURL(this ,'#img_view');
        });

        $("#inp_file2").on('change',function() {
            readURL(this ,'#img_view2');
        });


    </script>


@endsection

