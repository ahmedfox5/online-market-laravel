@extends('layouts.app')

@section('content')
    <div class="account-settings-cont">
        <h3 class="m-3 text-center">{{__('main.user.image')}}</h3>
        <form method="post" enctype="multipart/form-data" action="{{route('user.img.update')}}">
            @csrf

            <div class="row justify-content-center m-4">
                <img src="{{asset('img/users/' . auth()->user()->img_name)}}" id="preview_avatar" draggable="false" style="height: 250px;width: 250px; border-radius: 50%" class="img-thumbnail" alt="">
            </div>

            <div class="row justify-content-center">
                <input type="file" name="ch_avatar" id="ch_avatar" class="border p-3 w-75">
            </div>
            @error('ch_avatar')
            <p style="color: #ff1111;" class="text-center" role="alert" >{{$message}}</p>
            @enderror

            <div class="row justify-content-center">
                <input type="submit" class="btn-primary p-3 m-2 w-75" value="{{__('dashboard.save')}}">
            </div>

        </form>
    </div>

    <script>

        //    image preview

        function readURL(input ,viewer) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(viewer).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('ch_avatar').onchange = function (event){
            readURL(event.target,'#preview_avatar');
        }

    </script>
@endsection
