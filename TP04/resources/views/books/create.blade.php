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
    <form action="{{route('book.store')}}" method="post">
        @csrf
        @method("post")
        <div>
            <label for="">title</label>
            <input type="text" name="title" placeholder="title">
            <input type="text" name="description" placeholder="description">
            <input type="number" name="quantity" placeholder="quantity" >
            <input type="number" name="price" placeholder="price" >
        </div>
        <button type="submit" >Create Now</button>
    </form>
</body>
</html>