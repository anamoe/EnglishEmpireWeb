<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\CourseProgramController;
use App\Http\Controllers\InfoUpdateController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizCategoryController;
use App\Http\Controllers\SlideInfoController;
use App\Http\Controllers\StudentScheduleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\CourseProgram;
use App\Models\MainCategory;
use App\Models\Question;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/login', function () {
//     return view('login');
// });
Route::post('/postlogin', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'loginview']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/', [AuthController::class, 'loginview']);


Route::middleware(['middleware' => 'admin'])->group(function () {
    // Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::resource('user',UserController::class);
    Route::get('class/{id_course}',[UserController::class,'getclass']);
    Route::post('userupdate/{id}',[UserController::class,'updated']);

    


    Route::resource('quizcategory',QuizCategoryController::class);
    Route::get('quizcategory/maincategory/{id_category}',[MainCategoryController::class,'index']);
    Route::resource('quizcategory/maincategory',MainCategoryController::class);
    Route::resource('quizcategory/maincategory/subcategorys',SubCategoryController::class);
    Route::get('quizcategory/maincategory/subcategory/{id_main}',[SubCategoryController::class,'indexs']);

    Route::get('quizcategory/maincategory/subcategory/quiz/{sub_id}',[QuestionController::class,'soal']);
    Route::resource('kelolasoal',QuestionController::class);

    Route::get('kelolasoaldelete/{id}',[QuestionController::class,'destroy']);
    Route::post('hapus-all',[QuestionController::class,'hapus_select']);
    Route::get('soal/{id}',[QuestionController::class,'viewsoal']);

    Route::resource('slideinfo',SlideInfoController::class);
    Route::get('slideinfodelete/{id}',[SlideInfoController::class,'destroy']);

    Route::resource('infoupdate',InfoUpdateController::class);
    Route::get('infoupdatedelete/{id}',[InfoUpdateController::class,'destroy']);

    Route::resource('courseprogram',CourseProgramController::class);
    Route::get('courseprogramdelete/{id}',[CourseProgramController::class,'destroy']);

    Route::resource('class',ClassCourseController::class);
    Route::get('courseprogram/class/{id_course}',[ClassCourseController::class,'index']);

    Route::get('courseprogramdelete/{id}',[CourseProgramController::class,'destroy']);


    Route::resource('student-schedule',StudentScheduleController::class);
    Route::get('student-schedules/{user_id}',[StudentScheduleController::class,'index']);
    Route::post('schedule-student-update/{id}',[StudentScheduleController::class,'updated']);
    Route::get('schedule-student-delete/{id}',[StudentScheduleController::class,'destroys']);

});