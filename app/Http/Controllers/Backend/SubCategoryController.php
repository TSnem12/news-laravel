<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $subcategories = DB::table('subcategories')->join('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_en')->orderBy('id', 'desc')->paginate(3);

        return view('backend.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('backend.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_en' => 'required|unique:subcategories|max:255',
            'subcategory_ar' => 'required|unique:subcategories|max:255',
        ]);

        DB::table('subcategories')->insert([
            'category_id' => $request->category_id,
            'subcategory_en' => $request->subcategory_en,
            'subcategory_ar' => $request->subcategory_ar,
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategories')->with($notification);
    }

    public function edit($id)
    {
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {

        DB::table('subcategories')->where('id', $id)->update([
            'category_id' => $request->category_id,
            'subcategory_en' => $request->subcategory_en,
            'subcategory_ar' => $request->subcategory_ar,
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategories')->with($notification);
    }


    public function delete($id)
    {
        DB::table('subcategories')->where('id', $id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategories')->with($notification);
    }
}
