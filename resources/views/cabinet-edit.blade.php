@extends('layouts.user_layout')

@section('title')
    <title>Редактирование профиля</title>
@endsection


@section('content')

    <div class="container">

        <h3>Редактирование личных данных</h3><br>
        <form id="register" action="{{ route('cabinetEdit.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="row form-row">
                <div class="col-sm-2"><label  for="surname">Фамилия</label></div>
                <div class="col-sm-4"><input  type="text" name="surname" id="surname" required value="{{ auth()->user()->surname }}" /></div>
            </div>

            <div class="row form-row">
                <div class="col-sm-2"><label for="name">Имя</label></div>
                <div class="col-sm-4"><input type="text" name="name" id="name" required value="{{ auth()->user()->name }}"/></div>
            </div>

            <div class="row form-row">
                <div class="col-sm-2"><label for="patronymic">Отчество</label></div>
                <div class="col-sm-4"><input type="text" name="patronymic" id="patronymic" required value="{{ auth()->user()->patronymic }}"/></div>
            </div>

            <div class="row form-row">
                <div class="col-sm-2"><label for="gender">Пол</label></div>
                <div class="col-sm-4">
                    <label >
                        <select name="gender" id="gender">
                            <option value="0">Выбрать...</option>
                            <option value="1"@php if( auth()->user()->gender ==1 ) echo ' selected'; @endphp>
                                Мужской</option>
                            <option value="2"@php if( auth()->user()->gender ==2 ) echo ' selected'; @endphp>
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
                            <option value="Наемный работник"@php if( auth()->user()->occupation == 'Наемный работник' ) echo ' selected'; @endphp>
                                Наемный работник</option>
                            <option value="Предприниматель"@php if( auth()->user()->occupation == 'Предприниматель' ) echo ' selected'; @endphp>
                                Предприниматель</option>
                            <option value="Военный"@php if( auth()->user()->occupation == 'Военный' ) echo ' selected'; @endphp>
                                Военный</option>
                            <option value="Пенсионер"@php if( auth()->user()->occupation == 'Пенсионер' ) echo ' selected'; @endphp>
                                Пенсионер</option>
                            <option value="Учащийся"@php if( auth()->user()->occupation == 'Учащийся' ) echo ' selected'; @endphp>
                                Учащийся</option>
                            <option value="Безработный"@php if( auth()->user()->occupation ==  'Безработный' ) echo ' selected'; @endphp>
                                Безработный</option>
                            <option value="Домохозяйка"@php if( auth()->user()->occupation == 'Домохозяйка' ) echo ' selected'; @endphp>
                                Домохозяйка</option>
                        </select>
                    </label>
                </div>
            </div> <!-- <div class="row form-row"> -->
<!--
            <div class="row form-row">
                <div class="col-sm-2"><label  for="email">E-mail</label></div>
                <div class="col-sm-4"><input  type="email" name="email" id="email" required value="{{ auth()->user()->email }}"  /></div>
            </div>
-->
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
                <div class="col-sm-4"><input  type="submit" name="submit" id="submit" value="Сохранить"/></div>
            </div>

        </form>

    </div> <!-- <div class="container"> -->

@endsection

