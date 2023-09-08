<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Account extends Authenticatable
{
    public $table = "accounts";
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
