<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinStudentExam extends Model
{
    use HasFactory;
    protected $guarded=[];
    public static function cek_poin($exam_id,$user_id){
        $poin = PoinStudentExam::join('question_exams','question_exams.id','poin_student_exams.question_id')
        ->where('question_exams.exam_id',$exam_id)
        ->where('poin_student_exams.user_id',$user_id)
        ->select('poin_student_exams.*')->get();
        // return $poin;
        $point_saya = [
            "banyak_quiz"=>$poin->count(),
            "benar"=>$poin->where('point',1)->count(),
            "salah"=>$poin->where('point',0)->count(),
            "point"=>$poin->sum('point')
        ];
        return $point_saya;
    }
}
