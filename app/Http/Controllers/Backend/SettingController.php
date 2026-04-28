<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    //Social Settings

    public function SocialSetting()
    {
        $socials = DB::table('socials')->first();
        return view('backend.setting.social', compact('socials'));
    }


    public function UpdateSocial(Request $request, $id)
    {

        DB::table('socials')->where('id', $id)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin
        ]);

        $notification = array(
            'message' => 'Social Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('social.setting')->with($notification);
    }

    //Seo Settings

    public function SeoSetting()
    {
        $seo = DB::table('seos')->first();
        return view('backend.setting.seo', compact('seo'));
    }


    public function UpdateSeo(Request $request, $id)
    {

        DB::table('seos')->where('id', $id)->update([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);

        $notification = array(
            'message' => 'Seo Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seo.setting')->with($notification);
    }

    //Prayer Settings

    public function PrayerSetting()
    {
        $prayer = DB::table('prayers')->first();
        return view('backend.setting.prayer', compact('prayer'));
    }


    public function UpdatePrayer(Request $request, $id)
    {

        DB::table('prayers')->where('id', $id)->update([
            'fajr' => $request->fajr,
            'dhuhr' => $request->dhuhr,
            'asr' => $request->asr,
            'maghrib' => $request->maghrib,
            'isha' => $request->isha,
            'jummah' => $request->google_analytics,
        ]);

        $notification = array(
            'message' => 'Prayer Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('prayer.setting')->with($notification);
    }


    //Livetv Settings

    public function LivetvSetting()
    {
        $livetv = DB::table('livetvs')->first();
        return view('backend.setting.livetv', compact('livetv'));
    }


    public function UpdateLivetv(Request $request, $id)
    {

        DB::table('livetvs')->where('id', $id)->update([
            'embed_code' => $request->embed_code,
        ]);

        $notification = array(
            'message' => 'LiveTv Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('livetv.setting')->with($notification);
    }


    public function ActiveLivetv($id)
    {
        DB::table('livetvs')->where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'LiveTv Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function DeActiveLivetv($id)
    {
        DB::table('livetvs')->where('id', $id)->update(['status' => 0]);

        $notification = array(
            'message' => 'LiveTv DeActivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    //Notice Settings

    public function NoticeSetting()
    {
        $notice = DB::table('notices')->first();
        return view('backend.setting.notice', compact('notice'));
    }


    public function UpdateNotice(Request $request, $id)
    {

        DB::table('notices')->where('id', $id)->update([
            'notice_en' => $request->notice_en,
            'notice_ar' => $request->notice_ar,
        ]);

        $notification = array(
            'message' => 'Notice Settings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('notice.setting')->with($notification);
    }


    public function ActiveNotice($id)
    {
        DB::table('notices')->where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Notice Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function DeActiveNotice($id)
    {
        DB::table('notices')->where('id', $id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Notice DeActivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    //Website Settings

    public function WebsiteSetting()
    {
        $websites = DB::table('websites')->orderBy('id', 'desc')->paginate(3);
        return view('backend.website.index', compact('websites'));
    }

    public function AddWebsiteSetting()
    {
        return view('backend.website.create');
    }


    public function StoreWebsite(Request $request)
    {

        DB::table('websites')->insert([
            'website_name' => $request->website_name,
            'website_link' => $request->website_link,
        ]);

        $notification = array(
            'message' => 'Website links Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.website')->with($notification);
    }


    public function EditWebsite($id)
    {
        $website = DB::table('websites')->where('id', $id)->first();
        return view('backend.website.edit', compact('website'));
    }

    public function UpdateWebsite(Request $request, $id)
    {

        DB::table('websites')->where('id', $id)->update([
            'website_name' => $request->website_name,
            'website_link' => $request->website_link,
        ]);

        $notification = array(
            'message' => 'Website Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.website')->with($notification);
    }

    public function DeleteWebsite($id)
    {
        DB::table('websites')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Website Link Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.website')->with($notification);
    }
}
