@extends('frontend.layouts.master')

@section('frontend')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
<input type="hidden" name="_token" id="csrf__token" value="{{ csrf_token() }}">

    <!-- Slider Section -->
    <div class="mb-5">
        <div class="bg-img-hero" style="background-image: url({{ asset('frontend/assets/images/1920x714/bg-2.png') }});">
            <div class="container">
                <div class="mb-6 pt-3">
                    <div class="row align-items-end">
                        <div class="col">
                            <!-- Tab Content -->
                            <div class="tab-content">
                                @if($tag_first)
                                <div class="tab-pane fade show active" id="pills-one-code-features" role="tabpanel" aria-labelledby="pills-one-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-36 ">{!! strtoupper($tag_first->title) !!}</span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_first->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    @if( !empty($tag_first->amount) )
                                                    <sup class="font-size-36">$</sup>
                                                    @php
                                                    $first_amount = $tag_first->amount / 100
                                                    @endphp
                                                    {{ number_format((float)$first_amount, 2, '.', '') }}
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @else
                                                    <sup class="font-size-36"></sup>
                                                    {{ $tag_first->percent }}%
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_first->image)) ? url('storage/tags/' . $tag_first->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-two-code-features" role="tabpanel" aria-labelledby="pills-two-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($tag_second)
                                <div class="tab-pane fade" id="pills-two-code-features" role="tabpanel" aria-labelledby="pills-two-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-36">{!! $tag_second->title !!}</span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_second->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    @if( !empty($tag_second->amount) )
                                                    <sup class="font-size-36">$</sup>
                                                    @php
                                                    $amount = $tag_second->amount / 100
                                                    @endphp
                                                    {{ number_format((float)$amount, 2, '.', '') }}
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @else
                                                    <sup class="font-size-36"></sup>
                                                    {{ $tag_second->percent }}%
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_second->image)) ? url('storage/tags/' . $tag_second->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-two-code-features" role="tabpanel" aria-labelledby="pills-two-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($tag_third)
                                <div class="tab-pane fade" id="pills-three-code-features" role="tabpanel" aria-labelledby="pills-three-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                <span class="d-block font-size-36">{!! $tag_third->title !!}</span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_third->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    <sup class="font-size-36"></sup>
                                                    @php
                                                    $percent = $tag_third->percent / 100
                                                    @endphp
                                                    {{ number_format((float)$percent, 2, '.', '') }}%<sub class="font-size-16">OFF!</sub>
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_third->image)) ? url('storage/tags/' . $tag_third->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-three-code-features" role="tabpanel" aria-labelledby="pills-three-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($tag_forth)
                                <div class="tab-pane fade" id="pills-four-code-features" role="tabpanel" aria-labelledby="pills-four-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-36">{!! strtoupper($tag_forth->title) !!}</span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_forth->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    @if( !empty($tag_forth->amount) )
                                                    <sup class="font-size-36">$</sup>
                                                    @php
                                                    $amount = $tag_forth->amount / 100
                                                    @endphp
                                                    {{ number_format((float)$amount, 2, '.', '') }}
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @else
                                                    <sup class="font-size-36"></sup>
                                                    {{ $tag_forth->percent }}%
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_forth->image)) ? url('storage/tags/' . $tag_forth->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-four-code-features" role="tabpanel" aria-labelledby="pills-four-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($tag_fifth)
                                <div class="tab-pane fade" id="pills-five-code-features" role="tabpanel" aria-labelledby="pills-five-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-36">
                                                    {!! ($tag_fifth->title) ? strtoupper($tag_fifth->title) : 'No title' !!}
                                                </span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_fifth->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    @if( !empty($tag_fifth->amount) )
                                                    <sup class="font-size-36">$</sup>
                                                    @php
                                                    $amount = $tag_fifth->amount / 100
                                                    @endphp
                                                    {{ number_format((float)$amount, 2, '.', '') }}
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @else
                                                    <sup class="font-size-36"></sup>
                                                    {{ $tag_fifth->percent }}%
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_fifth->image)) ? url('storage/tags/' . $tag_fifth->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-five-code-features" role="tabpanel" aria-labelledby="pills-five-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($tag_sixth)
                                <div class="tab-pane fade" id="pills-six-code-features" role="tabpanel" aria-labelledby="pills-six-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-36 ">{!! (!empty($tag_sixth->title)) ? strtoupper($tag_sixth->title) : 'No info' !!}</span>
                                            </h1>
                                            <div class="mb-6"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <span class="font-size-15 font-weight-bold">{!! $tag_sixth->subtitle !!}</span>
                                                <span class="font-size-55 font-weight-bold text-lh-45">
                                                    @if( !empty($tag_sixth->amount) )
                                                    <sup class="font-size-36">$</sup>
                                                    @php
                                                    $amount = $tag_sixth->amount / 100
                                                    @endphp
                                                    {{ number_format((float)$amount, 2, '.', '') }}
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @else
                                                    <sup class="font-size-36"></sup>
                                                    {{ $tag_sixth->percent }}%
                                                    <sub class="font-size-16">OFF!</sub>
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="#" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                        <div class="col-lg-7"
                                            data-scs-animation-in="zoomIn"
                                            data-scs-animation-delay="500">
                                            <img class="img-fluid rounded-lg" 
                                            src="{{ (!empty($tag_sixth->image)) ? url('storage/tags/' . $tag_sixth->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade" id="pills-six-code-features" role="tabpanel" aria-labelledby="pills-six-code-features-tab">
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <h1 class="font-size-58 text-lh-57 mb-3 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                 <span class="d-block font-size-46">
                                                    No Info
                                                </span>
                                            </h1>                                                                                       
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <div class="col-auto">
                            <!-- Features Section -->
                            <div class="bg-light max-width-216">
                                <!-- Nav -->
                                <ul class="nav nav-box-custom bg-white rounded-sm py-2" role="tablist">
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4 active" id="pills-one-code-features-tab" data-toggle="pill" href="#pills-one-code-features" role="tab" aria-controls="pills-one-code-features" aria-selected="true">
                                            <span class="font-size-14">
                                                @if($tag_first)
                                                    {{ ($tag_first->click_name) ? strtoupper($tag_first->click_name) : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4" id="pills-two-code-features-tab" data-toggle="pill" href="#pills-two-code-features" role="tab" aria-controls="pills-two-code-features" aria-selected="false">
                                            <span class="font-size-14">
                                                @if($tag_second)
                                                    {{ ($tag_second->click_name) ? strtoupper($tag_second->click_name) : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4" id="pills-three-code-features-tab" data-toggle="pill" href="#pills-three-code-features" role="tab" aria-controls="pills-three-code-features" aria-selected="false">
                                            <span class="font-size-14">
                                                @if($tag_third)
                                                {{ ($tag_third->click_name) ? $tag_third->click_name : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </h4>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4" id="pills-four-code-features-tab" data-toggle="pill" href="#pills-four-code-features" role="tab" aria-controls="pills-four-code-features" aria-selected="false">
                                            <span class="font-size-14">
                                                @if($tag_forth)
                                                {{ ($tag_forth->click_name) ? $tag_forth->click_name : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </h4>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4" id="pills-five-code-features-tab" data-toggle="pill" href="#pills-five-code-features" role="tab" aria-controls="pills-five-code-features" aria-selected="false">
                                            <span class="font-size-14">
                                                @if($tag_fifth)
                                                    {{ ($tag_fifth->click_name) ? $tag_fifth->click_name : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </h4>
                                        </a>
                                    </li>
                                    <li class="nav-item mx-0">
                                        <a class="nav-link p-2 px-4" id="pills-six-code-features-tab" data-toggle="pill" href="#pills-six-code-features" role="tab" aria-controls="pills-six-code-features" aria-selected="false">
                                            <span class="font-size-14">
                                                @if($tag_sixth)
                                                    {{ ($tag_sixth->click_name) ? $tag_sixth->click_name : 'No info' }}
                                                @else
                                                    No Info
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Nav -->
                            </div>
                            <!-- End Features Section -->
                        </div>
                    </div>
                </div>

                <!-- Trending products -->
                <section class="category__highlight position-relative" style="padding-bottom:3rem; padding-top:1rem;">
                    <div class="category__highlightCarousel owl-carousel owl-theme">
                        @if( $category_first->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_first->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_first->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_first->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($category_first->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_first->products[0]->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}" 
                                    alt="{{ $category_first->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_first->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_first->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_first->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_first->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_second->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_second->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="#" class="text-blue font-weight-bold">
                                        {{ $category_second->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($category_second->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_second->products[0]->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}" 
                                    alt="{{ $category_second->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_second->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_second->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_second->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_second->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_third->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_third->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_third->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_third->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty( $category_third->products[0]->product_thumbnail )) ? url('storage/products/thumbnail/' . $category_third->products[0]->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}" 
                                    alt="{{ $category_third->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_third->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_third->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_third->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_third->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_forth->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_forth->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_forth->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_forth->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty( $category_forth->products[0]->product_thumbnail )) ? url('storage/products/thumbnail/' . $category_forth->products[0]->product_thumbnail) : url('storage/products/thumbnail/no_image.jpg') }}" 
                                    alt="{{ $category_forth->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_forth->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_forth->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_forth->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_forth->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_fifth->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_fifth->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_fifth->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_fifth->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($category_fifth->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_fifth->products[0]->product_thumbnail) : url('storage/tags/no_image.jpg') }}" 
                                    alt="{{ $category_fifth->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_fifth->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_fifth->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_fifth->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_fifth->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_fifth->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_fifth->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="#" class="text-blue font-weight-bold">
                                        {{ $category_fifth->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($category_fifth->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_fifth->products[0]->product_thumbnail) : url('storage/tags/no_image.jpg') }}" 
                                    alt="{{ $category_fifth->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_fifth->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_fifth->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_fifth->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_fifth->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_sixth->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_sixth->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_sixth->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_sixth->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty( $category_sixth->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_sixth->products[0]->product_thumbnail) : url('storage/tags/no_image.jpg') }}" 
                                    alt="{{ $category_sixth->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_sixth->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_sixth->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" id="{{ $category_first->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_sixth->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif   
                        @if( $category_seventh->products[0] )
                            <div class="card product__item">
                                <div class="mb-2">
                                    <a href="#" class="font-size-12 text-gray-5">
                                        {{ $category_seventh->name }}
                                    </a>
                                </div>
                                <h5 class="mb-1 product-item__title">
                                    <a href="{{ route('product.view', $category_fifth->products[0]->id) }}" class="text-blue font-weight-bold">
                                        {{ $category_seventh->products[0]->name }}
                                    </a>
                                </h5>
                                <div class="img__area">
                                    <img class="card-img-top" 
                                    src="{{ (!empty($category_second->products[0]->product_thumbnail)) ? url('storage/products/thumbnail/' . $category_second->products[0]->product_thumbnail) : url('storage/tags/no_image.jpg') }}" 
                                    alt="{{ $category_second->products[0]->name }}">
                                </div>
                                <div class="flex-center-between my-3">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">
                                            @php
                                            $price = $category_seventh->products[0]->price / 100;
                                            @endphp
                                            <span class="price__number">${{ number_format((float)$price, 2, '.', '') }}</span>
                                            <input type="hidden" value="{{ $category_seventh->products[0]->price }}" class="price__cents">
                                        </div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" 
                                        id="{{ $category_seventh->products[0]->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <a href="#" id="{{ $category_seventh->products[0]->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                </div>
                            </div>
                        @endif  
                    </div>
                </section>
                <!-- End Trending products -->
                
            </div>
        </div>
    </div>
    <!-- End Slider Section -->

    <div class="container">
    
        @if( !empty($ad_first) )
        <!-- Full banner -->
        <div class="mb-8">
            <a href="#" class="d-block text-gray-90">
                <div class="bg__cover" 
                style="background-image: url({{ (!empty($ad_first->image)) ? url('storage/images/ad/' . $ad_first->image) : '' }});">
                    <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                        <div class="flex-horizontal-center mt-lg-3 mt-xl-0 overflow-auto overflow-md-visble">
                            <h1 class="text-lh-38 font-size-32 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">
                                {!! $ad_first->title !!}    
                            </h1>
                            <div class="ml-5 flex-content-center flex-shrink-0">
                                <div class="bg-primary rounded-lg px-6 py-2">
                                    <em class="font-size-14 font-weight-light">{{ strtoupper($ad_first->click_name) }}</em>
                                    <div class="font-size-30 font-weight-bold text-lh-1">
                                        @php
                                            $price = $ad_first->price / 100;
                                        @endphp
                                        <sup class="">$</sup>{{ number_format((float)$price, 2, '.', '')}}<sup class=""></sup>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- End Full banner -->
        @endif

        <!-- Categories Carousel -->
        <div class="mb-5">
            <div class="position-relative">
                <div class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                    data-arrows-classes="d-none d-xl-block u-slick__arrow-normal u-slick__arrow-centered--y rounded-circle text-black font-size-30 z-index-2"
                    data-arrow-left-classes="fa fa-angle-left u-slick__arrow-inner--left left-n16"
                    data-arrow-right-classes="fa fa-angle-right u-slick__arrow-inner--right right-n20"
                    data-pagi-classes="d-xl-none text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                    data-slides-show="10"
                    data-slides-scroll="1"
                    data-responsive='[{
                        "breakpoint": 1400,
                        "settings": {
                        "slidesToShow": 8
                        }
                    }, {
                        "breakpoint": 1200,
                        "settings": {
                            "slidesToShow": 6
                        }
                    }, {
                        "breakpoint": 992,
                        "settings": {
                        "slidesToShow": 5
                        }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                        "slidesToShow": 3
                        }
                    }, {
                        "breakpoint": 554,
                        "settings": {
                        "slidesToShow": 2
                        }
                    }]'>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-laptop font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                            </div>
                        </a>
                    </div> 
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-smartwatch font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Smart Watch</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-gamepad font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Game Joy stick</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-headphones font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Headphones</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-tvs font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">LED TV</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-drone font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Drone</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-cameras font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">DSLR Camera</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-speaker font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Audio Speakers</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-smartphones font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Smartphones</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-laptop font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-cameras font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">DSLR Camera</h6>
                            </div>
                        </a>
                    </div>
                    <div class="js-slide">
                        <a href="#" class="d-block text-center bg-on-hover width-122 mx-auto">
                            <div class="bg pt-4 rounded-circle-top width-122 height-75">
                                <i class="ec ec-gamepad font-size-40"></i>
                            </div>
                            <div class="bg-white px-2 pt-2 width-122">
                                <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Game Joy stick</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Categories Carousel -->

        <!-- Catch Daily Deals! -->
        <section id="hot-deals" class="mb-4">
            <div class="container-fluid">
                <div class="mb-2 d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Daily Hot Deals</h3>
                    <a class="d-block text-gray-16" href="#">Go to Daily Hot Deals <i class="ec ec-arrow-right-categproes"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-4 px-4 py-2">
                        <!-- Deal -->
                        <div id="on__offer" class="on__offer p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370">
                            <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                                <h3 class="font-size-22 mb-0 font-weight-normal text-lh-28">Special Offer</h3>
                                <div class="d-flex align-items-center flex-column justify-content-center bg-primary rounded-pill height-75 width-75 text-lh-1">
                                    <span class="font-size-12">Save</span>
                                    <div class="font-size-20 font-weight-bold">
                                        {{ $special_offer->discounts->discount_percent }}%
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="d-block text-center">
                                    <div class="img__area">
                                        <img class="img-fluid" 
                                        src="{{ (!empty($special_offer->product_thumbnail)) ? url('storage/products/thumbnail/' . $special_offer->product_thumbnail) : url('storage/products/no_image.jpg') }}" alt="Image Description">
                                    </div>
                                </a>
                            </div>
                            <h5 class="mb-2 font-size-14 text-center mx-auto text-lh-18">
                                <a href="#" class="text-blue font-weight-bold">
                                {{ $special_offer->name }}
                                </a>
                            </h5>
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <del class="font-size-18 mr-2 text-gray-2">
                                    @php
                                    $price = $special_offer->price / 100
                                    @endphp
                                    ${{ number_format((float)$price, 2, '.', '') }}
                                </del>
                                <ins class="font-size-30 text-red text-decoration-none">
                                    @php
                                    $discount_percent = $special_offer->discounts->discount_percent / 100;
                                    $discount = $special_offer->price * $discount_percent;
                                    $price_cents = $special_offer->price - $discount;
                                    $price = $price_cents / 100;
                                    @endphp
                                    ${{ number_format((float)$price, 2, '.', '') }}
                                </ins>
                            </div>
                            <div class="mb-3 mx-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="">Available: <strong>{{ $special_offer->inventories->in_store_quantity}}</strong></span>  
                                </div>
                                
                            </div>
                            <div class="mb-2 mx-2 d-xl-flex align-items-xl-center justify-content-xl-between">
                                <h6 class="font-size-15 text-gray-2 text-center text-xl-left mb-3 mb-xl-0 max-width-100-xl">
                                    Hurry Up! Offer ends in:
                                </h6>
                                <div class="js-countdown d-flex justify-content-center"
                                    data-end-date="2022/07/30"
                                    data-days-format="%D"
                                    data-hours-format="%H"
                                    data-minutes-format="%M"
                                    data-seconds-format="%S">
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-days"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 font-weight-semi-bold text-center">DAYS</div>
                                    </div>
                                    <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-hours"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 font-weight-semi-bold text-center">HOURS</div>
                                    </div>
                                    <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-minutes"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 font-weight-semi-bold text-center">MINS</div>
                                    </div>
                                    <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-seconds"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 font-weight-semi-bold text-center">SECS</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Deal -->
                    </div>
                    <div class="col-lg-8">
                        <div class="container">
                            <div class="row">
                                @foreach($hot_products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card product__item">
                                        <div class="mb-2">
                                            <a href="{{ route('category.index', $product->categories[0]->id) }}" class="font-size-12 text-gray-5">
                                                {{ $product->categories[0]->name }}
                                            </a>
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>   
        <!-- End Catch Daily Deals! -->



        <!-- Trending products -->
        <section class="trending__products mb__2">
            <div class="mb-2 d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Trending Products</h3>
                <a class="d-block text-gray-16" href="#">Go to Trending Products <i class="ec ec-arrow-right-categproes"></i></a>
            </div>
            <div class="trending__productsCarousel owl-carousel owl-theme">
                @foreach($trending_products as $product)
                    <div class="card product__item">
                        <div class="mb-2">
                            <a href="{{ route('category.index', $product->categories[0]->id) }}" class="font-size-12 text-gray-5">
                                {{ $product->categories[0]->name }}
                            </a>
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
                                <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" id="{{ $product->id }}"><i class="ec ec-add-to-cart"></i></a>
                            </div>
                        </div>
                        <div class="border-top pt-2 flex-center-between flex-wrap">
                            <a href="#" id="{{ $product->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                            <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- End Trending products -->




        @if( !empty($ad_second) )
        <!-- Full banner -->
        <div class="mb-8">
            <a href="#" class="d-block text-gray-90">
                <div class="bg__cover" 
                style="background-image: url({{ (!empty($ad_second->image)) ? url('storage/images/ad/' . $ad_second->image) : '' }});">
                    <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                        <div class="flex-horizontal-center mt-lg-3 mt-xl-0 overflow-auto overflow-md-visble">
                            <h1 class="text-lh-38 font-size-32 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">
                                {!! $ad_second->title !!}    
                            </h1>
                            <div class="ml-5 flex-content-center flex-shrink-0">
                                <div class="bg-primary rounded-lg px-6 py-2">
                                    <em class="font-size-14 font-weight-light">{{ strtoupper($ad_second->click_name) }}</em>
                                    <div class="font-size-30 font-weight-bold text-lh-1">
                                        @php
                                            $price = $ad_second->price / 100;
                                        @endphp
                                        <sup class="">$</sup>{{ number_format((float)$price, 2, '.', '')}}<sup class=""></sup>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- End Full banner -->
        @endif





        <!-- :::::: Latest Products ::::::: -->
        <section class="latest__products mb__2">
            <div class="mb-3 d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Latest Products</h3>
                <a class="d-block text-gray-16" href="#">Go to Latest Products <i class="ec ec-arrow-right-categproes"></i></a>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="img__area">
                            <img src="{{ (!empty($tag_second->image)) ? url('storage/tags/' . $tag_second->image) : url('storage/tags/no_image.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="latest__productsCarousel owl-carousel owl-theme">
                                @foreach($latest_products as $product)
                                <div class="card product__item">
                                    <div class="mb-2">
                                        <a href="{{ route('category.index', $product->categories[0]->id) }}" class="font-size-12 text-gray-5">
                                            {{ $product->categories[0]->name }}
                                        </a>
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
                                            <a href="{{ route('cart.add') }}" class="add__toCartBtn btn-add-cart btn-primary transition-3d-hover" id="{{ $product->id }}"><i class="ec ec-add-to-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                        <a href="#" id="{{ $product->id }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i>Add To Quote</a>
                                        <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- :::::: End Latest Products ::::::: -->


        <!-- Banner -->
        <div class="mb-11">
            <div class="row flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                @if(!empty($tag_seventh) )
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                    <a href="#" class="min-height-132 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                        <div class="col-6 col-xl-7 col-wd-6 pr-0" 
                        style="width:190px; height:171px; background-color:white; margin-top: 0.2rem; margin-bottom:0.2rem; margin-left:0.7rem;">
                           <!--  <img class="img-fluid" src="{{ asset('frontend/assets/img/246x176/img1.jpg') }}" alt="Image Description"> -->
                        </div>
                        <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                            <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                CATCH BIG <strong>DEALS</strong> ON THE CAMERAS
                            </div>
                            <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                Shop now
                                <span class="link__icon ml-1">
                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(!empty($tag_eighth) )
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                    <a href="#" class="min-height-132 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                        <div class="col-6 col-xl-7 col-wd-6 pr-0" 
                        style="width:190px; height:171px; background-color:white; margin-top: 0.2rem; margin-bottom:0.2rem; margin-left:0.7rem;">
                           <img class="img-fluid img__fit" 
                           src="{{ (!empty($tag_eighth->image)) ? url('storage/tags/' . $tag_eighth->image) : url('storage/tags/no_image.jpg') }}" alt="Image Description">
                        </div>
                        <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                            <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                               {!! strtoupper($tag_eighth->title)  !!}
                            </div>
                            <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                Shop now
                                <span class="link__icon ml-1">
                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(!empty($tag_nineth) )
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                    <a href="#" class="min-height-132 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                        <div class="col-6 col-xl-7 col-wd-6 pr-0" 
                        style="width:190px; height:171px; background-color:white; margin-top: 0.2rem; margin-bottom:0.2rem; margin-left:0.7rem;">
                           <img class="img-fluid" 
                           src="{{ (!empty($tag_nineth->image)) ? url('storage/tags/' . $tag_nineth->image) : url('storage/tags/no_image.jpg') }}"  alt="Image Description"> -->
                        </div>
                        <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                            <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                {!! strtoupper( $tag_nineth->title )  !!}
                            </div>
                            <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                Shop now
                                <span class="link__icon ml-1">
                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif 
            </div>
        </div>
        <!-- End Banner -->


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
                        <a href="#" class="link-hover__brand">
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
        @if( !empty($latest_three) )
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
                                $price = $product->price / 100;
                                @endphp
                                ${{ number_format((float)$price, 2, '.', '') }}
                            </ins>
                            <!-- <del class="font-size-12 text-gray-9 ml-2">$250.00</del> -->
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if( !empty($tag_first_three) )
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
                                <div class="font-size-15">
                                    @php
                                    $price = $product->price / 100;
                                    @endphp
                                    ${{ number_format((float)$price, 2, '.', '') }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @if( !empty($tag_second_three) )
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
                                <div class="font-size-15">
                                    @php
                                    $price = $product->price / 100;
                                    @endphp
                                    ${{ number_format((float)$price, 2, '.', '') }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- End Footer-top-widget -->

@endsection