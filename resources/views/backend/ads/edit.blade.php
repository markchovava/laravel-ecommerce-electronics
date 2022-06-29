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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">My Projects</h1>
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
                    <li class="breadcrumb-item text-muted">Projects</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">My Projects</li>
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
            <!--begin::Stats-->
            <div class="row g-6 g-xl-9">
                
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Card-->
                    <div class="h-100 card card-flush py-4">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Heading-->
                            <div class="fs-2hx fw-bolder" style="margin-bottom:1rem;">Advert 1</div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="image__upload mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Ad Image</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file" name="ad_image_one" id="ad__oneUpload"class="form-control mb-2" placeholder="Category Name" value="" />
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
                            <div class="fs-2hx fw-bolder" style="margin-bottom:1rem;">Advert 2</div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="image__upload mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Ad Image</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file" name="ad_image_two" id="ad__twoUpload" class="form-control mb-2" placeholder="Category Name" value="" />
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
                            
                           
                            
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
               
            </div>
            <!--end::Stats-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

<script>
$('#ad__oneUpload').change(function(e){
    let upload_placeholder = $(this).closest('.image__upload').find('.upload__placeholder').addClass('display__none');
    let ad_upload = URL.createObjectURL(e.target.files[0]);
    let display_area = $(this).closest('.image__upload').find('img');
    display_area.attr('src', ad_upload);
    
});
$('#ad__twoUpload').change(function(e){
    let upload_placeholder = $(this).closest('.image__upload').find('.upload__placeholder').addClass('display__none');
    let ad_upload = URL.createObjectURL(e.target.files[0]);
    let display_area = $(this).closest('.image__upload').find('img');
    display_area.attr('src', ad_upload);
    
});
</script>

@endsection