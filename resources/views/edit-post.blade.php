<!DOCTYPE html>
<html>
<head>
    <title>Ndrysho Postim</title>
</head>
<body>
    <h1>Ndrysho postimin</h1>

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')

        <label>Titulli:</label><br>
        <input type="text" name="title" value="{{ $post->title }}"><br><br>

        <label>Përmbajtja:</label><br>
        <textarea name="body">{{ $post->body }}</textarea><br><br>

        <button type="submit">Përditëso</button>
    </form>
</body>
</html>