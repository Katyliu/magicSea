<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;


class LoginController extends CommonController
{
    //登陆
    public function login()
    {
        if($input = Input::all()){
            $rules = [
                'email'=>'required|email',
                'password'=>'required|alpha_num|between:6,20',
                'code'=>'required|between:4,4',
            ];
            $message = [
                'password.required'=>'密码不能为空！',
                'password.alpha_num'=>'密码必须是字母或数字！',
                'password.between'=>'密码必须在6-20位之间！',
                'email.required'=>'邮箱账号不能为空！',
                'email.email'=>'不是正确的邮箱账号！',
                'code.required'=>'验证码不能为空！',
                'code.between'=>'验证码必须是四位！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $codeObj = new \Code();
                $validatorCode  = $codeObj->get();
                if($validatorCode != strtoupper($input['code']))
                {
                    return back()->with('errors','验证码错误')->withInput();
                }
                $userData =  User::where('email', $input['email'])->first();
                if($userData)
                {
                    if($userData->status == 1)
                    {
                        return back()->with('errors','此邮箱账号被封禁')->withInput();
                    }
                    if($userData->password == md5($input['password']))
                    {
                        session(['userName'=>$userData->name]);
                        session(['userUid'=>$userData->uid]);
                        if(isset($input['rememberme']))
                        {
                            $user_info = array('name'=>$userData->name,'uid'=>$userData->uid);
                            $user = \Cookie::make('autoBlog', $user_info, 60*24*7);
                            return redirect(route('viewIndex'))->withCookie($user);
                        }
                        return redirect(route('viewIndex'));
                    }else{
                        return back()->with('errors','账号或者密码不对')->withInput();
                    }
                }else{
                    return back()->with('errors','此邮箱还未注册')->withInput();
                }
            }else {
                    return back()->withErrors($validator);
            }
            }else {
                return view('admin.login');
            }
    }

    //注册
    public function register()
    {
        if($input = Input::except('_token'))
        {
            $rules = [
                'email'=>'required|email|unique:user',
                'name'=>'required|between:1,10',
                'password'=>'required|alpha_num|between:6,20',
                'password_re'=>'same:password',
                'code'=>'required|between:4,4',
            ];
            $message = [
                'password.required'=>'密码不能为空！',
                'password.alpha_num'=>'密码必须是字母或数字！',
                'password.between'=>'密码必须在6-20位之间！',
                'password_re.same'=>'两次密码不一致！',
                'email.required'=>'邮箱账号不能为空！',
                'email.email'=>'不是正确的邮箱账号！',
                'email.unique' => '此邮箱已被注册过',
                'name.required' => '昵称不能为空',
                'name.between' => '昵称必须是1-10位',
                'code.required'=>'验证码不能为空！',
                'code.between'=>'验证码必须是四位！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $codeObj = new \Code();
                $validatorCode  = $codeObj->get();
                if($validatorCode != strtoupper($input['code']))
                {
                    return back()->with('errors','验证码错误')->withInput();
                }
                $input['uid'] = $this->makeUid($input['email']);
                $input['password'] = md5($input['password']);
                $ret = User::create($input);
                if($ret)
                {
                    return redirect(route('viewLogin'));
                }else
                {
                    return back()->with('errors','网络繁忙，请稍后再试')->withInput();
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.register');
        }
    }

    //生成uid
    protected function makeUid($email)
    {
        $time = time();
        $max_id = max(0, User::max('id'));
        $b = substr(base_convert($email,16,10),0,10);
        $c = sprintf('%010s',$b);
        $d = sprintf('%010s',$time);
        $f = substr(($c + $d + $max_id), 0, 10);
        return $f;
    }

}
