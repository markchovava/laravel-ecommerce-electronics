@extends('frontend.layouts.master')

@section('frontend')


<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Contact-v1</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->


            <div class="container">
                <div class="mb-5">
                    <h1 class="text-center">Contact Us</h1>
                </div>
                <div class="row mb-10">
                    <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Leave us a Message</h3>
                            </div>
                            <p class="max-width-830-xl text-gray-90">Write to us, we would like to hear from you.</p>
                            <form method="post" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                First name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="first_name" placeholder="" aria-label="" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Last name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="last_name" placeholder="" aria-label="" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Email
                                            </label>
                                            <input type="text" class="form-control" name="email" placeholder="" aria-label="" data-msg="Please enter Email." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Subject
                                            </label>
                                            <input type="text" class="form-control" name="subject" placeholder="" aria-label="" data-msg="Please enter subject." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Your Message
                                            </label>

                                            <div class="input-group">
                                                <textarea class="form-control p-5" rows="4" name="message" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6">
                        <div class="mb-6">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835252972956!2d144.95592398991224!3d-37.817327693787625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1575470633967!5m2!1sen!2sin" width="100%" height="288" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Our Address</h3>
                        </div>
                        <address class="mb-6 text-lh-23">
                            {!! $info->company_address !!}
                            <div class="">Support: {!! $info->company_phone_number !!} </div>
                            <div class="">Email: <a class="text-blue text-decoration-on"
                             href="mailto:{!! $info->company_email !!}"> {!! $info->company_email !!} </a>
                            </div>
                        </address>
                        <h5 class="font-size-14 font-weight-bold mb-3">Opening Hours</h5>
                        <div class="mb-6">{!! $info->operating_hours !!}</div>
                        <h5 class="font-size-14 font-weight-bold mb-3">Careers</h5>
                        <p class="text-gray-90">If you’re interested in employment opportunities at {!! $info->company_name !!}, please email us: 
                            <a class="text-blue text-decoration-on" 
                            href="mailto:contact@yourstore.com">{!! $info->email_two !!}</a></p>
                    </div>
                </div>


        <!-- Brand Carousel -->
        <div class="mb-8">
            <div class="py-2 border-top border-bottom">
                <div class="js-slick-carousel u-slick my-1"
                    data-slides-show="5"
                    data-slides-scroll="1"
                    data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                    data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                    data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                    data-responsive='[{
                        "breakpoint": 992,
                        "settings": {
                            "slidesToShow": 2
                        }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }, {
                        "breakpoint": 554,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }]'>
                    @foreach($brands as $brand)
                        <div class="js-slide">
                            <a href="{{ route('brand.view', $brand->id) }}" class="link-hover__brand">
                                <div style="width:200px; height:60px; object-fit:contain;">
                                    <img class="img-fluid m-auto max-height-50" 
                                    src="{{ (!empty($brand->image)) ? url('storage/products/brand/' . $brand->image) : url('storage/products/no_image.jpg') }}" alt="Image Description">
                                </div>
                                
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Brand Carousel -->


    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->



@endsection