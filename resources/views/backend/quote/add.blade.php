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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create</h1>
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
                    <li class="breadcrumb-item text-dark">Create Quotation</li>
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
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body p-12">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('admin.quote.store') }}">
                                @csrf
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-start flex-xxl-row">
                                    <!--begin::Input group-->
                                    <div class="d-flex align-items-center flex-equal fw-row me-4 order-2" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Specify quotation date">
                                        <!--begin::Date-->
                                        <div class="fs-6 fw-bolder text-gray-700 text-nowrap">Date:</div>
                                        <!--end::Date-->
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center w-150px">
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-transparent fw-bolder pe-5" placeholder="Select date" name="quote_date" />
                                            <!--end::Datepicker-->
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-2 position-absolute ms-4 end-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4">
                                        <span class="fs-2x fw-bolder text-gray-800">Quotation</span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Specify Quotation due date">
                                        <!--begin::Date-->
                                        <div class="fs-6 fw-bolder text-gray-700 text-nowrap">Due Date:</div>
                                        <!--end::Date-->
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center w-150px">
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-transparent fw-bolder pe-5" placeholder="Select date" name="quote_due_date" />
                                            <!--end::Datepicker-->
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-2 position-absolute end-0 ms-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-10"></div>
                                <!--end::Separator-->
                                <!--begin::Wrapper-->
                                <div class="mb-0">
                                    <!--begin::Row-->
                                    <div class="row gx-10 mb-5">
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Billing Details</label>
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="text" name="billing_name" class="form-control form-control-solid" placeholder="Name" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="email" name="billing_email" class="form-control form-control-solid" placeholder="abc@example.com" />
                                            </div>
                                            <!--end::Input group-->
                                             <!--begin::Input group-->
                                             <div class="mb-5">
                                                <input type="text" name="billing_phone" class="form-control form-control-solid" placeholder="Phone Number" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <textarea name="billing_address" class="form-control form-control-solid" rows="3" placeholder="Write the address."></textarea>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Shipping Details</label>
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="text" name="shipping_name" class="form-control form-control-solid" placeholder="Customer Name" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="email" name="shipping_email" class="form-control form-control-solid" placeholder="abc@example.com" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="text" name="shipping_phone" class="form-control form-control-solid" placeholder="Phone Number" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <textarea name="shipping_address" class="form-control form-control-solid" rows="3" placeholder="Write the customer address."></textarea>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive mb-10">
                                        <!--begin::Table-->
                                        <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                                    <th class="min-w-300px w-475px">Item</th>
                                                    <th class="min-w-100px w-100px">QTY</th>
                                                    <th class="min-w-150px w-150px">Price</th>
                                                    <th class="min-w-100px w-150px text-end">Total</th>
                                                    <th class="min-w-75px w-75px text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="product__insertArea">
                                                <tr id="product__searchItem" class="product__searchItem border-bottom border-bottom-dashed">
                                                    <td class="pe-7">
                                                        <div class="product__search">
                                                            <div class="input-group">
                                                                <input type="text" class="product__name form-control form-control-solid mb-2" placeholder="Search Product Name" />
                                                                <div class="input-group-append">
                                                                    <button href="{{ route('admin.quote.search') }}" style="border-top-left-radius:0px; border-bottom-left-radius:0px;" 
                                                                    class="search__btn btn btn-primary" id="search__btn">
                                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <ul class="product__results"></ul>
                                                        </div> 
                                                    </td>
                                                    <td class="ps-0"> </td>
                                                    <td>
                                                        <input type="number" number class="product__priceInsert form-control form-control-solid" min="0" placeholder="0" />
                                                    </td>
                                                    <td class="pt-8 text-end text-nowrap"></td>
                                                    <td class="pt-5 text-end">
                                                        <button type="button" class="add__productItem btn btn-link py-1">Add</button>
                                                    </td>
                                                </tr>
                                                <tr id="product__item" class="product__item border-bottom border-bottom-dashed display__none">
                                                    <td class="pe-7">
                                                        <input type="text" class="product__name form-control form-control-solid mb-2" placeholder="Item name" />
                                                        <textarea class="product__descriptionInsert form-control form-control-solid" placeholder="Description" cols="30" rows="2"></textarea>
                                                    </td>
                                                    <td class="ps-0">
                                                        <input type="number" number class="product__quantityInsert form-control form-control-solid" min="0" placeholder="0" />
                                                    </td>
                                                    <td>
                                                        <input type="number" number class="product__priceInsert form-control form-control-solid" min="0" placeholder="0">
                                                        <input type="hidden" number class="product__priceInsert_cents form-control form-control-solid" min="0" placeholder="0" >
                                                    </td>
                                                    <td class="pt-8 text-end text-nowrap">
                                                        $<span class="product__insertSum">0.00</span>
                                                        <input type="hidden" value="0">        
                                                    </td>
                                                    <td class="pt-5 text-end">
                                                        <button type="button" class="remove__productItem btn btn-sm btn-icon btn-active-color-primary">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                            <!--begin::Table foot-->
                                            <tfoot>
                                                <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                                                    <th class="text-primary">
                                                        
                                                    </th>
                                                    <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                                                        <div class="d-flex flex-column align-items-start">
                                                            <div class="fs-5">Subtotal</div>
                                                            <div class="btn btn-link py-1" data-bs-toggle="tooltip">Tax (%)</div>
                                                            <input type="text" name="quote_tax" class="quote__tax form-control form-control-solid" id="">
                                                            <div class="btn btn-link py-1" data-bs-toggle="tooltip">Discount</div>
                                                            <input type="text" name="quote_discount" class="quote__discount form-control form-control-solid" id="">
                                                        </div>
                                                    </th>
                                                    <th colspan="2" class="border-bottom border-bottom-dashed text-end">
                                                        <span>
                                                            $&nbsp;<input type="text" class="sub__total form-controll">
                                                            <input name="quote_subtotal_cents" type="hidden" class="sub__totalCents form-controll">
                                                        </span>
                                                    </th>
                                                </tr>
                                                <tr class="align-top fw-bolder text-gray-700">
                                                    <th></th>
                                                    <th colspan="2" class="fs-4 ps-0">
                                                        <a href="#" class="calculate__grandtotal text-primary">Calculate Total</a>
                                                    </th>
                                                    <th colspan="2" class="text-end fs-4 text-nowrap">$
                                                    <span><input type="text" class="grand__total form-controll"></span><br>
                                                    <input name="grandtotal_cents" type="hidden" class="grand__totalCents"></th>
                                                </tr>
                                            </tfoot>
                                            <!--end::Table foot-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                   
                                    <!--begin::Notes-->
                                    <div class="mb-4">
                                        <label class="form-label fs-6 fw-bolder text-gray-700">Notes</label>
                                        <textarea name="quote_notes" class="form-control form-control-solid" rows="3" placeholder="Thanks for your business"></textarea>
                                    </div>
                                    <!--end::Notes-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <button type="submit" id="" class="btn btn-primary">
                                           Get Quote          
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
                
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->


<script src="{{ asset('backend/assets/custom/quote.custom.js') }}"></script>



@endsection