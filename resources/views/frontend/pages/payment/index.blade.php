@extends('frontend.layouts.master')

@section('frontend')


@if(!$response->success)
    <h2>An error occured while communicating with Paynow</h2>
    <p> {{ $response->error }} </p>;
@else{
    <a href="{{ $response->redirectUrl() }}">Click here to make payment of ${{ $pay }}</a>
@endif


@if(isset($_GET['paynow-return']))
    <script>
        alert('Thank you for your payment!');
    </script>
@endif



@endsection