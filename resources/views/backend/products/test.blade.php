@foreach($products as $product)
    <h2>{{ $product->name}}</h2>
    @foreach($product->categories as $a)
        <p>{{$a->name}}</p>
    @endforeach
@endforeach