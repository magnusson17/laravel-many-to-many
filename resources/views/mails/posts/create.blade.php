<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body{
            background-color: blue;
        }
    </style>
</head>
<body>
    <h2>Hola chaval {{$post->title}}</h2>
    <p>Categoria: {{ $post->$category->label }}</p>

    <ul>
        @forelse ($post->tags as $tag)
            <li>{{$tag->label}}</li>
        @empty
            
        @endforelse
    </ul>
</body>
</html>