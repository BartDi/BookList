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
    <div class="card">
        <div class="clearfix mx-start">
            <div class="float-start">
                <img src="{{asset($author->img)}}" width="200px" height="300px" alt="">
            </div>
            <div class="float-start" style="padding:20px">
                <h1>{{$author->Fname.' '.$author->Lname}}</h1>
                <p>{{ substr($author->description,0,200) }}...</p>
            </div>
        </div>   
    </div>
    <h4>Author's books:</h4>
    @foreach($books as $book)
        <div class="card">
            <div class="clearfix mx-start">
                <div class="float-start">
                    <img class="card-img-top" width="100px" height="150px" src='{{ asset($book->imgUrl) }}' >
                </div>
                <div class="float-start">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ $book->description }}</p>
                        <a href='{{ url("/product/{$book->id}") }}' class="btn btn-primary">See</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>