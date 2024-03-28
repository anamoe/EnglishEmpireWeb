<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoUpdate;
use App\Models\SlideInfo;
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
}
