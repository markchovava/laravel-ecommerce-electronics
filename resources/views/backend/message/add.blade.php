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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Messages</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Inbox</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Messages</li>
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
            <!--begin::Inbox App - Messages -->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
                    <!--begin::Sticky aside-->
                    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Aside content-->
                        <div class="card-body">
                            <!--begin::Button-->
                            <a href="#" class="btn btn-primary text-uppercase w-100 mb-10">
                                New Message</a>
                            <!--end::Button-->
                            <!--begin::Menu-->
                            <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                <!--begin::Menu item-->
                                <div class="menu-item mb-3">
                                <a href="{{ route('admin.message.all') }}">
                                    <!--begin::Inbox-->
                                    <span class="menu-link active">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                            <span class="svg-icon svg-icon-2 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                    <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title fw-bolder">All Messages</span>
                                        <span class="badge badge-light-primary">{{ count($all) }}</span>
                                    </span>
                                    <!--end::Inbox-->
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item mb-3">
                                    <a href="{{ route('admin.message.unread') }}">
                                    <!--begin::Inbox-->
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                            <span class="svg-icon svg-icon-2 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                    <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title fw-bolder">Unread Messages</span>
                                        <span class="badge badge-light-warning">{{ count($unread) }}</span>
                                    </span>
                                    <!--end::Inbox-->
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item mb-3">
                                    <a href="{{ route('admin.message.read') }}">
                                    <!--begin::Inbox-->
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                            <span class="svg-icon svg-icon-2 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                    <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title fw-bolder">Read Messages</span>
                                        <span class="badge badge-light-success">{{ count($read) }}</span>
                                    </span>
                                    <!--end::Inbox-->
                                    </a>
                                </div>
                                <!--end::Menu item-->   
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Aside content-->
                    </div>
                    <!--end::Sticky aside-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::Card-->
                    <div class="card">
                        <div class="card-header align-items-center">
                            <div class="card-title">
                                <h2>Compose Message</h2>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!--begin::Form-->
                            <form id="kt_inbox_compose_form">
                                <!--begin::Body-->
                                <div class="d-block">
                                    <!--begin::Subject-->
                                    <div class="border-bottom">
                                        <input class="form-control form-control-transparent border-0 px-8 min-h-45px" name="compose_email" placeholder="Email" />
                                    </div>
                                    <!--end::Subject-->
                                    <!--begin::Subject-->
                                    <div class="border-bottom">
                                        <input class="form-control form-control-transparent border-0 px-8 min-h-45px" name="compose_subject" placeholder="Subject" />
                                    </div>
                                    <!--end::Subject-->
                                    <!--begin::Message-->
                                   <!--begin::Message-->
                                   <textarea name="compose_message" id="" class="form-control" cols="30" rows="10"></textarea>
									<!--end::Message-->
                                    <!--end::Message-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-3">
                                        <!--begin::Send-->
                                        <div class="btn-group me-4">
                                            <!--begin::Submit-->
                                            <span class="btn btn-primary fs-bold px-6" data-kt-inbox-form="send">
                                                <span class="indicator-label">Send</span>
                                            </span>
                                            <!--end::Submit-->     
                                        </div>
                                        <!--end::Send-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Inbox App - Messages -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->




@endsection