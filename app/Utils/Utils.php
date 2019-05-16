<?php
namespace App\Utils;

use App\Post;
use Illuminate\Support\Facades\Auth;

//유틸 클래스
class Utils
{
    /*유틸함수###################################################################*/
    //반올림(업) 함수
    public function round_up($number, $precision = 2)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    //페이지를 입력하면  맞도록 게시물 반환함수
    public function get_page_auth_post($page, $max, $view)
    {
        $id = Auth::user()->id;
        $count = Post::where('id', $id)->count();
        $pages = $this->round_up($count / $max, 0);

        $index = 1;
        $like = 0;
        $posts = array();

        //0인경우 인덱스 범위 벗어나버림
        if($count <= 0)
            return View($view)->with(['count' => $count, 'like' => $like, 'posts' => $posts]);

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
        for ($i=($index-1)*$max; $i < $index*$max ; $i++) {
            array_push($posts, $all[$i]);
            if($i >= $count - 1)
            break;
        }
        foreach ($all as $value) {
            $like += $value->likes;
        }
        return View($view)->with(['count' => $count, 'like' => $like, 'posts' => $posts]);
    }

    public function get_page_guest_post($page, $max, $view)
    {
        $count = Post::all()->count();
        $pages = $this->round_up($count / $max, 0);

        $index = 1;
        $like = 0;
        $posts = array();

        //0인경우 인덱스 범위 벗어나버림
        if($count <= 0)
            return View($view)->with(['count' => $count, 'like' => $like, 'posts' => $posts]);

        if ($page <= 0) {
            $index = 1;
        } else if($page > $pages){
            $index = $pages;
        }else
        {
            $index = $page;
        }
        $all = Post::orderBy('created_at', 'desc')->get();
        //인덱스 4n+1 수식이 나옴
        for ($i=($index-1)*$max; $i < $index*$max ; $i++) {
            array_push($posts, $all[$i]);
            if($i >= $count - 1)
            break;
        }
        return View($view)->with(['count' => $count, 'posts' => $posts]);
    }
    /*유틸함수###################################################################*/
}
