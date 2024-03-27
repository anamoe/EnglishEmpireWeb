<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function cek_poin($sub_id){
        $poin = PoinStudent::join('questions','questions.id','poin_students.question_id')
        ->where('questions.mapel_id',$sub_id)
        ->where('poin_students.user_id',auth()->user()->id)
        ->select('poin_students.*')->get();
        $point_saya = [
            "banyak_quiz"=>$poin->count(),
            "benar"=>$poin->where('poin','!=',0)->count(),
            "salah"=>$poin->where('poin','==',0)->count(),
            "poin"=>$poin->sum('poin')
        ];
        return $point_saya;
    }

}
