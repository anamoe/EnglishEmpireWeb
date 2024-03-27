<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizCategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/postlogin', [AuthController::class, 'login']);


Route::middleware(['middleware' => 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
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

});