<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoUpdate;
use App\Models\MainCategory;
use App\Models\QuizCategory;
use App\Models\SlideInfo;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class InfoApiController extends Controller
{
    //
    public function slide_info(){

        $slideinfo = SlideInfo::orderBy('id','desc')->get();
        foreach($slideinfo as $p){
            $p->image = asset('public/slide-info/'.$p->image);

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

    public function info_update(){
        $info = InfoUpdate::orderBy('id','desc')->get();
        foreach($info as $p){
            $p->image = asset('public/info-update/'.$p->image);

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

    public function TopSkor(){
        
    }


    public function quiz_category(){
        $quizcategory = QuizCategory::all();
        if ($quizcategory) {

            return response()->json([
                'code' => '200',
                'data' => $quizcategory
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }

    public function main_category($id_category){
        $main = MainCategory::where('quiz_category_id',$id_category)->get();

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

    public function sub_category($id_main){
        $sub = SubCategory::where('main_category_id',$id_main)->get();

        if ($sub) {

            return response()->json([
                'code' => '200',
                'data' => $sub
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
        
    }

}
