<?php

namespace App\Http\Controllers;

use App\Models\PoinStudentExam;
use App\Models\QuestionExam;
use App\Models\QuizExam;
use Illuminate\Http\Request;

class AnswerExamStudentController extends Controller
{
    public function index_answer($exam_id)
    {
        //
        $answer =PoinStudentExam::
        join('question_exams','poin_student_exams.question_id','question_exams.id')
        ->join('exams','question_exams.exam_id','exams.id')
        ->join('users','poin_student_exams.user_id','users.id')
        ->select('question_exams.*','exams.*','users.full_name','poin_student_exams.*')
        ->where('question_exams.exam_id',$exam_id)
        ->get();
        // ->groupBy(function($item) {
        //     return $item->sub_id . '-' . $item->user_id;
        // });
        return view('answer_exam_student',compact('answer'));
        return $answer;
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $p=PoinStudentExam::where('id',$id)->first();
        $question = QuestionExam::where('id',$p->question_id)->first();
        $quiz = QuizExam::where('exam',$question->exam_id)->where('user_id',$p->user_id)->first();
        $quiz->delete();
        
        $p->delete();
        return redirect()->back()->with("message","Jawaban Siswa berhasil dihapus");

    }


    public function hapus_select(Request $request){
        // return $request->ceklist;
        if($request->ceklist){
            $p = PoinStudentExam::whereIn('id', $request->ceklist)->get();
            foreach ($p as $v) {
                $question = QuestionExam::where('id',$v->question_id)->get();  // Fetch single question instance
                // return $question;
                if ($question) {
                    foreach($question as $v){
                        // return $v;
                        $quiz = QuizExam::where('exam_id',$v->exam_id) // Access single instance properties
                        ->where('status_test','finish')
                        ->get();
                        // return $quiz;

            foreach ($quiz as $q) {  // Iterate over the collection to delete each quiz
                $q->delete();
            }

                    }
                 
                }
            }
      
        PoinStudentExam::whereIn('id',$request->ceklist)->delete();
            return redirect()->back()->with('message','Data Jawaban Siswa Berhasil di Hapus');
        }else{
            //jika tidak ada hanya redirect kosongan
            return redirect()->back();
        }
    }
}
