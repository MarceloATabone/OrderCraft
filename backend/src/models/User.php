<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = [
        'first_name',
        'last_name',
        'document',
        'email',
        'password',
        'phone_number',
        'birth_date',
    ];
}
