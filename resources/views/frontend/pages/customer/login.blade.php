@extends('frontend.layouts.master')

@section('frontend')

 <!-- ========== MAIN CONTENT ========== -->
 <main id="content" role="main" class="checkout-page">
     <!-- breadcrumb -->
     <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Signin</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Sign In</h1>
        </div>
         <!-- Register Link -->
         <div class="alert alert-primary mb-4" role="alert">
            New customer? <a href="{{ route('customer.register') }}" class="alert-link">Click here to Register.</a>
        </div>
        <!-- Title -->
        <div class="mb-4">
                <p class="text-gray-90 mb-2"> Returning customer? Welcome back!</p>
            </div>
            <!-- End Title -->
        <!--  -->
        <!-- Form -->
        <form class="p-5" method="post" action="{{ route('customer.login.process') }}">
            @csrf
            
            <div class="row">
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3">Email address</label>
                        <input type="email" class="form-control" name="email" autocomplete="off" id="signinSrEmailExample3" placeholder="Email address" aria-label="Email address" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="">Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="off" id="" placeholder="********" aria-label="********" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
            </div>
            <!-- Checkbox -->
            <div class="js-form-message mb-3">
                <div class="custom-control custom-checkbox d-flex align-items-center">
                    <input type="checkbox" name="remember" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox">
                    <label class="custom-control-label form-label" for="rememberCheckbox">
                        Remember me
                    </label>
                </div>
            </div>
            <!-- End Checkbox -->
            <!-- Button -->
            <div class="mb-1">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary-dark-w px-5">Signin</button>
                </div>
                <div class="mb-2">
                    <a class="text-blue" href="#">Lost your password?</a>
                </div>
            </div>
            <!-- End Button -->
            
        </form>
        <!-- End Form -->
    </div>
</main>

@endsection