<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoUpdate;
use App\Models\MainCategory;
use App\Models\PoinStudent;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\SlideInfo;
use App\Models\StudentSchedule;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class InfoApiController extends Controller
{
    //

    public function get_schedule($user_id)
    {

        
        $slideinfo = StudentSchedule::where('user_id',$user_id)->orderBy('session', 'asc')->get();
     

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

    public function TopSkor()
    {
    }


    public function quiz_category()
    {
        $quizcategory = QuizCategory::all();
        foreach ($quizcategory as $quiz) {
            $quiz->total_main = MainCategory::where('quiz_category_id', $quiz->id)->count();
            // $quiz->save();
            $main_category = MainCategory::where('quiz_category_id', $quiz->id)->get();

            foreach ($main_category as $sub) {
                $sub->total_sub = SubCategory::where('main_category_id', $sub->id)->count();
            }

            $quiz->main_category = $main_category;
            // $quiz->total = $main_category->total_sub;

        }


        if ($quizcategory) {

            return response()->json([
                'code' => '200',
                'data' => $quizcategory
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
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

    public function sub_category($id_main)
    {
        $subcategories = SubCategory::where('main_category_id', $id_main)->get();




        foreach ($subcategories as $subcategory) {
            $all_quiz = Question::where('sub_id', $subcategory->id)->count();
            // $all_quiz_get = Question::where('sub_id',$subcategory->id)->get();

            $questions = Question::where('sub_id', $subcategory->id)->get();

            // Hitung total jawaban benar dan salah
            $total_correct_answers = PoinStudent::whereIn('question_id', $questions->pluck('id'))
                ->where('point', 1)
                ->count();
            $total_incorrect_answers = PoinStudent::whereIn('question_id', $questions->pluck('id'))
                ->where('point', 0)
                ->count();

            $subcategory->total_correct_answers = $total_correct_answers;
            $subcategory->total_incorrect_answers = $total_incorrect_answers;
            $quizzes = Quiz::where('sub_categories_id', $subcategory->id)->get();

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
                    $quiz->status_quiz = 'finish';
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
}
