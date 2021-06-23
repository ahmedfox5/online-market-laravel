@extends('auth.layouts.app')

@section('content')


    @section('action'){{ route('registerNew') }}@endsection


<div class="input-group mb-3">
    <input type="text" placeholder="{{__('main.first.name')}}" class="form-control fox-glass3-light @error('first_name') is-invalid @enderror" name="first_name"  autofocus>
    @error('first_name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="input-group mb-3">
    <input type="text" placeholder="{{__('main.last.name')}}" class="form-control fox-glass3-light @error('last_name') is-invalid @enderror" name="last_name">
    @error('last_name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="input-group mb-3">
    <input type="email" placeholder="{{__('main.email')}}" class="form-control fox-glass3-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
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
    <input type="password" placeholder="{{__('main.password')}}" class="form-control fox-glass3-light @error('password') is-invalid @enderror" name="password" >
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
    <div class=" mb-4">
        <div class="icheck-primary ">
            <input type="checkbox" class="ml-2" style="background: #fff;"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label  class="incheck font-weight-light">
                <a href="#" style="text-decoration: underline">{{__('main.agree')}}</a>
            </label>
        </div>
    </div>
    <script>
        document.getElementById('remember').onclick = function (){
            if(!this.checked){
                document.querySelector('.register').setAttribute('disabled','disabled');
            }else {
                document.querySelector('.register').removeAttribute('disabled');
            }
        }
    </script>
    <!-- /.col -->
    <div class="col-12">
        <button type="submit" disabled class="btn btn-primary register btn-block">{{__('main.register')}}</button>
    </div>

    <a href="{{url('/login')}}" class="text-center btn-block  m-2 mb-0 mb-0 btn btn-block fox-glass2-light f-glass1-cont-light ">
        {{__('main.already.ha.account')}}
    </a>
    <!-- /.col -->
</div>


@endsection


