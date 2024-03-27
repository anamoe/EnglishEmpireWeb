<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\QuizCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_category)
    {
        //
        $main = MainCategory::where('quiz_category_id',$id_category)->get();
        return view('categorymain',compact('main','id_category'));
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
        // return $request;
        MainCategory::create(["main" => $request->main,"quiz_category_id" => $request->id_category]);
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
        MainCategory::where('id', '=', $id)->update(["main" => $request->main]);
        return redirect()->back()->with('message', 'Main Category Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        MainCategory::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
