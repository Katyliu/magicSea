<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //验证码
    public function verifyCode()
    {
        $code = new \Code();
        $code->make();
    }
}
