@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-title">
                    <h3>@lang('front.registered_customers')</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title-wrapper-end -->
<!-- contuct-form-area-start -->
<div class="login-area ptb-80">
    <div class="container">
        <div class="row">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="login-title">
                    <h3>@lang('front.registered_customers')</h3>
                    <span>@lang('front.if_you_have_an_account_sign_in_with_your_email_address')</span>
                </div>
                <div class="login-form">
                    <form action="{{ url('/register') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="">
                            <p>@lang('front.name')</p>
                            <input value="{{ old('name') }}" type="name"
                                class="form-control {{ isset($errors) && $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name" placeholder="{{__('auth.name')}}" aria-label="{{__('auth.name')}}" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('name'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <p>@lang('front.email')</p>
                            <input value="{{ old('email') }}" type="email"
                                class="form-control {{ isset($errors) && $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" type="email" placeholder="{{__('auth.email')}}" aria-label="{{__('auth.email')}}"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('email'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <p>@lang('front.password')</p>
                            <input value="{{ old('password') }}" type="password"
                                class="form-control  {{ isset($errors) && $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" placeholder="{{__('auth.password')}}"
                                aria-label="{{__('auth.password')}}" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('password'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <p>@lang('front.confirm_password')</p>
                            <input value="{{ old('password_confirmation') }}" type="password"
                                class="form-control  {{ isset($errors) && $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                name="password_confirmation" placeholder="{{__('auth.password_confirmation')}}"
                                aria-label="{{__('auth.password_confirmation')}}" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('password_confirmation'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <p>@lang('front.select_account_type')</p>
                            <select class="form-control" name="account_type" required>
                                <option value="customer" @if (old('account_type')=="customer" ) selected="selected"
                                    @endif>@lang('front.customer')</option>
                                <option value="salon_owner" @if (old('account_type')=="salon_owner" )
                                    selected="selected" @endif>@lang('front.salon_owner')</option>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('account_type'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('account_type') }}
                            </div>
                            @endif
                        </div>


                        <div class="">
                            <p>@lang('front.address')</p>
                            <input value="{{ old('address') }}" type="text"
                                class="form-control {{ isset($errors) && $errors->has('address') ? ' is-invalid' : '' }}"
                                name="address" placeholder="{{__('front.address')}}" aria-label="{{__('auth.address')}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('address'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('address') }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="">
                            <p>@lang('front.phone')</p>
                            <input value="{{ old('phone') }}" type="text"
                                class="form-control {{ isset($errors) && $errors->has('phone') ? ' is-invalid' : '' }}"
                                name="phone_number" placeholder="{{__('front.phone')}}" aria-label="{{__('auth.phone')}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            @if (isset($errors) && $errors->has('phone'))
                            <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>
                        


                        <div class="mb-2">
                            <div class="col-8">
                                <div class="icheck-{{setting(" theme_color","primary")}}">
                                    <input type="checkbox" id="remember" name="remember" required> <label
                                        for="remember">
                                        {{__('auth.agree')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <!-- /.col -->
                            <div class="row col-sm-6" style="margin-bottom: 30px;margin-top:20px;">
                                <button type="submit" class="btn btn-default login-btn">{{__('auth.register')}}</button>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6" style="margin-bottom: 30px;margin-top:25px;">
                                <p class="mb-1 text-center">
                                    <a href="{{ url('/front/login') }}">{{__('auth.already_member')}}</a>
                                </p>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contuct-form-area-end -->
    @endsection
    