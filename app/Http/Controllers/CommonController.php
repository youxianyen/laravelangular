<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function timeLine()
    {
        list($limit, $skip) = paginate(rq('page'), rq('limit'));
        //获取问题
        $questions = question_ins()
            ->limit($limit)
            ->skip($skip)
            ->orderby('created_at', 'desc')
            ->get();

        //获取回答
        $answers = answer_ins()
            ->limit($limit)
            ->skip($skip)
            ->orderby('created_at', 'desc')
            ->get();
        //合并
        $data = $questions->merge($answers);
        //排序
        $data = $data->sortBy(function ($item) {
            return $item->created_at;
        });

        $data = $data->values()->all();
        return ['status' => 200, 'data' => $data];
    }
}
