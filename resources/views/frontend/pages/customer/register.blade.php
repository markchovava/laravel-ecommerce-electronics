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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Register</li>
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
             Returning customer? <a href="{{ route('customer.login') }}" class="alert-link"> Click here to Login.</a>
        </div>
        <!-- Title -->
        <div class="mb-4">
                <p class="text-gray-90 mb-2"> New customer? Register today.</p>
            </div>
            <!-- End Title -->
        <!--  -->
        <!-- Form -->
        <form class="p-5" method="post" action="{{ route('customer.register.process') }}">
        @csrf
            <div class="row">
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="">First Name</label>
                        <input type="text" class="form-control" name="first_name"  placeholder="First Name" aria-label="First Name">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrPasswordExample2">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="">Username</label>
                        <input type="name" class="form-control" name="name" id="" placeholder="Username" aria-label="Username" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email address" aria-label="Email address" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="">Password</label>
                        <input type="password" class="form-control" name="password" id="" 
                        placeholder="********" aria-label="********" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" 
                        placeholder="********" aria-label="********" required>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
            </div>
            <!-- Button -->
            <div class="mb-1">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary-dark-w px-5">Register</button>
                </div>
                
            </div>
            <!-- End Button -->
        </form>
        <!-- End Form -->
    </div>
</main>

@endsection