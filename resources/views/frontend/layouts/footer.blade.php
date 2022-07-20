<footer>
   
    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                        <div class="col my-4 my-md-0">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message">
                        <label class="sr-only" for="subscribeSrEmail">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="Email address" aria-label="Email address" aria-describedby="subscribeButton" required
                            data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
    <!-- Footer-bottom-widgets -->
    <div class="pt-8 pb-4 bg-gray-13">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-6">
                        <a href="#" class="d-inline-block">
                            <img src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" 
                                style="width:200px;" alt="">
                        </a>
                    </div>
                    @if(!empty($info))
                    <div class="mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support text-primary font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                @if( !empty($info->company_phone_number) )
                                <a href="tel:{{ $info->company_phone_number }}" class="font-size-20 text-gray-90"> 
                                    {{ $info->company_phone_number }}
                                </a>  
                                @endif     
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-1 font-weight-bold">Contact info</h6>
                        <address class="">
                            {{ $info->company_address }}
                        </address>
                    </div>
                    <div class="my-4 my-md-4">
                        <ul class="list-inline mb-0 opacity-7">
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" 
                                href="#">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-google btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-twitter btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-github btn-icon__inner"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @if( isset($footer_categories) )
                                    @foreach($footer_categories as $category)
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ route('category.view', $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                @if( isset($footer_brands) )
                                    @foreach($footer_brands as $brand)
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ route('brand.view', $brand->id) }}">
                                            {{ $brand->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @if(Auth::check() && $role_id > 1)
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ route('order.track') }}">Order Tracking</a>
                                    </li>
                                @else
                                    <li>
                                        <a class="list-group-item list-group-item-action" href="{{ route('customer.login') }}">My Account</a>
                                    </li>
                                @endif
                                <li><a class="list-group-item list-group-item-action" href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('contact.index') }}">Contact Us</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('brand.index') }}">Brands</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('tag.index') }}">Tags</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('privacy.index') }}">Terms and Conditions</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex">
                <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">Lunartech Store</a> - All rights Reserved 2022</div>
                
            </div>
        </div>
    </div>
    <!-- End Footer-copy-right -->
</footer>