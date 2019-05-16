<?php

namespace App\Traits;

use App\Post;
use Illuminate\Support\Facades\Auth;

trait Utils
{
    /*유틸함수###################################################################*/
    //반올림(업) 함수
    function round_up($number, $precision = 2)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    //페이지를 입력하면 4개로 맞도록 게시물 반환함수
    function get_page_post($page)
    {
        $id = Auth::user()->id;
        $count = Post::where('id', $id)->count();
        $pages = $this->round_up($count / 4, 0);

        $index = 1;
        $like = 0;
        $posts = array();

        if ($page <= 0) {
            $index = 1;
        } else if($page > $pages){
            $index = $pages;
        }else
        {
            $index = $page;
        }
        $all = Post::where('id', $id)->orderBy('created_at', 'desc')->get();
        //인덱스 4n+1 수식이 나옴
        for ($i=($index-1)*4; $i < $index*4 ; $i++) {
            $like += $all[$i]->likes;
            array_push($posts, $all[$i]);
            if($i >= $count - 1)
            break;
        }
        return View('home')->with(['count' => $count, 'like' => $like, 'posts' => $posts]);
    }
    /*유틸함수###################################################################*/
}
