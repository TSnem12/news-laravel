<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $categories = DB::table('categories')->orderBy('id', 'desc')->paginate(3);
        return view('backend.category.index', compact('categories'));
    }


    public function create() {
        return view('backend.category.create');
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'category_en' => 'required|unique:categories|max:225',
            'category_ar' => 'required|unique:categories|max:225',
        ]);

        DB::table('categories')->insert([
            'category_en' => $request->category_en,
            'category_ar' => $request->category_ar,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);

    }

    public function edit($id) {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request  $request, $id) {

        DB::table('categories')->where('id', $id)->update([
            'category_en' => $request->category_en,
            'category_ar' => $request->category_ar,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }

    public function destroy($id) {
        DB::table('categories')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }

}
