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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-5">
                    <h1 class="text-center">Login to Checkout</h1>
                </div>
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
                                <!-- Register Link -->
                                <div class="alert alert-primary mb-6" role="alert">
                                    New customer? <a href="{{ route('checkout.register') }}" class="alert-link">Click here to Register.</a>
                                </div>
                                <!--  -->
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Login Details</h3>
                                </div>
                                <!-- End Title -->
                               

                                <form class="" action="{{ route('checkout.login.process') }}" method="POST">
                                   @csrf
                                    <!-- Billing Form -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Email:
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" name="email" placeholder="abc@example.com" autocomplete="off">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                          
                                            </div>
                                            <!-- End Input -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Input -->
                                            <div class="js-form-message mb-6">
                                                <label class="form-label">
                                                    Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="password" class="form-control" name="password" placeholder="***********" aria-label="Password" data-msg="Please enter your Password here." data-error-class="u-has-error" data-success-class="u-has-success">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End Input -->
                                        </div>
                                        <div class="d-md-flex">
                                            <button type="submit" 
                                                class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </main>


@endsection