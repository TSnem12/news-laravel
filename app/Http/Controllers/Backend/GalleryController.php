<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    //Photos Functions

    public function PhotoGallery()
    {
        $photos = DB::table('photos')->orderBy('id', 'desc')->paginate(5);
        return view('backend.gallery.photos', compact('photos'));
    }


    public function AddPhoto()
    {
        return view('backend.gallery.create_photo');
    }



    public function StorePhoto(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'photo' => 'required|image',

        ]);

        $photo = null;
        $image = $request->file('photo');
        if ($image) {
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save(public_path('images/photo_gallery/' . $image_name));
            $photo = $image_name;
        }

        DB::table('photos')->insert([
            'title' => $request->title,
            'type' => $request->type,
            'photo' => $photo
        ]);

        $notification = array(
            'message' => 'Photo Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('photo.gallery')->with($notification);
    }


    public function EditPhoto($id)
    {
        $photo = DB::table('photos')->where('id', $id)->first();
        return view('backend.gallery.edit_photo', compact('photo'));
    }

    public function UpdatePhoto(Request $request, $id)
    {


        $image_name = $request->old_photo;
        if ($request->file('photo')) {
            $old_path = public_path('images/photo_gallery/' . $image_name);

            if (file_exists($old_path)) {
                unlink($old_path);
            }

            $image = $request->file('photo');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save(public_path('images/photo_gallery/' . $image_name));
        }

        DB::table('photos')->where('id', $id)->update([
            'title' => $request->title,
            'photo' => $image_name,
            'type' => $request->type
        ]);

        $notification = array(
            'message' => 'Photo Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('photo.gallery')->with($notification);
    }

    public function DeletePhoto($id)
    {
        DB::table('photos')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Photo Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('photo.gallery')->with($notification);
    }


    //Videos Functions

    public function VideoGallery()
    {
        $videos = DB::table('videos')->orderBy('id', 'desc')->paginate(5);
        return view('backend.gallery.videos', compact('videos'));
    }


    public function AddVideo()
    {
        return view('backend.gallery.create_video');
    }



    public function StoreVideo(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'embed_code' => 'required',

        ]);

        DB::table('videos')->insert([
            'title' => $request->title,
            'type' => $request->type,
            'embed_code' => $request->embed_code
        ]);

        $notification = array(
            'message' => 'Video Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('video.gallery')->with($notification);
    }


    public function EditVideo($id)
    {
        $video = DB::table('videos')->where('id', $id)->first();
        return view('backend.gallery.edit_video', compact('video'));
    }

    public function UpdateVideo(Request $request, $id)
    {

        DB::table('videos')->where('id', $id)->update([
            'title' => $request->title,
            'embed_code' => $request->embed_code,
            'type' => $request->type
        ]);

        $notification = array(
            'message' => 'Video Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('video.gallery')->with($notification);
    }

    public function DeleteVideo($id)
    {
        DB::table('videos')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Video Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('video.gallery')->with($notification);
    }
}
