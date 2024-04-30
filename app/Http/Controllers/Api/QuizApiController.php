<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\PoinStudent;
use App\Models\PoinStudentExam;
use App\Models\Question;
use App\Models\QuestionExam;
use App\Models\Quiz;
use App\Models\QuizExam;
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
        $history_pertanyaan = Question::cek_history($request->sub_id,$request->user_id)->latest('poin_students.id')->first();
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
        // return $all_quiz;s
        $all_questions = [];
        foreach ($all_quiz as $n => $q) {
            $q->image = asset('public/question/image/'.$q->image);
            $q->audio = asset('public/question/audio/'.$q->audio);
            $q->quest = strip_tags($q->quest);

            foreach ($q['ganda'] as &$ganda) {
                $ganda['answer'] = strip_tags($ganda['answer']);
            }

            $formatted_question = [
                "question" => $q,
               
             
            ];
            $all_questions[] = $formatted_question;
        }
    

    
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
     
    }

    public function cek_jawaban(Request $request)
    {
        $status='';
        // $cek = SubCategory::where('id',$sub_id)->first();
        $cek = Quiz::where('sub_categories_id',$request->sub_id)->first();
       if($cek){
      
        $status = 'finish';
       }else{
        $status = 'not_finish';
        Quiz::create([
            'user_id'=>$request->user_id,
            'sub_categories_id'=>$request->sub_id,
            'status_test'=>'started'
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

    public function submit_quiz(Request $request){

        $q=Quiz::where('sub_categories_id',$request->sub_id)->where('user_id',$request->user_id)->first();

        if($q){

            $ques=  Question::join('poin_students','poin_students.question_id','questions.id')
            ->where('questions.sub_id',$request->sub_id,)
            ->where('poin_students.user_id',$request->user_id)
            ->select('poin_students.*','questions.id as pid')->get();
            $point_saya = [
                "total_quiz"=>$ques->count(),
                "true_quiz"=>$ques->where('point','!=',0)->count(),
                "false_quiz"=>$ques->where('point','==',0)->where('answer_student','!=',null)->count(),
                "not_answer_quiz"=>$ques->where('answer_student','==',null)->count(),
                "score"=>$ques->sum('point'),
                "sub_id"=>$request->sub_id,
                "user_id"=>$request->user_id
            ];
            // return $point_saya;

            $q->update([
                'status_test'=>'finish'
            ]);
    
            return response()->json([
                'code' => '200',
                'message' => "Quiz Complete",
                'data' => $point_saya,
            ]);

        }else{
            return response()->json([
                'code' => '404',
                'message' => "Not Found",
            ]);
        }
        
      


    }

    public function list_jawaban_quiz(Request $request){

        $hasil = PoinStudent::
        leftjoin('questions','poin_students.question_id','questions.id')
        // ->with(['question_exams.ganda']) 
        ->leftjoin('sub_categories','questions.sub_id','sub_categories.id')
        ->select('questions.*','sub_categories.*','poin_students.*')->where('poin_students.user_id',$request->user_id)->where('sub_id',$request->sub_id)->get();
        foreach($hasil as $v){
            $hasils = Question::with('ganda')->where('id',$v->question_id)->get();
            $v->ganda =$hasils;
            // return $hasil;
            
        }
        

      
        return $hasil;

    }

  

}
