<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    tr{
        padding:20px;
    }
    .productImg, .product{
        position:relative;
        float:left;
    }
    .product{
        width:60%;  
    }
    .productImg{
        width:10%;
    }
    .productImg img{
        text-align:center;
    }
    hr{
        clear:both;
    }
    .btn{
        width:150px;
    }
    .shop{
        text-align:center;
    }
</style>

</head>
<body>
@include('layouts.app')
<div>
            <div class="productImg">
                <img src="{{asset($book->imgUrl)}}" width="100px" height="150px" alt="">
            </div>
            <div class="product">
                <h3>{{$book->title}}</h3>
                <a href='{{ url("author/".$book->author_id) }}'><h6>{{$author->Fname.' '.$author->Lname}}</h6></a>
                <p>{{ substr($book->description,0,200) }}...</p>
            </div>
            <div class="shop">
                <h3>{{$book->price}}$</h3>
                <button class="btn btn-primary">ADD TO CART</button>
                <br>
                <br>
                <button class="btn btn-primary">SAVE</button>
            </div>
            <hr>
        </div>
</body>
</html>