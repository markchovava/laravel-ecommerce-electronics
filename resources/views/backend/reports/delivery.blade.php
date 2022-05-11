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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Delivery Report</h1>
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
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Delivery</li>
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
                            <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_ecommerce_report_shipping_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Daterangepicker-->
                        <input class="form-control form-control-solid w-100 mw-250px" placeholder="Pick date range" id="kt_ecommerce_report_shipping_daterangepicker" />
                        <!--end::Daterangepicker-->
                        <!--begin::Filter-->
                        <div class="w-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="Completed">Completed</option>
                                <option value="In Transit">In Transit</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Filter-->
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Export Report</button>
                        <!--begin::Menu-->
                        <div id="kt_ecommerce_report_shipping_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to clipboard</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as Excel</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as CSV</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as PDF</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Export dropdown-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_shipping_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">Date</th>
                                <th class="min-w-100px">Delivery Type</th>
                                <th class="min-w-100px">Delivery ID</th>
                                <th class="min-w-100px">Status</th>
                                <th class="text-end min-w-75px">No. Orders</th>
                                <th class="text-end min-w-100px">Total</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Aug 19, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0034367</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">6</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$541.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0067988</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">18</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$379.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Dec 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0057955</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">2</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$509.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0067276</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">11</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$41.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Feb 21, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0029025</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">3</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$544.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0037502</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">5</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$421.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Apr 15, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0058745</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">7</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$110.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 24, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0068467</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">1</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$452.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Dec 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0039519</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">17</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$113.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jul 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0041867</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Cancelled</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">16</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$257.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Nov 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0036774</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">14</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$232.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Dec 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0039182</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Cancelled</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">20</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$346.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0057249</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">10</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$223.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jul 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0049126</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">8</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$463.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>May 05, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0069446</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">1</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$371.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0045788</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">14</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$416.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Apr 15, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0043373</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">1</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$312.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Aug 19, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0027516</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Cancelled</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">9</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$120.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0042039</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">7</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$34.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Nov 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0039790</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">14</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$225.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Aug 19, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0030875</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">11</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$496.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0061561</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">17</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$69.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0048586</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">4</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$220.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Aug 19, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0050388</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">7</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$373.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0029544</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">1</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$171.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 24, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0055054</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">13</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$340.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Aug 19, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0053182</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">2</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$173.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0062811</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">6</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$85.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0042513</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">20</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$311.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Apr 15, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0035955</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">16</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$266.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>May 05, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0055018</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">2</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$464.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0025844</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">In Transit</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">15</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$485.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Apr 15, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0035720</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">3</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$493.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Apr 15, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0061734</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">18</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$540.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Feb 21, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0059383</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">12</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$285.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0048811</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">8</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$147.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Nov 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0069011</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">9</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$334.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0035633</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">9</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$382.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0069117</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">19</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$36.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0063028</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">2</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$169.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0035824</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">13</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$53.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Mar 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0068805</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">11</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$408.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0039811</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">17</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$287.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Dec 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0061911</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-warning">Pending</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">4</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$120.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Dec 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0059596</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">12</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$38.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0051836</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">10</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$246.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Sep 22, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0065906</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Cancelled</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">13</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$339.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Nov 10, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0067585</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">13</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$481.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Jun 20, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0043820</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">4</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$493.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Date=-->
                                <td>Oct 25, 2022</td>
                                <!--end::Date=-->
                                <!--begin::Shipping Type=-->
                                <td>Flat Delivery Rate</td>
                                <!--end::Shipping Type=-->
                                <!--begin::Shipping ID=-->
                                <td>
                                    <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-dark text-hover-primary">#SHP-0055961</a>
                                </td>
                                <!--end::Shipping ID=-->
                                <!--begin::Status=-->
                                <td>
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Cancelled</div>
                                    <!--end::Badges-->
                                </td>
                                <!--end::Status=-->
                                <!--begin::No orders=-->
                                <td class="text-end pe-0">16</td>
                                <!--end::No orders=-->
                                <!--begin::Total=-->
                                <td class="text-end">$317.00</td>
                                <!--end::Total=-->
                            </tr>
                            <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
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