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
                                                    <th class="product-name">Product Details</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cart_items as $product)
                                                <tr class="cart_item">
                                                    <td>
                                                        {{ $product->product->name }}&nbsp;
                                                        <input type="hidden" name="product_name[]" value="{{ $product->product->name }}">
                                                        <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
                                                        <input type="hidden" name="product_variation_name[]" value="{{ $product->variation_name }}">
                                                        <input type="hidden" name="product_variation_value[]" value="{{ $product->variation_value }}">
                                                        <strong class="product-quantity">
                                                            × {{ $product->quantity }}
                                                            <input type="hidden" name="product_quantity[]" value="{{ $product->quantity }}">
                                                            
                                                        </strong></td>
                                                    <td>
                                                        @php
                                                        $discount = ($product->product->discounts->discount_percent / 100) * $product->product->price;
                                                        $discount_price = $product->product->price - $discount;
                                                        $product_totalCents = $discount_price * $product->quantity;
                                                        $total_price = $product_totalCents / 100;
                                                        @endphp
                                                        <input type="hidden" name="product_unit_price[]" value="{{ $discount_price }}">
                                                        ${{ number_format((float)$total_price, 2, '.', '') }}
                                                        <input type="hidden" name="product_total[]" value="{{ $product_totalCents }}">
                                                    </td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>
                                                        @php
                                                        $subtotal = $carts->cart_subtotal / 100;
                                                        @endphp
                                                        ${{ number_format((float)$subtotal, 2, '.', '') }}
                                                        <input type="hidden" name="cart_subtotal" value="{{ $product_totalCents }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td>
                                                        @php
                                                        $shipping_feeCents = $carts->shipping_fee;
                                                        $shipping_fee = $shipping_feeCents / 100;
                                                        @endphp
                                                        ${{ number_format((float)$shipping_fee, 2, '.', '') }}
                                                        <input type="hidden" name="shipping_fee" value="{{ $shipping_feeCents }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td>
                                                        @php
                                                        $cart_totalCents = $carts->total;
                                                        $cart_total = $cart_totalCents / 100;
                                                        @endphp
                                                        <strong>${{ number_format((float)$cart_total, 2, '.', '') }}</strong>
                                                        <input type="hidden" name="cart_total" value="{{ $cart_totalCents }}">
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
                                            <!-- Basics Accordion -->
                                            <div id="basicsAccordion1">
                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingOne">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="stylishRadio1" name="stylishRadio" checked>
                                                            <label class="custom-control-label form-label" for="stylishRadio1"
                                                                data-toggle="collapse"
                                                                data-target="#basicsCollapseOnee"
                                                                aria-expanded="true"
                                                                aria-controls="basicsCollapseOnee">
                                                                Direct bank transfer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                        aria-labelledby="basicsHeadingOne"
                                                        data-parent="#basicsAccordion1">
                                                        <div class="p-4">
                                                            Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->

                                                <!-- Card -->
                                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                                    <div class="p-3" id="basicsHeadingThree">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="stylishRadio">
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
                                                            <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="stylishRadio">
                                                            <label class="custom-control-label form-label" for="FourstylishRadio1"
                                                                data-toggle="collapse"
                                                                data-target="#basicsCollapseFour"
                                                                aria-expanded="false"
                                                                aria-controls="basicsCollapseFour">
                                                                Paynow <a href="#" class="text-blue">What is Paynow?</a>
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
                                                    I have read and agree to the website <a href="#" class="text-blue">Terms and Conditions.</a>
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
                            @if($user != false)
                            <div class="pb-7 mb-7">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
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
                                            <input type="text" name="first_name" value="{{ $user->first_name }}" placeholder="Your First name." class="form-control"  aria-label="Jack" autocomplete="off">
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
                                            <input name="last_name" type="text" value="{{ $user->last_name }}" class="form-control" placeholder="Your Surname.">
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
                                            <input name="phone_number" type="text" value="{{ $user->phone_number }}" class="form-control" placeholder="+263 (0) 782 210021">
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
                                            <input name="email" type="text"  value="{{ $user->email }}" class="form-control" placeholder="abc@example.com">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="4">{{ $user->address }}</textarea>
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
                                            <textarea class="form-control" name="address" id="" cols="30" rows="4">{{ $user->delivery_address }}</textarea>
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
                                            <input type="text" class="form-control" name="city" value="{{ $user->city }}" placeholder="Harare" aria-label="London" data-msg="Please enter a valid city." autocomplete="off">
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
                                            <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="shippingdiffrentAddress" >
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
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
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
                                            <input type="text" name="first_name" placeholder="Your First name." class="form-control"  aria-label="Jack" autocomplete="off">
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
                                            <input name="last_name" type="text" class="form-control" placeholder="Your Surname.">
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
                                            <input name="phone_number" type="text" class="form-control" placeholder="+263 (0) 782 210021">
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
                                            <input name="email" type="text" class="form-control" placeholder="abc@example.com">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="4">{{ $user->address }}</textarea>
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Delivery Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="4">{{ $user->delivery_address }}</textarea>
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
                                            <input type="text" class="form-control" name="city" placeholder="Harare" aria-label="London" data-msg="Please enter a valid city." autocomplete="off">
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
                                            <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="shippingdiffrentAddress" >
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
                                                        <input type="text" class="form-control" name="company_city" placeholder="Harare" aria-label="Harare" autocomplete="off">
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
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </main>


@endsection