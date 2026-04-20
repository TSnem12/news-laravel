<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
}
