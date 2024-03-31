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

        
//         $totalmain=0;
//         $totalsub=0;
$quizCategories = QuizCategory::with('mainCategories.subCategories')->get();

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

$quizCategories = QuizCategory::with('mainCategories.subCategories')->get();

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
