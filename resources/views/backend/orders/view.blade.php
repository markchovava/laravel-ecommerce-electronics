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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Order Details</h1>
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
                    <li class="breadcrumb-item text-dark">Order Details</li>
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
            <!--begin::Order details page-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Button-->
                    <a href="#" class="btn btn-icon btn-light-primary btn-sm ms-auto me-lg-n7">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-light-primary btn-sm me-lg-n7">Edit Order</a>
                    <!--end::Button-->
                </div>
                <!--begin::summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Order Details</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Order Number
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->reference_id }}</td>
                                        </tr>
                                        <!--end::-->
                                         <!--begin::-->
                                         <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Date Added
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->created_at }}</td>
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Include Shipping
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->include_shipping }}
                                        </tr>
                                        <!--end::-->
                                         <!--begin::-->
                                         <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Status
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->status }}
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Delivery
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->delivery }}
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Notes
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->notes }}
                                        </tr>
                                        <!--end::-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->    
                </div>
                <!--end::summary-->
                <!--begin::summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Company Details</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Company Name
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->customers->company_name }}</td>
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Company Phone Number
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->customers->company_phone_number }}</td>
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Company Email
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->customers->company_email }}</td>
                                        </tr>
                                        <!--end::-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Company Address
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->customers->company_address }}</td>
                                        </tr>
                                        <!--end::-->
                                         <!--begin::-->
                                         <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    Company City
                                                </div>
                                            </td>
                                            <td class="fw-bolder text-end">{{ $order->customers->company_city }}</td>
                                        </tr>
                                        <!--end::-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
                    <!--begin:: details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Customer Details</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Customer name-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                Customer</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin::Name-->
                                                    <a href="{{ route('admin.customer.view', $order->customer_id) }}" class="text-gray-600 text-hover-primary">
                                                        {{ $order->customers->first_name . ' ' . $order->customers->last_name }}
                                                    </a>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <!--end::Customer name-->
                                        <!--begin::Customer email-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                Email</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <a href="#" class="text-gray-600 text-hover-primary">
                                                {{ $order->customers->email }} 
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end::Payment method-->
                                        <!--begin::-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                Phone</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                {{ $order->customers->phone_number }} 
                                            </td>
                                        </tr>
                                        <!--end::-->
                                         <!--begin::-->
                                         <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                Delivery Address</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                {{ $order->customers->delivery_address }} 
                                            </td>
                                        </tr>
                                        <!--end::-->
                                         <!--begin::-->
                                         <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                City</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                {{ $order->customers->city }} 
                                            </td>
                                        </tr>
                                        <!--end::-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end:: details-->
                </div>
                <!--end::summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Product List-->
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Order #{{ $order->reference_id }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-175px">Product</th>
                                                    <th class="min-w-100px text-end">SKU</th>
                                                    <th class="min-w-70px text-end">Qty</th>
                                                    <th class="min-w-100px text-end">Unit Price</th>
                                                    <th class="min-w-100px text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">

                                                <!--begin::Products-->
                                                @foreach($order_items as $item)
                                                <tr>
                                                    <!--begin::Product-->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="#" class="symbol symbol-50px">
                                                                <span class="symbol-label" 
                                                                style="background-image:url({{ (!empty($item->product->product_thumbnail)) ? url('storage/products/thumbnail/' . $item->product->product_thumbnail) : url('storage/products/no_image.jpg') }});"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <!--begin::Title-->
                                                            <div class="ms-5">
                                                                <a href="#" class="fw-bolder text-gray-600 text-hover-primary">
                                                                    {{ $item->product_name }}
                                                                </a>
                                                                <div class="fs-7 text-muted">Delivery Date: {{ $item->delivery_date}}</div>
                                                            </div>
                                                            <!--end::Title-->
                                                        </div>
                                                    </td>
                                                    <!--end::Product-->
                                                    <!--begin::SKU-->
                                                    <td class="text-end">{{ $item->product->sku }}</td>
                                                    <!--end::SKU-->
                                                    <!--begin::Quantity-->
                                                    <td class="text-end">{{ $item->quantity }}</td>
                                                    <!--end::Quantity-->
                                                    <!--begin::Price-->
                                                    <td class="text-end">
                                                        @php
                                                        $unit_price = $item->unit_price / 100;
                                                        @endphp
                                                        ${{ number_format((float)$unit_price, 2,'.', '') }}
                                                    </td>
                                                    <!--end::Price-->
                                                    <!--begin::Total-->
                                                    <td class="text-end">
                                                        @php
                                                        $product_total = $item->product_total / 100;
                                                        @endphp
                                                        ${{ number_format((float)$product_total, 2,'.', '') }}
                                                    </td>
                                                    <!--end::Total-->
                                                </tr>
                                                <!--end::Products-->
                                                @endforeach
                                                <!--begin::Subtotal-->
                                                <tr>
                                                    <td colspan="4" class="text-end">Subtotal</td>
                                                    <td class="text-end">
                                                        @php
                                                        $subtotal = $order->subtotal / 100;
                                                        $zwl_subtotal = $order->zwl_subtotal / 100;
                                                        @endphp
                                                        USD${{ number_format((float)$subtotal, 2,'.', '') }} <br>
                                                        ZWL${{ number_format((float)$zwl_subtotal, 2,'.', '') }} 
                                                    </td>
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="4" class="text-end">Shipping Rate</td>
                                                    <td class="text-end">
                                                        @php
                                                        $shipping_fee = $order->shipping_fee / 100;
                                                        @endphp
                                                        ${{ number_format((float)$shipping_fee, 2,'.', '') }}
                                                    </td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Grand total-->
                                                <tr>
                                                    <td colspan="4" class="fs-3 text-dark text-end">Grand Total</td>
                                                    <td class="text-dark fs-3 fw-boldest text-end">
                                                        @php
                                                        $total = $order->total / 100;
                                                        @endphp
                                                        ${{ number_format((float)$total, 2,'.', '') }}
                                                    </td>
                                                </tr>
                                                <!--end::Grand total-->
                                            </tbody>
                                            <!--end::Table head-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->




@endsection