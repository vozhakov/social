<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Нет страницы</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

</head>

<body>
<div class="container">
<h1>{{ $exception->getMessage() }}</h1>
<h3>404 | Нет такой страницы.</h3>
    <h4><a href="{{ route('home') }}">Перейти на главную</a></h4>
</div>
</body>
</html>

