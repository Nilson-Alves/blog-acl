<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Login</title>
</head>
<body>
    <form action={{route('login')}} method="post">
        @csrf
        <label for="email">Email</label><br />
        <input type="email" name="email" id="email"><br />
        <label for="password">Password</label><br />
        <input type="password" name="password" id="password"><br />
        <button type="submit">Entrar</button>
    </form>
</body>
</html>