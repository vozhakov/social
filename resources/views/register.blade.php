@extends('layouts.user_layout')

@section('title')
    <title>Регистрация</title>
@endsection


@section('content')

    <div class="container">

        <h3>Заполните все поля <span id="photo-comment">(Фото не обязательно)<span></h3><br>
    <form id="register" action="{{ route('register.store') }}" method="post" enctype="multipart/form-data">

     @csrf

      <div class="row form-row">
      <div class="col-sm-2"><label  for="surname">Фамилия</label></div>
      <div class="col-sm-4"><input  type="text" name="surname" id="surname" required value="{{ old('surname') }}" /></div>
      </div>

      <div class="row form-row">
      <div class="col-sm-2"><label for="name">Имя</label></div>
      <div class="col-sm-4"><input type="text" name="name" id="name" required value="{{ old('name') }}"/></div>
      </div>

      <div class="row form-row">
      <div class="col-sm-2"><label for="patronymic">Отчество</label></div>
      <div class="col-sm-4"><input type="text" name="patronymic" id="patronymic" required value="{{ old('patronymic') }}"/></div>
      </div>

      <div class="row form-row">
      <div class="col-sm-2"><label for="gender">Пол</label></div>
      <div class="col-sm-4">
      <label >
      <select name="gender" id="gender">
      <option value="0">Выбрать...</option>
      <option value="1"@php if( old('gender') ==1 ) echo ' selected'; @endphp>
      Мужской</option>
      <option value="2"@php if( old('gender') ==2 ) echo ' selected'; @endphp>
      Женский</option>
      </select>
      </label>
      </div>
      </div> <!-- <div class="row form-row"> -->

      <div class="row form-row">
      <div class="col-sm-2"><label for="occupation">Род занятий</label></div>
      <div class="col-sm-4">
      <label >
      <select name="occupation" id="occupation">
      <option value="0">Выбрать...</option>
      <option value="Наемный работник"@php if( old('occupation') == 'Наемный работник' ) echo ' selected'; @endphp>
      Наемный работник</option>
      <option value="Предприниматель"@php if( old('occupation') == 'Предприниматель' ) echo ' selected'; @endphp>
      Предприниматель</option>
      <option value="Военный"@php if( old('occupation') == 'Военный' ) echo ' selected'; @endphp>
      Военный</option>
      <option value="Пенсионер"@php if( old('occupation') == 'Пенсионер' ) echo ' selected'; @endphp>
      Пенсионер</option>
      <option value="Учащийся"@php if( old('occupation') == 'Учащийся' ) echo ' selected'; @endphp>
      Учащийся</option>
      <option value="Безработный"@php if( old('occupation') == 'Безработный' ) echo ' selected'; @endphp>
      Безработный</option>
      <option value="Домохозяйка"@php if( old('occupation') == 'Домохозяйка' ) echo ' selected'; @endphp>
      Домохозяйка</option>
      </select>
      </label>
      </div>
      </div> <!-- <div class="row form-row"> -->

      <div class="row form-row">
      <div class="col-sm-2"><label  for="email">E-mail</label></div>
      <div class="col-sm-4"><input  type="email" name="email" id="email" required value="{{ old('email') }}"  /></div>
      </div>

      <div class="row form-row">
      <div class="col-sm-2"><label  for="password">Пароль</label></div>
      <div class="col-sm-4"><input  type="password" name="password" id="password" required placeholder="не может быть меньше 6 символов"/></div>
      </div>

        <div class="row form-row">
            <div class="col-sm-2"><label  for="password_confirmation">Подтвердите пароль</label></div>
            <div class="col-sm-4"><input  type="password" name="password_confirmation" id="password_confirmation" /></div>
        </div>

        <div class="row form-row">
            <div class="col-sm-2"><label  for="photo">Добавьте фото</label></div>
            <div class="col-sm-4"><input  type="file" name="photo" id="photo" class="form-control-file"/></div>
        </div>

        <div class="row form-row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4"><input  type="submit" name="submit" id="submit" value="Зарегистрироваться"/></div>
        </div>

    </form>

    </div> <!-- <div class="container"> -->

@endsection
