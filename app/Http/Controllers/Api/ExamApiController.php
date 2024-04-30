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

    public function list_exam(Request $request){

        $exam = Exam::all();

        foreach ($exam as $subcategory) {
            $all_quiz = QuestionExam::where('exam_id', $subcategory->id)->count();
            // $all_quiz_get = Question::where('sub_id',$subcategory->id)->get();

            $questions = QuestionExam::where('exam_id', $subcategory->id)->get();

            // Hitung total jawaban benar dan salah
            $total_correct_answers = PoinStudentExam::where('user_id',$request->user_id)->whereIn('question_id', $questions->pluck('id'))
                ->where('point', 1)
                ->count();
            $total_incorrect_answers = PoinStudentExam::where('user_id',$request->user_id)->whereIn('question_id', $questions->pluck('id'))
                ->where('point', 0)
                ->count();

            $subcategory->total_correct_answers = $total_correct_answers;
            $subcategory->total_incorrect_answers = $total_incorrect_answers;
            $quizzes = QuizExam::where('exam_id', $subcategory->id)->where('user_id',$request->user_id)->get();

            // Jika daftar kuis kosong, tambahkan objek kuis manual dengan status 'Belum Dikerjakan'
            if ($quizzes->isEmpty()) {
                $quizzes->push(new QuizExam([
                    'exam_id' => $subcategory->id,

                    // 'user_id' => $request-,
                    'status_quiz' => 'Not Taken'
                ]));
            } else {
                foreach ($quizzes as $quiz) {
                    $quiz->exam_id = $subcategory->id;
                    $quiz->status_quiz = $quiz->status_test;
                }
            }

            // Tambahkan properti quizzes ke objek SubCategory
            $subcategory->quizzes = $quizzes;
            $subcategory->total_quiz = $all_quiz;
            // $subcategory->total_quiz_true = $all_quiz_true;
            // $subcategory->total_quiz_false = $all_quiz_false;
        }

        return response()->json([
            'code' => 200,
            'data' => $exam
        ]);


    }
    public function quiz_exam(Request $request)
    {
      

        $quizes = QuestionExam::where('exam_id',$request->exam_id);
        $sub = Exam::where('id',$request->exam_id)->first();
        // dd($quiz);
        $banyak_quiz = $quizes->count();
        $history_pertanyaan = QuestionExam::cek_history($request->exam_id,$request->user_id)->latest('poin_student_exams.id')->first();
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
            $q->quest_exam = strip_tags($q->quest_exam);

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
        $next_quiz = QuestionExam::where('exam_id',$pertanyaan->exam_id)->where('id', '>', $request->id)->orderBy('id')->first();
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
            'next_quiz_exam'=> $next_quiz ? true : false,
            'status_create_quiz'=>$status
        ]);
    }

    public function submit_quiz_exam(Request $request){

        $q=QuizExam::where('exam_id',$request->exam_id)->where('user_id',$request->user_id)->first();

        if($q){

            $ques=  QuestionExam::join('poin_student_exams','poin_student_exams.question_id','question_exams.id')
            ->where('question_exams.exam_id',$request->exam_id,)
            ->where('poin_student_exams.user_id',$request->user_id)
            ->select('poin_student_exams.*','question_exams.id as pid')->get();
            $point_saya = [
                "total_quiz"=>$ques->count(),
                "true_quiz"=>$ques->where('point','!=',0)->count(),
                "false_quiz"=>$ques->where('point','==',0)->count(),
                "score"=>$ques->sum('point'),
                "exam_id"=>$request->exam_id,
                "user_id"=>$request->user_id
            ];
            // return $point_saya;

            $q->update([
                'status_test'=>'finish'
            ]);
    
            return response()->json([
                'code' => '200',
                'message' => "Exam Complete",
                'data' => $point_saya,
            ]);

        }else{
            return response()->json([
                'code' => '404',
                'message' => "Not Found",
            ]);
        }


       
    }
    public function list_jawaban_exam(Request $request){

        $hasil = PoinStudentExam::
        leftjoin('question_exams','poin_student_exams.question_id','question_exams.id')
        // ->with(['question_exams.ganda']) 
        ->leftjoin('exams','question_exams.exam_id','exams.id')
        ->select('question_exams.*','exams.*','poin_student_exams.*')->where('poin_student_exams.user_id',$request->user_id)->where('exam_id',$request->exam_id)->get();
        foreach($hasil as $v){
            $hasils = QuestionExam::with('ganda')->where('id',$v->question_id)->get();
            $v->exam =$hasils;
            // return $hasil;
            
        }
        

      
        return $hasil;

    }
}
