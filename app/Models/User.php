<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;
//Authenticatable
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "surname",
        "name",
        "patronymic",
        "gender",
        "occupation",
        "email",
        "password",
        "photo",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
// связь "один ко многим" таблицы users с таблицей walls
   /* public function walls() // имя связи walls
    {
       return $this->hasMany('app\Models\Wall', 'id_user');
    }*/
}
