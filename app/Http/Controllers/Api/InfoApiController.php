<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoUpdate;
use App\Models\MainCategory;
use App\Models\Message;
use App\Models\PoinStudent;
use App\Models\PoinStudentExam;
use App\Models\Question;
use App\Models\QuestionExam;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizExam;
use App\Models\SlideInfo;
use App\Models\Student;
use App\Models\StudentSchedule;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoApiController extends Controller
{
    //

    public function get_schedule($user_id)
    {


        $slideinfo = StudentSchedule::where('user_id', $user_id)->orderBy('session', 'asc')->get();


        if ($slideinfo) {

            return response()->json([
                'code' => '200',
                'data' => $slideinfo
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function slide_info()
    {

        $slideinfo = SlideInfo::orderBy('id', 'desc')->get();
        foreach ($slideinfo as $p) {
            $p->image = asset('public/slide-info/' . $p->image);
        }

        if ($slideinfo) {

            return response()->json([
                'code' => '200',
                'data' => $slideinfo
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function info_update()
    {
        $info = InfoUpdate::orderBy('id', 'desc')->get();
        foreach ($info as $p) {
            $p->image = asset('public/info-update/' . $p->image);
        }

        if ($info) {

            return response()->json([
                'code' => '200',
                'data' => $info
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

   


    public function quiz_category(Request $request)
    {


        //         $totalmain=0;
        //         $totalsub=0;
        $quizCategories = QuizCategory::with('mainCategories.subCategories')->where('program_id',$request->program_id)->get();

        // $results = [];

        // foreach ($quizCategories as $quizCategory) {
        //     echo "Quiz Category: {$quizCategory->name}" . PHP_EOL;

        //     // Menghitung dan menampilkan jumlah kategori utama
        //     $totalMainCategories = $quizCategory->mainCategories->count();
        //     echo "Total Main Categories: {$totalMainCategories}" . PHP_EOL;

        //     // Menghitung dan menampilkan jumlah subkategori per kategori utama
        //     $totalSubCategories = 0;
        //     foreach ($quizCategory->mainCategories as $mainCategory) {
        //         echo "- Main Category: {$mainCategory->name}" . PHP_EOL;
        //         $totalSubCategories += $mainCategory->subCategories->count();
        //     }
        //     echo "-- Total Sub Categories: {$totalSubCategories}" . PHP_EOL;

        //     // Menambahkan hasil ke dalam array
        //     $results[] = [
        //         'quiz_category' => $quizCategory->name,
        //         'total_main_categories' => $totalMainCategories,
        //         'total_sub_categories' => $totalSubCategories,
        //     ];
        // }

        // return $results;

        foreach ($quizCategories as $quizCategory) {

            $quizCategories = QuizCategory::with('mainCategories.subCategories')->where('program_id',$request->program_id)->get();

            $results = [];

            foreach ($quizCategories as $quizCategory) {
                $totalMainCategories = $quizCategory->mainCategories->count();
                $totalSubCategories = 0;

                foreach ($quizCategory->mainCategories as $mainCategory) {
                    $totalSubCategories += $mainCategory->subCategories->count();
                }

                $mainCategoriesData = [];

                foreach ($quizCategory->mainCategories as $mainCategory) {
                    $subCategoriesData = [];

                    foreach ($mainCategory->subCategories as $subCategory) {
                        $subCategoriesData[] = [
                            'id' => $subCategory->id,
                            'main_category_id' => $subCategory->main_category_id,
                            'sub' => $subCategory->sub,
                            'waktu_pengerjaan' => $subCategory->waktu_pengerjaan,
                            'created_at' => $subCategory->created_at,
                            'updated_at' => $subCategory->updated_at
                        ];
                    }

                    $mainCategoriesData[] = [
                        'id' => $mainCategory->id,
                        'main' => $mainCategory->main,
                        'quiz_category_id' => $mainCategory->quiz_category_id,
                        'created_at' => $mainCategory->created_at,
                        'updated_at' => $mainCategory->updated_at,
                        'sub_categories' => $subCategoriesData
                    ];
                }

                $results[] = [
                    'id' => $quizCategory->id,
                    'category' => $quizCategory->category,
                    'program_id' => $quizCategory->program_id,
                    'created_at' => $quizCategory->created_at,
                    'updated_at' => $quizCategory->updated_at,
                    'main_categories' => $mainCategoriesData,
                    'total_main_categories' => $totalMainCategories,
                    'total_sub_categories' => $totalSubCategories
                ];
            }
        }

        return response()->json([
            'code' => 200,
            'data' => $results
        ]);

        // $totalMainCategories = $quizCategory->mainCategories->count();
        // $totalSubCategories = 0;

        // foreach ($quizCategory->mainCategories as $mainCategory) {
        //     $totalSubCategories += $mainCategory->subCategories->count();


        // }
        // }

        //     if ($quizCategories) {

        //         return response()->json([
        //             'code' => '200',
        //             'data' =>$quizCategories,
        //             // 'total_main_category' =>$totalmain,
        //             // 'total_sub_category'=>$totalsub
        //         ]);
        //     } else {
        //         return response()->json([
        //             'code' => '500',
        //             'data' => []
        //         ]);
        //     }
    }

    public function main_category($id_category)
    {
        $main = MainCategory::where('quiz_category_id', $id_category)->get();
        // $main->total_sub_category = SubCategory::where('main_category_id', $main->id)->count();
        foreach ($main as $quiz) {
            $quiz->total_sub_category = SubCategory::where('main_category_id', $quiz->id)->count();
        }


        if ($main) {

            return response()->json([
                'code' => '200',
                'data' => $main
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function sub_category(Request $request,$id_main)
    {

        $subcategories = SubCategory::where('main_category_id', $id_main)->get();




        foreach ($subcategories as $subcategory) {
            $all_quiz = Question::where('sub_id', $subcategory->id)->count();
            // $all_quiz_get = Question::where('sub_id',$subcategory->id)->get();

            $questions = Question::where('sub_id', $subcategory->id)->get();

            // Hitung total jawaban benar dan salah
            $total_correct_answers = PoinStudent::where('user_id',$request->user_id)->whereIn('question_id', $questions->pluck('id'))
                ->where('point', 1)
                ->count();
            $total_incorrect_answers = PoinStudent::where('user_id',$request->user_id)->whereIn('question_id', $questions->pluck('id'))
                ->where('point', 0)
                ->count();

            $subcategory->total_correct_answers = $total_correct_answers;
            $subcategory->total_incorrect_answers = $total_incorrect_answers;
            $quizzes = Quiz::where('sub_categories_id', $subcategory->id)->where('user_id',$request->user_id)->get();
            // return $quizzes;

            // Jika daftar kuis kosong, tambahkan objek kuis manual dengan status 'Belum Dikerjakan'
            if ($quizzes->isEmpty()) {
                $quizzes->push(new Quiz([
                    'sub_categories_id' => $subcategory->id,

                    // 'user_id' => $request-,
                    'status_quiz' => 'Not Taken'
                ]));
            } else {
                foreach ($quizzes as $quiz) {
                    $quiz->sub_categories_id = $subcategory->id;
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
            'data' => $subcategories
        ]);


        if ($subcategories) {

            return response()->json([
                'code' => '200',
                'data' => $subcategories
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function studen_report($user_id)
    {
        $session = StudentSchedule::where('user_id', $user_id)->whereNot('note','None')->count();
        $presence = StudentSchedule::where('note', 'Present')->where('user_id', $user_id)->count();
        $alpha = StudentSchedule::where('note', 'Alpha')->where('user_id', $user_id)->count();
        $permit = StudentSchedule::where('note', "Permit")->where('user_id', $user_id)->count();
        $sick = StudentSchedule::where('note', 'Sick')->where('user_id', $user_id)->count();
        $remaining = StudentSchedule::where('note', 'None')->where('user_id', $user_id)->count();
        // return $remaining;


        return response()->json([
            'code' => '200',
            'total_session' => $session,
            'total_presence' => $presence,
            'total_alpha' => $alpha,
            'total_permit' => $permit,
            'total_sick' => $sick,
            'total_remaining' => $remaining,
        ]);
    }

    public function getlist_skor($user_id)
    {

        $skor_total = PoinStudent::where('user_id', $user_id)
                                        ->sum('point');

            // return $skor_poin;


        $skor = Quiz::join('sub_categories', 'quizzes.sub_categories_id', 'sub_categories.id')
            ->select('sub_categories.sub', 'quizzes.*')
            ->where('user_id', $user_id)
            ->get();

            foreach ($skor as $quiz) {
                $questions = Question::where('sub_id', $quiz->sub_categories_id)->get();
            
                foreach ($questions as $question) {
                    $skor_poin = PoinStudent::where('user_id', $user_id)
                                        ->where('question_id', $question->id)
                                        ->sum('point');
                    
                    // Konversi skor ke integer jika skornya adalah string
                    $question->skor = is_numeric($skor_poin) ? (int)$skor_poin : $skor_poin;
                }
            
                // Hitung total skor untuk kategori saat ini
                $subtotal = 0;
            
                foreach ($questions as $question) {
                    // Tambahkan skor setiap pertanyaan ke subtotal
                    $subtotal += $question->skor;
                }
            
                // Tambahkan subtotal ke objek kuis
                $quiz->total_skor = $subtotal;
            
                // Tambahkan pertanyaan dan skornya ke objek kuis
                // $quiz->questions = $questions;
            }
            
            return response()->json([
                'code' => '200',
                'data' => $skor,
                'skor_total'=>$skor_total
            ]);
            

        return response()->json([
            'code' => '200',
            'data' => $skor,

        ]);
    }

    public function getlist_skor_exam($user_id)
    {

        $skor_total = PoinStudentExam::where('user_id', $user_id)
                                        ->sum('point');

            // return $skor_poin;


        $skor = QuizExam::join('exams', 'quiz_exams.exam_id', 'exams.id')
            ->select('exams.title', 'quiz_exams.*')
            ->where('user_id', $user_id)
            ->get();

            foreach ($skor as $quiz) {
                $questions = QuestionExam::where('exam_id', $quiz->exam_id)->get();
            
                foreach ($questions as $question) {
                    $skor_poin = PoinStudentExam::where('user_id', $user_id)
                                        ->where('question_id', $question->id)
                                        ->sum('point');
                    
                    // Konversi skor ke integer jika skornya adalah string
                    $question->skor = is_numeric($skor_poin) ? (int)$skor_poin : $skor_poin;
                }
            
                // Hitung total skor untuk kategori saat ini
                $subtotal = 0;
            
                foreach ($questions as $question) {
                    // Tambahkan skor setiap pertanyaan ke subtotal
                    $subtotal += $question->skor;
                }
            
                // Tambahkan subtotal ke objek kuis
                $quiz->total_skor = $subtotal;
            
                // Tambahkan pertanyaan dan skornya ke objek kuis
                // $quiz->questions = $questions;
            }
            
            return response()->json([
                'code' => '200',
                'data' => $skor,
                'skor_total'=>$skor_total
            ]);
            

        return response()->json([
            'code' => '200',
            'data' => $skor,

        ]);
    }

    public function list_skor_asigment($user_id)
    {

        $skor_total = StudentSchedule::where('user_id', $user_id)->whereNot('homework','none')
                                        ->sum('skor');

        $asignmen = StudentSchedule::where('user_id', $user_id)->whereNot('homework','none')->get();

       
            
            return response()->json([
                'code' => '200',
                'data' => $asignmen,
                'skor_total'=>$skor_total
            ]);
            

     
    }




    public function topskor(){

        $totalScores = PoinStudent::select('users.id as user_id','users.foto_profil', 'users.full_name','students.school','course_programs.program','class_courses.class as class_name', DB::raw('SUM(poin_students.point) as total_score'))
        ->join('users', 'users.id', '=', 'poin_students.user_id')
        ->join('students', 'students.user_id', '=', 'users.id')
        ->join('course_programs', 'students.course_program_id', '=', 'course_programs.id')
        ->join('class_courses', 'students.class_id', '=', 'class_courses.id')
        ->groupBy('users.id', 'users.full_name','students.school','class_name','course_programs.program','users.foto_profil')
        ->orderBy('total_score','desc')
        ->get();
        foreach($totalScores as $v){
            $v->profil_picture = asset('public/profil/'.$v->foto_profil);

        }

        return response()->json([
            'code' => '200',
            'data' => $totalScores,
            
        ]);
        
    }

    public function message_notification(Request $request){
        $m= Message::orderBy('id','desc')->where('user_id',$request->user_id)->orWhere('type_message','All')->get();

        return response()->json([
            'code' => '200',
            'data' => $m,
        ]);

    }
}
