<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoinStudent;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class QuizApiController extends Controller
{
    //
    public function quiz(Request $request)
    {
      

        $quizes = Question::where('sub_id',$request->sub_id);
        $sub = SubCategory::where('id',$request->sub_id)->first();
        // dd($quiz);
        $banyak_quiz = $quizes->count();
        $history_pertanyaan = Question::cek_history($request->sub_id)->latest('poin_students.id')->first();
        if(!$history_pertanyaan){
            $quiz = $quizes->first();
        }else{
            $quiz = $quizes->where('id', '>', $history_pertanyaan->pid)->orderBy('id')->first();
            if(!$quiz){
                $poin = PoinStudent::cek_poin($request->sub_id,$request->user_id);

                return response()->json([
                    'code' => '200',
                    'data' => $poin
                ]);
                // return [
                //     "selamat menyelsaikan quiz",];
                // return view('user.quiz_soal.quiz_end',compact('id','poin'));
            }
        }
        $no_quiz;
        $all_quiz = Question::where('sub_id',$request->sub_id)->get();
        $all_questions = [];
        foreach ($all_quiz as $n => $q) {
            $q->image = asset('public/question/image/'.$q->image);
            $q->audio = asset('public/question/audio/'.$q->audio);
            $shuffled_options = $q->ganda->shuffle();
            $formatted_question = [
                "question" => $q,
               
                // "shuffled_options" => $shuffled_options
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
            "sub_id"=>$request->sub_id,
            "waktu_pengerjaan" => $sub->waktu_pengerjaan,

        ];
        return response()->json([
            'code' => '200',
            'data' => $response
        ]);
        // return response()->json($response);
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
        $status='';
        // $cek = SubCategory::where('id',$sub_id)->first();
        $cek = Quiz::where('sub_categories_id',$request->sub_id)->first();
       if($cek){
      
        $status = 'selesai';
       }else{
        $status = 'belum';
        Quiz::create([
            'user_id'=>$request->user_id,
            'sub_categories_id'=>$request->sub_id,
            'status_test'=>'dimulai'
        ]);
       }

    //    return $status;

      
        $pertanyaan = Question::find($request->id);
        $poin = $pertanyaan->answer_key == $request->answer ? 1 : 0;
        // return $poin;
        $history_poin = PoinStudent::where('user_id',$request->user_id)->where('question_id',$request->id)->first();
        // return $history_poin;
        $next_quiz = Question::where('sub_id',$pertanyaan->sub_id)->where('id', '>', $request->id)->orderBy('id')->first();
        if(!$history_poin){
            PoinStudent::create([
                'user_id'=>$request->user_id,
                'point'=>$poin,
                'question_id'=>$request->id,
                'answer_student'=>$request->answer,
            ]);
        }

        return response()->json([
            'status'=> $pertanyaan->answer_key == $request->answer ? 'benar' : 'salah',
            'jawaban_benar'=> $pertanyaan->answer_key,
            'next_quiz'=> $next_quiz ? true : false,
            'status_create_quiz'=>$status
        ]);
    }
}
