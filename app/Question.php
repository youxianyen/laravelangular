<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //创建问题
    public function add()
    {
        //1.检查用户是否登录
    	if(!user_ins()->is_logged_in())
    		{
                return ['status' => 0, 'msg' => 'login required'];
    		}

        //2.检查是否有问题title
    	if (!rq('title')) {
    		return ['status' => 0, 'msg' => 'title required'];
    	}
    	$this->title = rq('title');
    	$this->user_id = session('user_id');
    	
    	//3.如果有问题描述就添加描述
    	if (rq('desc')) {
    		$this->desc = rq('desc');
    	}

    	//4.保存信息
    	return  $this->save() ? 
    	['status' => 1, 'id' => $this->id] : 
    	['status' => 0, 'msg' => 'db insert failed'];
    }

    //更新问题api
    public function change()
    {
        //1.检查用户是否登录
        if(!user_ins()->is_logged_in())
        {
            return ['status' => 0, 'msg' => 'login required'];
        }

        //2.检查传参中是否有ID
        if (!rq('id')) 
        {
            return ['status' => 0, 'msg' => 'id is required'];
        }

        //3.获取指定ID的model
        $question = $this->find(rq('id'));
        if (!$question) {
            return ['status' => 0, 'msg' => 'question not exists'];
        }

        //4.判断问题是否存在
        if ($question->user_id != session('user_id')) 
        {
            return ['status' => 0, 'msg' => 'permission denied'];
        }

        //4.保存数据
        if (rq('title')) 
        {
            $question->title = rq('title');
        }

        //5.
        if (rq('desc')) 
        {
            $question->desc = rq('desc');
        }

        return $question->save() ? 
        ['status' => 1] : 
        ['status' => 0, 'msg' => 'db update failed'];
    }

    public function read_by_user_id($user_id)
    {
        $user = user_ins()->find($user_id);
        if (!$user) 
        {
            return err('user not exists');
        }

        $r = $this->where('user_id', $user_id)
          ->get()->keyBy('id');

        return suc($r->toArray());
    }

    //查看问题api
    public function read()
    {
        //1.请求参数中是否有ID，如果有ID，直接返回ID所在的行     
        if (rq('id')) 
        {
            return ['status' => 1,'data' => $this->find(rq('id'))];
        }

        if (rq('user_id'))
        {
            $user_id = rq('user_id') == 'self' ? 
              session('user_id') : 
              rq('user_id');
            return $this->read_by_user_id($user_id);
        }

        //limit条件
        $limit = rq('limit') ?: 15;
        //skip条件，用于分页。
        $skip = (rq('page') ? rq('page') - 1 : 0) * $limit;
        //构建query并返回collection数据。
        $r = $this
            ->orderBy('created_at')
            ->limit($limit)
            ->skip($skip)
            ->get(['id', 'title', 'desc', 'user_id', 'created_at', 'updated_at'])
            ->keyBy('id');

        return ['status' => 1, 'data' => $r];
    }

    //删除问题API
    public function remove()
    {
        //1.检查用户是否登录
        if(!user_ins()->is_logged_in())
        {
            return ['status' => 0, 'msg' => 'login required'];
        }

        //2.如果没有ID，直接返回
        if (!rq('id')) {
            return ['status' => 0, 'msg' => 'id is required'];
        }

        //3.获取传参ID对应 的model
        $question = $this->find(rq('id'));
        if (!$question) {
           return ['status' => 0, 'msg' => 'question not exists'];
        }

        //4.判断用户是否是问题所有者
        if (session('user_id') != $question->user_id) {
            return ['status' => 0, 'msg' => 'permission denied'];
        }

        return $question->delete() ? 
        ['status' => 1] : 
        ['status' => 0, 'msg' => 'db delete failed'];

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
