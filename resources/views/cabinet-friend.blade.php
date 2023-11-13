@extends('layouts.user_layout')

@section('title')
    <title>Запрос на дружбу</title>
@endsection


@section('content')

    <div class="container">
<!-- Вместо  action={{ '/cabinet/friend/'.$id }} можно action=""  -->
        <h3>Запрос на дружбу от: {{ $user->name }} {{ $user->surname }}</h3><br>
        <form id="register" action={{ '/cabinet/friend/'.$id }} method="post" >
            @csrf
            <div class="row form-row">
                <div class="col-sm-4"><input  type="submit" name="accept" id="submit" value="Принять"/></div>
                <div class="col-sm-4"><input  type="submit" name="reject" id="submit" value="Отклонить"/></div>
            </div>
        </form>

    </div> <!-- <div class="container"> -->

@endsection


