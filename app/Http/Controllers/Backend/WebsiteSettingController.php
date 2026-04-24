<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class WebsiteSettingController extends Controller
{
    public function MainWebSetting()
    {
        $websitesetting = DB::table('websitesettings')->first();
        return view('backend.setting.website', compact('websitesetting'));
    }

    public function UpdateWebSetting(Request $request, $id)
    {

        $logo_name = $request->old_logo;

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $logo_name = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 130)->save(public_path('images/logo/' . $logo_name));

            $old_path = public_path('images/logo/' . $request->old_logo);
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        DB::table('websitesettings')->where('id', $id)->update([
            'address_en' => $request->address_en,
            'address_ar' => $request->address_ar,
            'phone_en' => $request->phone_en,
            'phone_ar' => $request->phone_ar,
            'email' => $request->email,
            'logo' => $logo_name
        ]);

        $notification = array(
            'message' => 'WebsiteSettings Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('website.setting')->with($notification);
    }
}
