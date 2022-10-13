@extends('frontend.layouts.master')

@section('frontend')


 <!-- ========== MAIN CONTENT ========== -->
 <main id="content" role="main" class="cart-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Quote</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">Quote</h1>
        </div>
        <form class="mb-4" action="{{ route('quote.store') }}" method="post">
            @csrf
            <div class="mb-10 cart-table">
                @if(isset( $items))
                <table class="table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity w-lg-15">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $product)     
                        <tr class="product__item" id="{{ $product->id }}">
                            <td class="text-center">
                                <a href="{{ route('quote.delete', $product->id) }}" id="remove__btnInCart" class="text-gray-32 font-size-26">×</a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="{{ route('product.view', $product->product_id) }}"><img class="img-fluid max-width-100 p-1 border border-color-1" 
                                src="{{ (!empty($product->product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product->product_thumbnail) : url('storage/products/no_image.jpg') }}" 
                                alt="{{ $product->product->name }}"></a>
                            </td>

                            <td data-title="Product">
                                <a href="{{ route('product.view', $product->product_id) }}" class="text-gray-90">
                                    {{ $product->product->name }}
                                </a> <br>
                                    <span style="font-size:0.8rem;">
                                        <b>Quantity in Stock:</b>
                                        @php
                                        $product_quantity = $product->product->inventories->in_store_quantity;
                                        @endphp
                                        @if( $product_quantity == 0 )
                                            @php
                                            $quantity = 0;
                                            @endphp
                                        @else 
                                            @php
                                            $quantity = $product_quantity;
                                            @endphp
                                        @endif
                                        <span class="quantity__instore text-danger">{{ $quantity }}</span>
                                        <input type="hidden" value="{{ $quantity }}" class="db__quantity">
                                        <input type="hidden" name="in_store_quantity[]" value="{{ $quantity }}" class="quantity__submit">
                                    </span>
                                <input type="hidden" value="{{ $product->product_id }}" name="product_id[]">
                            </td>
                            <td data-title="Price">
                                @php
                                    $discount = ($product->product->discounts->discount_percent / 100) * $product->product->price;
                                    $discount_price = $product->product->price - $discount;
                                    $price = $discount_price  / 100;
                                @endphp
                                $<span class="price__number">{{ number_format((float)$price, 2, '.', '') }}</span>
                                <input type="hidden" name="price__cents[]" value="{{ $discount_price }}" class="price__cents">
                            </td>
                            <td data-title="Quantity">
                                <span class="sr-only">Quantity</span>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                    <div class="js__quantity row align-items-center">
                                        <div class="col">
                                            <input name="product_quantity[]" class="product__quantity form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="{{ $product->quantity }}">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="quantity-minus js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="quantity-add js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </td>
                            <td data-title="Total">
                                @php
                                $product_totalCents = $discount_price * $product->quantity;
                                $total_price = $product_totalCents / 100;
                                @endphp
                                $<span class="product__total">{{ number_format((float)$total_price, 2, '.', '') }}</span>
                                <input type="hidden" name="product_totalCents" value="{{ $product_totalCents }}" class="product__totalCents">
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td colspan="6" class="border-top space-top-2 justify-content-center">
                                <div class="pt-md-3">
                                    <div class="d-block d-md-flex flex-center-between">
                                        <div class="mb-3 mb-md-0 w-xl-40">
                                        </div>
                                        
                                        <div class="d-md-flex">
                                            <input type="submit" 
                                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block"
                                            value="Get Quote">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                <h4 class="text-secondary" style="text-align:center;">
                    {{ isset($message) ? $message : '' }}
                </h4>
                @endif
            </div>
            <div class="mb-8 cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                        <div class="border-bottom border-color-1 mb-3">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Quote Total</h3>
                        </div>
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td data-title="Subtotal">
                                        <span class="quote__subtotal">0</span>
                                        <input type="hidden" name="quote_subtotalCents" value="0" class="quote__subtotalCents">
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>Shipping Fee (Around Harare)</th>
                                    <td data-title="Shipping">
                                        Flat Fee: <span class="shipping__fee">
                                            @php
                                            $fee = $shipping->fee / 100
                                            @endphp
                                            {{ number_format((float)$fee, 2, '.', '') }}
                                        </span>
                                        <input type="hidden" name="shipping_feeCents" value="{{ $shipping->fee }}" class="shipping__feeCents">
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total (USD$)</th>
                                    <td data-title="Total">
                                        <strong>$<span class="quote__total">00</span></strong>
                                        <input type="hidden" name="quote_totalCents" class="quote__totalCents">
                                    </td>
                                </tr>
                                <tr class="order-zwltotal">
                                    <th>Total (ZWL$)</th>
                                    <td data-title="Total">
                                        <strong>$<span class="quote__zwltotal">00</span></strong>
                                        <input type="hidden" name="quote_zwl" value="{{ $currency->value }}" class="quote__zwl">
                                        <input type="hidden" name="quote_zwltotalCents" class="quote__zwltotalCents">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-md-flex" style="float:right; margin-top:1.5rem;">
                            <input type="submit" 
                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block"
                            value="Get Qoute">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


<script>
    /* Calculate Subtotal Total */
    let cart_subtotalCentsInsert = $('.quote__subtotalCents');
    let cart_subtotalInsert = $('.quote__subtotal'); 
    let products_totalInCents = new Array();
    $('.product__totalCents').each((i, item) => {
        products_totalInCents.push(item.value);
    }); 
    let cart_subtotalCents = products_totalInCents.reduce((a, b) => Number(a) + Number(b));
    let cart_subtotalCalculate = cart_subtotalCents / 100;
    let cart_subtotalDecimal = cart_subtotalCalculate.toFixed(2);
    cart_subtotalInsert.text(cart_subtotalDecimal);
    cart_subtotalCentsInsert.val(cart_subtotalCents);
    /* 
    *   Calculate Cart Total
    */ 
    let cart_totalCentsInsert = $('.quote__totalCents');
    let cart_totalInsert = $('.quote__total');
    let shipping_feeCents = $('.shipping__feeCents').val();
    let shipping_feeCentsNumber = Number(shipping_feeCents);
    /* 
    *   Calculate Total
    */
    let cart_totalCentsCalculate = Number(cart_subtotalCents) + shipping_feeCentsNumber;
    let cart_totalCalculate = cart_totalCentsCalculate / 100;
    let cart_totalDecimal = cart_totalCalculate.toFixed(2);
    cart_totalCentsInsert.val(cart_totalCentsCalculate);
    cart_totalInsert.text(cart_totalDecimal);

    /* 
    *   Zim Dollar Coversion
    */
    let cart_zwltotalCentsInsert = $('.quote__zwltotalCents');
    let cart_zwltotalInsert = $('.quote__zwltotal');
    let cart_zwltotalCents = cart_totalCentsCalculate * 500;
    let cart_zwltotalCalculate = cart_zwltotalCents / 100;
    let cart_zwltotalCentsDecimal = cart_zwltotalCalculate.toFixed(2);
    cart_zwltotalInsert.text(cart_zwltotalCentsDecimal);
    cart_zwltotalCentsInsert.val(cart_zwltotalCents);

    /* Restrict user form typing  */
    $('.product__quantity').keydown(() => {
        return false;
    });

    $('.quantity-add').click(function(e){  
        e.preventDefault();
        let product_quantity = $(this).closest('.js__quantity').find('.product__quantity');
        let quantity_instoreInsert = $(this).closest('.product__item').find('.quantity__instore');
        let quantity_submit = $(this).closest('.product__item').find('.quantity__submit');
        let quantity_instore = Number(quantity_instoreInsert.text());
        let db_quantity = $(this).closest('.product__item').find('.db__quantity');
        let db_quantityNumber = Number(db_quantity.val());
        let quantityNumber = Number(product_quantity.val());
        if(quantity_instore != 0 || quantity_instore != false){
            let deduct_instore = db_quantityNumber - quantityNumber;
            let quantity_add = quantityNumber + 1;
            //if(){}
            product_quantity.val(quantity_add);
            quantity_instoreInsert.text(deduct_instore);
            quantity_submit.val(deduct_instore);
        }
        
    });
    $('.quantity-minus').click(function(e){  
        e.preventDefault();
        let product_quantityInsert = $(this).closest('.js__quantity').find('.product__quantity');
        let quantity_instoreInsert = $(this).closest('.product__item').find('.quantity__instore');
        let quantity_submit = $(this).closest('.product__item').find('.quantity__submit');
        let product_quantity = product_quantityInsert.val();
        let product_quantityNumber = Number(product_quantity);
        let quantity_instoreNumber = Number(quantity_instoreInsert.text());
        let db_quantity = $(this).closest('.product__item').find('.db__quantity');
        let db_quantityNumber = Number(db_quantity.val());
        if(product_quantityNumber > 0){
            //alert(product_quantityNumber)
            let quantity_minus = product_quantityNumber - 1;  
            let add_quantityInStore = quantity_instoreNumber + 1;
            product_quantityInsert.val(quantity_minus);
            quantity_instoreInsert.text(add_quantityInStore);
            quantity_submit.val(add_quantityInStore);
        }
        /* let quantity = product_quantity.val();
        let quantity_minus = Number(quantity) - 1;
        if(quantity_minus >= 0){
            product_quantity.val(quantity_minus);
            //console.log(product_quantity.val())
        } */
    });
    $(document).on('click', '.quantity-minus, .quantity-add', function(e){  
        e.preventDefault();
        /* Calculate Product Total */ 
        let product_quantity = $(this).closest('.js__quantity').find('.product__quantity').val();
        let quantity_number = Number(product_quantity);
        let price_cents = $(this).closest('.product__item').find('.price__cents').val();
        let price_number = Number(price_cents);
        let product_totalCentsInsert = $(this).closest('.product__item').find('.product__totalCents');
        let product_total = $(this).closest('.product__item').find('.product__total');
        let total_cents = price_number * quantity_number;
        let total_price = total_cents / 100;
        let price_decimal = total_price.toFixed(2);
        product_totalCentsInsert.val(total_cents);
        product_total.text(price_decimal);
        /* Calculate Cart Total */
        let cart_subtotalCentsInsert = $('.quote__subtotalCents');
        let cart_subtotal = $('.quote__subtotal');
        let products_totalInCents = new Array();
        $('.product__totalCents').each((i, item) => {
            products_totalInCents.push(item.value);
        }); 
        // console.log(products_totalInCents)
        let cart_subtotalCents = products_totalInCents.reduce((a, b) => Number(a) + Number(b));
        //alert(cart_subtotalCents)
        let cart_subtotalCalculate = cart_subtotalCents / 100;
        let cart_subtotalDecimal = cart_subtotalCalculate.toFixed(2);
        // alert(cart_subtotalDecimal)
        cart_subtotal.text(cart_subtotalDecimal);
        // console.log(cart_subtotal)
        cart_subtotalCentsInsert.val(cart_subtotalCents);
        // Calculate Cart Total
        let cart_totalCentsInsert = $('.quote__totalCents');
        let cart_totalInsert = $('.quote__total');
        let shipping_feeCents = $('.shipping__feeCents').val();
        let shipping_feeCentsNumber = Number(shipping_feeCents);
        let cart_totalCentsCalculate = Number(cart_subtotalCents) + shipping_feeCentsNumber;
        let cart_totalCalculate = cart_totalCentsCalculate / 100;
        let cart_totalDecimal = cart_totalCalculate.toFixed(2);
        cart_totalCentsInsert.val(cart_totalCentsCalculate);
        cart_totalInsert.text(cart_totalDecimal);
        /* 
        *   Zim Dollar Coversion
        */
        let cart_zwl = $('.quote__zwl').val();
        let cart_zwlNumber = Number(cart_zwl);
        let cart_zwltotalCentsInsert = $('.quote__zwltotalCents');
        let cart_zwltotalInsert = $('.quote__zwltotal');
        let cart_zwltotalCents = cart_totalCentsCalculate * cart_zwlNumber;
        let cart_zwltotalCalculate = cart_zwltotalCents / 100;
        let cart_zwltotalCentsDecimal = cart_zwltotalCalculate.toFixed(2); // Convert to Decimals
        cart_zwltotalInsert.text(cart_zwltotalCentsDecimal); // Display Decimals
        cart_zwltotalCentsInsert.val(cart_zwltotalCents);

    });

     /* Edit Cart Page */
     $(document).on('click', '#remove__btnInCart', function(e){  
        e.preventDefault();
        let product_itemRow = $(this).closest('.product__item');
        let product_id =  $(this).closest('.product__item').attr('id');
        let product_IdNumber = Number(product_id);
        let delete_route = $(this).attr('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: delete_route,
            method: "GET",
            dataType: "json",
            data: {},
            success: function(result){
                console.log(result);
                if(result){
                    product_itemRow.remove();
                }            
            }
        });
        //product_itemRow.remove();
    });
</script>





@endsection