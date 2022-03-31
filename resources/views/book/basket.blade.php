<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
@include('layouts.app')
<body>
    @if(session()->has('bookss'))
        @foreach(session()->get('bookss') as $book)
            <div class="clearfix mx-start">
                <div class="float-start productImg">
                    <img src="asset($book['imgUrl'])" width="100px" height="150px" alt="">
                </div>
                <div class="float-start product">
                    <h3>{{$book['title']}}</h3>
                    <h4>{{$book['price']}}$</h4>

                </div>
            </div>
        @endforeach
    @endif
</body>
</html>