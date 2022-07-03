@extends('backend.layouts.master')

@section('backend')

<style>
.display__area{
    position: relative;
    width:100%;
    height:100px;
    object-fit: cover;
    border: 2px dashed #000000;
    overflow: hidden;
}

.image__cover{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload__placeholder{
    width:100%;
    height:100%;
    display: flex;
    align-items:center;
    justify-content: center;
    position: absolute;
    z-index:1;

}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Adverts</h1>
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
                    <li class="breadcrumb-item text-dark">Adverts</li>
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
        <form action="{{ route('admin.ad.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="row g-6 g-xl-9">    
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Card-->
                        <div class="h-100 card card-flush py-4">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bolder" style="margin-bottom:1rem;">Advert Content</div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="image__upload mb-10">
                                    <!--begin::Label-->
                                    <label class="required form-label">Ad Image</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" name="ad_image" class="form-control mb-2 ad__upload" placeholder="Category Name" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">A Ad Image dimensions 690 * 150 is required and recommended to be unique.</div>
                                    <!--end::Description-->
                                    <section class="display__area" style="margin-top:1rem;">
                                        <div class="upload__placeholder text-muted">Upload image will appear here.</div>
                                        <img class="image__cover" alt="">
                                        
                                    </section>
                                </div>
                                <!--end::Input group--> 
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Title</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input type="text" name="ad_title" class="form-control mb-2" placeholder="Add Description..." value="" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a title to the ad for better visibility.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Short Description</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input type="text" name="ad_description" class="form-control mb-2" placeholder="Add Description..." value="" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a description to the ad for better visibility.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label">Price </label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <input type="number" name="ad_price" class="form-control mb-2" placeholder="Add price in cents..." />
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Set a price to the ad.</div>
                                            <!--end::Description-->
                                        </div>
                                        <div class="col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label">Percent </label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <input type="number" name="ad_percent" class="form-control mb-2" placeholder="Add Percent..." />
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Set a percent to the ad.</div>
                                            <!--end::Description-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Card-->
                        <div class="h-100 card card-flush py-4">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bolder" style="margin-bottom:1rem;">Advert Meta</div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Position </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select name="ad_position" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add__status_select">
                                        <option value="">Select on option.</option>
                                        <option value="First" >First</option>
                                        <option value="Second">Second</option>
                                        <option value="Third">Third</option>
                                        <option value="Forth">Forth</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the ad position.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Button Name:</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input type="text" name="ad_click_name" class="form-control mb-2" placeholder="Add Description..." value="" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a button text to the ad for better visibility.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Link </label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input type="text" name="ad_link" class="form-control mb-2" placeholder="Add Price..." value="" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a link to the ad.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Status </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select name="ad_status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select">
                                        <option value="">Select an option.</option>
                                        <option value="Published" selected="selected">Published</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Unpublished">Unpublished</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the ad status.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Page </label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select name="ad_page" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select">
                                        <option value="">Select an option.</option>
                                        <option value="Home">Home</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the ad page.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                        </button>
                        <!--end::Button-->
                    </div>
                        
                </div>
            </div>
            <!--end::Container-->
        </form>
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

<script>
$('.ad__upload').change(function(e){
    let upload_placeholder = $(this).closest('.image__upload').find('.upload__placeholder').addClass('display__none');
    let ad_upload = URL.createObjectURL(e.target.files[0]);
    let display_area = $(this).closest('.image__upload').find('img');
    display_area.attr('src', ad_upload);   
});
</script>

@endsection