<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $districts = DB::table('districts')->orderBy('id', 'desc')->paginate(3);
        return view('backend.district.index', compact('districts'));
    }

    public function create()
    {
        return view('backend.district.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_en' => 'required|unique:districts|max:255',
            'district_ar' => 'required|unique:districts|max:255',
        ]);

        DB::table('districts')->insert([
            'district_en' => $request->district_en,
            'district_ar' => $request->district_ar,
        ]);

        $notification = array(
            'message' => 'District created successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('districts')->with($notification);
    }

    public function edit($id)
    {
        $district = DB::table('districts')->where('id', $id)->first();
        return view('backend.district.edit', compact('district'));
    }

    public function update(Request $request, $id)
    {

        DB::table('districts')->where('id', $id)->update([
            'district_en' => $request->district_en,
            'district_ar' => $request->district_ar,
        ]);

        $notification = array(
            'message' => 'District updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('districts')->with($notification);
    }

    public function delete($id)
    {
        DB::table('districts')->where('id', $id)->delete();

        $notification = array(
            'message' => 'District deleted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('districts')->with($notification);
    }
}
