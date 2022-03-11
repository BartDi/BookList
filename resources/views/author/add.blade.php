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
    <form action='{{url("/storeAuthor")}}' method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="Fname" id="Fname" placeholder="First Name">
    <input type="text" name="Lname" id="Lname" placeholder="Last Name">
    <input type="text" name="description" placeholder="description">
    <input type="file" name="author" id="author">
    <input type="submit">
    </form>
</body>
</html>