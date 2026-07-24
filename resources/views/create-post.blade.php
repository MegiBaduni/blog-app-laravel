<!DOCTYPE html>
<html>
<head>
    <title>Shto Postim</title>
</head>
<body>
    <h1>Shto një postim të ri</h1>

    <form action="/posts" method="POST">
        @csrf

        <label>Titulli:</label><br>
        <input type="text" name="title"><br><br>

        <label>Përmbajtja:</label><br>
        <textarea name="body"></textarea><br><br>

        <button type="submit">Ruaj</button>
    </form>
</body>
</html>
