<?php

namespace App\Http\Controllers;

use App\Models\CourseProgram;
use Illuminate\Http\Request;

class CourseProgramController extends Controller
{
    public function index()
    {
        //
        $course = CourseProgram::all();
        
        return view('courseprogram',compact('course'));
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
        CourseProgram::create(["program" => $request->program]);
        return redirect()->back()->with('message', 'Course Program Berhasil Ditambahkan');
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
        CourseProgram::where('id', '=', $id)->update(["program" => $request->program]);
        return redirect()->back()->with('message', 'Course Program Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        CourseProgram::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
