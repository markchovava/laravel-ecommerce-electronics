@foreach($categories as $category)
    <h2>{{ $category->name}}</h2>
    @foreach($category->products as $a)
        <p>{{$a->name}}</p>
    @endforeach
@endforeach