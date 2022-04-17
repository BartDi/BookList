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
        @if(session()->has('information'))
            <div class="alert alert-primary" role="alert">
                {{ session()->get('information') }}
            </div>
        @elseif(session()->has('succes'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('succes') }}
            </div>
        @endif
        @if(isset($books[0]))
            @foreach($books as $book)
            <a href='{{url("product/{$book->id}")}}'><div class="clearfix mx-start">
                <div class="float-start productImg">
                    <img src="{{asset($book->imgUrl)}}" width="100px" height="150px" alt="">
                </div>
                <div class="float-start product">
                    <h3>{{$book->title}}</h3>
                    <a href='{{ url("author/".$book->author_id) }}'><h6>{{$book->Fname.' '.$book->Lname}}</h6></a>
                    <p>{{ substr($book->description,0,200) }}...</p>
                </div>
                @if(Auth::user())
                <div class="float-start shop">
                    <form action='{{ url("/save") }}' method="POST">
                        @csrf
                        <input type="hidden" name="id" value='{{ $book->id }}'>
                        @if( $book->amount === 0 )
                            <h6 style="color:red">Out of stock</h6>
                        @elseif($book->amount < 10)
                            <h6 style="color:red">Last units</h6>
                        @endif
                        <h3>{{$book->price}}$</h3>
                        <button class="btn btn-primary" name="action" value="add" type="submit">ADD TO CART</button>
                        <br>
                        <br>
                        <button class="btn btn-primary" name="action" value="save" type="submit">SAVE</button>
                    </form>
                </div>
                @endif
                <hr>
            </div></a>
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


@section('footer')

@endsection
</body>
