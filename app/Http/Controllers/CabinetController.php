<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    // Личный кабинет
    public function index()
    {

// выборка друзей, которых я добавил в друзья, мой id Auth::id() записан в сессии
      $friends1  = DB::table('friends')
            ->join('users', 'friends.friend_two', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.occupation', 'users.photo')
            ->where('friends.friend_one', '=', Auth::id())
            ->where('friends.status', '=', '2')
            ->orderBy('friends.id', 'asc');
// выборка друзей, которые меня добавили в друзья + верхняя выборка
        $friends  = DB::table('friends')
            ->join('users', 'friends.friend_one', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.occupation', 'users.photo')
            ->where('friends.friend_two', '=', Auth::id())
            ->where('friends.status', '=', '2')
            ->orderBy('friends.id', 'asc')
            ->union($friends1)
            ->paginate(3);

// мои заявки на дружбу
        $myId = Auth::id();
        $MyRequestForFriendship = DB::select("SELECT u.id, u.name, u.surname, u.occupation, u.photo FROM  users u JOIN friends f WHERE  f.friend_two = u.id AND f.friend_one = $myId AND f.status = '1'");

// заявки на дружбу со мной
     $requestForFriendship = DB::select("SELECT u.id, u.name, u.surname, u.occupation, u.photo FROM  users u JOIN friends f WHERE  f.friend_one = u.id AND f.friend_two = $myId AND f.status = '1'");

        return view('cabinet', ['friends' => $friends, 'friendship' => $requestForFriendship, 'myfriendship' => $MyRequestForFriendship] );
    }

    /* Редактирование */
    public function create()
    {
       return view('cabinet-edit',) ;
    }

    /* Валидация и сохранение в БД результата редактирования */
    public function store(Request $request)
    {
// сделал перевод в файле resources/lang/ru/validation.php
        $request->validate([
            "surname" => "required", // фамилия
            "name" => "required",  // имя
            "patronymic" => "required",  // очество
            "gender" => "not_in:0",   // пол
            "occupation" => "not_in:0", // род занятий
           // "email" => "required|email|unique:users",
            "password" => "required|min:6|confirmed",
        ]);

        if($request->hasFile('photo')) {
            $folder = date('Y-m-d'); //например 2021-11-28
             Storage::delete("images/{$folder}");
            //  путь к фотографии storage/app/public/images/дата/имя файла
            // имя файлу дает laravel
            $photo = $request->file('photo')->store("images/{$folder}");
        }

        DB::table('users')
            ->where('id', auth()->user()->id)
            ->update([
            "surname" => $request->surname,
            "name" => $request->name,
            "patronymic" => $request->patronymic,
            "gender" => $request->gender,
            "occupation" => $request->occupation,
            //  "email" => $request->email,
            "password" =>Hash::make($request->password),
            "photo" => $photo ?? null,
        ]);
        session()->flash('success', 'Данные изменены');
        //return redirect()->route('home');
        //return redirect('/');
        return redirect()->home();
    }

// добавление друга по заявке в кабинете, форма
   public function friend($id)
   {
       $user = User::find($id);
       return view('cabinet-friend', ['id' => $id, 'user' => $user]) ;
    }

    public function storeFriend(Request $request, $id )
    {

        $input = $request->input('accept');

        if($input) {
            DB::table('friends')
                ->where('friend_one', $id)
                ->update(['status' => '2']);
            session()->flash('success', 'Дружба одобрена');
            return redirect()->route('cabinet');
        }
        else {
            DB::table('friends')
                ->where('id', $id)
                ->delete();
            session()->flash('success', 'Дружба отклонена');
            return redirect()->route('cabinet');
        }
    }
// выбор: написать сообщение или исключить  из друзей
    public function friendw($id)
    {
        $user = User::find($id);
        return view('cabinet-friendw', ['id' => $id, 'user' => $user]) ;
    }
// исключить из друзей
    public function deleteFriendw($id)
    {
        DB::table('friends')
            ->where('friend_one', $id)
            ->orWhere('friend_two', $id)
            ->update(['status' => '0']);
        session()->flash('success', 'Пользователь исключен из друзей');
        return redirect()->route('cabinet');
    }
// вывод переписки с другом $id и формы сообщения другу
    public function messageFriendw($id)
    {
        $user = User::find($id); // объект одна запись, столбцы-свойства
        $messages = DB::table('messages') //массив объектов
            ->where('mes_from', '=', $id)
            ->where('mes_to', '=', Auth::id())
            ->orWhere('mes_from', '=', Auth::id())
            ->where('mes_to', '=', $id)
            ->get();

        return view('cabinet-message', ['messages' => $messages, 'user' => $user]) ;
    }

    public function storeCabinetMessage(Request $request, $id)
    {
        $myId = Auth::id(); // id пользователя -  от кого
        $friendId = $id; // id пользователя - кому
        $text = $request->input('text');
        if($text){
           DB::table('messages')->insert(
            ['mes_from' => $myId, 'mes_to' => $friendId, 'message' => $text]
            );
            session()->flash('success', 'Сообщение отправлено');
            return redirect()->route('cabinet');
        }else{
            dump('no');
        }
    }


}
