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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Products</h1>
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
                    <li class="breadcrumb-item text-muted">Catalog</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Products</li>
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
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <form action="{{ route('admin.products.search') }}" method="GET">
                                <input type="text" name="search" value="{{ isset($search) ? $search : '' }}" 
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                            </form>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Add product-->
                        <a href="{{ route('admin.products.add') }}" class="btn btn-primary">Add Product</a>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    #
                                </th>
                                <th class="min-w-200px">Product</th>
                                <th class="text-end min-w-100px">SKU</th>
                                <th class="text-end min-w-70px">Qty</th>
                                <th class="text-end min-w-100px">Price</th>
                                <th class="text-end min-w-100px">Category</th>
                                <th class="text-end min-w-100px">Author</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @if( isset($products) )
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($products as $product)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Category=-->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin::Thumbnail-->
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label" 
                                                style="background-image:url({{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }});"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{ route('admin.products.view', $product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="{{ $product->name }}">
                                                    {{ $product->name }}
                                                </a>
                                                <!--end::Title-->
                                                <div class="text-muted fs-7 fw-bolder">
                                                    @if( !empty($product->tags) )
                                                        <small>Tag: 
                                                            @foreach($product->tags as $_data)
                                                                @if($_data->position)
                                                                    <span class="text-primary">
                                                                        {{ $_data->position }}
                                                                    </span>,
                                                                @endif
                                                            @endforeach
                                                        </small>                      
                                                    @endif
                                                </div>
                                                <div class="text-muted fs-7 fw-bolder">
                                                    @if( !empty($product->special_offer) )
                                                        <small>Special Offer: 
                                                            <span class="text-warning">
                                                                {{ $product->special_offer }}
                                                            </span>
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::Category=-->
                                    <!--begin::SKU=-->
                                    <td class="text-end pe-0">
                                        <span class="fw-bolder">{{ $product->sku }}</span>
                                    </td>
                                    <!--end::SKU=-->
                                    <!--begin::Qty=-->
                                    <td class="text-end pe-0" data-order="{{ $product->quantity }}">
                                        <span class="fw-bolder">
                                            @php
                                            $quantity = intval($product->inventories->in_store_quantity);
                                            @endphp
                                            {{ $quantity }}
                                        </span>
                                    </td>
                                    <!--end::Qty=-->
                                    <!--begin::Price=-->
                                    <td class="text-end pe-0">
                                        <span class="fw-bolder">
                                            @php 
                                            $price = $product->price / 100;
                                            $zwl_price = $product->zwl_price / 100;
                                            @endphp
                                            ${{ number_format((float)$price, 2, '.', '') }},&nbsp; <br>
                                            ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
                                        </span>
                                    </td>
                                    <!--end::Price=-->
                                    <!--begin::Rating-->
                                        <td class="text-end pe-0" data-order="categories">
                                            @foreach($product->categories as $_data)
                                                {{ $_data->name }}
                                                @if($_data->position)
                                                <small class="badge badge-light-success">
                                                    {{ $_data->position }}
                                                </small>
                                                @else
                                                    {{ $_data->name }}
                                                @endif,&nbsp;      
                                            @endforeach
                                        </td>  
                                    <!--end::Rating-->
                                    <!--begin::Status=-->
                                        <td class="text-end pe-0" data-order="users">
                                            @foreach($product->users as $user)
                                                {{ $user->name }},&nbsp;
                                            @endforeach
                                        </td>
                                    <!--end::Status=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="menu-link px-3">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.view', $product->id) }}" class="menu-link px-3">View</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.delete', $product->id) }}" class="menu-link px-3">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                                <!--end::Table row-->
                                @endforeach
                           @endif
                           @if( isset($results) )
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($results as $product)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Category=-->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin::Thumbnail-->
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label" 
                                                style="background-image:url({{ (!empty($product->product_thumbnail)) ? url('storage/products/thumbnail/' . $product->product_thumbnail) : url('storage/products/no_image.jpg') }});"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{ route('admin.products.view', $product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="{{ $product->name }}">
                                                    {{ $product->name }}
                                                </a>
                                                <!--end::Title-->
                                                <div class="text-muted fs-7 fw-bolder">
                                                    @if( !empty($product->tags) )
                                                        <small>Tag: 
                                                            @foreach($product->tags as $_data)
                                                                @if($_data->position)
                                                                    <span class="text-primary">
                                                                        {{ $_data->position }}
                                                                    </span>,
                                                                @endif
                                                            @endforeach
                                                        </small>                      
                                                    @endif
                                                </div>
                                                <div class="text-muted fs-7 fw-bolder">
                                                    @if( !empty($product->special_offer) )
                                                        <small>Special Offer: 
                                                            <span class="text-warning">
                                                                {{ $product->special_offer }}
                                                            </span>
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::Category=-->
                                    <!--begin::SKU=-->
                                    <td class="text-end pe-0">
                                        <span class="fw-bolder">{{ $product->sku }}</span>
                                    </td>
                                    <!--end::SKU=-->
                                    <!--begin::Qty=-->
                                    <td class="text-end pe-0" data-order="{{ $product->quantity }}">
                                        <span class="fw-bolder">
                                            @php
                                            $quantity = intval($product->inventories->in_store_quantity);
                                            @endphp
                                            {{ $quantity }}
                                        </span>
                                    </td>
                                    <!--end::Qty=-->
                                    <!--begin::Price=-->
                                    <td class="text-end pe-0">
                                        <span class="fw-bolder">
                                            @php 
                                            $price = $product->price / 100;
                                            $zwl_price = $product->zwl_price / 100;
                                            @endphp
                                            ${{ number_format((float)$price, 2, '.', '') }},&nbsp; <br>
                                            ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
                                        </span>
                                    </td>
                                    <!--end::Price=-->
                                    <!--begin::Rating-->
                                        <td class="text-end pe-0" data-order="categories">
                                            @foreach($product->categories as $_data)
                                                {{ $_data->name }}
                                                @if($_data->position)
                                                <small class="badge badge-light-success">
                                                    {{ $_data->position }}
                                                </small>
                                                @else
                                                    {{ $_data->name }}
                                                @endif,&nbsp;      
                                            @endforeach
                                        </td>  
                                    <!--end::Rating-->
                                    <!--begin::Status=-->
                                        <td class="text-end pe-0" data-order="users">
                                            @foreach($product->users as $user)
                                                {{ $user->name }},&nbsp;
                                            @endforeach
                                        </td>
                                    <!--end::Status=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="menu-link px-3">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.view', $product->id) }}" class="menu-link px-3">View</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.products.delete', $product->id) }}" class="menu-link px-3">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                                <!--end::Table row-->
                                @endforeach
                           @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                    <div class="row">
                        <div class="col-sm-12 col-md-5"></div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            @if( isset($products) )
                                {{ $products->links() }}
                            @endif
                            @if( isset($results) )
                                {{ $results->links() }}
                            @endif
                        </div>
                    </div>
                    
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->



@endsection