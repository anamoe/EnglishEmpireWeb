<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\CourseProgram;
use App\Models\Quiz;
use App\Models\QuizCategory;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $categoryquiz = QuizCategory::all();
        
    //     return view('categoryquiz',compact('categoryquiz'));
    // }

    public function index_class($class_id)
    {
        // return $program_id;
        //
        $class = ClassCourse::where('id',$class_id)->first();
        $coursePrograms = CourseProgram::where('id',$class->course_program_id )->first();
        $categoryquiz = QuizCategory::where('class_id',$class_id)->get();
        
        return view('categoryquiz',compact('categoryquiz','coursePrograms','class'));
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
        QuizCategory::create(["category" => $request->category,"class_id"=>$request->class_id]);
        return redirect()->back()->with('message', 'Quiz Category Berhasil Ditambahkan');
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
        QuizCategory::where('id', '=', $id)->update(["category" => $request->category]);
        return redirect()->back()->with('message', 'Quiz Category Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        QuizCategory::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
