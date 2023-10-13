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

<!-- coupon-area end -->
<!-- checkout-area start -->
<div class="checkout-area pb-50">
   <div class="container">
      <div class="row">
         <form action="{{Route('saloon.place_order', $service->id)}}" method="post">
         {{-- <form action="#" method="post"> --}}
            @csrf

            <input type="hidden" name="service_id" value="{{$service->id}}">
            <input type="hidden" name="booking_at" value="{{$booking_at}}">
            <input type="hidden" name="salon_id" value="{{$salon_id}}">
            <div class="col-lg-6 col-md-6">
               <div class="checkbox-form">
                  {{-- <h3>Service Details</h3>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
                        <label class="radio-inline">
                           <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka
                           ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
                        </label>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
                        <label class="radio-inline">
                           <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka
                           ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
                        </label>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
                        <label class="radio-inline">
                           <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka
                           ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
                        </label>
                     </div>
                  </div> --}}
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="your-order">
                  <h3>@lang('front.booking_summary')
                     <div class="your-order-table table-responsive">
                        <table>
                           <tr class="cart_item">
                              <td class="product-name">@lang('front.service_name'):</td>
                              <td class="product-name">{{$service->name}}</td>
                           </tr>
                           <tr class="cart_item">
                              <td class="product-name">@lang('front.booking_at'): </td>
                              <td class="product-total"> {{Carbon\Carbon::parse($booking_at)->format('Y-m-d i:s a')}}
                              </td>
                           </tr>
                           {{-- <tr class="cart_item">
                              <td class="product-name">Tax Amount: </td>
                              <td class="product-total"> -</td>
                           </tr> --}}
                           {{-- <thead>
                              <tr>
                                 <th class="product-name">Service Name</th>
                                 <th class="product-total">Total</th>
                              </tr>
                           </thead> --}}
                           @php
                           $total = $service->price;
                           @endphp
                           {{-- <tbody>
                              @foreach ($carts as $prd)
                              @php
                              $total = $total + ($prd['new_price']) * $prd['quantity'];
                              @endphp
                              <tr class="cart_item">
                                 <td class="product-name">
                                    {{$prd->product->name}} <strong class="product-quantity"> x
                                       {{$prd->quantity}}</strong>
                                 </td>
                                 <td class="product-total">
                                    <span class="amount">${{$prd->quantity * $prd->new_price}}</span>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody> --}}
                           <tfoot>
                              {{-- <tr class="cart-subtotal">
                                 <th>Cart Subtotal</th>
                                 <td><span class="amount">${{$total}}</span></td>
                              </tr> --}}
                              {{-- <tr class="cart-subtotal">
                                 <th>GST IN</th>
                                 <td><span class="amount">28%</span></td>
                              </tr> --}}
                              {{-- <tr class="shipping">
                                 <th>Shipping</th>
                                 <td>
                                    <ul>
                                       <li>
                                          <input type="radio" />
                                          <label>
                                             Flat Rate: <span class="amount">$7.00</span>
                                          </label>
                                       </li>
                                       <li>
                                          <input type="radio" />
                                          <label>Free Shipping:</label>
                                       </li>
                                       <li></li>
                                    </ul>
                                 </td>
                              </tr> --}}
                              <tr class="order-total">
                                 <th>@lang('front.order_total')</th>
                                 <td><strong><span class="amount">{!! getPrice($total) !!}</span></strong>
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
                           <input type="submit" value="Place Order" />
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
<script>
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
       merchantId: "{{setting('googlepay_merchantId')}}",
       merchantName: "{{setting('googlepay_merchantName') ?: 'Google merchant name' }}"
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
         merchantId: "{{setting('googlepay_merchantId')}}",
         merchantName: "{{setting('googlepay_merchantName') ?: 'Google merchant name' }}"
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
           price: "0.00",
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
                  url: "{{ Route('saloon.place_order', $service->id) }}",
                  method: 'POST',
                  data: {
                     data : paymentData,
                     booking_at : "{{$booking_at}}",
                        salon_id : {{$salon_id}},
                     amount: {{$total}},
                     _token: "{{ csrf_token() }}"
                  },
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
   }
</script>
<script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
@endpush