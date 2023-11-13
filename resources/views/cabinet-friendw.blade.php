@extends('layouts.user_layout')

@section('title')
    <title>Запрос на дружбу</title>
@endsection

@section('content')

    <div class="container">
    <h3>Работа с пользователем: {{ $user->name }} {{ $user->surname }}</h3><br>

        <div class="row">
            <div class="col-sm-4">
                <a href="{{ '/cabinet/friendmes/'.$id }}">
                    <button type="button" class="btn btn-default btn-sm btn-color">
                        Посмотреть переписку и написать сообщение
                    </button>
                </a>
            </div>

                <div class="col-sm-4">
                    <a href="{{ '/cabinet/frienddel/'.$id }}">
                        <button type="button" class="btn btn-default btn-sm btn-color">
                            Удалить из друзей
                        </button>
                    </a>
                </div>

        </div>
     </div> <!-- <div class="container"> -->

@endsection
