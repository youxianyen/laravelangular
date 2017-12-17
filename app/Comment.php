<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /*添加评论api*/
    public function add()
    {
    	//1.检查用户是否登录
    	if(!user_ins()->is_logged_in())
    	{
    		return ['status' => 0, 'msg' => 'login required'];
    	}

        //2.检查评论是否为空
        if (!rq('content')) 
        {
        	return ['status' => 0, 'msg' => 'empty content'];
        }

        //3.
        if (
        	(!rq('question_id') && !rq('answer_id')) ||   //none
        	(rq('question_id') && rq('answer_id'))        //all
        ) 
        {
        	return ['status' => 0, 'msg' => 'question_id or answer_id is required'];
        }

        //4.
        if (rq('question_id')) 
        {
        	$question = question_ins()->find(rq('question_id'));
        	if (!question) 
        	{
        		return ['status' => 0, 'msg' => 'question not exists'];
        	}
        	$this->question_id = rq('question_id');
        } 
        else 
        {
        	$answer = answer_ins()->find(rq('answer_id'));
        	if (!answer) 
        	{
        		return ['status' => 0, 'msg' => 'answer not exists'];
        	}
        	$this->answer_id = rq('answer_id');
        }

        if (rq('reply_to')) 
        {
            $target = $this->find('reply_to');
            if (!target) 
            {
            	return ['status' => 0, 'msg' => 'target comment not exists'];
            }
            else 
            {
            	$this->reply_to = rq('reply_to');
            }
        }        

        $this->content = rq('content');
        $this->user_id = session('user_id');
        $this->save() ? 
        ['status' => 1, 'id' => $this->id] :
        ['status' => 0, 'msg' => 'db insert failed'];
    }

}
