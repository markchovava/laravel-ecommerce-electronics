@foreach($products as $product)
    <h1> {{ $product->name }} </h1>
    @if( intval($product->discounts->discount_percent) > 0)
    <p> The Discount: {{ intval($product->discounts->discount_percent) }}% </p>
    @endif
@endforeach