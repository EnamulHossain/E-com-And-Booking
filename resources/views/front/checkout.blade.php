@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
               <h3>@lang('front.checkout')</h3>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- page-title-wrapper-end -->
<!-- entry-header-area start -->
<div class="entry-header-area ptb-40">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="entry-header">
               <h1 class="entry-title">@lang('front.checkout')</h1>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- entry-header-area end -->
<!-- coupon-area start -->
<div class="coupon-area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="coupon-accordion">
               <!-- ACCORDION START -->
               @if(!auth()->check())
               <h3>@lang('front.returning_customer') <span id="showlogin">@lang('front.click_here_to_login')</span></h3>
               <div id="checkout-login" class="coupon-content">
                  <div class="coupon-info">
                     <!--<p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>-->
                     <form action="{{route('front.login')}}">
                        <p class="form-row-first">
                           <label>@lang('front.email') <span class="required">*</span></label>
                           <input type="text" />
                        </p>
                        <p class="form-row-last">
                           <label>@lang('front.password') <span class="required">*</span></label>
                           <input type="text" />
                        </p>
                        <p class="form-row">
                           <input type="submit" value="Login" />
                           <label>
                              <input type="checkbox" />
                              @lang('front.remember_me')
                           </label>
                        </p>
                        <p class="lost-password">
                           <a href="{{route('front.reset')}}">@lang('front.lost_your_password')</a>
                        </p>
                     </form>
                  </div>
               </div>
               @endif
               <!-- ACCORDION END -->
               <!-- ACCORDION START -->
               <h3>@lang('front.have_a_coupon') <span
                     id="showcoupon">@lang('front.click_here_to_enter_your_code')</span></h3>
               <div id="checkout_coupon" class="coupon-checkout-content">
                  <div class="coupon-info">
                     <form action="#">
                        <p id="coupon"></p>
                        <input type="text" placeholder="@lang('coupon_code')" />
                        <input type="submit" onclick="coupon()" value="@lang('front.apply_coupon')" />
                        <script>
                           function coupon() {
                              document.getElementById("coupon").innerHTML = "Coupon invalid";
                           }
                        </script>
                     </form>
                  </div>
               </div>
               <!-- ACCORDION END -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<div class="checkout-area pb-50">
   <div class="container">
      <div class="row">
         <form action="{{route('place_order')}}" method="POST">
            @csrf
            <div class="col-lg-6 col-md-6">
               <div class="checkbox-form">
                  @if (auth()->check())
                  <h3>@lang('front.choose_address')</h3>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     @foreach ($addresses as $address )
                     <div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
                        <label class="radio-inline">
                           <input type="radio" name="address" onchange="addressChanges()" id="inlineRadio1" value="{{$address->id}}">  {{$address->address}}
                        </label>
                     </div>
                     @endforeach
                  </div>
                  <h3>@lang('front.enter_new_address')</h3>
                  <div class="col-md-12">
                     <div class="checkout-form-list">
                        <label>@lang('front.address') <span class="required">*</span></label>
                        <input type="text" name="add_new_address" placeholder="@lang('front.street_address')" />
                     </div>
                  </div>
                  {{-- <div class="col-md-12">
                     <div class="checkout-form-list">
                        <input type="text" placeholder="@lang('front.apartment_suite_unit_etc_optional')" />
                     </div>
                  </div> --}}
                  @endif
                  @if (!Auth::check())
                  <h3>@lang('front.enter_new_address')</h3>
                  <div class="row">
                     <!-- Address-Coloum end -->
                     <div class="col-md-12">
                        <div class="country-select">
                           <label>@lang('front.country') <span class="required">*</span></label>
                           <select>
                              <option value="volvo">bangladesh</option>
                              <option value="saab">Algeria</option>
                              <option value="mercedes">Afghanistan</option>
                              <option value="audi">Ghana</option>
                              <option value="audi2">Albania</option>
                              <option value="audi3">Bahrain</option>
                              <option value="audi4">Colombia</option>
                              <option value="audi5">Dominican Republic</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.first_name') <span class="required">*</span></label>
                           <input type="text" name="first_name" placeholder="" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.last_name') <span class="required">*</span></label>
                           <input type="text" name="last_name" placeholder="" />
                        </div>
                     </div>
                     <!--<div class="col-md-12">
                        <div class="checkout-form-list">
                        	<label>Company Name</label>
                        	<input type="text" placeholder="" />
                        </div>
                        </div>-->
                     <div class="col-md-12">
                        <div class="checkout-form-list">
                           <label>@lang('front.address') <span class="required">*</span></label>
                           <input type="text" name="address" placeholder="@lang('front.street_address')" />
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="checkout-form-list">
                           <input type="text" name="apartment_suite_unit_etc_optional" placeholder="@lang('front.apartment_suite_unit_etc_optional')" />
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="checkout-form-list">
                           <label>@lang('front.town_or_city') <span class="required">*</span></label>
                           <input type="text" name="town_or_city" placeholder="@lang('front.town_or_city')" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.state_or_county') <span class="required">*</span></label>
                           <input type="text" name="state_or_county" placeholder="" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.postcode_or_zip') <span class="required">*</span></label>
                           <input type="text" name="postcode_or_zip" placeholder="@lang('front.postcode_or_zip')" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.email_address') <span class="required">*</span></label>
                           <input type="email" name="email" placeholder="" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="checkout-form-list">
                           <label>@lang('front.phone') <span class="required">*</span></label>
                           <input type="text" name="phone" placeholder="@lang('front.phone')" />
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="checkout-form-list create-acc">
                           <input id="cbox" type="checkbox" />
                           <label>@lang('front.create_an_account')</label>
                        </div>
                        <div id="cbox_info" class="checkout-form-list create-account">
                           <p>@lang('front.create_an_account_details')</p>
                           <label>@lang('front.account_password') <span class="required">*</span></label>
                           <input type="password" name="password" placeholder="@lang('front.password')" />
                        </div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="your-order">
                  <h3>@lang('front.your_order')</h3>
                  <div class="your-order-table table-responsive">
                     <table>
                        <thead>
                           <tr>
                              <th class="product-name">@lang('front.product')</th>
                              <th class="product-total">@lang('front.total')</th>
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
                           <tr class="cart_item">
                              <td class="product-name">
                                 <input type="hidden" name="product_id" value="{{$prd->product->id}} ">
                                 <input type="hidden" name="quantity" value="{{$prd->quantity}}">
                                 {{$prd->product->name}} <strong class="product-quantity"> x {{$prd->quantity}}</strong>
                              </td>
                              <td class="product-total">
                                 <span class="amount">{!! getPrice($prd->quantity * $prd->new_price) !!}</span>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr class="cart-subtotal">
                              <th>@lang('front.cart_subtotal')</th>
                              <td><span class="amount">{!! getPrice($total) !!}</span></td>
                           </tr>
                           <tr class="cart-subtotal">
                              <th>@lang('front.gst_in')</th>
                              <td><span class="amount">28%</span></td>
                           </tr>
                           <tr class="shipping">
                              <th>@lang('front.shipping')</th>
                              <td>
                                 <ul id="shipping_method">
                                    @if ($total < 6000)
                                       <li>
                                          <input type="checkbox" id="flat-rate-checkbox" class="shipping-checkbox" checked disabled/>
                                          <label  id="flat-rate" for="flat-rate-checkbox">@lang('front.flat_rate'): <span class="amount">$7.00</span></label>
                                       </li>
                                    @else
                                       <li>
                                          <input type="checkbox" id="free-shipping-checkbox" class="shipping-checkbox" checked disabled/>
                                          <label id="free-shipping" for="free-shipping-checkbox">@lang('front.free_shipping')</label>
                                       </li>
                                    @endif
                                 </ul>
                              </td>
                           </tr>
                           <tr class="order-total">
                              <th>@lang('front.order_total')</th>
                              @if ($total < 6000)
                                 <td><strong><span class="amount">{!! getPrice($total + 7) !!}</span></strong>
                              @else
                                 <td><strong><span class="amount">{!! getPrice($total) !!}</span></strong>
                              @endif
                              
                              </td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  <div class="payment-method">
                     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                           <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    @lang('front.google_pay')
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                              aria-labelledby="headingOne">
                              <div class="panel-body payment-content">
                                 <div id="google_payment_button"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="order-button-payment">
                        <input type="submit" value="Place order" />
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- checkout-area end -->
@endsection

@push('js')
{{-- <script>
   /**
    * Define the version of the Google Pay API referenced when creating your
    * configuration
    *
    */
   const baseRequest = {
     apiVersion: 2,
     apiVersionMinor: 0
   };
   
   /**
    * Card networks supported by your site and your gateway
    *
    */
   const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "MIR", "VISA"];
   
   /**
    * Card authentication methods supported by your site and your gateway
    *
    * supported card networks
    */
   const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];
   
   /**
    * Identify your gateway and your site's gateway merchant identifier
    *
    * The Google Pay API response will return an encrypted payment method capable
    * of being charged by a supported gateway after payer authorization
    *
    */
   const tokenizationSpecification = {
     type: 'PAYMENT_GATEWAY',
     parameters: {
       'gateway': 'example',
       'gatewayMerchantId': 'exampleGatewayMerchantId'
     }
   };
   
   /**
    * Describe your site's support for the CARD payment method and its required
    * fields
    *
    */
   const baseCardPaymentMethod = {
     type: 'CARD',
     parameters: {
       allowedAuthMethods: allowedCardAuthMethods,
       allowedCardNetworks: allowedCardNetworks
     }
   };
   
   /**
    * Describe your site's support for the CARD payment method including optional
    * fields
    *
    */
   const cardPaymentMethod = Object.assign(
     {},
     baseCardPaymentMethod,
     {
       tokenizationSpecification: tokenizationSpecification
     }
   );
   
   /**
    * An initialized google.payments.api.PaymentsClient object or null if not yet set
    *
    */
   let paymentsClient = null;
   
   /**
    * Configure your site's support for payment methods supported by the Google Pay
    * API.
    *
    * Each member of allowedPaymentMethods should contain only the required fields,
    * allowing reuse of this base request when determining a viewer's ability
    * to pay and later requesting a supported payment method
    *
    */
   function getGoogleIsReadyToPayRequest() {
     return Object.assign(
         {},
         baseRequest,
         {
           allowedPaymentMethods: [baseCardPaymentMethod]
         }
     );
   }
   
   /**
    * Configure support for the Google Pay API
    *
    */
   function getGooglePaymentDataRequest() {
     const paymentDataRequest = Object.assign({}, baseRequest);
     paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
     paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
     paymentDataRequest.merchantInfo = {
       // merchantId: '12345678901234567890',
       merchantName: 'Example Merchant'
     };
   
     paymentDataRequest.callbackIntents = ["SHIPPING_ADDRESS",  "SHIPPING_OPTION", "PAYMENT_AUTHORIZATION"];
     paymentDataRequest.shippingAddressRequired = true;
     paymentDataRequest.shippingAddressParameters = getGoogleShippingAddressParameters();
     paymentDataRequest.shippingOptionRequired = true;
   
     return paymentDataRequest;
   }
   
   /**
    * Return an active PaymentsClient or initialize
    *
    */
   function getGooglePaymentsClient() {
     if ( paymentsClient === null ) {
       paymentsClient = new google.payments.api.PaymentsClient({
         environment: "TEST",
         merchantInfo: {
           merchantName: "Example Merchant",
           merchantId: "01234567890123456789"
         },
         paymentDataCallbacks: {
           onPaymentAuthorized: onPaymentAuthorized,
           onPaymentDataChanged: onPaymentDataChanged
         }
       });
     }
     return paymentsClient;
   }
   
   
   function onPaymentAuthorized(paymentData) {
           return new Promise(function(resolve, reject){
   
     // handle the response
     processPayment(paymentData)
       .then(function() {
         resolve({transactionState: 'SUCCESS'});
       })
       .catch(function() {
           resolve({
           transactionState: 'ERROR',
           error: {
             intent: 'PAYMENT_AUTHORIZATION',
             message: 'Insufficient funds',
             reason: 'PAYMENT_DATA_INVALID'
           }
         });
       });
   
     });
   }
   
   /**
    * Handles dynamic buy flow shipping address and shipping options callback intents.
    *
    */
   function onPaymentDataChanged(intermediatePaymentData) {
     return new Promise(function(resolve, reject) {
   
           let shippingAddress = intermediatePaymentData.shippingAddress;
       let shippingOptionData = intermediatePaymentData.shippingOptionData;
       let paymentDataRequestUpdate = {};
   
       if (intermediatePaymentData.callbackTrigger == "INITIALIZE" || intermediatePaymentData.callbackTrigger == "SHIPPING_ADDRESS") {
         if(shippingAddress.administrativeArea == "NJ")  {
           paymentDataRequestUpdate.error = getGoogleUnserviceableAddressError();
         }
         else {
           paymentDataRequestUpdate.newShippingOptionParameters = getGoogleDefaultShippingOptions();
           let selectedShippingOptionId = paymentDataRequestUpdate.newShippingOptionParameters.defaultSelectedOptionId;
           paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(selectedShippingOptionId);
         }
       }
       else if (intermediatePaymentData.callbackTrigger == "SHIPPING_OPTION") {
         paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(shippingOptionData.id);
       }
   
       resolve(paymentDataRequestUpdate);
     });
   }
   
   /**
    * Helper function to create a new TransactionInfo object.
    *
    */
   function calculateNewTransactionInfo(shippingOptionId) {
           let newTransactionInfo = getGoogleTransactionInfo();
   
     let shippingCost = getShippingCosts()[shippingOptionId];
     newTransactionInfo.displayItems.push({
       type: "LINE_ITEM",
       label: "Shipping cost",
       price: shippingCost,
       status: "FINAL"
     });
   
     let totalPrice = 0.00;
     newTransactionInfo.displayItems.forEach(displayItem => totalPrice += parseFloat(displayItem.price));
     newTransactionInfo.totalPrice = totalPrice.toString();
     return newTransactionInfo;
   }
   
   /**
    * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
    *
    * Display a Google Pay payment button after confirmation of the viewer's
    * ability to pay.
    */
   function onGooglePayLoaded() {
     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
         .then(function(response) {
           if (response.result) {
             addGooglePayButton();
             // @todo prefetch payment data to improve performance after confirming site functionality
             // prefetchGooglePaymentData();
           }
         })
         .catch(function(err) {
           // show error in developer console for debugging
           console.error(err);
         });
   }
   
   /**
    * Add a Google Pay purchase button alongside an existing checkout button
    *
    */
   function addGooglePayButton() {
     const paymentsClient = getGooglePaymentsClient();
     const button =
         paymentsClient.createButton({
           onClick: onGooglePaymentButtonClicked,
           allowedPaymentMethods: [baseCardPaymentMethod]
         });
     document.getElementById('google_payment_button').appendChild(button);
   }
   
   /**
    * Provide Google Pay API with a payment amount, currency, and amount status
    *
    */
   function getGoogleTransactionInfo() {
     return {
           displayItems: [
           {
             label: "Subtotal",
             type: "SUBTOTAL",
             price: "{{$total}}",
           },
         {
             label: "Tax",
             type: "TAX",
             price: "0",
           }
       ],
       countryCode: 'US',
       currencyCode: "USD",
       totalPriceStatus: "FINAL",
       totalPrice: "{{$total}}",
       totalPriceLabel: "Total"
     };
   }
   
   /**
    * Provide a key value store for shippping options.
    */
   function getShippingCosts() {
           return {
       "shipping-001": "0.00",
       "shipping-002": "1.99",
       "shipping-003": "10.00"
     }
   }
   
   /**
    * Provide Google Pay API with shipping address parameters when using dynamic buy flow.
    *
    */
   function getGoogleShippingAddressParameters() {
           return  {
           allowedCountryCodes: ['US'],
       phoneNumberRequired: true
     };
   }
   
   /**
    * Provide Google Pay API with shipping options and a default selected shipping option.
    *
    */
   function getGoogleDefaultShippingOptions() {
           return {
         defaultSelectedOptionId: "shipping-001",
         shippingOptions: [
           {
             "id": "shipping-001",
             "label": "Free: Standard shipping",
             "description": "Free Shipping delivered in 5 business days."
           },
           {
             "id": "shipping-002",
             "label": "$1.99: Standard shipping",
             "description": "Standard shipping delivered in 3 business days."
           },
           {
             "id": "shipping-003",
             "label": "$10: Express shipping",
             "description": "Express shipping delivered in 1 business day."
           },
         ]
     };
   }
   
   /**
    * Provide Google Pay API with a payment data error.
    *
    */
   function getGoogleUnserviceableAddressError() {
           return {
       reason: "SHIPPING_ADDRESS_UNSERVICEABLE",
       message: "Cannot ship to the selected address",
       intent: "SHIPPING_ADDRESS"
           };
   }
   
   /**
    * Prefetch payment data to improve performance
    *
    */
   function prefetchGooglePaymentData() {
     const paymentDataRequest = getGooglePaymentDataRequest();
     // transactionInfo must be set but does not affect cache
     paymentDataRequest.transactionInfo = {
       totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
       currencyCode: 'USD'
     };
     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.prefetchPaymentData(paymentDataRequest);
   }
   
   
   /**
    * Show Google Pay payment sheet when Google Pay payment button is clicked
    */
   function onGooglePaymentButtonClicked() {
     const paymentDataRequest = getGooglePaymentDataRequest();
     paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
   
     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.loadPaymentData(paymentDataRequest);
   }
   
   /**
    * Process payment data returned by the Google Pay API
    *
    *
    */
   function processPayment(paymentData) {
           return new Promise(function(resolve, reject) {
           setTimeout(function() {
                   paymentToken = paymentData.paymentMethodData.tokenizationData.token;
                 if(paymentToken != ''){
                 jQuery.ajax({
                    url: "{{ url('payment') }}",
                    method: 'POST',
                    data: { data : paymentData,
                amount: {{$total}},
                     _token: "{{ csrf_token() }}"},
                    success: function(result){
                        if(result.success){
                            window.location.href = result.url;
                        }else{
                   alert('Some thing went wrong, please tray again');
                   }
                    }});  
            }
   
           resolve({});
       }, 3000);
     });
   }</script>
   <script async
     src="https://pay.google.com/gp/p/js/pay.js"
     onload="onGooglePayLoaded()"></script>





     <script>
      function coupon() {
         document.getElementById("coupon").innerHTML = "Coupon is not Valid";
      }
</script> --}}
   
   {{-- <script>
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
   </script> --}}

<script>
   function addressChanges() {
    var selectedAddressId = document.querySelector('input[name="address"]:checked').value;
    console.log(selectedAddressId);
      $.ajax({
         type: 'GET',
         url: '/addressinfo/' + selectedAddressId,
         
         success: function(response) {
            // Success!
            console.log(url);
         },
         error: function(error) {
            // Error!
            console.log(error);
         }
      });
}
</script>
@endpush