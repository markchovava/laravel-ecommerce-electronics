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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Quotation</h1>
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
                    <li class="breadcrumb-item text-muted">Quotation Manager</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">View Quotation</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark"> Quotation</li>
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
            <!-- begin::Invoice 3-->
            <div class="card">
                <!-- begin::Body-->
                <div class="card-body py-20">
                    <!-- begin::Wrapper-->
                    <div id="quotation__area" class="mw-lg-950px mx-auto w-100">
                        <section>
                            <!-- begin::Header-->
                            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">Quotation</h4>
                                <!--end::Logo-->
                                <div class="text-sm-end">
                                    <!--begin::Logo-->
                                    <a href="#" class="d-block mw-150px ms-sm-auto">
                                        <img alt="Logo" src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" class="w-100" />
                                    </a>
                                    <!--end::Logo-->
                                    <!--begin::Text-->
                                    <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                                        <div>{{ $quote->address }}</div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pb-12">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column gap-7 gap-md-10">
                                    <!--begin::Message-->
                                    <div class="fw-bolder fs-2">Dear {{ $quote->email }}
                                    <span class="fs-6">({{ $quote->email }})</span>,
                                    <br />
                                    <span class="text-muted fs-5">Here are your quotation details. We look forward to your purchase.</span></div>
                                    <!--begin::Message-->
                                    <!--begin::Separator-->
                                    <div class="separator"></div>
                                    <!--begin::Separator-->
                                    <!--begin::Billing & shipping-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Customer Address</span>
                                            <span class="fs-6">
                                            {{ $quote->client_address }}</span>
                                        </div>
                                    </div>
                                    <!--end::Billing & shipping-->
                                    <!--begin::Order details-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quatation Date</span>
                                            <span class="fs-5">{{ $quote->quote_date }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Due Date</span>
                                            <span class="fs-5">{{ $quote->quote_due_date}}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quotation ID</span>
                                            <span class="fs-5">{{ $quote->quote_number }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quotation Number</span>
                                            <span class="fs-5">{{ $quote->id }}</span>
                                        </div>
                                    </div>
                                    <!--end::Order details-->
                                    <!--begin:Order summary-->
                                    <div class="d-flex justify-content-between flex-column">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-9">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                    <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                        <th class="min-w-175px pb-2">Products</th>
                                                        <th class="min-w-70px text-end pb-2">Price</th>
                                                        <th class="min-w-80px text-end pb-2">QTY</th>
                                                        <th class="min-w-100px text-end pb-2">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">
                                                    <!--begin::Products-->
                                                    @foreach($quote_items as $quote_item)
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <div class="fw-bolder">{{ $quote_item->product_name }}</div>
                                                                    <div class="fs-7 text-muted">{{ $quote_item->description }}</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">${{ $quote_item->price_cents }}</td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{ $quote_item->quantity }}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Total-->
                                                        <td class="text-end">${{ $quote_item->total_cents / 100 }}</td>
                                                        <!--end::Total-->
                                                    </tr>
                                                    @endforeach
                                                    <!--end::Products-->


                                                    <!--begin::Subtotal-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Subtotal</td>
                                                        <td class="text-end">${{ $quote->subtotal_cents / 100 }}</td>
                                                    </tr>
                                                    <!--end::Subtotal-->
                                                    <!--begin::VAT-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">VAT (0%)</td>
                                                        <td class="text-end">{{ $quote->tax }}%</td>
                                                    </tr>
                                                    <!--end::VAT-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Discount (0%)</td>
                                                        <td class="text-end">{{ $quote->discount }}%</td>
                                                    </tr>
                                                    <!--begin::Grand total-->
                                                    <tr>
                                                        <td colspan="3" class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
                                                        <td class="text-dark fs-3 fw-boldest text-end">${{ $quote->grandtotal_cents / 100}}</td>
                                                    </tr>
                                                    <!--end::Grand total-->
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end:Order summary-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                        </section>
                    </div>
                    <!-- end::Wrapper-->
                        <!-- begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                                <!-- begin::Pint-->
                                <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Quotation</button>
                                <!-- end::Pint-->
                                <!-- begin::Download-->
                                <a href="{{ route('admin.quote.pdf', $quote->id) }}" class="btn btn-light-success my-1">Generate PDF</a>
                                <!-- end::Download-->
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            <a href="{{ route('admin.quote') }}" class="btn btn-primary my-1">View Quotations</a>
                            <!-- end::Action-->
                        </div>
                        <!-- end::Footer-->
                </div>
                <!-- end::Body-->
            </div>
            <!-- end::Invoice 1-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->




@endsection