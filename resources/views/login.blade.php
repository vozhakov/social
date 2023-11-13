@extends('layouts.user_layout')

@section('title')
    <title>Вход</title>
@endsection


@section('content')

    <div class="container">

        <h3>Заполните поля</h3><br>
        <form id="login" action="{{ route('login') }}" method="post">

            @csrf

            <div class="row form-row">
                <div class="col-sm-2"><label  for="email">E-mail</label></div>
                <div class="col-sm-4"><input  type="email" name="email" id="email" required value="{{ old('email') }}"  /></div>
            </div>

            <div class="row form-row">
                <div class="col-sm-2"><label  for="password">Пароль</label></div>
                <div class="col-sm-4"><input  type="password" name="password" id="password" required/></div>
            </div>

            <div class="row form-row">
                <div class="col-sm-2"></div>
                <div class="col-sm-4"><input  type="submit" name="submit" id="submit" value="Войти"/></div>
            </div>

        </form>

    </div> <!-- <div class="container"> -->

@endsection

