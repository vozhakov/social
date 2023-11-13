@extends('layouts.user_layout')

@section('title')
    <title>Запрос на дружбу</title>
@endsection


@section('content')

    <div class="container">
        <h4>Переписка с пользователем: {{ $user->name }} {{ $user->surname }}</h4>
        @if(count($messages))
           @foreach($messages as $message)
                <div class="row">
                    @if($message->mes_from == Auth::id())
                        {{ $message->time  }}  | От меня:
                    <p>{{ $message->message }}</p> <hr>
                    @else
                        {{ $message->time  }}  | От пользователя: {{ $user->name }} {{ $user->surname }}
                    <p>{{ $message->message }}</p> <hr>
                    @endif
                  </div>
            @endforeach

            @else
            <p>Нет сообщений</p> <hr>
        @endif



        <h4>Напишите сообщение пользователю: {{ $user->name }} {{ $user->surname }}</h4>
        <form action="" method="post">
            @csrf

            <div class="row form-row">
                <div><textarea rows="12" cols="64" name="text"></textarea></div>
            </div>

            <div class="row form-row">
                 <div class="col-sm-4"><input  type="submit" name="submit" id="submit" value="Отправить"/></div>
            </div>

        </form>

    </div> <!-- <div class="container"> -->

@endsection



