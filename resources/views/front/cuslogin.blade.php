@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
               <h3>@lang('front.customer_login')</h3>
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
               <form action="{{ url('/login') }}" method="post">
                  {!! csrf_field() !!}
                  <div class="">
                     <input value="{{ old('email') }}" type="email"
                        class="form-control {{ isset($errors) && $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" placeholder="{{ __('auth.email') }}" aria-label="{{ __('auth.email') }}">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                     </div>
                     @if (isset($errors) && $errors->has('email'))
                     <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                     </div>
                     @endif
                  </div>
                  <div class="">
                     <input value="{{ old('password') }}" type="password"
                        class="form-control  {{ isset($errors) && $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" placeholder="{{__('auth.password')}}" aria-label="{{__('auth.password')}}">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                     </div>
                     @if (isset($errors) && $errors->has('password'))
                     <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                     </div>
                     @endif
                  </div>
                  <div class="mb-2">
                     <div class="col-8">
                        <div class="icheck-{{setting(" theme_color","primary")}}">
                           <input type="checkbox" id="remember" name="remember"> <label for="remember">
                              {{__('auth.remember_me')}}
                           </label>
                        </div>
                     </div>
                     <div class="col-4">
                        <button type="submit" class="btn btn-default login-btn">{{__('auth.login')}}</button>
                     </div>
                  </div>
               </form>
            </div>
            <a href="{{ url('/front/password/reset') }}" class="back">@lang('front.forgot_your_password')</a>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="login-title">
               <h3>@lang('front.new_customers')</h3>
               <span>@lang('front.new_customers_details')</span>
            </div>
            <a href="{{ url('/front/regestration') }}" class="btn btn-default login-btn"
               style="margin-top:20px;margin-bottom: 20px;">@lang('front.create_an_account')</a>
         </div>
      </div>
   </div>
</div>
<!-- contuct-form-area-end -->
@endsection
