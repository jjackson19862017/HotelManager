<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    public static function getUserIdAttribute($id)
    {
        //dd($id);
        $username = User::find($id)->select('username')->get();
        return $username;
    }
}
