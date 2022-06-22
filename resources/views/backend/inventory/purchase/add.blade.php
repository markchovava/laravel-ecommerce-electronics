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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Purchased Goods</h1>
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
                    <li class="breadcrumb-item text-muted">Purchase</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Add Purchase</li>
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
            <div class="card card-flush">
                <!--begin::Card body-->
                <div class="card-body p-12">
                    <form method="post" action="{{ route('inventory.purchase.store') }}">
                        <h3 class="fs-2x fw-bolder text-gray-800 mb-3">Purchase Details</h3>
                        <!--begin::Wrapper-->
                        <div class="mb-0">
                            <!--begin::Row-->
                            <div class="row gx-10 mb-5">
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Product Details</label>
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <section class="product__search">
                                            <div class="input-group">
                                                <input type="text" name="product_name" class="product__name form-control form-control-solid" placeholder="Product Name" />
                                                <div class="input-group-append">
                                                    <button href="{{ route('inventory.purchase.search.product') }}" style="border-top-left-radius:0px; border-bottom-left-radius:0px;" 
                                                    class="search__btn btn btn-primary" id="search__btn">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="product_id">
                                            </div>
                                            <ul class="product__results"></ul>
                                        </section>                                          
                                    </div> 
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <input type="number" name="product_quantity" class="form-control form-control-solid" placeholder="Product Quantity" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <input type="number" name="product_cost" class="form-control form-control-solid" placeholder="Product Cost" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <textarea name="product_notes" class="form-control form-control-solid" rows="3" placeholder="Product Notes"></textarea>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-4">Supplier Details</label>
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <section class="supplier__search">
                                            <div class="input-group">
                                                <input type="text" name="supplier_name" class="supplier__name form-control form-control-solid" placeholder="Supplier Name" />
                                                <div class="input-group-append">
                                                    <button href="{{ route('inventory.purchase.search.supplier') }}" style="border-top-left-radius:0px; border-bottom-left-radius:0px;" 
                                                    class="search__btn btn btn-primary" id="search__supplierBtn">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="supplier_id">
                                            </div>
                                            <ul class="supplier__results"></ul>
                                        </section>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <input type="text" name="supplier_email" class="form-control form-control-solid" placeholder="Supplier Email" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <input type="text" name="supplier_phone" class="form-control form-control-solid" placeholder="Supplier Phone Number" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        <textarea name="supplier_address" class="form-control form-control-solid" rows="3" placeholder="Write the Supplier Address."></textarea>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                                <div class="col-lg-12">
                                    <div class="mb-5">
                                        <select name="product_status" class="form-select" aria-label="Select example">
                                            <option>Open this select menu</option>
                                            <option value="In-transit">In-transit</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Not cleared">Not cleared</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Row-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <button type="submit" id="" class="btn btn-primary">
                                    Save Purchase         
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Wrapper-->
                    </form>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->


<script>
/* Search Product in the database. */
$('#search__btn').click(function(e){
    e.preventDefault();
    let product__name = $(this).closest('.product__search').find('.product__name').val();
    let product__searchResults = $(this).closest('.product__search').find('.product__results');
    // alert(product_searchResults.text());
    if(this.id == "search__btn"){
        if( product__name != "" ){
            product__searchResults.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('href'),
                method: "GET",
                dataType: 'json',
                data: {
                    product_name: product__name,
                },
                success: function(res){
                    //console.log(res.product);
                    if(res.product.length > 0){
                        product__searchResults.empty();
                        for(var i = 0; i < res.product.length; i++){
                            $.each(res, function () {
                                product__searchResults
                                .append('<li id="' + res.product[i].id + '">' + res.product[i].name + '</li>');
                            });
                        }
                    } else{
                        product__searchResults.empty();
                        product__searchResults.append('<li class="text-danger">No Results.</li>');
                    }
                }
            });
        }
    }
});

//Removes product_id if empty product name value is empty
$(document).on('change', '.product__name', function(e){
    if($(this).val() == ''){
        $('input[name="product_id"').val('');
    }
});

/* Add Product to th input box. */
$(document).on('click', '.product__results li', function(e){
    var product__item = $(this).text();
    var product__id = $(this).attr('id');
    let product__idInsert = $(this).closest('.product__search').find('input[name="product_id"');
    var product__list = $(this).closest('.product__results');
    var product__value = $(this).closest('.product__search').find('.product__name');
    if(product__item != "No Results."){
        product__value.val(product__item);
        product__idInsert.val(product__id);
    }else{
        product__list.empty().removeClass('display__block');
    }
    product__list.empty().removeClass('display__block');
});



/* Search User in the database. */
$('#search__supplierBtn').click(function(e){
    e.preventDefault();
    let supplier__name = $(this).closest('.supplier__search').find('.supplier__name').val();
    let supplier__searchResults = $(this).closest('.supplier__search').find('.supplier__results');
    if(this.id == "search__supplierBtn"){
        if( supplier__name != "" ){
            supplier__searchResults.addClass('display__block').append('<li class="results__pretext text-success">Loading...</li>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('href'),
                method: "GET",
                dataType: 'json',
                data: {
                    supplier_name: supplier__name,
                },
                success: function(res){
                    //console.log(res.supplier);
                    if(res.supplier.length > 0){
                        supplier__searchResults.empty();
                        for(var i = 0; i < res.supplier.length; i++){
                            $.each(res, function () {
                                supplier__searchResults
                                .append('<li id="' + res.supplier[i].id + '">' + res.supplier[i].name + '</li>');
                            });
                        }
                    } else{
                        supplier__searchResults.empty();
                        supplier__searchResults.append('<li class="text-danger">No Results.</li>');
                    }
                }
            });
        }
    }
}); 
/* Add Supplier to th input box. */
$(document).on('click', '.supplier__results li', function(e){
    var supplier__item = $(this).text();
    var supplier__id = $(this).attr('id');
    let supplier__idInsert = $(this).closest('.supplier__search').find('input[name="supplier_id"');
    var supplier__list = $(this).closest('.supplier__results');
    var supplier__value = $(this).closest('.supplier__search').find('.supplier__name');
    if(supplier__item != "No Results."){
        supplier__value.val(supplier__item);
        supplier__idInsert.val(supplier__id);
    }else{
        supplier__list.empty().removeClass('display__block');
    }
    supplier__list.empty().removeClass('display__block');
});
//Removes supplier_id if empty supplier name value is empty
$(document).on('change', '.supplier__name', function(){
    if($(this).val() == ''){
        $('input[name="supplier_id"').val('');
    }
});
</script>

@endsection