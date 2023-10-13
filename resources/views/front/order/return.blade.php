@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="page-title">
               <h3>{{__('front.create_new_customer_account')}}</h3>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <div class="justify-center">
      @if (session('error'))
         <div class="alert alert-danger" role="alert">
            {{ session('error') }}
         </div>
      @endif

      @if (session('success'))
         <div class="alert alert-success" role="alert">
            {{ session('success') }}
         </div>
      @endif
   </div>
</div>


<!-- page-title-wrapper-end -->
<!-- contuct-form-area-start -->
<div class="login-area ptb-80">
   <div class="container">
    <div class="container">
        <div class="row">
                <h3>Return Order Details</h3>
                <hr/>
                <div  class="col-sm-12">
                    <div class="form-group">
                        <label for="">Billing Email : </label>
                        {{$order->billing_email ?? ""}}
                    </div>
                    <div class="form-group">
                        <label for="">Name: </label>
                        {{$order->billing_name ?? ""}}
                    </div>
                    <div class="form-group">
                        <label for="">Address: </label>
                        {{$order->billing_address ?? ""}}
                    </div>
                    <div class="form-group">
                        <label for="">Phone: </label>
                        {{$order->billing_phone ?? ""}}
                    </div>
                    <div class="form-group">
                        <label for="">Tax: </label>
                        {{$order->billing_tax ?? ""}}
                    </div>
                    <div class="form-group">
                        <label for="">Total: </label>
                        {{$order->billing_total ?? ""}}
                    </div>

                    <div class="status-bar">
                        <div class="status-item ">Order Placed</div>
                        <div class="status-item @if($order->status == 'pending') active @endif">Pending</div>
                        <div class="status-item @if($order->status == 'processing') active @endif">Processing</div>
                        <div class="status-item @if($order->status == 'shiped') active @endif">Shiped</div>
                        <div class="status-item @if($order->status == 'returned') active @endif">Delivered</div>
                    </div>
                    <style>
                        .status-bar {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            background-color: #f1f1f1;
                            padding: 10px;
                            border-radius: 5px;
                        }

                        /* Styling for each status item */
                        .status-item {
                            flex: 1;
                            text-align: center;
                            font-weight: bold;
                            color: #666;
                            padding: 8px;
                        }

                        /* Styling for the active status item */
                        .status-item.active {
                            color: #007bff; /* Change this to your preferred active color */
                            border-bottom: 3px solid #007bff; /* Change this to your preferred active color */
                        }
                    </style>
                </div>
                <div class="clearfix"></div>
        </div>
        <!-- /container -->
    </div>
   </div>
</div>
<div id="snackbar">{{__('front.item_removed_successfully')}}</div>
<div id="snackbarAddress">{{__('front.address_added_successfully')}}</div>
<div id="snackbarAccount">{{__('front.account_updated_successfully')}}</div>
<div id="snackbarAccountPass">{{__('front.password_updated_successfully')}}</div>
<!-- contuct-form-area-end -->
@endsection
@section('js_custom')
<script>
   function removeFromWishlist(key){
     $.post('{{ route('home.removeFromWishlist') }}',{_token:'{{ csrf_token() }}', id:key})
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
 }
</script>
<script>
	function addAddress(address){
      let adrs = document.getElementById('address').value;
      var adrserr = document.getElementById("adrsErr");
      if(adrs == ""){
         adrserr.classList.remove("hidden");
         adrserr.innerHTML = "Please Enter Address."
         return false;
      }
     $.post('{{ route('home.storeCusAddress') }}',{_token:'{{ csrf_token() }}',address:address})
     var x = document.getElementById("snackbarAddress");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

   function updateUserAcc(){
      var x = document.getElementById("snackbarAccount");
      let name = document.getElementById('name').value;
      let email = document.getElementById('email').value;
		let EmailRegex = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
      var emailerr = document.getElementById("emailErr");
      if(name == ""){
         document.getElementById("nameErr").classList.remove("hidden");
         return false;
      }

      if(email == ""){
         emailerr.classList.remove("hidden");
         emailerr.innerHTML = "Please Enter Email."
         return false;
      }

      if (!email.match(EmailRegex)) {
         emailerr.classList.remove("hidden");
         emailerr.innerHTML = "Please enter Valid Email."
         return false;
      }

     $.post('{{ route('home.updateUserAccount') }}',{_token:'{{ csrf_token() }}', name:name, email:email})
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

   function updateUserPassword(){
      let newpass = document.getElementById('new_password').value;
      let conpass = document.getElementById('confirm_password').value;
      var passerr = document.getElementById("passErr");
      var cobfpasserr = document.getElementById("confPassErr");
      if(newpass == ""){
         passerr.classList.remove("hidden");
         passerr.innerHTML = "Password can't be Empty."
         return false;
      }
      if(conpass == ""){
         cobfpasserr.classList.remove("hidden");
         cobfpasserr.innerHTML = "Confirm Password can't be Empty."
         return false;
      }
      if(newpass != conpass){
         passerr.classList.remove("hidden");
         passerr.innerHTML = "New password and Confirm password dosen't match."
         document.getElementById('new_password').value = "";
         document.getElementById('confirm_password').value = "";
         return false;
      }
     $.post('{{ route('home.updateUserPassword') }}', {_token:'{{ csrf_token() }}',  new_password:newpass, confirm_password:conpass})
     var x = document.getElementById("snackbarAccountPass");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

   function nameValidErrorRemove(){
      var nameerr = document.getElementById("nameErr");
      nameerr.classList.add("hidden");
   }

   function emailValidErrorRemove(){
      var emailerr = document.getElementById("emailErr");
      emailerr.classList.add("hidden");
   }

   function passwordValidErrorRemove(){
      var passerr = document.getElementById("passErr");
      passerr.classList.add("hidden");
   }
   
   function confPasswordValidErrorRemove(){
      var confpasserr = document.getElementById("confPassErr");
      confpasserr.classList.add("hidden");
   }

   function addressValidErrorRemove(){
      var adrserr = document.getElementById("adrsErr");
      adrserr.classList.add("hidden");
   }

   $(".nav-tabs").on("click", 'li', function() {
      const id = $(this).find('a').attr('href')
      $(".tab-pane").removeClass('active');
      $(id).addClass('active')
   })
</script>
@endsection

