@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="page-title">
               <h3>@lang('front.create_new_customer_account')</h3>
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
         <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <div class="login-title">
               <h3>@lang('front.create_new_user_account')</h3>
            </div>
            <div class="login-form">
               <form>
                  <div class="form-group login-page">
                     <label for="exampleInputName1">@lang('front.first_name') <span>*</span></label>
                     <input type="text" class="form-control" id="exampleInputName1">
                  </div>
                  <div class="form-group login-page">
                     <label for="exampleInputName2">@lang('front.last_name') <span>*</span></label>
                     <input type="email" class="form-control" id="exampleInputName2">
                  </div>
                  <div class="form-group login-page">
                     <label for="exampleInputEmail1">@lang('front.email') <span>*</span></label>
                     <input type="text" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group login-page">
                     <label for="exampleInputPassword1">@lang('front.password') <span>*</span></label>
                     <input type="Password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group login-page">
                     <label for="exampleInputPassword2">@lang('front.confirm_password') <span>*</span></label>
                     <input type="Password" class="form-control" id="exampleInputPassword2">
                  </div>
                  <button type="submit" class="btn btn-default login-btn">@lang('front.create_an_account')</button>
               </form>
            </div>
            <a href="#" class="back">@lang('front.back')</a>
         </div>
      </div>
   </div>
</div>
<!-- contuct-form-area-end -->
@endsection
