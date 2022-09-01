<header id="header" class="u-header u-header-left-aligned-nav">'
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="#" class="text-gray-110 font-size-13 u-header-topbar__nav-link">Welcome to Lunartech Store</a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ route('contact.index') }}" class="u-header-topbar__nav-link"><i class="ec ec-map-pointer mr-1"></i> Store Locator</a>
                            </li>
                            @if( auth()->check())
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ route('order.track') }}" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Track Your Order</a>
                            </li>
                            @endif
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                <div class="d-flex align-items-center">
                                    <!-- Language -->
                                    <div class="position-relative">
                                        <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button"
                                            aria-controls="languageDropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-unfold-event="hover"
                                            data-unfold-target="#languageDropdown"
                                            data-unfold-type="css-animation"
                                            data-unfold-duration="300"
                                            data-unfold-delay="300"
                                            data-unfold-hide-on-scroll="true"
                                            data-unfold-animation-in="slideInUp"
                                            data-unfold-animation-out="fadeOut">
                                            <span class="d-inline-block d-sm-none">US</span>
                                            <span class="d-none d-sm-inline-flex align-items-center"><i class="ec ec-dollar mr-1"></i> Dollar (US)</span>
                                        </a>

                                        <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">
                                            <a class="dropdown-item active" href="#">USDollar</a>
                                            <a class="dropdown-item" href="#">ZIMDollar</a>
                                        </div>
                                    </div>
                                    <!-- End Language -->
                                </div>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ route('privacy.index') }}" class="u-header-topbar__nav-link">
                                     Terms and Conditions
                                </a>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                @if(Auth::check() && $role_id > 1)
                                <a id="sidebarNavToggler" href="{{ route('customer.logout') }}" role="button" class="u-header-topbar__nav-link"
                                    aria-controls="sidebarContent"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarContent"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInRight"
                                    data-unfold-animation-out="fadeOutRight"
                                    data-unfold-duration="500">
                                    <i class="ec ec-user mr-1"></i> Signout
                                </a>
                                
                                @elseif(Auth::check() && $role_id == 1)
                                <a id="sidebarNavToggler" href="{{ route('admin.products') }}" role="button" class="u-header-topbar__nav-link"
                                    aria-controls="sidebarContent"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarContent"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInRight"
                                    data-unfold-animation-out="fadeOutRight"
                                    data-unfold-duration="500">
                                    <i class="ec ec-user mr-1"></i>Go to Dashboard
                                </a>
                                @else
                                <a id="sidebarNavToggler" href="{{ route('customer.login') }}" role="button" class="u-header-topbar__nav-link"
                                    aria-controls="sidebarContent"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarContent"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInRight"
                                    data-unfold-animation-out="fadeOutRight"
                                    data-unfold-duration="500">
                                    <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span> Sign in
                                </a>
                                @endif
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo and Menu -->
        <div class="py-2 py-xl-4 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ url('/')}}" aria-label="Electro">
                                <img src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" 
                                    style="width:175.748px;" alt="">
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                aria-controls="sidebarHeader"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarHeader1"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft"
                                data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset pb-0">
                                        <!-- Toggle Button -->
                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                            <button type="button" class="close ml-auto"
                                                aria-controls="sidebarHeader"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-event="click"
                                                data-unfold-hide-on-scroll="false"
                                                data-unfold-target="#sidebarHeader1"
                                                data-unfold-type="css-animation"
                                                data-unfold-animation-in="fadeInLeft"
                                                data-unfold-animation-out="fadeOutLeft"
                                                data-unfold-duration="500">
                                                <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>
                                        <!-- End Toggle Button -->

                                        <!-- Content -->
                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                <!-- Logo -->
                                                <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" 
                                                    href="{{ url('/') }}" aria-label="Electro">
                                                        <img src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" 
                                                        style="width:175.748px;" alt="">
                                                <!-- End Logo -->



                                                <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                    <!-- Home -->
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ url('/') }}">Home</a>
                                                    </li>
                                                    <!-- End Home -->
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ url('/') }}">About Us</a>
                                                    </li>
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ route('category.index') }}">Categories</a>
                                                    </li>
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ route('tag.index') }}">Tags</a>
                                                    </li>
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ route('brand.index') }}">Brands</a>
                                                    </li>
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                                                    </li>
                                                    <li class="nav-item u-header__nav-item">
                                                        <a class="nav-link u-header__nav-link" href="{{ route('privacy.index') }}">Terms and Conditions</a>
                                                    </li>
                                                </ul>

                                                
                                            </div>
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Primary Menu -->
                    <div class="col d-none d-xl-block">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    <!-- Home -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <!-- End Home -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ url('/') }}">About Us</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('category.index') }}">Categories</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('tag.index') }}">Tags</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('brand.index') }}">Brands</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Primary Menu -->
                    <!-- Customer Care -->
                    <div class="d-none d-xl-block col-md-auto">
                        <div class="d-flex">
                            <i class="ec ec-support font-size-50 text-primary"></i>
                            <div class="ml-2">
                                <div class="phone">
                                    <strong>Support</strong> <a href="+263719719971" class="text-gray-90">+263 719719971</a>
                                </div>
                                <div class="email">
                                    E-mail: <a href="mailto:info@lunartechstore.co.zw?subject=Help Need" class="text-gray-90">info@lunartechstore.co.zw</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customer Care -->
                    <!-- Header Icons -->
                    <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Search"
                                        aria-controls="searchClassic"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-target="#searchClassic"
                                        data-unfold-type="css-animation"
                                        data-unfold-duration="300"
                                        data-unfold-delay="300"
                                        data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Search Product">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                            
                                <li class="col d-xl-none px-2 px-sm-3"><a href="{{ route('customer.login') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>
                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="{{ route('cart.index') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo and Menu -->

        <!-- Vertical-and-Search-Bar -->
        <div class="d-none d-xl-block bg-primary">
            <div class="container">
                <div class="row align-items-stretch min-height-50">
                    <!-- Vertical Menu -->
                    <div class="col-md-auto d-none d-xl-flex align-items-end">
                        <div class="max-width-270 min-width-270">
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion">
                                <!-- Card -->
                                <div class="card border-0 rounded-0">
                                    <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                        <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                            data-toggle="collapse"
                                            data-target="#basicsCollapseOne"
                                            aria-expanded="true"
                                            aria-controls="basicsCollapseOne">
                                            <span class="pl-1 text-gray-90">Lunartech Store</span>        
                                        </button>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Basics Accordion -->
                        </div>
                    </div>
                    <!-- End Vertical Menu -->
                    <!-- Search bar -->
                    <div class="col align-self-center">
                        <!-- Search-Form -->
                        <form method="get" action="{{ route('product.search') }}">
                            <label class="sr-only" for="searchProduct">Search</label>
                            <div class="input-group">
                                <input type="text" name="product_name" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="email" id="searchProduct" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
                                    <select class="js-select selectpicker dropdown-select custom-search-categories-select"
                                        data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2">
                                        <option value="one" selected>All Categories</option>
                                    </select>
                                    <!-- End Select -->
                                    <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="submit" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- End Search-Form -->
                    </div>
                    <!-- End Search bar -->
                    <!-- Header Icons -->
                    <div class="col-md-auto align-self-center">
                        <div class="d-flex">
                            <ul class="d-flex list-unstyled mb-0">
                                <li class="col pr-0">
                                    <a href="{{ route('quote.index') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Quote">
                                        <i class="font-size-22 ec ec-favorites"></i>
                                        <span id="quote__quantity" 
                                        class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">      
                                            {{ ( !empty($quote_quantity) ) ? $quote_quantity : 0 }}
                                        </span>
                                        <span class="text-gray-90 ml-3">
                                            <span class="ec ec-arrow-down-search"></span>
                                        </span>
                                    </a>       
                                </li>
                                <li class="col pr-0">
                                    <a href="{{ route('cart.index') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span id="cart__quantity" 
                                        class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">      
                                            {{ ( !empty($cart_quantity) ) ? $cart_quantity : 0 }}
                                        </span>
                                        <span class="text-gray-90 ml-3">
                                            <span class="ec ec-arrow-down-search"></span>
                                        </span>
                                    </a>       
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>