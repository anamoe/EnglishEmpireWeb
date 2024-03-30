<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function cek_poin($sub_id,$user_id){
        $poin = PoinStudent::join('questions','questions.id','poin_students.question_id')
        ->where('questions.sub_id',$sub_id)
        ->where('poin_students.user_id',$user_id)
        ->select('poin_students.*')->get();
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
