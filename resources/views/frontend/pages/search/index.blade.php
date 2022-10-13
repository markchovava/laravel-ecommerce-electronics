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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                            <a href="{{ route('product.search') }}">Search</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
                        <li><div class="dropdown-title">Browse Categories</div></li>
                        @foreach($all_categories_names as $cat)
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="{{ route('category.view', $cat->id) }}">
                                {{ $cat->name }}
                                <span class="text-gray-25 font-size-12 font-weight-normal"> ({{ count($cat->products) }}) </span>
                            </a>    
                        </li>
                        @endforeach
                    </ul>
                    <!-- End List -->
                </div>
                <div class="mb-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Tags</h3>
                    </div>
                    <div class="border-bottom pb-4 mb-4">
                            <!-- List -->
                        <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
                            <li><div class="dropdown-title">Browse Tags</div></li>
                            @foreach($all_tags_names as $tag)
                            <li>
                                <a class="dropdown-toggle dropdown-toggle-collapse" href="{{ route('tag.view', $cat->id) }}">
                                    {{ $tag->click_name }}<span class="text-gray-25 font-size-12 font-weight-normal"> ({{ count($tag->products) }}) </span>
                                </a>    
                            </li>
                            @endforeach
                        </ul>
                        <!-- End List -->
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="flex-center-between mb-3">
                    <h3 class="font-size-25 mb-0">All Search Results</h3>
                </div>
                <!-- End shop-control-bar Title -->
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                        <form method="post" class="min-width-50 mr-1">
                            <input size="2" min="1" max="3" step="1" type="number" class="form-control text-center px-2 height-35" value="1">
                        </form> of 3
                        <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
                    </nav>
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content pb-4 mb-4" id="pills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="pills-four-example1" role="tabpanel" aria-labelledby="pills-four-example1-tab" data-target-group="groups">
                    @if(!empty($results))
                    <ul class="d-block list-unstyled products-group prodcut-list-view-small">
                        @foreach($results as $product)
                        <li class="product__item product-item remove-divider">
                            <input type="hidden" name="csrf_token" value={{ csrf_token() }} id="csrf__token">
                            <div class="product-item__outer w-100">
                                <div class="product-item__inner remove-prodcut-hover py-4 row">
                                    <div class="product-item__header col-6 col-md-2">
                                        <div class="mb-2">
                                            <a href="" class="d-block text-center" style="width:100%; aspect-ratio:5/4; overflow:hidden;">
                                                <img class="img__fit" 
                                                src="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}" alt="Image Description"></a>
                                        </div>
                                    </div>
                                    <div class="product-item__body col-6 col-md-7">
                                        <div class="pr-lg-10">
                                            <div class="mb-2">
                                                @foreach($product->categories as $_data)
                                                <a href="{{ route('category.view',$_data->id) }}" class="font-size-12 text-gray-5">
                                                    {{ $_data->name }},
                                                </a>
                                                @endforeach
                                            </div>
                                            <h5 class="mb-2 product-item__title">
                                                <a href="{{ route('product.view', $product->id) }}" class="text-blue font-weight-bold">
                                                    {{ $product->name }}
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="product__id">
                                                </a>
                                            </h5>
                                            <div class="prodcut-price d-md-none">
                                                <div class="text-gray-100">$685,00</div>
                                            </div>
                                            <ul class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                {!! $product->description !!}
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    <div class="product-item__footer col-md-3 d-md-block">
                                        <div class="mb-2 flex-center-between">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">
                                                    @php
                                                        $price = (int)$product->price / 100;
                                                    @endphp
                                                    $<span class="price__amount">{{ number_format((float)$price, 2, '.', '') }}</span>
                                                    <input type="hidden" value="{{ $product->price }}" class="price__cents">
                                                </div>
                                            </div>
                                            <div class="prodcut-add-cart">
                                                <a href="{{ route('cart.add') }}" 
                                                    class="add__searchCartBtn btn-add-cart btn-primary transition-3d-hover">
                                                    <i class="ec ec-add-to-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div 
                                            class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                            <a href="{{ route('quote.add') }}" class="add__searchQuoteBtn text-gray-6 font-size-13 mx-wd-3">
                                                <i class="ec ec-compare mr-1 font-size-15"></i> 
                                                Add to Quote
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                        <h4>No Search Results found.</h4>
                    @endif
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                        <li class="page-item"><a class="page-link current" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div>
    </div>
    <!-- Brand Carousel -->
    <div class="mb-6">
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