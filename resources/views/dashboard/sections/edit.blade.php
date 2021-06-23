@extends('dashboard.layouts.app')

@section('content')


    <!-- general form elements -->
    <div class="card card-primary fox-glass2-light">
        <div class="card-header fox-glass3-light">
            <h3 class="card-title">{{__('dashboard.section.create')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" class="create-form" enctype="multipart/form-data" action="{{route('d.update.section')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('dashboard.section.name.en')}}</label>
                    <input type="text" name="section_name_en" class="form-control" value="{{$section->section_name_en}}" id="exampleInputEmail1" placeholder="{{__('dashboard.section.name.en')}}">
                    @error('section_name_en')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('dashboard.section.name.ar')}}</label>
                    <input type="text" name="section_name_ar" class="form-control" value="{{$section->section_name_ar}}" id="exampleInputEmail1" placeholder="{{__('dashboard.section.name.ar')}}">
                    @error('section_name_ar')
                    <p style="color: #ff1111;" role="alert" >{{$message}}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="exampleInputFile">{{__('dashboard.section.image.offer')}}</label>
                    <div class="w-100 align-items-center file_input_cont m-1 p-1 border row">
                        <input type="file" name="image" class="col-9 " id="inp_file" >
                        <div class="col-3 row align-items-center justify-content-center">
                            <img src="@if($section->section_image) {{asset('img/sections/' . $section->section_image)}} @else {{asset('img/products/default.png')}} @endif" class="img-thumbnail img-lg " id="img_view" alt="">
                        </div>
                    </div>
                    @error('image')
                    <li style="list-style: none"><p style="color: #ff1111;" role="alert" >{{$message}}</p></li>
                    @enderror
                </div>


            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary ajax-s">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $('.d-sections').addClass('active');

        $("#inp_file").on('change',function() {
            readURL(this ,'#img_view');
        });
    </script>


@endsection
