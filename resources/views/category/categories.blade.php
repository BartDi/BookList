@include('layouts.app')

<table>
    <tr>
        <th>@sortablelink('category')</th>
    </tr>
    @foreach($categories as $key => $category)
        <tr>
        <td>{{$category->category}}</td>
        </tr>
    @endforeach
</table>