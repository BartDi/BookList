<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
<title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>
</head>
<body>
@include('layouts.app')
<h1>Library</h1>

@foreach($books as $book)
    <a href='{{ url("/book/{$book->id}") }}'><div class="clearfix mx-start">
        <div class="float-start productImg">
            <img src="{{asset($book->imgUrl)}}" width="100px" height="150px" alt="">
        </div>
        <div class="float-start product">
            <h3>{{$book->title}}</h3>
            <p>{{ substr($book->description,0,200) }}...</p>
        </div> 
    </div></a>
    <hr>
@endforeach

</body>
</html>