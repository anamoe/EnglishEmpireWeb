<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionExam extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function ganda()
    {
        return $this->hasMany(AnswerExam::class,'quest_exam_id');
    }

    public static function cek_history($exam_id,$user_id){
        return  QuestionExam::join('poin_student_exams','poin_student_exams.question_id','question_exams.id')
        ->where('question_exams.exam_id',$exam_id)
        ->where('poin_student_exams.user_id',$user_id)
        ->select('poin_student_exams.*','question_exams.id as pid');
    }
}
