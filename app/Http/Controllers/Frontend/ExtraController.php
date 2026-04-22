<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ExtraController extends Controller
{
    public function Arabic()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang', 'arabic');

        return redirect()->back();
    }


    public function English()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang', 'english');

        return redirect()->back();
    }


    public function SinglePost($id)
    {
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.*',
                'categories.category_en',
                'categories.category_ar',
                'subcategories.subcategory_en',
                'subcategories.subcategory_ar',
                'users.name'
            )->where('posts.id', $id)->first();

        return view('main.single_post', compact('posts'));
    }
}
