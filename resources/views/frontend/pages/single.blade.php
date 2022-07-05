@extends('frontend.layouts.master')

@section('frontend')

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/')}}">Home</a></li>
                                &nbsp; > &nbsp;
                                <li class="flex-shrink-0 flex-xl-shrink-1">
                                    @foreach($product->categories as $_data)
                                    <a class="text-gray-5" href="{{ route('category.view', $_data->id) }}">,
                                         {{ $_data->name }}
                                    </a>
                                    @endforeach
                                </li>&nbsp; > &nbsp;
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $product->name}}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
            <div class="container">
                <form method="post" action="{{ route('product.cart_store') }}">
                    @csrf
                <!-- Single Product Body -->
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                                data-infinite="true"
                                data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                data-nav-for="#sliderSyncingThumb">
                                @foreach($product_images as $_data)
                                <div class="js-slide">
                                    <img class="img-fluid" style="object-fit:cover; width:100%; height:100%;" 
                                    src="{{ (!empty($_data->image)) ? url('storage/products/images/' . $_data->image) : '' }}" alt="Image Description">
                                </div>
                                @endforeach
                            </div>

                            <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                                data-infinite="true"
                                data-slides-show="5"
                                data-is-thumbs="true"
                                data-nav-for="#sliderSyncingNav">
                                @foreach($product_images as $_data)
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" 
                                    src="{{ (!empty($_data->image)) ? url('storage/products/images/' . $_data->image) : '' }}" alt="Image Description">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7 mb-md-6 mb-lg-0">
                            <div class="mb-2">
                                <div class="border-bottom mb-3 pb-md-1 pb-3">
                                    @foreach($product->categories as $_data)
                                    <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">
                                        {{ $_data->name }}
                                    </a>
                                    @endforeach
                                    <a class="text-gray-5" href="{{ route('category.view', $_data->id) }}">,
                                         {{ $_data->name }}
                                    </a>
                                    
                                    <h2 class="font-size-25 text-lh-1dot2">{!! $product->name !!}</h2>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                    <div class="d-md-flex align-items-center">
                                        @foreach($product->brands as $_data)
                                        <a href="{{ route('brand.view', $_data->id) }}" class="max-width-100 ml-n2 mb-2 mb-md-0 d-block">
                                            <img class="img-fluid" src="{{ (!empty($_data->image)) ? '/storage/products/brand/' . $_data->image : '/storage/products/no_image.jpg' }}" alt="Image Description">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-gray-9 font-size-14 mb-3">Availability: 
                                    <span class="text-green font-weight-bold">{{ $product->inventories->in_store_quantity }} in stock</span>
                                    <input type="hidden" name="in_store_quantity" value="{{ $product->inventories->in_store_quantity }}">
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                    <a href="#" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    <a href="#" class="text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> Add to Quote</a>
                                </div>
                                <div class="mb-2">
                                    {!! $product->short_description !!}
                                    </ul>
                                </div>
                                <p>{!! $product->description !!}</p>
                                <p><strong>SKU</strong>: {{ $product->sku }}</p>
                                <div class="mb-4 pricing">
                                    <div class="d-flex align-items-baseline">
                                        <del class="font-size-18 mr-2 text-gray-2">
                                            @php
                                            $price = $product->price / 100;
                                            @endphp
                                            ${{ number_format((float)$price, 2, '.', '') }}
                                        </del>
                                        <ins class="font-size-36 text-decoration-none">
                                            @php
                                                $discount = ($product->discounts->discount_percent / 100) * $product->price;
                                                $discount_price = $product->price - $discount;
                                                $price = $discount_price / 100;
                                            @endphp
                                            <span class="price__number">
                                                ${{ number_format((float)$price, 2, '.', '') }}
                                            </span>
                                        </ins>
                                        <input type="hidden" name="product_price" value="{{ $discount_price }}">
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <del class="font-size-18 mr-2 text-gray-2">
                                            @php
                                            $zwl_price = $product->zwl_price / 100;
                                            @endphp
                                            ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
                                        </del>
                                        <ins class="font-size-36 text-decoration-none">
                                            @php
                                                $discount = ($product->discounts->discount_percent / 100) * $product->zwl_price ;
                                                $discount_price = $product->zwl_price - $discount;
                                                $zwl_price = $discount_price / 100;
                                            @endphp
                                            <span class="price__number">
                                                ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
                                            </span>
                                        </ins>
                                        <input type="hidden" name="product_zwl_price" value="{{ $discount_price }}">
                                    </div>
                                </div>
                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-size-14 mb-0">Options</h6>
                                        <!-- Select -->
                                        <select name="product_variation" class="js-select selectpicker dropdown-select ml-3"
                                            data-style="btn-sm bg-white font-weight-normal py-2 border">
                                            @foreach($variations as $variation)
                                                <option value="{{ $variation->name }}: {{ $variation->value }}" >
                                                    {{ $variation->name }}: {{ $variation->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                </div>
                                <div id="lower__bodyArea" class="d-md-flex align-items-end mb-3">
                                    <div class="max-width-150 mb-4 mb-md-0">
                                        <h6 class="font-size-14">Quantity</h6>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-2 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input type="text" name="product_quantity" value="1" class="js-result form-control h-auto border-0 rounded p-0 shadow-none">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </div>
                                    <div class="ml-md-3">
                                        <input type="submit" value="Add to Cart" class=" btn px-5 btn-primary-dark transition-3d-hover">
                                            <!-- <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</button> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Product Body -->
                </form>
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">Accessories</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Description</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                                <div class="row no-gutters">
                                    <div class="col mb-6 mb-md-0">
                                        <ul class="row list-unstyled products-group no-gutters border-bottom border-md-bottom-0">
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down border-0">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center">
                                                                    <img class="img-fluid" style="object-fit:cover; width:100%; height:100%;" src="{{ asset('frontend/assets/images/212x200/1.png') }}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center">
                                                                    <img class="img-fluid" style="object-fit:cover; width:100%; height:100%;" src="{{ asset('frontend/assets/images/212x200/1.png') }}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price d-flex align-items-center position-relative">
                                                                    <ins class="font-size-20 text-red text-decoration-none">$1999,00</ins>
                                                                    <del class="font-size-12 tex-gray-6 position-absolute bottom-100">$2 299,00</del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down remove-divider">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center">
                                                                    <img class="img-fluid" style="object-fit:cover; width:100%; height:100%;" src="{{ asset('frontend/assets/images/212x200/1.png') }}"alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" value="" id="inlineCheckbox1" checked disabled>
                                            <label class="form-check-label mb-1" for="inlineCheckbox1">
                                                <strong>This product: </strong> Ultra Wireless S50 Headphones S50 with Bluetooth - <span class="text-red font-size-16">$35.00</span>
                                            </label>
                                        </div>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                            <label class="form-check-label mb-1 text-blue" for="inlineCheckbox2">
                                                <span class="text-decoration-on cursor-pointer-on">Universal Headphones Case in Black</span> - <span class="text-red font-size-16">$159.00</span>
                                            </label>
                                        </div>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2" checked>
                                            <label class="form-check-label mb-1 text-blue" for="inlineCheckbox3">
                                                <span class="text-decoration-on cursor-pointer-on">Headphones USB Wires</span> - <span class="text-red font-size-16">$50.00</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mr-xl-15">
                                            <div class="mb-3">
                                                <div class="text-red font-size-26 text-lh-1dot2">$244.00</div>
                                                <div class="text-gray-6">for 3 item(s)</div>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">Add all to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pt-lg-8 pt-xl-10">
                                            <h3 class="font-size-24 mb-3">{{ $product->type }}</h3>
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <img class="img-fluid mr-n4 mr-lg-n10" style="object-fit:cover; width:100%; height:100%;" 
                                        src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }}" alt="Image Description">
                                    </div>
                                    
                                </div>
                                <ul class="nav flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>SKU:</strong> <span class="sku">{{ $product->sku }}</span></li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1">
                                        <strong>Category:</strong> 
                                        @foreach( $product->categories as $category)
                                        <a href="#" class="text-blue">{{ $category->name }}</a>,
                                        @endforeach
                                    </li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1">
                                        <strong>Tags:</strong> 
                                        @foreach( $product->tags as $tag)
                                        <a href="#" class="text-blue">{{ $tag->name }}</a>,
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                                <div class="mx-md-5 pt-1">
                                    <div class="table-responsive mb-4">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">Weight</th>
                                                    <td class="border-top-0">7.25kg</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Dimensions</th>
                                                    <td>90 x 60 x 90 cm</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Size</th>
                                                    <td>One Size Fits all</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">color</th>
                                                    <td>Black with Red, White with Gold</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Guarantee</th>
                                                    <td>5 years</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3 class="font-size-18 mb-4">Technical Specifications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">Brand</th>
                                                    <td class="border-top-0">Apple</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Height</th>
                                                    <td>18 Millimeters</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Width</th>
                                                    <td>31.4 Centimeters</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Screen Size</th>
                                                    <td>13 Inches</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Weight</th>
                                                    <td>1.6 Kg</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Product Dimensions</th>
                                                    <td>21.9 x 31.4 x 1.8 cm</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item model number</th>
                                                    <td>MF841HN/A</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Brand</th>
                                                    <td>Intel</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Type</th>
                                                    <td>Core i5</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Speed</th>
                                                    <td>2.9 GHz</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">RAM Size</th>
                                                    <td>8 GB</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hard Drive Size</th>
                                                    <td>512 GB</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hard Disk Technology</th>
                                                    <td>Solid State Drive</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Graphics Coprocessor</th>
                                                    <td>Intel Integrated Graphics</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Graphics Card Description</th>
                                                    <td>Integrated Graphics Card</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hardware Platform</th>
                                                    <td>Mac</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Operating System</th>
                                                    <td>Mac OS</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Average Battery Life (in hours)</th>
                                                    <td>9</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->

                <!-- Related products -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($trending_products as $product)
                        <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="card product__item">
                                <div class="mb-2">
                                    @foreach($product->categories as $_data)
                                    <a href="{{ route('category.index', $_data->id) }}" class="font-size-12 text-gray-5">
                                        {{ $_data->name }},
                                    </a>
                                    @endforeach
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $product->id) }}" class="text-blue font-weight-bold">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }}" alt="Card image cap">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                                $price_cents = $product->price / 100;
                                            @endphp
                                            $<span class="price__number">{{ number_format((float)$price_cents, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $product->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" 
                                            class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                            id="{{ $product->id }}">
                                                <i class="ec ec-add-to-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $product->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </div>
                <!-- End Related products -->

                <!-- Brand Carousel -->
                <div class="mb-8">
                    <div class="py-2 border-top border-bottom">
                        <div class="js-slick-carousel u-slick my-1"
                            data-slides-show="5"
                            data-slides-scroll="1"
                            data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                            data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                            data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                            data-responsive='[{
                                "breakpoint": 992,
                                "settings": {
                                    "slidesToShow": 2
                                }
                            }, {
                                "breakpoint": 768,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }, {
                                "breakpoint": 554,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }]'>
                             @foreach($brands as $brand)
                                <div class="js-slide">
                                    <a href="{{ route('brand.view', $brand->id) }}" class="link-hover__brand">
                                        <div style="width:200px; height:60px; object-fit:contain;">
                                            <img class="img-fluid m-auto max-height-50" 
                                            src="{{ (!empty($brand->image)) ? url('storage/products/brand/' . $brand->image) : url('storage/products/no_image.jpg') }}" alt="Image Description">
                                        </div>        
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- End Brand Carousel -->
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

@endsection

      