<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Book</h1>
        <div>
        @if(session()->has('success'))
        <div>
            {{session('success')}}
        </div>
        @endif
    </div>
    <div>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>title</th>
                <th>quantity</th>
                <th>price</th>
                <th>description</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->quantity}}</td>
                <td>{{$book->price}}</td>
                <td>{{$book->description}}</td>
                <td>
                    <a href="{{route('book.edit',['book' => $book])}}">edit</a>
                </td>
                <td>
                    <form action="{{route('book.delete',['book'=>$book])}}" method="post">
                        @csrf
                        @method("delete")
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>