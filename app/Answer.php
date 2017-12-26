<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //1.添加回答api
    public function add()
    {

    	//1.检查用户是否登录
    	if(!user_ins()->is_logged_in())
    	{
    		return ['status' => 0, 'msg' => 'login required'];
    	}
        
    	//2.检查是否存在question_id 和content
    	if (!rq('question_id') || !rq('content')) 
    	{
    		return ['status' => 0, 'msg' => 'question_id and content are required'];
    	} 

        //3.检查问题是否存在
        $question = question_ins()->find(rq('question_id'));
    	//3.
    	if (!$question) 
    	{
    		 return ['status' => 0, 'msg' => 'question not exists'];
    	}
        
        //检查是否已回答
    	$answered = $this
    	->where(['question_id' => rq('question_id'), 'user_id' => session('user_id')])
    	->count();

    	//如果已经回答过了
    	if ($answered) 
    	{
    		return ['status' => 0, 'msg' => 'duplicate answers'];
    	}

    	$this->content = rq('content');
    	$this->question_id = rq('question_id');
    	$this->user_id = session('user_id');
    	//保存数据

    	return $this->save() ? 
    	    ['status' => 1, 'id' => $this->id] : 
    	    ['status' => 0, 'msg' => 'db insert failed'];
    }

    //1.更新回答api
    public function change()
    {
        //1.检查用户是否登录
    	if(!user_ins()->is_logged_in())
    	{
    		return ['status' => 0, 'msg' => 'login required'];
    	}

    	//2.检查是否存在id 
    	if (!rq('id') || !rq('content')) 
    	{
    		return ['status' => 0, 'msg' => 'id and content are required'];
    	} 

    	//3.检查权限
    	$answer = $this->find(rq('id'));
    	if ($answer->user_id != session('user_id')) 
    	{
    		return ['status' => 0, 'msg' => 'permission denied'];
    	}

        $answer->content = rq('content');
        return $answer->save() ? 
        ['status' => 1] : 
        ['status' => 0, 'msg' => 'db update failed'];

    }

    //1.查看回答问题api
    public function read()
    {   

        if (!rq('id') && !rq('question_id')) 
        {
            return ['status' => 0, 'msg' => 'id or question_id is required'];
        }

        if (rq('id')) 
        {
            //查看单个回答
            $answer = $this->find(rq('id'));
            if (!$answer) 
            {
                return ['status' => 0, 'msg' => 'answer not exists'];
            }
            else
            {
                return ['status' => 1, 'data' => $answer];
            }
        }

        //在查看回答前，检查问题是否存在
        if (!question_ins()->find(rq('question_id'))) 
        {
            return ['status' => 0, 'msg' => 'question not exists'];
        }
        
        //查看同一个问题的回答
        $answers = $this
          ->where('question_id', rq('question_id'))
          ->get()
          ->keyBy('id');

        return ['status' => 1, 'data' => $answers];

    }

    //删除回答api
    public function remove()
    {
        //1.检查用户是否登录
        if(!user_ins()->is_logged_in())
        {
            return ['status' => 0, 'msg' => 'login required'];
        }
        
        if(!rq('id'))
        {
            return ['status' => 0, 'msg' => 'id is required'];
        }

        $answer = $this->find(rq('id'));
        if(!$answer)
        {
            return ['status' => 0, 'msg' => 'answer not exists'];
        }

        if($answer->user_id != session('user_id'))
        {
            return ['status' => 0, 'msg' => 'permission denied'];
        }

        return $answer->delete() ? 
        ['status' => 1, 'msg' => 'delete success'] : 
        ['status' => 0, 'msg' => 'db delete failed'];
    }

    //投票API
    public function vote()
    {

        //1.检查用户是否登录
        if(!user_ins()->is_logged_in())
        {
            return ['status' => 0, 'msg' => 'login required'];
        }

        if(!rq('id') || !rq('vote'))
        {
            return ['status' => 0, 'msg' => 'id and vote are required'];
        }

        $answer = $this->find(rq('id'));
        
        if (!$answer) 
        {
            return ['status' => 0, 'msg' => 'answer not exists'];
        }

        //1.赞成 2.反对
        $vote = rq('vote') <= 1 ? 1 : 2;

        //检查此用户是否在相同问题下投过票,如果投过票就删除投票
        $answer->users()
        ->newPivotStatement()
        ->where('user_id', session('user_id'))
        ->where('answer_id', rq('id'))
        ->delete();

        //在连接表中增加数据  
        $answer
        ->users()
        ->attach(session('user_id'), ['vote' => $vote]);
        
        return ['status' => 1, 'msg' => 'success'];
    }

    public function user()
    {
        return $this
        ->belongsToMany('App\User');
        
    }

    public function users()
    {
        return $this
        ->belongsToMany('App\User')
        ->withPivot('vote')
        ->withTimestamps();   
    }
}


