<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
                 /* Регистрация */
   public function create()
   {
      return view('register',) ;
   }

    public function store(Request $request)
    {
// сделал перевод в файле resources/lang/ru/validation.php
 $request->validate([
      "surname" => "required", // фамилия
      "name" => "required",  // имя
      "patronymic" => "required",  // очество
      "gender" => "not_in:0",   // пол
      "occupation" => "not_in:0", // род занятий
      "email" => "required|email|unique:users",
      "password" => "required|min:6|confirmed",
     "photo" => "nullable|image",
     ]);
// Второй вариант валидации
       /* $rules = [
            "surname" => "required", // фамилия
            "name" => "required",  // имя
            "patronymic" => "required",  // очество
            "gender" => "not_in:0",   // пол
            "occupation" => "not_in:0", // род занятий
            "email" => "required|email|unique:users",
            "password" => "required|min:6|confirmed",
        ];

        $messages = [
            "surname.required" => 'Заполните поле "Фамилия".',
            "name.required" => 'Заполните поле "Имя".',
            "patronymic.required" => 'Заполните поле "Отчество".',
            "gender.not_in" => "Выберите пол",
            "occupation.not_in" => "Выберите род занятий",
            "email.required" => 'Заполните поле "E-mail".',
            "email.email" => 'Поле "E-mail не соответствует формату e-mail".',
            "email.unique:users" => 'Такой е-mail имеется в базе данных.',
            "password.required" => 'Заполните поле "Пароль".',
            "password.min" => 'Поле "Пароль" должно быть не менее 6 символов.',
            "password.confirmed" => 'Не совпадают пароли.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate(); */

    /*    User::create($request->all()); // Записываем в БД без хеширования */

      if($request->hasFile('photo')) {
         $folder = date('Y-m-d'); //например 2021-11-28
          //  путь к фотографии storage/app/public/images/дата/имя файла
          // имя файлу дает laravel
          $photo = $request->file('photo')->store("images/{$folder}");
      }

       $user = User::create([
            "surname" => $request->surname,
            "name" => $request->name,
            "patronymic" => $request->patronymic,
            "gender" => $request->gender,
            "occupation" => $request->occupation,
            "email" => $request->email,
            "password" =>Hash::make($request->password),
            "photo" => $photo ?? null,
        ]);

        session()->flash('success', 'Вы зарегистрированы');
        // сразу авторизуем
       Auth::login($user); // Авторизуем в сессии

       //return redirect()->route('home');
        //return redirect('/');
        return redirect()->home();
    }

                      /* Авторизация */
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([

            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('wall');
            }
        return redirect()->back()->with('error', 'Неправильный E-mail или парооль');
    // Ошибка error выводится в файле resources/views/layouts/alerts.blade.php
    }

    public function logout()
    {
       Auth::logout();
       return redirect()->route('login.create');
    }

}
