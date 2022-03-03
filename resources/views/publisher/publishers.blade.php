@include('layouts.app')

@foreach($publishers as $publisher)
    <a href='{{ url("publisher/".$publisher->id) }}'><h3>{{$publisher->publisher}}</h3></a>
@endforeach