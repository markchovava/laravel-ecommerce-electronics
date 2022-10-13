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
                                @if(!empty($product->categories) )
                                <li class="flex-shrink-0 flex-xl-shrink-1">
                                    @foreach($product->categories as $_data)
                                    <a class="text-gray-5" href="{{ (!empty($_data->id)) ? route('category.view', $_data->id) : '#'}}">,
                                         {{ $_data->name }}
                                    </a>
                                    @endforeach
                                </li>
                                @endif
                                &nbsp; > &nbsp;
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ !empty($product->name) ? $product->name : '' }}</li>
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
                                    <img class="img-fluid" style="object-fit:contain; width:100%; aspect-ratio:5/4;" 
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
                                    @if(!empty($product->categories) )
                                    @foreach($product->categories as $_data)
                                    <a class="text-gray-5" href="{{ (!empty($_data->id)) ? route('category.view', $_data->id) : '#'}}">,
                                         {{ $_data->name }}
                                    </a>
                                    @endforeach
                                    @endif
                                    <h2 class="font-size-25 text-lh-1dot2">{!! !empty($product->name) ? $product->name : ""  !!}</h2>
                                    <input type="hidden" name="product_id" value="{{ !empty($product->id) ? $product->id : '' }}" class="product__id">
                                
                                    <div class="d-md-flex align-items-center">
                                        @if( !empty($product->brands) )
                                        @foreach($product->brands as $_data)
                                        <a href="{{ (!empty($_data->id)) ? route('brand.view', $_data->id) : '#' }}" 
                                        class=" ml-n2 mb-2 mb-md-0 d-block"
                                        style="margin-right:0.5rem;">
                                            <img class="img-fluid" style="width:auto; height:30px !important;" src="{{ (!empty($_data->image)) ? '/storage/products/brand/' . $_data->image : '/storage/products/no_image.jpg' }}" alt="Image Description">
                                        </a>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="text-gray-9 font-size-14 mb-3">Availability: 
                                        @if( intval($product->inventories->in_store_quantity) < 10 && intval($product->inventories->in_store_quantity) != 0)
                                            <span class="text-warning font-weight-bold">
                                                {{ $product->inventories->in_store_quantity }}, Low in Stock</span>
                                            </span>
                                        @elseif(intval($product->inventories->in_store_quantity) == 0)
                                            <span class="text-red font-weight-bold">
                                                {{ $product->inventories->in_store_quantity }} Not in Stock</span>
                                            </span>
                                        @else
                                            <span class="text-green font-weight-bold">
                                                {{ $product->inventories->in_store_quantity }}</span>
                                            </span>
                                        @endif
                                    
                                        <input type="hidden" name="in_store_quantity" value="{{ !empty($product->inventories) ? $product->inventories->in_store_quantity : '' }}">
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                    
                                </div>
                                <div class="mb-2">
                                    {!! !empty($product->short_description) ? : '' !!}
                                    </ul>
                                </div>
                    
                                <p><strong>SKU</strong>: {{ !empty($product->sku ) ? : '' }}</p>
                                @if(!empty($product->price))
                                <div class="mb-4 pricing">
                                    <div class="d-flex align-items-baseline">
                                        <ins class="font-size-36 text-decoration-none">
                                            @php
                                                $price = $product->price / 100;
                                            @endphp
                                            <span class="price__number">
                                                ${{ number_format((float)$price, 2, '.', '') }}
                                            </span>
                                            <input type="hidden" name="product_price" value="{{ $product->price }}" class="product__price">
                                        </ins>
                                    </div>
                                   
                                </div>
                                @endif
                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-size-14 mb-0">Options</h6>
                                        <!-- Select -->
                                        <select name="product_variation" class="js-select selectpicker dropdown-select ml-3"
                                            data-style="btn-sm bg-white font-weight-normal py-2 border">
                                            <option value="">Select an option.</option>
                                            @if($variations)
                                            @foreach($variations as $variation)
                                                <option value="{{ $variation->name }}: {{ $variation->value }}" >
                                                    {{ $variation->name }}: {{ $variation->value }}
                                                </option>
                                            @endforeach
                                            @endif
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
                                                    <input type="number" name="product_quantity" value="0" class="js-result product__quantity form-control h-auto border-0 rounded p-0 shadow-none">
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
                                        <button type="button" href="{{ route('quote.add') }}" class="btn add__pageQuoteBtn px-5 btn-secondary-dark transition-3d-hover">
                                            <i class="ec ec-compare mr-1 font-size-15"></i>
                                            Add to Quote
                                        </button>
                                    </div>
                                    <div class="ml-md-3">
                                        @if(intval($product->inventories->in_store_quantity) == 0)
                                        <input type="submit" onclick="return false;" value="Add to Cart" class=" btn px-5 btn-primary-dark transition-3d-hover">
                                            <!-- <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</button> -->
                                        <script>
                                            $('input[value="Add to Cart"]').click(() => (
                                                alert('Not in stock')
                                            ));
                                        </script>
                                        @else
                                            <input type="submit" value="Add to Cart" class=" btn px-5 btn-primary-dark transition-3d-hover">
                                        @endif
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
                                <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">
                                    Specification
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            <div class="tab-pane fade  active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pt-lg-8 pt-xl-10">
                                            <h3 class="font-size-24 mb-3">Description</h3>
                                            <p><p>{!! (!empty($product->description)) ? $product->description : '' !!}</p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <img class="img-fluid mr-n4 mr-lg-n10" style="object-fit:contain; width:100%; aspect-ratio:5/4;"
                                        src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }}" alt="Image Description">
                                    </div>
                                    
                                </div>
                                <ul class="nav flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>SKU:</strong> <span class="sku">{{ ( !empty($product->sku) ) ? : '' }}</span></li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1">
                                        <strong>Category:</strong> 
                                        @if(!empty($product->categories))
                                        @foreach( $product->categories as $category)
                                        <a href="{{ route('category.view', $category->id) }}" class="text-blue">{{ $category->name }}</a> |
                                        @endforeach
                                        @endif
                                    </li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1">
                                        <strong>Tags:</strong> 
                                        @if(!empty($product->tags))
                                            @foreach( $product->tags as $tag)
                                            <a href="{{ route('tag.view', $tag->id) }}" class="text-blue">{{ $tag->click_name }}</a> |
                                            @endforeach
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                                <div class="mx-md-5 pt-1">
                                    <h3 class="font-size-18 mb-4">All Specifications</h3>
                                    <div class="table-responsive">
                                        @if(!empty($specifications))
                                        <table class="table table-hover">
                                            <tbody>
                                                @foreach($specifications as $specification)
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">{{ $specification->name }}</th>
                                                    <td class="border-top-0">{{ $specification->value }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
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
                        <h3 class="section-title mb-0 pb-2 font-size-22">Trending Products</h3>
                    </div>
                    @if(!empty($trending_products) )
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($trending_products as $product)
                        <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="card product__item">
                                <div class="mb-2">
                                    @foreach($product->categories as $_data)
                                    <a href="{{ !empty($_data->id) ? route('category.index', $_data->id) : '#' }}" class="font-size-12 text-gray-5">
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
                                                $price = intval($product->price) / 100;
                                            @endphp
                                            $<span class="price__number">{{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $product->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class=" prodcut-add-cart">
                                            <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                            id="{{ $product->id }}"><i class="ec ec-add-to-cart"></i></a>
                                        </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    
                                </div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                    @endif
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

      