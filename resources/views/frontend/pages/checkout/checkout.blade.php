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
               
                <form class="js-validate" novalidate="novalidate">
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
                                                    <td>{{ $product->product->name }}&nbsp;<strong class="product-quantity">× {{ $product->quantity }}</strong></td>
                                                    <td>
                                                    @php
                                                    $product_totalCents = $product->product->price * $product->quantity;
                                                    $total_price = $product_totalCents / 100;
                                                    @endphp
                                                    ${{ number_format((float)$total_price, 2, '.', '') }}
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
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td>
                                                        @php
                                                        $shipping_fee = $carts->shipping_fee / 100;
                                                        @endphp
                                                        ${{ number_format((float)$shipping_fee, 2, '.', '') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td>
                                                        @php
                                                        $cart_total = $carts->total / 100;
                                                        @endphp
                                                        <strong>${{ number_format((float)$cart_total, 2, '.', '') }}</strong>
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
                                    </div>
                                    <!-- End Order Summary -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 order-lg-1">
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
                                            <input type="text" class="form-control" name="first_name" placeholder="Your First name." aria-label="Jack" autocomplete="off">
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
                                            <input name="text" type="text" class="form-control" placeholder="+263 (0) 782 210021">
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
                                                Delivery address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="4"></textarea>
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
                                                            Email
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" class="form-control" name="company_email" placeholder="Wayley" aria-label="Wayley" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                                    </div>
                                                    <!-- End Input -->
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- Input -->
                                                    <div class="js-form-message mb-6">
                                                        <label class="form-label">
                                                            Phone Number
                                                        </label>
                                                        <input type="text" class="form-control" name="company_phone_number" placeholder="Company Name" aria-label="Company Name" data-msg="Please enter a company name." data-error-class="u-has-error" data-success-class="u-has-success">
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
                                        <textarea class="form-control p-5" rows="4" name="text" placeholder="Notes about your order."></textarea>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>


@endsection