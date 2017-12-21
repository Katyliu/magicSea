<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'user';
    protected $guarded = array();
    public $timestamps  = false;
    protected $fillable = ['uid', 'name', 'email', 'password'];
}
