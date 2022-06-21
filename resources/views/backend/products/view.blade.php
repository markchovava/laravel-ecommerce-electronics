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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Blog Home</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Product</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Details</li>
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
            <!--begin::Home card-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-20">
                    <!--begin::Section-->
                    <div class="mb-17">
                        <!--begin::Title-->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
                        <!--end::Title-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed mb-9"></div>
                        <!--end::Separator-->
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Feature post-->
                                <div class="d-flex flex-column justify-content-between pe-lg-6 mb-lg-0 mb-10">
                                    <!--begin::Video-->
                                    <div class="mb-3">
                                        <img class="embed-responsive-item card-rounded h-275px w-100" 
                                        src="{{ ( !empty($product->product_thumbnail) ) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }}" />
                                    </div>
                                    <!--end::Video-->
                                    <!--begin::Body-->
                                    <div class="mb-5">
                                        <div class="row">
                                            @foreach($product->product_images as $_data)
                                            <div class="col-md-6 my-3">
                                                <div class="aspect__Ratio5x4">
                                                    <img 
                                                    src="{{ (!empty($_data->image)) ? url('storage/products/images/' . $_data->image) : '' }}" alt="{{ $product->name }}" class="img__fullCover">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="d-flex flex-stack flex-wrap">
                                       
                                    </div>
                                    <!--end::Footer-->
                                </div>
                                <!--end::Feature post-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 justify-content-between d-flex flex-column">
                                <!--begin::Post-->
                                <div class="ps-lg-6 mb-16 mt-md-0 mt-17">
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Title-->
                                        <div class="fw-bold fs-5 mt-4 text-gray-600 text-dark"> 
                                            Product Name: 
                                            <span class="fw-bolder text-dark mb-4 lh-base">{{ $product->name }}</span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <div class="fw-bold fs-5 mt-4 text-gray-600 text-dark">
                                            Product Description: 
                                            <span class="fw-bolder text-dark mb-4 lh-base">
                                            {{ $product->description }}</span> 
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Category :::::-->
                                    <div class="mb-6 d-flex flex-stack flex-wrap">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pe-2">
                                            Category:&nbsp;
                                            <!--begin::Text-->
                                            <div class="fs-5 fw-bolder">
                                                @foreach($product->categories as $_data)
                                                <a href="" class="text-gray-700 text-hover-primary">{{ $_data->name }},</a>&nbsp;
                                                @endforeach
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                    </div>
                                    <!--begin::Brands :::::-->
                                    <div class="mb-6 d-flex align-items-center pe-2 my-3">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pe-2">
                                            <!--begin::Text-->
                                            @if($brands)
                                            <div class="fs-5 mt-4 ">
                                            Brands:&nbsp;
                                                @foreach($product->brands as $_data)
                                                <div class="symbol symbol-35px symbol-circle me-3">
                                                    <img alt="" src="{{ (!empty($_data->image)) ? url('storage/products/brands/' . $_data->image) : url('storage/products/no_image.jpg') }}" />
                                                    {{ $_data->name }}
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                            <!--end::Text-->
                                        </div>
                                    </div>
                                    <!--::::Tags::::-->
                                    <div class="mb-6 d-flex flex-stack flex-wrap">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pe-2">
                                            Tags:&nbsp;
                                            <!--begin::Text-->
                                            @if($tags)
                                            <div class="fs-5 fw-bolder">
                                                @foreach($product->tags as $_data)
                                                <a href="" class="text-gray-700 text-hover-primary">{{ $_data->name }},</a>&nbsp;
                                                @endforeach
                                            </div>
                                            @endif
                                            <!--end::Text-->
                                        </div>
                                    </div>
                                     <!--end::Item-->
                                     <!--::::Tags::::-->
                                    <div class="mb-6 ">   
                                        <!--begin::Text-->
                                        @if($variations)
                                        <div class="fs-5 mt-4 ">
                                        Variations:&nbsp;
                                            @foreach($variations as $variation)
                                                <span class="text-gray-700 fw-bolder">{{ $variation->name }}:</span>&nbsp;
                                                <span class="text-gray-700 fw-bolder">{{ $variation->value }}</span>&nbsp;,
                                                &nbsp;
                                            @endforeach
                                        </div>
                                        @endif
                                        <!--end::Text-->
                                    </div>
                                     <!--end::Item-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Status:&nbsp; 
                                            <span class="fw-bold text-dark">{{ $product->status}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Type:&nbsp; 
                                            <span class="fw-bold text-dark">{{ $product->type}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Short Description:&nbsp; 
                                            <span class="fw-bold text-dark">{{ $product->short_description}}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Price:&nbsp; 
                                            <span class="fw-bold text-dark">
                                                ${{ number_format((float)$product->price, 2, '.', '') }}
                                            </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Discount:&nbsp; 
                                            @if($product->discounts)
                                            <span class="fw-bold text-dark">{{ $product->discounts->name }}</span>, 
                                            <span class="fw-bold text-dark">{{ $product->discounts->discount_percent }}%</span>
                                            @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Tax:&nbsp;
                                            @if($product->taxes)
                                            <span class="fw-bold text-dark">{{ $product->taxes->name }}</span>, 
                                            <span class="fw-bold text-dark">{{ $product->taxes->amount_percent }}%</span>
                                            @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Quantity In-store:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->inventories->in_store_quantity }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Quantity In-Warehouse:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->inventories->in_warehouse_quantity }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Tax:&nbsp;
                                            @if($product->taxes)
                                            <span class="fw-bold text-dark">{{ $product->taxes->name }}</span>, 
                                            <span class="fw-bold text-dark">{{ $product->taxes->amount_percent }}%</span>
                                            @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            SKU:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->sku }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Barcode:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->barcode }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            QR Code:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->qrcode }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Physical Delivery:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->physical_delivery }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                     <!--begin::Body-->
                                     <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Weight:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->weight }} </span>,
                                            Length:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->length }} </span>,
                                            Width:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->width }} </span>,
                                            Height:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->height }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Product Meta Title:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->product_metas->title }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Product Meta Description:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->product_metas->description }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 text-gray-600 text-dark">
                                            Product Meta Keywprds:&nbsp;
                                            <span class="fw-bold text-dark">{{ $product->product_metas->keywords }} </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        <div class="fs-5 mt-4 ">
                                            <a href="{{ route('admin.products.serial', $product->id) }}" class="btn btn-primary">View Serial Numbers</a>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Post-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--begin::Row-->
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Home card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->



@endsection