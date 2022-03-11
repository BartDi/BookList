<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    @include('layouts.app')
    <div>
        <img src="{{asset('$author->img')}}" alt="">
    </div>
    <div>
        <h1>{{$author->Fname.' '.$author->Lname}}</h1>
        <p>{{$author->description}}</p>
    </div>
    @foreach($books as $book)
        <h5>{{ $book->title }}</h5>
    @endforeach
</body>
</html>