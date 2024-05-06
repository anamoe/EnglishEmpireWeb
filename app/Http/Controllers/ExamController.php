<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\CourseProgram;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // public function index()
    // {
    //     //
    //     $e = Exam::leftjoin('class_courses', 'exams.class_id', 'class_courses.id')
    //         ->leftjoin('course_programs', 'exams.course_program_id', 'course_programs.id')
    //         ->select('course_programs.program', 'class_courses.class', 'exams.*')->get();
    //     $coursePrograms = CourseProgram::all();

    //     return view('exam.exam', compact('e', 'coursePrograms'));
    // }

    public function index_class($class_id)
    {
        //
        $class = ClassCourse::where('id',$class_id)->first();
        $coursePrograms = CourseProgram::where('id',$class->course_program_id )->first();
        $e = Exam::leftjoin('class_courses', 'exams.class_id', 'class_courses.id')
            ->leftjoin('course_programs', 'exams.course_program_id', 'course_programs.id')->where('class_id',$class_id)
            ->select('course_programs.program', 'class_courses.class', 'exams.*')->get();
        // $coursePrograms = CourseProgram::all();

        return view('exam.exam', compact('e', 'coursePrograms','class'));
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
        Exam::create([
            "title" => $request->title,
            "waktu_pengerjaan" => $request->waktu_pengerjaan,
            'course_program_id' => $request->course_program_id,
            'class_id' => $request->class_id
        ]);
        return redirect()->back()->with('message', ' Berhasil Ditambahkan');
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
        Exam::where('id', '=', $id)->update([
            "title" => $request->title,
            "waktu_pengerjaan" => $request->waktu_pengerjaan,
            // 'course_program_id' => $request->course_program_id,
            // 'class_id' => $request->class_id
        ]);
        return redirect()->back()->with('message', ' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Exam::where('id', $id)->delete();

        return redirect()->back()->with("message", " berhasil dihapus");
    }
}
