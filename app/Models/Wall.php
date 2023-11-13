<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wall extends Model
{
    use HasFactory;

    protected $fillable = [
        "mes",
        "id",
        ];


    protected $hidden = [
        'id',
        'remember_token',
    ];


}
