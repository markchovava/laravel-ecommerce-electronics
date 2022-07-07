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
                            <a href="{{ route('admin.message.add') }}" class="btn btn-primary text-uppercase w-100 mb-10">
                                New Message</a>
                            <!--end::Button-->
                            <!--begin::Menu-->
                            <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                <!--begin::Menu item-->
                                <div class="menu-item mb-3">
                                    <a href="{{ route('admin.message.all') }}">
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
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap gap-1">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_inbox_listing .form-check-input" value="1" />
                                </div>
                                <!--end::Checkbox-->
            
                                <!--begin::Reload-->
                                <a href="#" class="btn btn-sm btn-icon btn-clear btn-active-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr029.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="black" />
                                            <path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Reload-->
                            </div>
                            <!--end::Actions-->
                            <!--begin::Pagination-->
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" data-kt-inbox-listing-filter="search" class="form-control form-control-sm form-control-solid mw-100 min-w-150px min-w-md-200px ps-12" placeholder="Search Inbox" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Pagination-->
                        </div>
                        <div class="card-body p-0">
                            <!--begin::Table-->
                            <table class="table table-hover table-row-dashed fs-6 gy-5 my-0" id="kt_inbox_listing">
                                <!--begin::Table head-->
                                <thead class="d-none">
                                    <tr>
                                        <th>Checkbox</th>
                                        <th>Actions</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @if(!empty($read))
                                    @foreach($read as $message)
                                    <tr>
                                        <td class="ps-9">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-sm form-check-custom form-check-solid mt-3">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                            <!--end::Checkbox-->
                                        </td>
                                        <td class="min-w-80px">
                                            <!--begin::Important-->
                                            <a href="#" class="btn btn-icon btn-color-gray-400 btn-sm btn-active-color-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Mark as important">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen056.svg-->
                                                <span class="svg-icon svg-icon-3 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M16.0077 19.2901L12.9293 17.5311C12.3487 17.1993 11.6407 17.1796 11.0426 17.4787L6.89443 19.5528C5.56462 20.2177 4 19.2507 4 17.7639V5C4 3.89543 4.89543 3 6 3H17C18.1046 3 19 3.89543 19 5V17.5536C19 19.0893 17.341 20.052 16.0077 19.2901Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--end::Important-->
                                            <!--begin::Delete-->
                                            <a href="{{ route('admin.message.delete', $message->id) }}" class="btn btn-icon btn-color-gray-400 btn-sm btn-active-color-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--end::Delete-->     
                                        </td>
                                        <!--begin::Author-->
                                        <td class="w-150px w-md-175px">
                                            <a href="{{ route('admin.message.view', $message->id) }}" class="d-flex align-items-center text-dark">
                                                <!--begin::Name-->
                                                <span class="fw-bold">{{ $message->first_name . ' ' . $message->last_name }}</span>
                                                <!--end::Name-->
                                            </a>
                                        </td>
                                        <!--end::Author-->
                                        <!--begin::Title-->
                                        <td>
                                            <div class="text-dark mb-1">
                                                <!--begin::Heading-->
                                                <a href="{{ route('admin.message.view', $message->id) }}" class="text-dark">
                                                    <span class="fw-bolder">{{ $message->subject }}</span>
                                                    <span class="fw-bolder d-md-inine"> - </span>
                                                    <span class="d-md-inine text-muted">
                                                     @php 
                                                        $string = strip_tags($message->message);
                                                        if (strlen($string) > 50) {

                                                            // truncate string
                                                            $stringCut = substr($string, 0, 50);
                                                            $endPoint = strrpos($stringCut, ' ');

                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string .= '...';
                                                        }
                                                     @endphp  
                                                    {{  $string }}</span>
                                                </a>
                                                <!--end::Heading-->
                                            </div>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary">{{ $message->status }}</div>
                                            <div class="badge badge-light-warning">{{ $message->type }}</div>
                                            <!--end::Badges-->
                                        </td>
                                        <!--end::Title-->
                                        <!--begin::Date-->
                                        <td class="w-100px text-end fs-7 pe-9">
                                            <span class="fw-bold">{{ $message->created_at }}</span>
                                        </td>
                                        <!--end::Date-->
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
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