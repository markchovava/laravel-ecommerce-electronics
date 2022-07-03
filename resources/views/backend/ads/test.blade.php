<div class="col-lg-6 col-xxl-4">
    <!--begin::Card-->
    <div class="h-100 card card-flush py-4">
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Heading-->
            <div class="fs-2hx fw-bolder" style="margin-bottom:1rem;">Advert 1</div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="image__upload mb-10">
                <!--begin::Label-->
                <label class="required form-label">Ad Image</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="file" name="ad_image[]" value="{{ $ads[3]->image }}" class="form-control mb-2 ad__upload" placeholder="Category Name" value="" />
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
                <label class="form-label">Position </label>
                <!--end::Label-->
                <!--begin::Select2-->
                <select name="ad_position[]" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add__status_select">
                    <option value="">Select on option.</option>
                    <option value="First" {{ ($ads[3]->position == 'First') ? 'selected="selected"' : '' }}>First</option>
                    <option value="Second" {{ ($ads[3]->position == 'Second') ? 'selected="selected"' : '' }}>Second</option>
                    <option value="Third" {{ ($ads[3]->position == 'Third') ? 'selected="selected"' : '' }}>Third</option>
                    <option value="Forth" {{ ($ads[3]->position == 'Forth') ? 'selected="selected"' : '' }}>Forth</option>
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
                <label class="form-label">Title</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="text" name="ad_title[]" value="{{ $ads[3]->title }}" class="form-control mb-2" placeholder="Add Description..." />
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a title to the ad for better visibility.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label">Button Name:</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="text" name="ad_click_name[]" value="{{ $ads[3]->click_name }}" class="form-control mb-2" placeholder="Add Description..." />
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a button text to the ad for better visibility.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label">Short Description</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="text" name="ad_description[]" value="{{ $ads[3]->description }}" class="form-control mb-2" placeholder="Add Description..."/>
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a description to the ad for better visibility.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label">Percent </label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="number" name="ad_percent[]" value="{{ $ads[3]->percent }}" class="form-control mb-2" placeholder="Add Percent..." />
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a percent to the ad.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label">Price </label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="number" name="ad_price[]" value="{{ $ads[3]->price }}" class="form-control mb-2" placeholder="Add Price..."/>
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a price in cents, it will be converted to dollars.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="form-label">Link </label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input type="text" name="ad_link[]" value="{{ $ads[3]->link }}" class="form-control mb-2" placeholder="Add Price..."/>
                <!--end::Editor-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set a link to the ad.</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Select2-->
                <select name="ad_status[]" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select">
                    <option></option>
                    <option value="Published" {{ ($ads[3]->status == 'Published') ? 'selected="selected"' : '' }}>Published</option>
                    <option value="Scheduled" {{ ($ads[3]->status == 'Scheduled') ? 'selected="selected"' : '' }}>Scheduled</option>
                    <option value="Unpublished" {{ ($ads[3]->status == 'Unpublished') ? 'selected="selected"' : '' }}>Unpublished</option>
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set the ad status.</div>
                <!--end::Description-->
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>