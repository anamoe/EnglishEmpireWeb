<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoinStudent;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizApiController extends Controller
{
    //
    public function quiz($sub_id)
    {
        $quizes = Question::where('sub_id',$sub_id);
        // dd($quiz);
        $banyak_quiz = $quizes->count();
        $history_pertanyaan = Question::cek_history($sub_id)->latest('poin_students.id')->first();
        if(!$history_pertanyaan){
            $quiz = $quizes->first();
        }else{
            $quiz = $quizes->where('id', '>', $history_pertanyaan->pid)->orderBy('id')->first();
            if(!$quiz){
                $poin = PoinStudent::cek_poin($sub_id);
                return ["selamat menyelsaikan quiz",$poin,$sub_id];
                return view('user.quiz_soal.quiz_end',compact('id','poin'));
            }
        }
        $no_quiz;
        $all_quiz = Question::where('sub_id',$sub_id)->get();
        $all_questions = [];
        foreach ($all_quiz as $n => $q) {
            $shuffled_options = $q->ganda->shuffle();
            $formatted_question = [
                "question" => $q,
                "shuffled_options" => $shuffled_options
            ];
            $all_questions[] = $formatted_question;
        }
    
        // Cari indeks pertanyaan saat ini
        $current_question_index = array_search($quiz, array_column($all_questions, 'question'));
    
        // Menentukan pertanyaan sebelumnya dan berikutnya
        $previous_question_index = $current_question_index - 1;
        $next_question_index = $current_question_index + 1;
    
       
        // Buat array asosiatif untuk menggabungkan semua data
        $response = [
            "all_questions" => $all_questions,
            "banyak_quiz" => $banyak_quiz,
            // "no_quiz"=>$no_quiz,
            "sub_id"=>$sub_id

        ];
    
        return response()->json($response);
        // foreach($all_quiz as $n=>$q){
        //     if($q->id == $quiz->id){
        //         $no_quiz = $n+1;
        //     }
        // }
        // $shuffled_options = $quiz->ganda->shuffle();
        // $formatted_quiz = [
        //     "quiz" => $quiz,
        //     "pilgan" => $shuffled_options,
        //     "banyak_quiz" => $banyak_quiz,
        //     "no_quiz"=>$no_quiz,
        //     "sub_id"=>$sub_id


        // ];
    
        // return response()->json($formatted_quiz);
        // return[$quiz,$quiz->ganda->shuffle()];
        // return [$quiz,$quiz->ganda->shuffle(),$banyak_quiz,$sub_id,$no_quiz];
        // return view('user.quiz_soal.quiz_soal',compact('id','quiz','banyak_quiz','no_quiz'));
    }

    public function cek_jawaban(Request $request)
    {
        $pertanyaan = Question::find($request->id);
        $poin = $pertanyaan->jawaban == $request->jawaban ? 1 : 0;
        $history_poin = PoinStudent::where('user_id',auth()->user()->id)->where('question_id',$request->id)->first();
        $next_quiz = Question::where('sub_id',$pertanyaan->sub_id)->where('id', '>', $request->id)->orderBy('id')->first();
        if(!$history_poin){
            PoinStudent::create([
                'user_id'=>auth()->user()->id,
                'poin'=>$poin,
                'question_id'=>$request->id
            ]);
        }

        return response()->json([
            'status'=> $pertanyaan->jawaban == $request->jawaban ? 'benar' : 'salah',
            'jawaban_benar'=> $pertanyaan->jawaban,
            'next_quiz'=> $next_quiz ? true : false
        ]);
    }
}
