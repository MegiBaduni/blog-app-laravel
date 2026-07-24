<!DOCTYPE html>
<html>
<head>
    <title>Postimet e mia</title>
</head>
<body>
    <h1>Postimet e mia</h1>

    <a href="/posts/create">+ Shto Postim</a>
    <hr>

    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>

        <a href="/posts/{{ $post->id }}/edit">Ndrysho</a>

        <form action="/posts/{{ $post->id }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Fshi</button>
        </form>

        <h4>Komentet:</h4>
        <ul>
            @foreach ($post->comments as $comment)
                <li>{{ $comment->body }}</li>
            @endforeach
        </ul>

        <form action="/posts/{{ $post->id }}/comments" method="POST">
            @csrf
            <input type="text" name="body" placeholder="Shkruaj një koment...">
            <button type="submit">Shto Koment</button>
        </form>

        <hr>
    @endforeach
    {{ $posts->links() }}
</body>
</html>