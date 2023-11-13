<?php

namespace App\Http\Controllers;

use App\Models\Wall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Models\User;

class PageController extends Controller
{
    /************************************/
    public function community()
    {
    // выборка id моих друзей из столбца  friend_two, мой id Auth::id() записан в сессии
        $friends_two  = DB::table('friends')
            ->select('friend_two')
            ->where('friend_one', '=', Auth::id())
            ->where('status', '=', '2');
// выборка моих id друзей из столбца  friend_one + верхняя выборка
        // массив объектов
        $friends  = DB::table('friends')
            ->select('friend_one')
            ->where('friend_two', '=', Auth::id())
            ->where('status', '=', '2')
            ->union($friends_two)
            ->get();
/*
         foreach ($friends as $friend) {
           echo $friend->friend_one . '<br>'; здесь id моих друзей
        }
*/
        $members = DB::table('users') ->orderBy('occupation', 'asc')->paginate(16);
        $isFriend = false;
        return view('community', ['members' => $members, 'friends' => $friends, 'isFriend' => $isFriend]);
    }
    /************************************/
    public function addfriend($id)
    {
        // Проверка на наличие друга в таблице friends
        // выборка id моих друзей из столбца  friend_two, мой id Auth::id() записан в сессии
        $friends_two  = DB::table('friends')
            ->select('friend_two')
            ->where('friend_one', '=', Auth::id())
            ->where('status', '=', '2');
// выборка моих id друзей из столбца  friend_one + верхняя выборка
        // массив объектов
        $friends  = DB::table('friends')
            ->select('friend_one')
            ->where('friend_two', '=', Auth::id())
            ->where('status', '=', '2')
            ->union($friends_two)
            ->get();
// В массиве объектов $friends в $friend->friend_one находятся id всех моих друзей
        $isFriend = false;
        foreach ($friends as $friend) {
            if($friend->friend_one == $id) $isFriend = true;
        }

        if($isFriend){
            session()->flash('error', '"Этот друг имеется у вас"');
            return redirect()->route('community');
        }

        DB::table('friends')
            ->where('friend_one', $id)
            ->orWhere('friend_two', $id)
            ->update(['status' => '2']);
        session()->flash('success', 'Друг добавлен');
        return redirect()->route('community');
    }
    /************************************/
    public function wall()
    {
        $friends1  = DB::table('friends')
            ->join('users', 'friends.friend_two', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.occupation', 'users.photo')
            ->where('friends.friend_one', '=', Auth::id())
            ->where('friends.status', '=', '2')
            ->orderBy('friends.id', 'desc');
// выборка друзей, которые меня добавили в друзья + верхняя выборка
        $friends  = DB::table('friends')
            ->join('users', 'friends.friend_one', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.occupation', 'users.photo')
            ->where('friends.friend_two', '=', Auth::id())
            ->where('friends.status', '=', '2')
            ->orderBy('friends.id', 'desc')
            ->union($friends1)
            ->limit(10)
            ->get();

     $posts = DB::table('walls')
    ->join('users', 'walls.id_user', '=', 'users.id')
    ->select('users.id', 'users.name', 'users.surname', 'users.occupation', 'users.photo', 'walls.message', 'walls.id AS walls_message_id')
     ->orderBy('walls.id', 'desc')
     ->paginate(4);

        $comments = DB::table('comments')
            ->join('users', 'comments.from_user', '=', 'users.id')
            ->select('comments.id_message', 'comments.comment', 'comments.from_user', 'users.name', 'users.surname', 'users.occupation', 'users.photo')
            ->get();

        return view('wall', ['friends' => $friends, 'posts' => $posts, 'comments' => $comments]);
    }
    /***********************************************/
    public function wallStore(Request $request)
    {
        $request->validate([
            "mes" => "required",
             ]);


       Wall::insert([
            "message" => $request->mes,
            "id_user" => $request->id,
]);


        session()->flash('success', 'Сообщение сохранено');
        return redirect()->route('wall');
    }

    public function commentStore(Request $request)
    {
        $request->validate([
            "comment" => "required",
        ]);

        DB::table('comments')
            ->insert(['id_message' => $request->id_message, 'comment' => $request->comment, 'from_user' => $request->id,]);
        return redirect()->route('wall');
    }
}
