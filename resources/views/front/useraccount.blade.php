@extends('front.layouts.base')
@section('content')
<style>
   .rating {
       display: flex;
       align-items: center;
       margin-bottom: 10px;
   }

   .star {
       font-size: 24px;
       cursor: pointer;
   }

   /* Highlight the selected stars */
   .star.active {
       color: gold;
   }

   /* The modal background */
   .modal {
       display: none;
       position: fixed;
       z-index: 9999;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       overflow: auto;
       background-color: rgba(0, 0, 0, 0.5);
       /* Semi-transparent background */
   }

   /* Modal content */
   .modal-content {
       background-color: #fefefe;
       margin: 15% auto;
       padding: 20px;
       border-radius: 5px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       max-width: 400px;
   }

   /* Close button */
   .close {
       float: right;
       font-size: 20px;
       font-weight: bold;
       cursor: pointer;
   }

   .close:hover {
       color: #aaa;
   }

   /* Form styles */
   #reviewForm label,
   #reviewForm input,
   #reviewForm textarea,
   #reviewForm button {
       display: block;
       width: 100%;
       margin-bottom: 10px;
       padding: 5px;
       font-size: 16px;
       border-radius: 4px;
   }

   #reviewForm textarea {
       height: 100px;
   }

   #reviewForm button {
       background-color: #4CAF50;
       color: white;
       border: none;
       cursor: pointer;
   }

   #reviewForm button:hover {
       background-color: #45a049;
   }

   /* Center the modal content horizontally */
   @media screen and (max-width: 600px) {
       .modal-content {
           margin-left: 10px;
           margin-right: 10px;
       }
   }
</style>
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
                <div class="col-sm-12">
                    <h3>@lang('front.edit_profile')</h3>
                    <hr />
                    <div class="col-sm-3">
                        <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active"><a href="#profile" data-toggle="tab">@lang('front.profile')</a></li>
                            <li><a href="#chnage_passwrd" data-toggle="tab">@lang('front.change_password')</a></li>
                            <li><a href="#deliveryaddress" data-toggle="tab">@lang('front.delivery_address')</a></li>
                            <li><a href="#reentorders" data-toggle="tab">@lang('front.recent_orders')</a></li>
                            <li><a href="#returnorders" data-toggle="tab">@lang('front.return_orders')</a></li>
                            <li><a href="#booking" data-toggle="tab">@lang('front.booking')</a></li>
                            <li><a href="#wishlist" data-toggle="tab">@lang('front.wishlist')</a></li>
                            <li><a href="#toreview" data-toggle="tab">Review</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="login-form">
                                    <form>
                                        <div class="form-group login-page">
                                            <label for="">@lang('fullname') <span>*</span></label>
                                            <input oninput="nameValidErrorRemove();" type="text" required
                                                class="form-control" name="name" id="name"
                                                value="{!! auth()->user()->name !!}">
                                            <p id="nameErr" style="color:red;" class="hidden">@lang('front.please_enter_name').</p>
                                        </div>
                                        {{-- <div class="form-group login-page">
                              <label for="">Last Name <span>*</span></label>
                              <input type="email" class="form-control" id="">
                           </div> --}}
                                        <!--<div class="form-group">
                                          <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> Sign Up for Newsletter
                                          </label>
                                          </div>
                                          </div>
                                          <div class="login-title">
                                          <h3>Sign-in Information</h3>
                                          </div>-->
                                        <div class="form-group login-page">
                                            <label for="">@lang('front.email') <span>*</span></label>
                                            <input oninput="emailValidErrorRemove();" type="email" required
                                                class="form-control" name="email" id="email"
                                                value="{!! auth()->user()->email !!}">
                                            <p id="emailErr" style="color:red;" class="hidden"></p>
                                        </div>
                                        <a onclick="updateUserAcc()"
                                            class="btn btn-default login-btn">@lang('front.submit')</a>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="chnage_passwrd">
                                <form>
                                    {{-- <div class="form-group login-page">
                           <label for="">Old Password<span>*</span></label>
                           <input type="password" class="form-control" id="">
                        </div> --}}
                                    <div class="form-group login-page">
                                        <label for="">@lang('front.new_password')<span>*</span></label>
                                        <input oninput="passwordValidErrorRemove();" type="password" class="form-control"
                                            id="new_password" name="new_password" value="">
                                        <p id="passErr" style="color:red;" class="hidden"></p>
                                    </div>
                                    <div class="form-group login-page">
                                        <label for="">@lang('front.confirm_password')<span>*</span></label>
                                        <input oninput="confPasswordValidErrorRemove();" type="password"
                                            class="form-control" id="confirm_password" name="confirm_password">
                                        <p id="confPassErr" style="color:red;" class="hidden"></p>
                                    </div>
                                    <a onclick="updateUserPassword()"
                                        class="btn btn-default login-btn">@lang('front.submit')</a>
                                </form>
                            </div>
                            <div class="tab-pane" id="booking">
                                <div class="wishlist-table table-responsive">
                                    <div class="wishlist-title">
                                        <h2>@lang('front.my_booking')</h2>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="">@lang('front.id')</th>
                                                <th class="product-name"><span class="nobr">@lang('front.booking_date')</span></th>
                                                <th class="product-name"><span class="nobr">Saloon</span>
                                                </th>
                                                <th class="product-name"><span class="nobr">@lang('front.service_name')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.total_price')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.booking_status')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.saloon_address')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr"> @lang('front.action') </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @foreach ($bookings as $key => $booking)
                                            <tbody>
                                                <tr>
                                                    <td><span>{{ $key + 1 }}</span></td>
                                                    <td>
                                                        <span>{{ $booking->booking_at->format('Y-m-d i:s a') }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $booking->salon->name ?? '' }}</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @foreach ($booking->e_services as $e_service)
                                                                {{ $e_service['name'] }}
                                                            @endforeach
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @foreach ($booking->e_services as $e_service)
                                                                {!! getPrice($e_service['price']) !!}
                                                            @endforeach
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge">{{ $booking->bookingStatus->status ?? '' }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $booking->address->address ?? '' }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('booking.show', $booking->id) }}"
                                                            class="btn btn-default login-btn">@lang('front.view_details')</a>
                                                            <a href="{{ route('booking.show', $booking->id) }}"
                                                            class="btn btn-default login-btn">Review</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="wishlist">
                                <div class="wishlist-title">
                                    <h2>@lang('front.my_wishlist')</h2>
                                </div>
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">@lang('front.remove')</span>
                                                </th>
                                                <th class="product-thumbnail">@lang('front.image')</th>
                                                <th class="product-name"><span class="nobr">@lang('front.product_name')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.unit_price')</span>
                                                </th>
                                                <th class="product-stock-stauts"><span
                                                        class="nobr">@lang('front.stock_status')</span></th>
                                                <th class="product-add-to-cart"><span
                                                        class="nobr">@lang('front.add_to_cart')</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wishlist as $wsl)
                                                <tr>
                                                    <td class="product-remove"><a
                                                            onclick="removeFromWishlist({{ $wsl['id'] }})">x</a></td>
                                                    <td class="product-thumbnail"><a href="#"><img
                                                                src="img/wishlist/1.jpg" alt="" /></a></td>
                                                    <td class="product-name"><a
                                                            href="#">{{ $wsl->product ? $wsl->product->name : '' }}</a>
                                                    </td>
                                                    <td class="product-price"><span class="amount">
                                                            {!! getPrice($wsl->product ? $wsl->product->price : 0) !!}</span></td>
                                                    <td class="product-stock-status"><span class="wishlist-in-stock">In
                                                            Stock</span></td>
                                                    <td class="product-add-to-cart"><a
                                                            href="{!! route('home.cart') !!}" onclick="addToCart({{$wsl->product->id}})">@lang('front.add_to_cart')</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="wishlist-share">
                                                        <h4 class="wishlist-share-title">@lang('front.share_on'):</h4>
                                                        <ul>
                                                            <li><a class="facebook" href="#"></a></li>
                                                            <li><a class="twitter" href="#"></a></li>
                                                            <li><a class="pinterest" href="#"></a></li>
                                                            <li><a class="googleplus" href="#"></a></li>
                                                            <li><a class="email" href="#"></a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="toreview">
                                <div class="toreview-title">
                                    <h2>Product Review</h2>
                                </div>
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">ID</span>
                                                </th>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-name"><span class="nobr">Total Price</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">Unit Price</span>
                                                </th>
                                                <th class="product-stock-stauts"><span
                                                        class="nobr">Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $ordr)
                                            @php
                                                    $total = \App\Models\OrderProduct::where('order_id', $ordr->id)
                                                        ->get()
                                                        ->count();
                                                @endphp
                                        <tbody>
                                            @if ($ordr->status == 'received')
                                            <tr>
                                                <td class="product-price"><span>{{ $ordr->id }}</span></td>
                                                <td class="product-name"><span>{{ $ordr->created_at }}</span></td>
                                                <td class="product-name"><span>{!! getPrice($total) !!}</span></td>
                                                <td class="product-price"><span
                                                        class="amount">{!! getPrice($ordr->billing_total) !!}</span></td>
                                                <td class="product-price"><span class="amount">{{ $ordr->status }}</span>
                                                </td>
                                                <td class="product-price"><a href="#"
                                                        class="btn btn-default login-btn"
                                                        onclick="document.getElementById('reviewModal').style.display='block';">Review</a>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="wishlist-share">
                                                        <h4 class="wishlist-share-title">@lang('front.share_on'):</h4>
                                                        <ul>
                                                            <li><a class="facebook" href="#"></a></li>
                                                            <li><a class="twitter" href="#"></a></li>
                                                            <li><a class="pinterest" href="#"></a></li>
                                                            <li><a class="googleplus" href="#"></a></li>
                                                            <li><a class="email" href="#"></a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>



                            <!-- Modal -->
                            <div id="reviewModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <form id="reviewForm" action="{{route('home.review')}}"  method="POST">
                                        @csrf
                                        <div class="rating">
                                            <label for="rate">Rate:</label>
                                            <span class="star" onclick="setRating(1)">&#9733;</span>
                                            <span class="star" onclick="setRating(2)">&#9733;</span>
                                            <span class="star" onclick="setRating(3)">&#9733;</span>
                                            <span class="star" onclick="setRating(4)">&#9733;</span>
                                            <span class="star" onclick="setRating(5)">&#9733;</span>
                                            <input type="hidden" id="rate" name="rate" value="0" required>
                                        </div>
                                        <label for="review">Review:</label>
                                        <textarea id="review" name="review" required></textarea>
                                        <input type="hidden" name="order_id" value="{{ $ordr->id }}">
                                        <input type="hidden" name="product_id" value="{{ $ordr->id }}">
                                        <button  type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="deliveryaddress">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4 class="profile_addresstab">@lang('front.choose_address')</h4>
                                    @foreach ($address as $adrs)
                                        <div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                                    value="option1"> {{ $adrs->address }} 
                                                    <a href="{{ route('address.destroy', ['id' => $adrs->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <h4 class="profile_addresstab">@lang('front.enter_new_address_here')</h4>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>@lang('front.address')<span class="required">*</span></label>
                                            <input oninput="addressValidErrorRemove();" type="text" name="address"
                                                id="address" placeholder="Street address" />
                                            <p id="adrsErr" style="color:red;" class="hidden"></p>
                                        </div>
                                        <a onclick="addAddress(address.value)"
                                            class="btn btn-default login-btn">@lang('front.submit')</a>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="reentorders">
                                <div class="wishlist-table table-responsive">
                                    <div class="wishlist-title">
                                        <h2>@lang('front.my_orders')</h2>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">@lang('front.order_id')</th>
                                                <th class="product-name"><span class="nobr">@lang('front.order_date')</span>
                                                </th>
                                                <th class="product-name"><span class="nobr">@lang('front.total_product')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.total_price')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.order_status')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.action')</span>
                                                </th>

                                            </tr>
                                        </thead>
                                        @foreach ($order as $ordr)
                                            @php
                                                $total = \App\Models\OrderProduct::where('order_id', $ordr->id)
                                                    ->get()
                                                    ->count();
                                            @endphp
                                            <tbody>
                                                <tr>
                                                    <td class="product-price"><span>{{ $ordr->id }}</span></td>
                                                    <td class="product-name"><span>{{ $ordr->created_at }}</span></td>
                                                    <td class="product-name"><span>{!! getPrice($total) !!}</span></td>
                                                    <td class="product-price"><span class="amount">{!! getPrice($ordr->billing_total) !!}</span></td>
                                                    <td class="product-price"><span class="amount">{{ $ordr->status }}</span></td>
                                                        <td class="product-price">
                                                            <div style="display: flex; gap: 10px;">
                                                                    <a href="{{ route('order.show', $ordr->id) }}" class="btn btn-default login-btn">@lang('front.view_details')</a>
                                                                    @if ($ordr->status == "received")
                                                                        @if (now()->diffInDays($ordr->created_at) <= 10)
                                                                            <a href="{{ route('order.return', $ordr->id) }}" class="btn btn-default login-btn">Return</a>
                                                                        @endif
                                                                    @elseif ($ordr->status == "pending")
                                                                    <a href="{{ route('order.return', $ordr->id) }}" class="btn btn-default login-btn">Cancel</a>
                                                                    @endif
                                                            </div>
                                                        </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="returnorders">
                                <div class="wishlist-table table-responsive">
                                    <div class="wishlist-title">
                                        <h2>@lang('front.return_orders')</h2>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">@lang('front.order_id')</th>
                                                <th class="product-name"><span class="nobr">@lang('front.order_date')</span>
                                                </th>
                                                <th class="product-name"><span class="nobr">@lang('front.total_product')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.total_price')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.order_status')</span>
                                                </th>
                                                <th class="product-price"><span class="nobr">@lang('front.action')</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @foreach ($returnOrder as $rtordr)
                                            @php
                                                $total = \App\Models\OrderProduct::where('order_id', $rtordr->id)
                                                    ->get()
                                                    ->count();
                                            @endphp
                                            <tbody>
                                                <tr>
                                                    <td class="product-price"><span>{{ $rtordr->id }}</span></td>
                                                    <td class="product-name"><span>{{ $rtordr->created_at }}</span></td>
                                                    <td class="product-name"><span>{!! getPrice($total) !!}</span></td>
                                                    <td class="product-price"><span
                                                            class="amount">{!! getPrice($rtordr->billing_total) !!}</span></td>
                                                    <td class="product-price"><span
                                                            class="amount">{{ $rtordr->status }}</span></td>
                                                    <td class="product-price"><a href="{{ route('order.returnshow', $rtordr->id) }}"
                                                            class="btn btn-default login-btn">View Details</a></td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /container -->
        </div>
    </div>
    <div id="snackbar">@lang('front.item_removed_successfully')</div>
    <div id="snackbar">@lang('front.address_added_successfully')</div>
    <div id="snackbar">@lang('front.account_updated_successfully')</div>
    <div id="snackbar">@lang('front.password_updated_successfully')</div>
    <!-- contuct-form-area-end -->
@endsection
@section('js_custom')
    <script>
        function removeFromWishlist(key) {
            $.post('{{ route('home.removeFromWishlist') }}', {
                _token: '{{ csrf_token() }}',
                id: key
            })
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
    <script>
        function addAddress(address) {
            let adrs = document.getElementById('address').value;
            var adrserr = document.getElementById("adrsErr");
            if (adrs == "") {
                adrserr.classList.remove("hidden");
                adrserr.innerHTML = "Please Enter Address."
                return false;
            }
            $.post('{{ route('home.storeCusAddress') }}', {
                _token: '{{ csrf_token() }}',
                address: address
            })
            var x = document.getElementById("snackbarAddress");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        function updateUserAcc() {
            var x = document.getElementById("snackbarAccount");
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let EmailRegex = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
            var emailerr = document.getElementById("emailErr");
            if (name == "") {
                document.getElementById("nameErr").classList.remove("hidden");
                return false;
            }

            if (email == "") {
                emailerr.classList.remove("hidden");
                emailerr.innerHTML = "Please Enter Email."
                return false;
            }

            if (!email.match(EmailRegex)) {
                emailerr.classList.remove("hidden");
                emailerr.innerHTML = "Please enter Valid Email."
                return false;
            }

            $.post('{{ route('home.updateUserAccount') }}', {
                _token: '{{ csrf_token() }}',
                name: name,
                email: email
            })
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        function updateUserPassword() {
            let newpass = document.getElementById('new_password').value;
            let conpass = document.getElementById('confirm_password').value;
            var passerr = document.getElementById("passErr");
            var cobfpasserr = document.getElementById("confPassErr");
            if (newpass == "") {
                passerr.classList.remove("hidden");
                passerr.innerHTML = "Password can't be Empty."
                return false;
            }
            if (conpass == "") {
                cobfpasserr.classList.remove("hidden");
                cobfpasserr.innerHTML = "Confirm Password can't be Empty."
                return false;
            }
            if (newpass != conpass) {
                passerr.classList.remove("hidden");
                passerr.innerHTML = "New password and Confirm password dosen't match."
                document.getElementById('new_password').value = "";
                document.getElementById('confirm_password').value = "";
                return false;
            }
            $.post('{{ route('home.updateUserPassword') }}', {
                _token: '{{ csrf_token() }}',
                new_password: newpass,
                confirm_password: conpass
            })
            var x = document.getElementById("snackbarAccountPass");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        function nameValidErrorRemove() {
            var nameerr = document.getElementById("nameErr");
            nameerr.classList.add("hidden");
        }

        function emailValidErrorRemove() {
            var emailerr = document.getElementById("emailErr");
            emailerr.classList.add("hidden");
        }

        function passwordValidErrorRemove() {
            var passerr = document.getElementById("passErr");
            passerr.classList.add("hidden");
        }

        function confPasswordValidErrorRemove() {
            var confpasserr = document.getElementById("confPassErr");
            confpasserr.classList.add("hidden");
        }

        function addressValidErrorRemove() {
            var adrserr = document.getElementById("adrsErr");
            adrserr.classList.add("hidden");
        }

        $(".nav-tabs").on("click", 'li', function() {
            const id = $(this).find('a').attr('href')
            $(".tab-pane").removeClass('active');
            $(id).addClass('active')
        })
        
        function addToCart(id) {
       @if(Auth::check())
       var quantityInput = document.getElementById("french-hens");
       var quantity = 0;
       if (quantityInput) {
           // Get the value of the input field using .value, not .val
           quantity = quantityInput.value;
       }

       // Use the proper route for the AJAX call, assuming 'home.storecart' is the correct route
       $.post('{{ route('home.storecart') }}', {
           _token: '{{ csrf_token() }}',
           id: id,
           quantity: quantity
       }, function (results) {
           dynamicCart(results);
       });
       
       var x = document.getElementById("snackbarCart");
       x.className = "show";
       setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
       @else
       var x = document.getElementById("mustlogin");
       x.className = "show";
       setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
       @endif
   }
    
    let ratingValue = 0;
 
    function setRating(value) {
        ratingValue = value;
 
        const stars = document.querySelectorAll('.star');
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
 
        document.getElementById('rate').value = ratingValue;
    }
 
    function openModal() {
        // Clear the star rating when the modal is opened
        setRating(0);
        document.getElementById('reviewModal').style.display = 'block';
    }
 
    function openModal() {
        document.getElementById('reviewModal').style.display = 'block';
    }
 
    function closeModal() {
        document.getElementById('reviewModal').style.display = 'none';
    } 
 </script>
@endsection
