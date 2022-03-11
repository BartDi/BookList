<head>
    <style>
        a{
            text-decoration: none;  
        }
    </style>
</head>
@include('layouts.app')

<table class="table">
  <thead>
    <tr>
        <th>@sortablelink('category')</th>
    </tr>
  </thead>
  <tbody>
        @foreach($categories as $key => $category)
            <tr>
                <td><a href='{{ url("/category/{$category->id}") }}' class="text-dark" title="{{$category->category}} Books">{{$category->category}}</a></td>
            </tr>
        @endforeach
        {{ $categories->links() }}
    </tbody>
</table>