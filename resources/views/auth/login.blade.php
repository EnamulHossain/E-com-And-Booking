@extends('layouts.auth.default')
@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{__('auth.login_title')}}</p>
        <form action="{{ url('/login') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input value="{{ old('email') }}" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('auth.email') }}" aria-label="{{ __('auth.email') }}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="input-group mb-3">
                <input value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('auth.password')}}" aria-label="{{__('auth.password')}}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="row mb-2">
                <div class="col-8">
                    <div class="icheck-{{setting("theme_color","primary")}}">
                        <input type="checkbox" id="remember" name="remember"> <label for="remember">
                            {{__('auth.remember_me')}}
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-{{setting("theme_color","primary")}} btn-block">{{__('auth.login')}}</button>
                </div>
            </div>
        </form>
        <p class="mb-1 text-center">
            <a href="{{ url('/password/reset') }}">{{__('auth.forgot_password')}}</a>
        </p>
        <p class="mb-0 text-center">
            <a href="{{ url('/register') }}" class="text-center">{{__('auth.register_new_member')}}</a>
        </p>
    </div>
@endsection
