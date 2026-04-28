<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class AdsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function ListAds()
    {
        $ads = DB::table('ads')->orderBy('id', 'desc')->get();
        return view('backend.ads.list_ads', compact('ads'));
    }


    public function AddAds()
    {
        return view('backend.ads.add_ads');
    }


    public function StoreAds(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'type' => 'required',
            'ads' => 'required|file'
        ]);


        if ($request->type == 2) {
            $image = $request->file('ads');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(970, 90)->save(public_path('images/ads/' . $image_name));

            DB::table('ads')->insert([
                'link' => $request->link,
                'ads' => $image_name,
                'type' => $request->type
            ]);

            $notification = array(
                'message' => 'Horizontal Ad Inserted Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route('list.add')->with($notification);
        } else {

            $image = $request->file('ads');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save(public_path('images/ads/' . $image_name));

            DB::table('ads')->insert([
                'link' => $request->link,
                'ads' => $image_name,
                'type' => 1
            ]);

            $notification = array(
                'message' => 'Vertical Ad Inserted Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route('list.ads')->with($notification);
        }
    }


    public function EditAds($id)
    {

        $ads = DB::table('ads')->where('id', $id)->first();
        return view('backend.ads.edit', compact('ads'));
    }


    public function UpdateAds(Request $request, $id)
    {

        $image_name = $request->old_image;
        if ($request->file('ads')) {
            $image = $request->file('ads');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();

            $width = ($request->type == 2) ? 970 : 500;
            $height = ($request->type == 2) ? 90 : 500;
            Image::make($image)->resize($width, $height)->save(public_path('images/ads/' . $image_name));

            $old_path = public_path('images/ads/' . $request->old_image);
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        DB::table('ads')->where('id', $id)->update([
            'link' => $request->link,
            'ads'  => $image_name,
            'type' => $request->type
        ]);


        $notification = array(
            'message' => 'Ad Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('list.ads')->with($notification);
    }


    public function DeleteAds($id)
    {

        $ad = DB::table('ads')->where('id', $id)->first();

        if ($ad->ads) {
            $old_path = public_path('images/ads/' . $ad->ads);
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }


        DB::table('ads')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Ad Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('list.ads')->with($notification);
    }
}
