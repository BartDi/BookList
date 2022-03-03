@include('layouts.app')


@foreach($authors as $author)
    <h3>{{$author->Fname. ' ' .$author->Lname}}</h3>
    <a href='{{url("author/books/".$author->id)}}'><h2>Books</h2></a>
@endforeach