<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function ganda()
    {
        return $this->hasMany(Answer::class);
    }

    public static function cek_history($sub_id){
        return  Question::join('poin_students','poin_students.question_id','questions.id')
        ->where('questions.sub_id',$sub_id)
        ->where('poin_students.user_id',1)
        ->select('poin_students.*','questions.id as pid');
    }
}
