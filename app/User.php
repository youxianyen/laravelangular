<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use Hash;


class User extends Model
{
    public function signup()
    {   
    /*
        dd(Request::get('password'));
        dd(Request::has('age'));
        dd(Request::all());
    */
        $has_username_and_password = $this->has_username_and_password();
        if (!$has_username_and_password) {
            return ['status' => 0, 'msg' => '用户名和密码不能为空！'];
        }
       
       $username = $has_username_and_password[0];
       $password = $has_username_and_password[1];
       /* 检查用户名是否存在。*/

       $user_exists = $this
         ->where('username', $username)
         ->exists();

        if ($user_exists) {
            return ['status' => 0, 'msg' => '用户名已存在'];
        }

        

        /* 加密密码。*/
        //$hashed_password = Hash::make($password);
        $hashed_password = bcrypt($password);  //和上面是一样的，换一种写法
        /* 存入数据库。*/
        $user = $this;
        $this->password = $hashed_password;
        $user->username = $username;

        if($user->save())
        {
            return ['status' => 1, 'id' => $user->id];
        }
        else 
        {
            return ['status' => 0, 'msg' => 'db insert fail'];
        }      
        
    }

    /*登录API*/
    public function login()
    {
        //dd(session('abc', 'csd')); 
        //检查用户名和密码是否存在
        $has_username_and_password = $this->has_username_and_password();
        if (!$has_username_and_password) {
            return ['status' => 0, 'msg' => '用户名和密码不能为空！'];
        }
        $username = $has_username_and_password[0];
        $password = $has_username_and_password[1];
        
        //检查用户是否存在
        $user =  $this->where('username', $username)->first();
        if (!$user) {
            return  ['status' => 0, 'msg' => '用户不存在'];
        }

        //检查密码是否正确
        $hashed_password = $user->password;
        $user_id = $user->id;
        if (!Hash::check($password, $hashed_password)) {

            return ['status' => 0, 'msg' => '密码错误'];
        }

        //将用户信息写入session
        session()->put('username', $user->username);
        session()->put('user_id', $user_id);

        return ['status' => 1, 'id' => $user->id];

    }

    public function has_username_and_password()
    {
        $username = rq('username');  //查看web.php定义rq方法
        $password = rq('password');
    /*检查用户名和密码是否为空。*/
        if ($username && $password)
            return [$username, $password];
        return false;
         
    }

    /*登出API*/
    public function logout()
    {
        //删除username
        session()->forget('username');
        //删除user_id
        session()->forget('user_id');
        return ['status' => 1];
        return redirect('/');
        //方法2
        //session()->put('username', null);  //清空username
        //session()->put('password', null);  //清空password
        //dd(session()->all());
    }
    
    /*检测用户是否登录*/
    public function is_logged_in()
    {
        //有user_id就返回user_id，没有user_id就返回false
        return session('user_id') ?: false;  //
    }
}
