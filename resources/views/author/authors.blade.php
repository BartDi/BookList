<head>

</head>
@include('layouts.app')

<div class="container">
@if(isset($authors[0]))
    @foreach($authors as $author)
    <div class="card">
        <a href='{{ url("author/{$author->id}") }}'>
            <div class="clearfix mx-auto">
                <div class="float-start">
                    <img src="{{asset($author->img)}}" width="200px" height="300px" alt="">
                </div>
                <div class="float-start" style="padding:20px">
                    <h1>{{$author->Fname.' '.$author->Lname}}</h1>
                    <p>{{ substr($author->description,0,200) }}...</p>
                </div>
            </div> 
        </a>   
    </div>
<hr>
    @endforeach

@endif
</div>