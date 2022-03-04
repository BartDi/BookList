<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@include('layouts.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action='{{url("/storeBook")}}' method="POST" enctype="multipart/form-data">
    @csrf
    <select name="categories" id="categories">
        @foreach($categories as $key => $category)
            <option name="category" value="{{$key}}">{{$category}}</option>
        @endforeach
    </select>
    <select name="authors" id="authors">
        @foreach($authors as $key => $author)
            <option name="author" value="{{$key}}">{{$author}}</option>
        @endforeach
    </select>
    <select name="publishers" id="publishers">
        @foreach($publishers as $key => $publisher)
            <option name="publisher" value="{{$key}}">{{$publisher}}</option>
        @endforeach
    </select>
    <input type="text" name="title" placeholder="title">
    <input type="text" name="description" placeholder="description">
    <input type="number" name="publication" placeholder="2022">
    <input type="file" name="file" id="file">
    <input type="submit">
    </form>
</body>
</html>