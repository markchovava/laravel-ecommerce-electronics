@extends('frontend.layouts.master')

@section('frontend')


<main id="content" role="main" class="checkout-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>
        
        <form action="{{ route('checkout.process') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">                              
                                @if(!empty($cart_items))
                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name"><h6><b>Product Details</b></h6> </th>
                                            <th class="product-total"><h6><b>Total</b></h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart_items as $product)
                                        <tr class="cart_item">
                                            <td>
                                                {{ $product->product->name }}&nbsp;
                                                <input type="hidden" name="product_name[]" value="{{ $product->product->name }}">
                                                <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
                                                <input type="hidden" name="product_variation[]" value="{{ $product->variation }}">
                                                <strong class="product-quantity">
                                                    × {{ $product->quantity }}
                                                    <input type="hidden" name="product_quantity[]" value="{{ $product->quantity }}">
                                                    
                                                </strong></td>
                                            <td>
                                                @php
                                                $discount = ($product->product->discounts->discount_percent / 100) * $product->product->price;
                                                $discount_price = $product->product->price - $discount;
                                                $product_totalCents = $discount_price * $product->quantity;
                                                $product_zwl_totalCents = $product_totalCents * intval($zwl_currency->value);
                                                $total_price = $product_totalCents / 100;
                                                @endphp
                                                <input type="hidden" name="product_unit_price[]" value="{{ $discount_price }}">
                                                ${{ number_format((float)$total_price, 2, '.', '') }}
                                                <input type="hidden" name="product_total[]" value="{{ $product_totalCents }}">
                                                <input type="hidden" name="product_zwl_total[]" value="{{ $product_zwl_totalCents }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>
                                                @php
                                                $subtotal = $cart->cart_subtotal / 100;
                                                @endphp
                                                ${{ number_format((float)$subtotal, 2, '.', '') }}
                                                <input type="hidden" name="cart_subtotal" value="{{ $cart->cart_subtotal }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td>
                                                @php
                                                $shipping_feeCents = $cart->shipping_fee;
                                                $shipping_fee = $shipping_feeCents / 100;
                                                @endphp
                                                ${{ number_format((float)$shipping_fee, 2, '.', '') }}
                                                <input type="hidden" name="shipping_fee" value="{{ $shipping_feeCents }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total (USD)</th>
                                            <td>
                                                @php
                                                $cart_totalCents = $cart->total;
                                                $cart_total = $cart_totalCents / 100;
                                                @endphp
                                                <strong>${{ number_format((float)$cart_total, 2, '.', '') }}</strong>
                                                <input type="hidden" name="cart_total" value="{{ $cart_totalCents }}">
                                                <input type="hidden" name="total_payamount" value="{{ number_format((float)$cart_total, 2, '.', '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total (ZWL)</th>
                                            <td>
                                                @php
                                                $cart_zwltotalCents = $cart->zwl_total;
                                                $cart_zwltotal = $cart_zwltotalCents / 100;
                                                @endphp
                                                <strong>${{ number_format((float)$cart_zwltotal, 2, '.', '') }}</strong>
                                                <input type="hidden" name="cart_zwltotal" value="{{ $cart_zwltotalCents }}">
                                                <input type="hidden" name="total_payzwlamount" value="{{ number_format((float)$cart_zwltotal, 2, '.', '') }}">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                @else
                                    <!-- Product Content -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product Details</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                            <td>
                                                <h4 class="text-secondary" style="text-align:center;">
                                                    {{ $message }}
                                                </h4>
                                            </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>
                                                    @php
                                                    $subtotal = 0;
                                                    @endphp
                                                    ${{ number_format((float)$subtotal, 2, '.', '') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    @php
                                                    $shipping_fee = 0;
                                                    @endphp
                                                    ${{ number_format((float)$shipping_fee, 2, '.', '') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>
                                                    @php
                                                    $cart_total = 0;
                                                    @endphp
                                                    <strong>${{ number_format((float)$cart_total, 2, '.', '') }}</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>    
                                @endif
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <h6><b>Choose Currency</b></h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check" >
                                                <input type="radio" name="currency" value="ZWL" 
                                                class="form-check-input" checked="checked">
                                                <label class="form-check-label"><b>ZWL </b></label>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1">
                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingThree">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="payment_method" value="Cash_on_delivery" class="custom-control-input" id="thirdstylishRadio1" >
                                                    <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapseThree"
                                                        aria-expanded="false"
                                                        aria-controls="basicsCollapseThree">
                                                        Cash on delivery
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeadingThree"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    Pay with cash upon delivery.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeadingFour">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="payment_method" checked="checked" value="Paynow" class="custom-control-input" id="FourstylishRadio1">
                                                    <label class="custom-control-label form-label" for="FourstylishRadio1"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapseFour"
                                                        aria-expanded="false"
                                                        aria-controls="basicsCollapseFour">
                                                        Paynow <a href="#" target="_blank" class="text-blue">What is Paynow?</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeadingFour"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4">
                                                    Pay via Paynow; you can pay with your Ecocash, Telecash or One Money.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck10" required
                                            data-msg="Please agree terms and conditions."
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="{{ route('privacy.index') }}" class="text-blue">Terms and Conditions.</a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Checkout Order</button>
                            
                            </div>
                            <!-- End Order Summary -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    @if( isset($user) )
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing Details</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        First name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="first_name" value="{{ $user->first_name }}" required="required" placeholder="Your First name." class="form-control"  aria-label="Jack" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Last name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="last_name" type="text" value="{{ $user->last_name }}" required="required" class="form-control" placeholder="Your Surname.">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="phone_number" type="text" value="{{ $user->phone_number }}" required="required" class="form-control" placeholder="+263 (0) 782 210021">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="email" type="text"  value="{{ $user->email }}" required="required" class="form-control" placeholder="abc@example.com">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Delivery address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="delivery_address" required="required" id="" cols="30" rows="3">{{ $user->delivery_address }}</textarea>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        City (Delivery in Harare Only)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="city" value="{{ $user->city }}" placeholder="Harare" aria-label="London" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>
                        </div>

                            
                        <!-- End Billing Form -->

    
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Company Details</h3>
                        </div>
                        <!-- End Title -->
                        <!-- Accordion -->
                        <div id="shopCartAccordion3" class="accordion rounded mb-5">
                            <!-- Card -->
                            <div class="card border-0">
                                <div id="shopCartHeadingFour" class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="to_company_address" >
                                    <label class="custom-control-label form-label" for="shippingdiffrentAddress" data-toggle="collapse" data-target="#shopCartfour" aria-expanded="false" aria-controls="shopCartfour">
                                        Ship to a Company address?
                                    </label>
                                </div>
                                <div id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour" data-parent="#shopCartAccordion3" style="">
                                    <!-- Shipping Form -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="company_name" value="{{ $user->company_name }}" placeholder="Your Company name." aria-label="Your Company name." autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" name="company_email" value="{{ $user->company_email }}" placeholder="abc@example.co.zw" aria-label="abc@example.co.zw" data-msg="Please enter your email here." autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Phone Number
                                                </label>
                                                <input type="text" class="form-control" name="company_phone_number" value="{{ $user->company_phone_number }}" placeholder="+ 263 (0)242 456 456" aria-label="Company Phone Number" data-msg="Please enter a Company Phone Number" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Address
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="company_address" class="form-control" cols="30" rows="4">{{ $user->company_address }}</textarea>
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    City
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="company_city" value="{{ $user->company_city }}"  placeholder="Harare" aria-label="Harare" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                    </div>
                                    <!-- End Shipping Form -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Order notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="notes"  placeholder="Notes about your order."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                    @else
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing Details</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        First name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="first_name" value="{{ $user->first_name }}" required="required" placeholder="Your First name." class="form-control"  aria-label="Jack" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Last name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="last_name" type="text" required="required" class="form-control" placeholder="Your Surname.">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="phone_number" type="text" required="required" class="form-control" placeholder="+263 (0) 782 210021">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input name="email" type="text" required="required" class="form-control" placeholder="abc@example.com">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Delivery address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="delivery_address" placeholder="Write your Delivery Address" required="required" id="" cols="30" rows="3"></textarea>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        City (Delivery in Harare Only)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="city" placeholder="Write the city" aria-label="London" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>
                        </div>

                            
                        <!-- End Billing Form -->

    
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Company Details</h3>
                        </div>
                        <!-- End Title -->
                        <!-- Accordion -->
                        <div id="shopCartAccordion3" class="accordion rounded mb-5">
                            <!-- Card -->
                            <div class="card border-0">
                                <div id="shopCartHeadingFour" class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="to_company_address" >
                                    <label class="custom-control-label form-label" for="shippingdiffrentAddress" data-toggle="collapse" data-target="#shopCartfour" aria-expanded="false" aria-controls="shopCartfour">
                                        Ship to a Company address?
                                    </label>
                                </div>
                                <div id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour" data-parent="#shopCartAccordion3" style="">
                                    <!-- Shipping Form -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="company_name" placeholder="Your Company name." aria-label="Your Company name." autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" name="company_email" placeholder="abc@example.co.zw" aria-label="abc@example.co.zw" data-msg="Please enter your email here." autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Phone Number
                                                </label>
                                                <input type="text" class="form-control" name="company_phone_number" placeholder="+ 263 (0)242 456 456" aria-label="Company Phone Number" data-msg="Please enter a Company Phone Number" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Company Address
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="company_address" class="form-control" cols="30" rows="4"></textarea>
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    City
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="company_city" placeholder="Write the city." aria-label="Harare" autocomplete="off">
                                            </div>
                                            <!-- End Input -->
                                        </div>

                                    </div>
                                    <!-- End Shipping Form -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Order notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="notes" placeholder="Notes about your order."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</main>

<!-- Footer-top-widget -->
<div class="container d-none d-lg-block mb-3">
    <div class="row">
        <div class="col-wd-3 col-lg-4">
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
            </div>
            <ul class="list-unstyled products-group">
                @foreach($latest_three as $product)
                <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                    <div class="col-auto">
                        <a href="{{ route('product.view', $product->id) }}" class="d-block width-75 text-center">
                            <div style="width:75px;height:75px;overflow:hidden;">
                                <img class="img__fit" 
                                src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}"  alt="Image Description">
                            </div> 
                        </a>        
                    </div>
                    <div class="col pl-4 d-flex flex-column">
                        <h5 class="product-item__title mb-0">
                            <a href="{{ route('product.view', $product->id) }}" class="text-blue font-weight-bold">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div class="prodcut-price mt-auto flex-horizontal-center">
                            <ins class="font-size-15 text-decoration-none">
                                @php
                                    $usd_price = intval($product->price);
                                    $discount = ($product->discounts->discount_percent / 100) * $usd_price;
                                    $discount_usd_price = $usd_price - $discount;
                                    $price = $discount_usd_price / 100;
                                @endphp
                                $<span class="price__number">{{ number_format((float)$price, 2, '.', '') }}</span>
                                <input type="hidden" value="{{ $discount_usd_price }}" class="price__cents">
                            </ins>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-wd-3 col-lg-4">
            <div class="widget-column">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Trending Products</h3>
                </div>
                <ul class="list-unstyled products-group">
                    @foreach($tag_first_three as $product)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ route('product.view', $product->id) }}" class="d-block width-75 text-center">
                                <div style="width:75px;height:75px;overflow:hidden;">
                                    <img class="img__fit" 
                                    src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}"  alt="Image Description">
                                </div> 
                        </a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0">
                                <a href="{{ route('product.view', $product->id) }}" class="text-blue font-weight-bold">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div class="prodcut-price mt-auto">
                                <ins class="font-size-15 text-decoration-none">
                                    @php
                                        $usd_price = intval($product->price);
                                        $discount = ($product->discounts->discount_percent / 100) * $usd_price;
                                        $discount_usd_price = $usd_price - $discount;
                                        $price = $discount_usd_price / 100;
                                    @endphp
                                    $<span class="price__number">{{ number_format((float)$price, 2, '.', '') }}</span>
                                    <input type="hidden" value="{{ $discount_usd_price }}" class="price__cents">
                                </ins>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-wd-3 col-lg-4">
            <div class="widget-column">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Daily Hot Deals</h3>
                </div>
                <ul class="list-unstyled products-group">
                    @foreach($tag_second_three as $product)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ route('product.view', $product->id) }}" class="d-block width-75 text-center">
                                <div style="width:75px;height:75px;overflow:hidden;">
                                    <img class="img__fit" 
                                    src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}"  alt="Image Description">
                                </div> 
                            </a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0">
                                <a href="{{ route('product.view', $product->id) }}" class="text-blue font-weight-bold">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div class="prodcut-price mt-auto">
                                <ins class="font-size-15 text-decoration-none">
                                    @php
                                        $usd_price = intval($product->price);
                                        $discount = ($product->discounts->discount_percent / 100) * $usd_price;
                                        $discount_usd_price = $usd_price - $discount;
                                        $price = $discount_usd_price / 100;
                                    @endphp
                                    $<span class="price__number">{{ number_format((float)$price, 2, '.', '') }}</span>
                                    <input type="hidden" value="{{ $discount_usd_price }}" class="price__cents">
                                </ins>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Footer-top-widget -->


@endsection