<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

class User extends Model
{
    //注册API
    public function signup()
    {
    	/*检查用户名是否为空*/
    	/*检查密码是否为空*/
    	/*检查用户名是否存在*/
    	/*加密密码*/
    	/*存入数据库*/
    	dd(Request::get('password'));
    	dd(Request::has(['age']));
    	dd(Request::all());
    }
}
