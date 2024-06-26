<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PoinStudent;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AnswerStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_answer($sub_id)
    {
        //
        $answer =PoinStudent::
        join('questions','poin_students.question_id','questions.id')
        ->join('sub_categories','questions.sub_id','sub_categories.id')
        ->join('users','poin_students.user_id','users.id')
        ->select('questions.*','sub_categories.*','users.full_name','poin_students.*')
        ->where('questions.sub_id',$sub_id)
        ->get();
        // ->groupBy(function($item) {
        //     return $item->sub_id . '-' . $item->user_id;
        // });
        return view('answer_student',compact('answer'));
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
        $p=PoinStudent::where('id',$id)->first();
        $question = Question::where('id',$p->question_id)->first();
        $quiz = Quiz::where('sub_categories_id',$question->sub_id)->where('user_id',$p->user_id)
        ->where('status','finish')->first();
        $quiz->delete();
        
        $p->delete();
        return redirect()->back()->with("message","Jawaban Siswa berhasil dihapus");

    }


    public function hapus_select(Request $request){
        // return $request->ceklist;
        if($request->ceklist){
            // $p= PoinStudent::whereIn('id',$request->ceklist)->get();
            // foreach($p as $v){
            //     $question = Question::whereIn('id',[$v->question_id])->get();
            //     $quiz = Quiz::where('sub_categories_id',[$question->sub_id])->where('user_id',[$question->user_id])->get();
            //     $quiz->delete();
            // }

            $p = PoinStudent::whereIn('id', $request->ceklist)->get();
            foreach ($p as $v) {
                $question = Question::where('id',$v->question_id)->get();  // Fetch single question instance
                // return $question;
                if ($question) {
                    foreach($question as $v){
                        // return $v;
                        $quiz = Quiz::where('sub_categories_id',$v->sub_id) // Access single instance properties
                        ->where('status_test','finish')
                        ->get();
                        // return $quiz;

            foreach ($quiz as $q) {  // Iterate over the collection to delete each quiz
                $q->delete();
            }

                    }
                 
                }
            }
           
           

      
        PoinStudent::whereIn('id',$request->ceklist)->delete();
            return redirect()->back()->with('message','Data Jawaban Siswa Berhasil di Hapus');
        }else{
            //jika tidak ada hanya redirect kosongan
            return redirect()->back();
        }
    }
}
