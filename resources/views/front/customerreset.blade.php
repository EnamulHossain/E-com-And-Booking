@extends('front.layouts.base')
@section('content')
<!-- contuct-form-area-start -->
<div class="page-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-title">
                    <h3>@lang('front.reset_password')</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
    <div class="row">
        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="login-title" style="padding-left:15px;">
                <h3>@lang('front.email_to_reset_password')</h3>
            </div>
            <div class="login-form">
                <form method="post" action="{{ url('password/email') }}">
                    {!! csrf_field() !!}
                    <div class="col-sm-12">
                        <input value="{{ old('email') }}" type="email"
                            class="form-control {{ isset($errors) && $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" placeholder="{{__('auth.email')}}" aria-label="{{__('auth.email')}}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        @if (isset($errors) && $errors->has('email'))
                        <div class="invalid-feedback" style="margin-bottom:20px;color:#ff0000;">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <!-- /.col -->
                        <div class="col-9 m-auto text-left">
                            <button type="submit"
                                class="btn btn-default login-btn">{{__('auth.send_password')}}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="col-sm-8">
                        <!-- /.col -->
                        <div class="col-9 m-auto text-right" style="margin-top: 10px;">
                            <p class="mb-0">
                                <a href="{{ url('/front/login') }}" class="">{{__('auth.remember_password')}}</a>
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
