<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexs($id_main)
    {
   
        $sub = SubCategory::where('main_category_id',$id_main)->get();
        // return $sub;
        return view('categorysub',compact('sub','id_main'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        SubCategory::create(["sub" => $request->sub,"main_category_id" => $request->main_id,'waktu_pengerjaan'=>$request->waktu_pengerjaan]);
        return redirect()->back()->with('message', 'Main Category Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        SubCategory::where('id', '=', $id)->update(["sub" => $request->sub,"main_category_id" => $request->main_category_id,'waktu_pengerjaan'=>$request->waktu_pengerjaan]);
        return redirect()->back()->with('message', 'Sub Category Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        SubCategory::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
