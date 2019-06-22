<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function User()
    {
        return  $this->hasOne(User::class,'id','user_id');
    }
}
