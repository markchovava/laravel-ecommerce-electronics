@foreach($products as $product)
    <h1>{{ $product->name }}</h1>
   <p>Amount in stock: 
        @if( intval($product->inventories->quantity) > 0 )
            {{ intval($product->inventories->quantity) }}
        @else  
            <span style="color:red;">{{ $product->inventories->quantity }}</span>
        @endif
    </p>
@endforeach