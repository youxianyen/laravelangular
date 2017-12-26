<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    /*时间域API*/
    public function timeline()
    {
    	list($limit, $skip) = paginate(rq('page'), rq('limit'));

    	/*获取问题数据*/
    	$question = question_ins()
    	->with('user')
    	->limit($limit)
    	->skip($skip)
    	->orderBy('create_at', 'desc')
    	->get();

    	//获取回答数据
    	$answer = answer_ins()
    	->limit($limit)
    	->skip($skip)
    	->orderBy('create_at', 'desc')
    	->get();
    }
}
