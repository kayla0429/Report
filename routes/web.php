<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $utils = new Utils();
    return $utils->get_page_guest_post(0, 12, 'main');
});

Route::get('/posts/{page}', function ($page) {
    $utils = new Utils();
    return $utils->get_page_guest_post($page, 12, 'main');
});

Route::get('/like/{pid}', function ($pid) {
    $current = Post::where('pid', $pid)->first();
    $likeimage = Post::where('pid', $pid)->update(['likes' => $current->likes += 1]);
    $all = Post::all();
    return redirect()->back()->with(['all' => $all,]);
});

Auth::routes();

Route::post('/home', 'HomeController@validator')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/delete/{pid}', 'HomeController@delete');
Route::get('/home/change', 'HomeController@change');
Route::get('/home/{page}', 'HomeController@page');
Route::get('/home/change/check', 'HomeController@check');

