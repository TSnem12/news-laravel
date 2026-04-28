<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function InsertWriter()
    {

        return view('backend.role.insert');
    }


    public function StoreWriter(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'category' => $request->category,
            'district' => $request->district,
            'post' => $request->post,
            'setting' => $request->setting,
            'website' => $request->website,
            'gallery' => $request->gallery,
            'ads' => $request->ads,
            'role' => $request->role,
            'type' => 0,
        ]);


        $notification = array(
            'message' => 'Writer Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.writer')->with($notification);
    }



    public function AllWriter()
    {
        $writer = DB::table('users')->where('type', 0)->get();
        return view('backend.role.index', compact('writer'));
    }


    public function EditWriter($id)
    {
        $writer = DB::table('users')->where('id', $id)->first();
        return view('backend.role.edit', compact('writer'));
    }


    public function UpdateWriter(Request $request, $id)
    {

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'category' => $request->category,
            'district' => $request->district,
            'post' => $request->post,
            'setting' => $request->setting,
            'website' => $request->website,
            'gallery' => $request->gallery,
            'ads' => $request->ads,
            'role' => $request->role,
            'type' => 0,
        ]);


        $notification = array(
            'message' => 'Writer Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.writer')->with($notification);
    }
}
