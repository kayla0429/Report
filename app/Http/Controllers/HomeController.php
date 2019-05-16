<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Traits\UploadTrait;
use App\Utils\Utils;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    use UploadTrait;


    //생성자
    public function __construct()
    {
        $this->middleware('auth');
        $utils = new Utils();
    }

    //성능향샹을 위해서 db접속을 최소화 하자.
    public function index()
    {
        $utils = new Utils();
        return $utils->get_page_auth_post(0, 4, 'home');
    }

    public function page($page)
    {
        $utils = new Utils();
        return $utils->get_page_auth_post($page, 4, 'home');
    }

    public function delete($pid)
    {
        $all = Post::all();
        Post::where('pid', $pid)->delete();
        foreach ($all as $value) {
            if($value->pid == $pid)
            {
                unlink('.'.$value->image);
            }
        }
        return redirect()->back()->with(['posts' => $all,]);
    }

    //비밀번호 변경 유효성검사
    public function check(Request $request)
    {
        if($request->password != $request->password_confirmation)
        {
            return redirect()->back()->with(['status'=>'비밀번호가 일치하지 않습니다.']);
        }
        if(strlen($request->password) < 8)
        {
            return redirect()->back()->with(['status'=>'비밀번호는 최소 8자 이상이여야 합니다.']);
        }
        //엘로퀀트 사용안됨 ㄷㄷ 임시로 이렇게 해둠;;(비밀번호는 암호화해서 저장)
        DB::update('update users set password = ? '.' where id = ?', [Hash::make($request->password), Auth::user()->id]);

        $id = Auth::user()->id;

        $mypostsinfo = Post::where('id', $id)->orderBy('created_at', 'desc')->get();
        $count = Post::where('id', $id)->count();
        $like = 0;
        foreach (Post::where('id', $id)->get('likes') as $value) {
            $like += $value->likes;
        }
        return View('home')->with(['count' => $count, 'like' => $like, 'posts' => $mypostsinfo]);
    }

    //비밀번호 변경
    public function change()
    {
        return View('changepassword');
    }

    //이미지 유효성 검사 및 업로드
    public function validator(Request $request)
    {
        $post = new Post;

        //검사및 메세지
        $messages = [
            'required' => '이미지 업로드에 문제가 있습니다.',
            'title.max' => '제목은 최대 12자 까지 입니다.',
            'content.max' => '내용은 최대 255자 까지 입니다.',
            'image.max' => '최대 5MB까지 올릴수 있습니다.',
            'image' => '이미지만 입력 가능합니다.',
            'mimes' => 'jpeg, png, jpg, gif, svg 형식 만 업로드 가능합니다.'
        ];
        $this->validate($request, [
            'title' => 'required|max:12',
            'content' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120' //폰 사진 찍어서 올리는것도 감안해서 5mb정도만 허용함(응답시간 조정 및 프론트에서 한번더 체크바람)
        ], $messages);



        //title_date 형식으로 파일을 /imgs에 저장할거임
        $image = $request->file('image');
        $name = str_slug($request->input('title')).'_'.time();
        $folder = '/imgs';

        try {
            $filePath = $folder .'/'. $name. '.' . $image->getClientOriginalExtension();
            $this->upload($image, $folder, 'public', $name);

            //DB저장
            $post->likes = 0;
            $post->id = Auth::user()->id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $filePath;
            $post->save();

        } catch (Throwable $th) {
            return redirect()->back()->with(['status'=>'업로드에 실패 했습니다.']);
        }
        return redirect()->back()->with(['status'=>'사진이 업로드 되었습니다.']);
    }
}
