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


    public function SeoSetting() {
        $seo = DB::table('seos')->first();
        return view('backend.setting.seo', compact('seo'));

    }


    public function UpdateSeo(Request $request, $id) {

        DB::table('seos')->where('id', $id)->update([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);
        
        $notification = array (
            'message' => 'Seo Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seo.setting')->with($notification);

    }





}
