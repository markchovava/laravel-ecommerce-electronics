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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Track your Order</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mx-xl-10">
            <div class="mb-6 text-center">
                <h1 class="mb-6">To proceed to PayNow Click Below.</h1>
                @if(!$response->success)
                <div class="alert alert-primary mb-4 text-black" style="text-align:left;">
                    Report: <b>An error occured while communicating with Paynow</b><br>
                    Status: <b> {{ $response->error }} </b>
                </div>
                @else
                <a href="{{ $response->redirectUrl() }}" class="text-black font-weight-medium"> 
                    <div class="alert alert-primary mb-4 text-black">
                        Click here To make payment of:
                        <strong>${{ number_format((float)$pay, 2, '.', '') }}</strong>
                    </div>
                </a> 
                @endif


                @if(isset($_GET['paynow-return']))
                    <script>
                        alert('Thank you for your payment!');
                    </script>
                @endif
                
                
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->









@endsection