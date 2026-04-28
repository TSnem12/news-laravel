<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = DB::table('posts')
            ->leftjoin('categories', 'posts.category_id', 'categories.id')
            ->leftjoin('subcategories', 'posts.subcategory_id', 'subcategories.id')
            ->leftjoin('districts', 'posts.district_id', 'districts.id')
            ->leftjoin('subdistricts', 'posts.subdistrict_id', 'subdistricts.id')
            ->select('posts.*', 'categories.category_en', 'subcategories.subcategory_en', 'districts.district_en', 'subdistricts.subdistrict_en')
            ->orderBy('id', 'desc')->paginate(3);

        return view('backend.post.index', compact('posts'));
    }



    public function create()
    {
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();
        $districts = DB::table('districts')->get();
        $subdistricts = DB::table('subdistricts')->get();
        return view('backend.post.create', compact('categories', 'subcategories', 'districts', 'subdistricts'));
    }

    public function getSubCategory($category_id)
    {
        $subcat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return response()->json($subcat);
    }

    public function getSubDistrict($district_id)
    {
        $subdist = DB::table('subdistricts')->where('district_id', $district_id)->get();
        return response()->json($subdist);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'image' => 'required',
        ]);

        $filename = null;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(500, 300)->save(public_path('images/post_image/' . $filename));
        }


        DB::table('posts')->insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'district_id' => $request->district_id,
            'subdistrict_id' => $request->subdistrict_id,
            'user_id' => Auth::id(),
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
            'tags_en' => $request->tags_en,
            'tags_ar' => $request->tags_ar,
            'headline' => $request->headline,
            'first_section' => $request->first_section,
            'first_section_thumbnail' => $request->first_section_thumbnail,
            'bigthumbnail' => $request->thumbnail,
            'post_date' => date('d-m-Y'),
            'post_month' => date("F"),
            'image' => $filename,
        ]);

        $notification = array(
            'message' => 'Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts')->with($notification);
    }

    public function edit($id)
    {
        $posts = DB::table('posts')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();
        $districts = DB::table('districts')->get();
        $subdistricts = DB::table('subdistricts')->get();
        return view('backend.post.edit', compact('posts', 'categories', 'subcategories', 'districts', 'subdistricts'));
    }


    public function update(Request $request, $id)
    {

        $filename = $request->old_image;

        if ($request->file('image')) {

            $old_path = public_path('images/post_image/' . $request->old_image);
            if (file_exists($old_path)) {
                unlink($old_path);
            }

            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(500, 300)->save(public_path('images/post_image/' . $filename));
        }


        DB::table('posts')->where('id', $id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'district_id' => $request->district_id,
            'subdistrict_id' => $request->subdistrict_id,
            'user_id' => Auth::id(),
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
            'tags_en' => $request->tags_en,
            'tags_ar' => $request->tags_ar,
            'headline' => $request->headline,
            'first_section' => $request->first_section,
            'first_section_thumbnail' => $request->first_section_thumbnail,
            'bigthumbnail' => $request->thumbnail,
            'image' => $filename,
        ]);

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts')->with($notification);
    }

    public function delete($id)
    {
        $posts = DB::table('posts')->where('id', $id)->first();

        $image_path = public_path('images/post_image/' . $posts->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        DB::table('posts')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts')->with($notification);
    }
}
