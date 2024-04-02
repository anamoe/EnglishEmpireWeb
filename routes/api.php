<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\InfoApiController;
use App\Http\Controllers\Api\QuizApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthApiController::class,'login']);

Route::get('quiz-soal', [QuizApiController::class,'quiz']);
Route::post('cekjawaban-quiz', [QuizApiController::class,'cek_jawaban']);

Route::get('slide-info', [InfoApiController::class,'slide_info']);
Route::get('info-update', [InfoApiController::class,'info_update']);

Route::get('quiz-category', [InfoApiController::class,'quiz_category']);
Route::get('main-category/{id_category}', [InfoApiController::class,'main_category']);
Route::get('sub-category/{id_main}', [InfoApiController::class,'sub_category']);


Route::get('schedule-student/{user_id}',[InfoApiController::class,'get_schedule']);

Route::get('student-report/{user_id}',[InfoApiController::class,'studen_report']);
Route::get('getlist_skor/{user_id}',[InfoApiController::class,'getlist_skor']);
Route::get('topskor',[InfoApiController::class,'topskor']);

