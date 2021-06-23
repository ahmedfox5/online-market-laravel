@extends('layouts.app')

@section('content')

    <h3 class="m-3 text-center" >{{__('main.change.password')}}</h3>
    <form class="p-2 m-auto w-50 border" action="{{route('user.password.update')}}" method="post">
        @csrf
        <div class="row justify-content-center m-3 align-items-center">
            <label for="old_password" class="row w-100" >{{__('main.old.password')}}</label>
            <input type="password" name="old_password" id="old_password" class="border w-50 p-2 m-2 w-100">
            @error('old_password')
                <p style="color: #ff1111;" class="text-center" role="alert" >{{$message}}</p>
            @enderror
        </div>

        <div class="row justify-content-center m-3 align-items-center">
            <label for="old_password" class="row w-100" >{{__('main.new.password')}}</label>
            <input type="password" name="new_password" id="old_password" class="border w-50 p-2 m-2 w-100">
            @error('new_password')
                <p style="color: #ff1111;" class="text-center" role="alert" >{{$message}}</p>
            @enderror
        </div>

        <div class="row justify-content-center m-3 align-items-center">
            <input type="submit" id="old_password" class="btn-primary w-50 p-2 m-2 w-100">
        </div>
    </form>

@endsection
