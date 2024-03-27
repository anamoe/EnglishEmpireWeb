<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    public function index($id_course)
    {
        //
        $class = ClassCourse::where('course_program_id',$id_course)->get();
        return view('classcourse',compact('class','id_course'));
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
        ClassCourse::create(["class" => $request->class,"course_program_id" => $request->course_program_id]);
        return redirect()->back()->with('message', 'Class Berhasil Ditambahkan');
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
        ClassCourse::where('id', '=', $id)->update(["class" => $request->class]);
        return redirect()->back()->with('message', 'Class Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        ClassCourse::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
