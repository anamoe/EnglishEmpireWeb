<?php

namespace App\Http\Controllers;

use App\Models\CourseProgram;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        //
        $e = Exam::leftjoin('class_courses', 'exams.class_id', 'class_courses.id')
            ->leftjoin('course_programs', 'exams.course_program_id', 'course_programs.id')
            ->select('course_programs.program', 'class_courses.class', 'exams.*')->get();
        $coursePrograms = CourseProgram::all();

        return view('exam.exam', compact('e', 'coursePrograms'));
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
