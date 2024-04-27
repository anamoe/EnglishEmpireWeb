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

    public static function cek_history($sub_id){
        return  Question::join('poin_students','poin_students.question_id','questions.id')
        ->where('questions.sub_id',$sub_id)
        ->where('poin_students.user_id',1)
        ->select('poin_students.*','questions.id as pid');
    }
}
