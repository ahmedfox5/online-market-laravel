@extends('layouts.app')

@section('content')

    <br>
    <?php
        $user = auth()->user();
    ?>
    <div class="account-settings-cont">
        <ul class="settings-items">
            <li class="row justify-content-center setting-item">
                <div class="col-9 m-2 p-3 border">{{__('main.user.image')}} :
                    <img src="{{asset('img/users/' . $user->img_name)}}" style="width: 80px;height: 80px; margin: 0 20px;border-radius: 50%" alt="">
                </div>
                <a href="{{route('user.img')}}" class="col-1 m-2 p-3 border text-center edit"><i class="fa fa-pen"></i></a>
            </li>

            <li class="row justify-content-center setting-item">
                <div class="col-9 m-2 p-3 border">{{__('main.first.name')}} : {{$user->first_name}}</div>
                <a href="#" class="col-1 m-2 p-3 border text-center edit"><i class="fa fa-pen"></i></a>
            </li>

            <li class="row justify-content-center setting-item">
                <div class="col-9 m-2 p-3 border">{{__('main.last.name')}} : {{$user->last_name}}</div>
                <a href="#" class="col-1 m-2 p-3 border text-center edit"><i class="fa fa-pen"></i></a>
            </li>

            <li class="row justify-content-center setting-item">
                <div class="col-9 m-2 p-3 border">{{__('main.password')}}</div>
                <a href="{{route('account.password')}}" class="col-1 m-2 p-3 border text-center edit"><i class="fa fa-pen"></i></a>
            </li>
        </ul>
    </div>

@endsection
