<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台系统首页
    public function index()
    {
        return view('admin.index');
    }

    //系统设置的网站配置
    public function info()
    {
        return view('admin.info');
    }
}
