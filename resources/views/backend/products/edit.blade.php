@extends('backend.layouts.master')

@section('backend')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Edit Form</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Edit Product</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
           
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form method="post" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf

                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-450px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Product Thumbnail</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" 
                                style="background-image:url({{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }});">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="product_thumbnail" value="{{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : '' }}" 
                                        accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status">
                                    </div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select2-->
                                <select name="product_status" class="form-select mb-2" >
                                    <option></option>
                                    <option value="Published" {{ ($product->status == "Published") ? "selected='selected'" : "" }}>Published</option>
                                    <option value="Draft" {{ ($product->status == "Draft") ? "selected='selected'" : "" }}>Draft</option>
                                    <option value="Inactive" {{ ($product->status == "Inactive") ? "selected='selected'" : "" }}>Inactive</option>
                                </select>
                                <!--end::Select2-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the product status.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Status-->
                    <!--begin::Category-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Product Categories</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                       
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                @php
                                    $categories_from_db = $product->categories()->where('product_id', $product->id)->get();
                                @endphp
                                @if($categories_from_db)   
                                <!--begin::Repeater Display-->
                                <section id="category_repeaterDisplay">   
                                    @foreach($categories_from_db as $category) 
                                    <div class="category__Row form-group row my-3">
                                        <div class="col-md-9">
                                            <select name="category__repeaterBasic[0][]" id="" class="form-select">
                                                <option value="{{ $category->id }}">
                                                    @if( $category->position ) 
                                                        ({{$category->position }})  
                                                    @endif
                                                    {{ $category->name }} 
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <a href="javascript:;" id="btn__removeCategory" class="btn btn-sm btn-light-danger">
                                                <i class="la la-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach  
                                </section>
                                <!--end::Repeater Display-->
                            @endif

                            @if($categories)
                                <!--begin::Repeater-->
                                <div id="category__repeaterBasic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="category__repeaterBasic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-9">
                                                        <label class="form-label">Category Name:</label>
                                                        <!--begin::Select2-->
                                                        <select name="" class="form-control mb-2 p-2">
                                                        <option selected="" disabled="">Select Option Below.</option>
                                                        @foreach($categories as $category) 
                                                            <option value="{{ $category->id }}"> 
                                                                @if( $category->position ) 
                                                                    ({{ $category->position }})  
                                                                @endif
                                                                {{ $category->name }} 
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-3">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="la la-plus"></i>Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            </div>
                            <!--end::Card body-->
                        @endif
                    </div>
                    <!--end::Category -->
                    <!--begin::Brands-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Product Brands</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                            
                            @php
                                $brands_from_db = $product->brands()->where('product_id', $product->id)->get();
                            @endphp 
                            @if($brands_from_db)   
                            <!--begin::Repeater Display-->
                            <section id="brand_repeaterDisplay">   
                                @foreach($brands_from_db as $brand) 
                                <div class="brand__Row form-group row my-3">
                                    <div class="col-md-9">
                                        <select name="brand__repeaterBasic[0][]" id="" class="form-select">
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center">
                                        <a href="javascript:;" id="btn__removeBrand" class="btn btn-sm btn-light-danger">
                                            <i class="la la-trash-o"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach  
                            </section>
                            <!--end::Repeater Display-->
                            @endif

                            @if(!empty($brands))
                                <!--begin::Repeater-->
                                <div id="brand__repeaterBasic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="brand__repeaterBasic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-9">
                                                        <label class="form-label">Brand Name:</label>
                                                        <!--begin::Select2-->
                                                        <select name="" class="form-control mb-2 p-2">
                                                            <option selected="" disabled="">Select Option Below.</option>
                                                            @foreach($brands as $brand)   
                                                                <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7 mb-7">Add product Brand.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-3">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="la la-plus"></i>Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            @endif
                            </div>
                            <!--end::Card body-->
                        
                    </div>
                    <!--end::Brands-->

                    <!--begin::Tags-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Product Tags</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->


                        @php
                            $tags_from_db = $product->tags()->where('product_id', $product->id)->get();
                        @endphp
                        @if( !empty($tags_from_db) )  
                        <div class="card-body pt-0"> 
                        <!--begin::Repeater Display-->
                        <section id="tag_repeaterDisplay">   
                            @foreach($tags_from_db as $tag) 
                            <div class="tag__Row form-group row my-3">
                                <div class="col-md-9">
                                    <select name="tag__repeaterBasic[0][]" id="" class="form-select">
                                        <option value="{{ $tag->id }}"> 
                                            @if( $tag->position ) 
                                                ({{$tag->position }})  
                                            @endif
                                            {{ $tag->click_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <a href="javascript:;" id="btn__removeTag" class="btn btn-sm btn-light-danger">
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach  
                        </section>
                        <!--end::Repeater Display-->
                        </div>
                        @endif
                        @if(!empty($tags))
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Repeater-->
                                <div id="tag__repeaterBasic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="tag__repeaterBasic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-9">
                                                        <label class="form-label">Tag Name:</label>
                                                        <!--begin::Select2-->
                                                        <select name="" class="form-control mb-2 p-2">
                                                        <option selected="" disabled="">Select Option Below.</option>
                                                            @foreach($tags as $tag)   
                                                                <option value="{{ $tag->id }}">
                                                                    @if( $tag->position ) 
                                                                        ({{$tag->position }})  
                                                                    @endif
                                                                    {{ $tag->click_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7 mb-7">Add product tag.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-3">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="la la-plus"></i>Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            </div>
                            <!--end::Card body-->
                        @endif
                    </div>
                    <!--end::Tags-->
                    
                </div>
                <!--end::Aside column-->


                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">                           
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Product Information</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#serial__number">Serial Number</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content">

                        <!--begin::Tab content-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>General</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Product Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_name" value="{{ $product->name }}" class="form-control mb-2" placeholder="Product name"  />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="required form-label">Description</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea name="product_description" id="" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Short Description</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="product_short_description" value="{{ $product->short_description }}" class="form-control mb-2" placeholder="Product Short Description"/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Add product short description.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="checkbox" name="product_special_offer" {{ ($product->special_offer == 'Yes') ? 'checked="checked"' : '' }} value="Yes" class="mb-2" />
                                                Special Offer
                                                <!--end::Input-->
                                                </label>
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Add product Special Offer.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                    <!--begin::Pricing-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Pricing</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Price</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="product_price" class="form-control mb-2" placeholder="Product price" value="{{ $product->price }}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the product price.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">ZWL Price</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" name="zwl_product_price" class="form-control mb-2" placeholder="Product ZWL Price" value="{{ $product->zwl_price }}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the product price.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Discount Type
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select a discount type that will be applied to this product"></i></label>
                                                <!--End::Label-->
                                                <!--begin::Row-->
                                                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        @if($product->discounts->name != NULL)
                                                            <!--begin::Option-->
                                                            <label class="{{($product->discounts->name == 'No Discount') ? 'active' : ''}} btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input type="radio" class="form-check-input" name="discount_option" value="No Discount" 
                                                                        {{ ($product->discounts->name == "No Discount") ? "checked='checked'" : "checked=''" }} />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bolder text-gray-800 d-block">No Discount</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        @else
                                                            <!--begin::Option-->
                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input type="radio" class="form-check-input" name="discount_option" value="No Discount" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bolder text-gray-800 d-block">No Discount</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col">
                                                    @if($product->discounts->name != NULL)
                                                        <!--begin::Option-->
                                                        <label 
                                                            class="{{ ($product->discounts->name == 'Discount Percentage') ? 'active'  : '' }} btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                            <!--begin::Radio-->
                                                            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                <input type="radio" name="discount_option" class="form-check-input" value="Discount Percentage" 
                                                                    {{ ($product->discounts->name == "Discount Percentage") ? "checked='checked'" : "checked=''" }} />
                                                            </span>
                                                            <!--end::Radio-->
                                                            <!--begin::Info-->
                                                            <span class="ms-5">
                                                                <span class="fs-4 fw-bolder text-gray-800 d-block">Percentage %</span>
                                                            </span>
                                                            <!--end::Info-->
                                                        </label>
                                                        <!--end::Option-->
                                                        @else
                                                            <!--begin::Option-->
                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input type="radio" name="discount_option" class="form-check-input" value="Discount Percentage" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bolder text-gray-800 d-block">Percentage %</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        @endif
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                <!--begin::Label-->
                                                <label class="form-label">Set Discount Percentage (%)</label>
                                                <!--end::Label-->
                                                <!--begin::Slider-->
                                                <div class="d-flex flex-column text-center mb-5">
                                                    <input type="number" name="discount_percent" class="form-control mb-2" placeholder="Discount Percentage..." 
                                                        value="{{ $product->discounts->discount_percent }}" />
                                                </div>
                                                <!--end::Slider-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        
                                            <!--begin::Tax-->
                                            <div class="d-flex flex-wrap gap-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Tax Class</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select name="tax_name" class="form-select mb-2">
                                                        <option>Select option below</option>
                                                        <option value="Taxable Goods" {{ ($product->taxes->name == "Taxable Goods") ? 'selected="selected"' : '' }}> Taxable Goods </option>
                                                        <option value="Downloadable Product" {{ ($product->taxes->name == "Downloadable Product") ? 'selected="selected"' : '' }}> Downloadable Product </option>
                                                        <option value="Tax Free" {{ ($product->taxes->name == "Tax Free") ? 'selected="selected"' : '' }}> Tax Free </option>
                                                    </select>
                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the product tax class.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="form-label">VAT Amount (%)</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" number name="tax_amount_percent" class="form-control mb-2" value="{{ $product->taxes->amount_percent }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the product VAT about.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end:Tax-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Pricing-->
                                    <!--begin::Media-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Media</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Repeater-->
                                            <div class="container">
                                                @if( !empty($product->product_images) )
                                                <div class="row">
                                                    @foreach($product->product_images as $image)
                                                    <div class="col-md-6 image__uploadSect">
                                                        <!--begin::Form group-->
                                                        <div class="form-group row mb-3">
                                                            <div class="col-md-9">
                                                                <!-- <input type="file" value="{{ $image->image }}" multiple="" class="product__imageUpload form-control mb-md-0"/> -->
                                                                <input type="hidden" name="db_product_images[]" class="db__productImages" value="{{ $image->image }}">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="{{ route('admin.products.remove', $image->id )}}" 
                                                                class="db__imageRemove btn btn-sm btn-light-danger ">
                                                                    <i class="la la-trash-o"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="product__uploadDisplayer">
                                                                    <img src="{{ (!empty($image->image)) ? url('storage/products/images/' . $image->image) : url('storage/products/no_image.jpg') }}" alt="" class="img__fullCover">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::-->
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                                <div class="upload__row row">
                                                    <div class="col-md-6 image__uploadSect display__none">
                                                        <!--begin::Form group-->
                                                        <div class="form-group row mb-3">
                                                            <div class="col-md-9">
                                                                <input type="file" class="product__imageUpload form-control mb-md-0" placeholder="Upload Image" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:;" class="remove__uploadSectBtn btn btn-sm btn-light-danger ">
                                                                    <i class="la la-trash-o"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="product__uploadDisplayer">
                                                                    <img alt="" class="img__fullCover">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::-->
                                                    </div>
                                                    <div class="col-md-6 image__uploadSect">
                                                        <!--begin::Form group-->
                                                        <div class="form-group row mb-3">
                                                            <div class="col-md-9">
                                                                <input type="file" name="product_images[]" multiple="" class="product__imageUpload form-control mb-md-0" placeholder="Upload Image" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:;" class="remove__uploadSectBtn btn btn-sm btn-light-danger ">
                                                                    <i class="la la-trash-o"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="product__uploadDisplayer">
                                                                    <img alt="" class="img__fullCover">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::-->
                                                    </div>
                                                </div>
                                                <button type="button" class="add__uploader btn btn-info">Add</button>
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Media-->
                                    <!--begin::Inventory-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Inventory</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">SKU</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="sku" value="{{ $product->sku }}" class="form-control mb-2" placeholder="SKU Number" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product SKU.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Barcode</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control mb-2" placeholder="Barcode Number" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product barcode number.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Serial Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="serialnumber" value="{{ $product->serialnumber }}" class="form-control mb-2" placeholder="Serial Number" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product Serial Number.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">QR Code</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="qrcode" value="{{ $product->qrcode }}" class="form-control mb-2" placeholder="QR Code"/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product QR Code.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Quantity</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="d-flex gap-3">
                                                    <input type="number" name="in_store_quantity" value="{{ $product->inventories->in_store_quantity }}" class="form-control mb-2" placeholder="On shelf" value="" />
                                                    <input type="number" name="in_warehouse_quantity" value="{{ $product->inventories->in_warehouse_quantity }}" class="form-control mb-2" placeholder="In warehouse" />
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product quantity.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Inventory-->
                                    <!--begin::Variations-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Variations</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Repeater Display-->
                                            <section id="variation_repeaterDisplay">
                                                @php($i = 0)
                                                @foreach($variations as $variation)
                                                <div class="variation__Row form-group row">
                                                    <div class="col-md-5">
                                                        <label class="form-label">Name:</label>
                                                        <input type="text" name="variation_from_db[{{ $i }}][0]" value="{{ $variation->name }}" class="form-control mb-2 mb-md-0" placeholder="Enter name" />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="form-label">Value:</label>
                                                        <input type="text" name="variation_from_db[{{ $i }}][1]" value="{{ $variation->value }}" class="form-control mb-2 mb-md-0" placeholder="Enter value" />
                                                    </div> 
                                                    
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" id="btn__removeVariation" class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                @php($i++)
                                                @endforeach  
                                            </section>
                                            <!--end::Repeater Display-->
                                            <!--begin::Repeater-->
                                            <div id="variation__addOptions">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="variation__addOptions">
                                                        <div data-repeater-item>
                                                            <div class="form-group row">
                                                                <div class="col-md-5">
                                                                    <label class="form-label">Name:</label>
                                                                    <input type="text" name="0" class="form-control mb-2 mb-md-0" placeholder="Enter name" />
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label class="form-label">Value:</label>
                                                                    <input type="text" name="1" class="form-control mb-2 mb-md-0" placeholder="Enter value" />
                                                                </div>
                                                            
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                        <i class="la la-trash-o"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Form group-->

                                                <!--begin::Form group-->
                                                <div class="form-group mt-5">
                                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Variations-->
                                     <!--begin::Specifications-->
                                     <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Specifications</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Repeater Display-->
                                            <section id="specification_repeaterDisplay">
                                                @php($i = 0)
                                                @foreach($specifications as $specification)
                                                <div class="specification__Row form-group row">
                                                    <div class="col-md-5">
                                                        <label class="form-label">Name:</label>
                                                        <input type="text" name="specification_from_db[{{ $i }}][0]" value="{{ $specification->name }}" class="form-control mb-2 mb-md-0" placeholder="Enter name" />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="form-label">Value:</label>
                                                        <input type="text" name="specification_from_db[{{ $i }}][1]" value="{{ $specification->value }}" class="form-control mb-2 mb-md-0" placeholder="Enter value" />
                                                    </div> 
                                                    
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" id="btn__removeSpecification" class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                @php($i++)
                                                @endforeach  
                                            </section>
                                            <!--end::Repeater Display-->
                                            <!--begin::Repeater-->
                                            <div id="specification__addOptions">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="specification__addOptions">
                                                        <div data-repeater-item>
                                                            <div class="form-group row">
                                                                <div class="col-md-5">
                                                                    <label class="form-label">Name:</label>
                                                                    <input type="text" name="0" class="form-control mb-2 mb-md-0" placeholder="Enter name" />
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label class="form-label">Value:</label>
                                                                    <input type="text" name="1" class="form-control mb-2 mb-md-0" placeholder="Enter value" />
                                                                </div>
                                                            
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                        <i class="la la-trash-o"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Form group-->

                                                <!--begin::Form group-->
                                                <div class="form-group mt-5">
                                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Specifications-->
                                    <!--begin::Shipping-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Physical Delivery</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                        <!--begin::Select2-->
                                            <select name="physical_delivery" class="form-select mb-2" data-control="select2" data-hide-search="true" 
                                                data-placeholder="{{ ($product->physical_delivery != NULL) ? $product->physical_delivery : 'Select An Option..'  }}" id="kt_ecommerce_add_product_status_select">
                                                <option></option>
                                                <option value="Yes" {{ ($product->physical_delivery == "Yes") ? 'selected="selected"' : "" }} >Yes</option>
                                                <option value="No" {{ ($product->physical_delivery == "No") ? 'selected="selected"' : "" }} >No</option>
                                            </select>
                                            <!--end::Select2-->
                                            <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping..</div>
                                            <!--begin::Shipping form-->
                                            <div id="kt_ecommerce_add_product_shipping" class=" mt-10">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Weight</label>
                                                    <!--end::Label-->
                                                    <!--begin::Editor-->
                                                    <input type="text" name="product_weight" value="{{ $product->weight }}" class="form-control mb-2" placeholder="Product weight" value="" />
                                                    <!--end::Editor-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Dimension</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                                        <input type="number" name="product_width" value="{{ $product->width }}" class="form-control mb-2" placeholder="Width (w)" value="" />
                                                        <input type="number" name="product_height" value="{{ $product->height }}" class="form-control mb-2" placeholder="Height (h)" value="" />
                                                        <input type="number" name="product_length" value="{{ $product->length }}" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Shipping form-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Shipping-->
                                    <!--begin::Meta options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Meta Options</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label">Meta Tag Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control mb-2" name="meta_title" value="{{ $product->product_metas->title }}" placeholder="Meta tag name" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label">Meta Tag Description</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea name="meta_description" id="" cols="30" rows="10" class="form-control">{{ $product->product_metas->description }}</textarea>
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Label-->
                                                <label class="form-label">Meta Tag Keywords</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="meta_keywords" value="{{ $product->product_metas->keywords }}" class="form-control mb-2" />
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma
                                                <code>,</code>between each keyword.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Meta options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="serial__number" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Variations-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Serial Number</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <section id="serial_numberDisplay">
                                            @foreach($product_serial as $_serial)
                                            <div class="serial__Row form-group row my-3">
                                                <div class="col-md-10">
                                                    <input type="text" name="edit__serialNumber[]" value="{{ $_serial->serial_number }}" class="form-control mb-md-0" placeholder="Serial Number" />
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="javascript:;" id="btn__removeSerial" class="btn btn-sm btn-light-danger ">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </section>
                                        <!--begin::Repeater-->
                                        <div id="add__serialNumber">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="add__serialNumber">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-3">
                                                            <div class="col-md-10">
                                                                <input type="text" name="0" class="form-control mb-md-0" placeholder="Serial Number" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger ">
                                                                    <i class="la la-trash-o"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <i class="la la-plus"></i>Add
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Variations-->

                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>

                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

<script>
$(document).ready(function(){
    $('.add__uploader').click(function(e){
        e.preventDefault();
        let upload__sect =  $(this).siblings('.upload__row').find('.image__uploadSect:first');
        let clone_sect = upload__sect.clone(true)
                .appendTo('.upload__row')
                .removeClass('display__none');
        clone_sect.find('.product__imageUpload').attr('name', 'product_images[]');
    });
    $('.product__imageUpload').change(function(e){
        e.preventDefault();
        let display_image =  $(this).closest('.image__uploadSect').find('.product__uploadDisplayer img');
        let image_upload = URL.createObjectURL(e.target.files[0]);
        display_image.attr('src', image_upload);   
    });
   /* 
    *   Remove image from DB 
    */
    $('.db__imageRemove').click(function(e){
        e.preventDefault();
        let image_uploadSect = $(this).closest('.image__uploadSect');
        //alert(image_uploadSect.html());
        let image_name = $(this).closest('.image__uploadSect').find('.db__productImages').val();
        let remove_image = $(this).attr('href');
        //alert(remove_image);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: remove_image,
            method: "GET",
            dataType: "json",
            data: {},
            success: function(result){
                console.log(result);
                if(result){
                    image_uploadSect.remove(); 
                }   
            }
        }); 
    });  

    /* 
    *   Remove from Upload 
    */
    $('.remove__uploadSectBtn').click(function(e){
        e.preventDefault();
        $(this).closest('.image__uploadSect').remove();
    });
     
});  

</script>
<script>

/* ::::::: Remove previous Categories:::::: */
$(document).ready(function(){
    $(document).on('click', '#btn__removeCategory', function(){
        $(this).closest('.category__Row').slideUp().remove();
    })
});

/* ::::::: Remove previous Brands:::::: */
$(document).ready(function(){
    $(document).on('click', '#btn__removeBrand', function(){
        $(this).closest('.brand__Row').slideUp().remove();
    })
});

/* ::::::: Remove previous Tags:::::: */
$(document).ready(function(){
    $(document).on('click', '#btn__removeTag', function(){
        $(this).closest('.tag__Row').slideUp().remove();
    })
});

$(document).ready(function(){
    $(document).on('click', '#btn__removeVariation', function(){
        $(this).closest('.variation__Row').slideUp().remove();
    })
});

$(document).on('click', '#btn__removeSerial', function(){
    $(this).closest('.serial__Row').slideUp().remove();
});
$(document).on('click', '#btn__removeSpecification', function(){
    $(this).closest('.specification__Row').remove();
});


   
    $('#category__repeaterBasic').repeater({
        initEmpty: false,
        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });


    $('#tag__repeaterBasic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#brand__repeaterBasic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#variation__addOptions').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#specification__addOptions').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#add__serialNumber').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

</script>

@endsection