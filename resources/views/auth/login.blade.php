@extends('auth.layouts.app')

@section('content')

@section('action'){{ route('login') }}@endsection
<div class="input-group mb-3">
    <input type="email" placeholder="{{__('main.email')}}" class="form-control fox-glass3-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
    @if(!$errors->has('email'))
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    @endif
</div>

<div class="input-group mb-3">
    <input type="password" placeholder="{{__('main.password')}}" class="form-control fox-glass3-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
    @if(!$errors->has('password'))
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-6 mb-4">
        <div class="icheck-primary ">
            <input type="checkbox" style="background: #fff;"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="incheck">
                {{__('main.remember.me')}}
            </label>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-6">
        <button type="submit" class="btn btn-primary btn-block">{{__('main.sign.in')}}</button>
    </div>
    <!-- /.col -->
</div>
{{--                <br>--}}
<button class="mb-1 btn btn-block fox-glass2-light f-glass1-cont-light">
    <a href="#">{{__('main.forgot.password')}}</a>
</button>
<a href="{{url('/newuser')}}" class="text-center mb-0 btn btn-block fox-glass2-light f-glass1-cont-light">
    {{__('main.register.new')}}
</a>



@endsection
