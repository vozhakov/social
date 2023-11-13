<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   @section('title') <title>Социальная сеть</title>@show

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
</head>

<body>

<header>
    <div class="container">
        <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="img">
@php
    //$authorization = \Illuminate\Support\Facades\Auth::check();
     $authorization = auth()->check();
@endphp
        @if($authorization)
            <form class="form-inline">
                <div class="form-group">
                    {{ auth()->user()->name }}  {{ auth()->user()->surname }}, вы авторизованы <i class="fa fa-user" aria-hidden="true"></i>

                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" height="40">
                    @else <img src="{{ asset('assets/img/no-photo.png') }}" height="40">
                    @endif

                </div>
            </form>
        @else
            <form class="form-inline">
                <div class="form-group">
                    Вы не авторизованы <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
            </form>
        @endif

        <!-- Здесь была форма входа            -->
    </div>
</header>

<nav class="navbar navbar-default nav-js">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}/" class="href-link">Главная</a></li>

                @if($authorization)
                <li><a href="{{ route('wall') }}" class="href-link">Стена</a></li>
                <li><a href="{{ route('community') }}" class="href-link">Сообщество</a></li>
                <li><a href="{{ route('cabinet') }}" class="href-link" id="cabinet">Личный кабинет</a></li>
                <li><a href="{{ route('logout') }}" class="href-link">Выход</a></li>
                @else
                <li><a href="{{ route('register') }}" class="href-link">Регистрация</a></li>
                <li><a href="{{ route('login.create') }}" class="href-link">Вход</a></li>
                @endif

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">@include('layouts.alerts')</div>


@yield('content')

<footer>
    <div class="container">
        <p>СоцСеть &copy, 2015 - @php echo date('Y'); @endphp</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>

<script>
let url = document.location.href;
let uri = document.location.pathname
let nav = document.querySelectorAll( ".href-link" );


nav.forEach(function(el){
    if(url == el.getAttribute('href') ) {
       el.classList.add('current');
    }
 });

/* if  (uri == '/cabinet/edit'){
document.querySelector("#cabinet").classList.add('current');
} */
</script>

</body>
</html>

