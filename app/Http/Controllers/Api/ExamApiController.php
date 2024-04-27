<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\PoinStudentExam;
use App\Models\QuestionExam;
use App\Models\QuizExam;
use Illuminate\Http\Request;

class ExamApiController extends Controller
{
    //
    public function quiz_exam(Request $request)
    {
      

        $quizes = QuestionExam::where('exam_id',$request->exam_id);
        $sub = Exam::where('id',$request->exam_id)->first();
        // dd($quiz);
        $banyak_quiz = $quizes->count();
        $history_pertanyaan = QuestionExam::cek_history($request->sub_id)->latest('poin_students.id')->first();
        if(!$history_pertanyaan){
            $quiz = $quizes->first();
        }else{
            $quiz = $quizes->where('id', '>', $history_pertanyaan->pid)->orderBy('id')->first();
            if(!$quiz){
                $poin = PoinStudentExam::cek_poin($request->exam_id,$request->user_id);

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
        $all_quiz = QuestionExam::where('exam_id',$request->exam_id)->get();
        // return $all_quiz;s
        $all_questions = [];
        foreach ($all_quiz as $n => $q) {
            $q->image = asset('public/question_exam/image/'.$q->image);
            $q->audio = asset('public/question_exam/audio/'.$q->audio);
            $q->quest = strip_tags($q->quest);

            foreach ($q['ganda'] as &$ganda) {
                $ganda['answer'] = strip_tags($ganda['answer']);
            }

            
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
            "exam_id"=>$request->exam_id,
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

    public function cek_jawaban_exam(Request $request)
    {
        $status='';
        // $cek = SubCategory::where('id',$sub_id)->first();
        $cek = QuizExam::where('exam_id',$request->exam_id)->first();
       if($cek){
      
        $status = 'finish';
       }else{
        $status = 'not_finish';
        QuizExam::create([
            'user_id'=>$request->user_id,
            'exam_id'=>$request->exam_id,
            'status_test'=>'started'
        ]);
       }

    //    return $status;

      
        $pertanyaan = QuestionExam::find($request->id);
        $poin = $pertanyaan->answer_key == $request->answer ? 1 : 0;
        // return $poin;
        $history_poin = PoinStudentExam::where('user_id',$request->user_id)->where('question_id',$request->id)->first();
        // return $history_poin;
        $next_quiz = QuestionExam::where('sub_id',$pertanyaan->sub_id)->where('id', '>', $request->id)->orderBy('id')->first();
        if(!$history_poin){
            PoinStudentExam::create([
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

    public function submit_quiz_exam(Request $request){

        QuizExam::where('exam_id',$request->exam_id)->update([
            'status_test'=>'finish'
        ]);

        return response()->json([
            'code' => '200',
            'message' => "Quiz Complete",
        ]);


    }

}
