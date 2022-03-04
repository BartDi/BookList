<head>
<style>
    tr{
        padding:20px;
    }
</style>
</head>
<body>
@include('layouts.app')
<table class="table table-hover">
<thead>
    <td scope="col"><b>Image</b></td>
    <td scope="col"><b>Title</b></td>
    <td scope="col"><b>Description</b></td>
    <td scope="col"><b>Author</b></td>
    <td scope="col"><b>Publisher</b></td>
    <td scope="col"><b>Category</b></td>
    <td scope="col"><b>Publication</b></td>
</thead>
<tbody>
@foreach($books as $book)
<tr>
    <td><img src="{{$book->imgUrl}}" width="20" height="20"></td>
    <td>{{$book->title}}</td>
    <td>{{$book->description}}</td>
    <td>{{$book->Fname.' '.$book->Lname}}</td>
    <td>{{$book->publisher}}</td>
    <td>{{$book->category}}</td>
    <td>{{$book->publication}}</td>
</tr>
@endforeach
</tbody>
</table>
</body>
