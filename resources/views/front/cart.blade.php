@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
               <h3>@lang('front.cart')</h3>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- page-title-wrapper-end -->
<!-- entry-header-area start -->
<div class="entry-header-area pt-40">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="entry-header">
               <h1 class="entry-title">@lang('front.cart')</h1>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- entry-header-area end -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb-40">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="#">
               <div class="table-content table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th class="product-thumbnail">@lang('front.image')</th>
                           <th class="product-name">@lang('front.product')</th>
                           <th class="product-price">@lang('front.price')</th>
                           <th class="product-quantity">@lang('front.quantity')</th>
                           <th class="product-subtotal">@lang('front.total')</th>
                           <th class="product-remove">@lang('front.remove')</th>
                        </tr>
                     </thead>
                     @php
                     $total = 0;
                     @endphp
                     <tbody>
                        @foreach ($carts as $prd)
                        @php
                        $total = $total + ($prd['new_price']) * $prd['quantity'];
                        @endphp
                        <tr>
                           <td class="product-thumbnail"><a href="#"><img src="{!! url($prd->product->getFirstMediaUrl('image')) !!}" alt="" /></a></td>
                           <td class="product-name"><a href="#">{{$prd->product->name}}</a></td>

                           <td class="product-price">
                              <span class="amount">{!! getPriceColumn($prd, 'new_price') !!}</span>
                           </td>

                           <td class="product-quantity"><span>{{$prd->quantity}}</span></td>
                           <td class="product-subtotal">
                              {!! getPrice($prd->quantity * $prd->new_price) !!}</td>
                           <td class="product-remove"><a onclick="removeFromCarT({{ $prd['id'] }})"><i
                                    class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                     <div class="buttons-cart">
                        {{-- <input type="submit" value="@lang('front.update_cart')" /> --}}
                        <a href="{{route('home.cart')}}">@lang('front.update_cart')</a>
                        <a href="{{route('home.shop')}}">@lang('front.continue_shopping')</a>
                     </div>
                     <div class="coupon">
                        <h3>@lang('front.coupon')</h3>
                        <p id="coupon">@lang('front.enter_your_coupon_code_if_you_have_one')</p>
                        <input type="text" placeholder="@lang('front.coupon_code')" />
                        <input type="submit" onclick="coupon()" value="@lang('front.apply_coupon')" />
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                     <div class="cart_totals">
                        <h2>@lang('front.cart_totals')</h2>
                        <table>
                           <tbody>
                              <tr class="cart-subtotal">
                                 <th>@lang('front.subtotal')</th>
                                 <td><span class="amount">{!! getPrice($total) !!}</span></td>
                              </tr>
                              <tr class="shipping">
                                 <th>@lang('front.shipping')</th>
                                 <td>
                                    <ul id="shipping_method">
                                       <li>
                                          <input type="checkbox" id="flat-rate-checkbox" class="shipping-checkbox" />
                                          <label for="flat-rate-checkbox">@lang('front.flat_rate'): <span class="amount">$7.00</span></label>
                                       </li>
                                       <li>
                                          <input type="checkbox" id="free-shipping-checkbox" class="shipping-checkbox" />
                                          <label for="free-shipping-checkbox">@lang('front.free_shipping')</label>
                                       </li>
                                       <li></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr class="order-total">
                                 <th>@lang('front.total')</th>
                                 <td>
                                    <strong><span class="amount">{!! getPrice($total) !!}</span></strong>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <div class="wc-proceed-to-checkout">
                           <a href="{{url('/front/checkout')}}">@lang('front.proceed_to_checkout')</a>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="snackbar">@lang('front.item_removed_successfully')</div>
<!-- cart-main-area end -->
@endsection
@section('js_custom')
<script>
   function removeFromCarT(key){
     $.post('{{ route('home.removeFromCart') }}',{_token:'{{ csrf_token() }}', id:key})
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ 
         x.className = x.className.replace("show", ""); 
         location.reload(); // Reload the page
     }, 3000);
 }
</script>
<script>
   function coupon() {
      document.getElementById("coupon").innerHTML = "Coupon is not Valid";
   }
</script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
       const flatRateCheckbox = document.getElementById("flat-rate-checkbox");
       const totalAmount = document.querySelector(".order-total .amount");
   
       flatRateCheckbox.addEventListener("change", function () {
           // Update the total based on whether "Flat Rate" is checked or unchecked
           const currentTotal = parseFloat(totalAmount.innerText.replace("$", ""));
           if (flatRateCheckbox.checked) {
               // Flat Rate is checked, add $7.00 to the total
               const newTotal = currentTotal + 7.0;
               totalAmount.innerText = "$" + newTotal.toFixed(2); // Format to two decimal places
           } else {
               // Flat Rate is unchecked, subtract $7.00 from the total if it was previously added
               const newTotal = currentTotal - 7.0;
               totalAmount.innerText = "$" + newTotal.toFixed(2); // Format to two decimal places
           }
       });
   });
</script>
@endsection
