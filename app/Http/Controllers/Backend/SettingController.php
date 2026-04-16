<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function SocialSetting() {
        $socials = DB::table('socials')->first();
        return view('backend.setting.social', compact('socials'));

    }


    public function UpdateSocial(Request $request, $id) {

        DB::table('socials')->where('id', $id)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin
        ]);
        
        $notification = array (
            'message' => 'Social Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('social.setting')->with($notification);



    }






}
