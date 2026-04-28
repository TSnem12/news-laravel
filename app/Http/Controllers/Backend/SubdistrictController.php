<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubdistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $subdistricts = DB::table('subdistricts')->join('districts', 'subdistricts.district_id', 'districts.id')->select('subdistricts.*', 'districts.district_en')->orderBy('id', 'desc')->paginate(3);
        return view('backend.subdistrict.index', compact('subdistricts'));
    }

    public function create()
    {
        $districts = DB::table('districts')->get();
        return view('backend.subdistrict.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subdistrict_en' => 'required|unique:subdistricts|max:255',
            'subdistrict_ar' => 'required|unique:subdistricts|max:255',
        ]);

        DB::table('subdistricts')->insert([
            'district_id' => $request->district_id,
            'subdistrict_en' => $request->subdistrict_en,
            'subdistrict_ar' => $request->subdistrict_ar
        ]);

        $notification = array(
            'message' => 'SubDistrict Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subdistricts')->with($notification);
    }

    public function edit($id)
    {
        $subdistrict = DB::table('subdistricts')->where('id', $id)->first();
        $districts = DB::table('districts')->get();
        return view('backend.subdistrict.edit', compact('subdistrict', 'districts'));
    }

    public function update(Request $request, $id)
    {

        DB::table('subdistricts')->where('id', $id)->update([
            'district_id' => $request->district_id,
            'subdistrict_en' => $request->subdistrict_en,
            'subdistrict_ar' => $request->subdistrict_ar
        ]);

        $notification = array(
            'message' => 'SubDistrict Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subdistricts')->with($notification);
    }

    public function destroy($id)
    {
        DB::table('subdistricts')->where('id', $id)->delete();

        $notification = array(
            'message' => 'SubDistrict Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subdistricts')->with($notification);
    }
}
