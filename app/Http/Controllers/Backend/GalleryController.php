<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

    public function PhotoGallery()
    {
        $photos = DB::table('photos')->orderBy('id', 'desc')->paginate(5);
        return view('backend.gallery.photos', compact('photos'));
    }


    public function AddPhoto()
    {
        return view('backend.gallery.create');
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
        return view('backend.gallery.edit', compact('photo'));
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
}
