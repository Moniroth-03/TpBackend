<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a book</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form action="{{route('book.update',['book'=>$book])}}" method="post">
        @csrf
        @method("put")
        <div>
            <label for="">title</label>
            <input type="text" name="title" placeholder="title" value="{{$book->title}}">
            <input type="text" name="description" placeholder="description" value="{{$book->description}}">
            <input type="number" name="quantity" placeholder="quantity" value="{{$book->quantity}}">
            <input type="number" name="price" placeholder="price" value="{{$book->price}}">
        </div>
        <button type="submit" >update</button>
    </form>
</body>
</html>