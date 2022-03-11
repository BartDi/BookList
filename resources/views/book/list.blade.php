<head>
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
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>
</head>
<body>
@include('layouts.app')
    <div class="container">
        @if(isset($books[0]))
            @foreach($books as $book)
            <div>
                <div class="productImg">
                    <img src="{{asset($book->imgUrl)}}" width="100px" height="150px" alt="">
                </div>
                <div class="product">
                    <h3>{{$book->title}}</h3>
                    <a href='{{ url("author/".$book->author_id) }}'><h6>{{$book->Fname.' '.$book->Lname}}</h6></a>
                    <p>{{ substr($book->description,0,200) }}...</p>
                </div>
                @if(Auth::user())
                <div class="shop">
                    <form action='{{ route("save.product", ["id" => $book->id]) }}' method="GET">
                        <h3>{{$book->price}}$</h3>
                        <button class="btn btn-primary" type="submit">ADD TO CART</button>
                        <br>
                        <br>
                        <button class="btn btn-primary" type="submit">SAVE</button>
                    </form>
                </div>
                @endif
                <hr>
            </div>
            @endforeach 
            {{ $books->links('pagination::bootstrap-4') }}
        @else
        <div>
            <h1>There aren't any books,<br> Sorry</h1>
        </div>
        @endif

        @if(session()->has('books') )

        @endif

    </div>
    
</body>
