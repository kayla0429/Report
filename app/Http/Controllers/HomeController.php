<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadTrait;
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
    }

    public function index()
    {
        $id = Auth::user()->id;

        $mypostsinfo = Post::where('id', $id)->orderBy('created_at', 'desc')->get();
        $count = Post::where('id', $id)->count();
        $like = 0;
        foreach (Post::where('id', $id)->get('likes') as $value) {
            $like += $value->likes;
        }
        return View('home')->with(['count' => $count, 'like' => $like, 'posts' => $mypostsinfo]);
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
        //엘로퀀트 사용안됨 ㄷㄷ 임시로 이렇게 해둠;;
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
    public function change()
    {
        return View('changepassword');
    }

    //유효성 검사 및 업로드
    public function validator(Request $request)
    {


        $post = new Post;

        $messages = [
            'required' => '이미지 업로드에 문제가 있습니다.',
            'max:12' => '최대 12자 까지 입니다.',
            'max:255' => '최대 255자 까지 입니다.',
            'image' => '이미지만 입력 가능합니다.',
            'mimes' => 'jpeg, png, jpg, gif, svg 형식 만 업로드 가능합니다.',
        ];

        $this->validate($request, [
            'title' => 'required|max:12',
            'content' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], $messages);


        $image = $request->file('image');
        $name = str_slug($request->input('title')).'_'.time();
        $folder = '/imgs';

        try {
            $filePath = $folder .'/'. $name. '.' . $image->getClientOriginalExtension();
            $this->upload($image, $folder, 'public', $name);

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
