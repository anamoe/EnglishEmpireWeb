<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PoinStudent;
use App\Models\Question;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexs($id_main)
    {
   
        $sub = SubCategory::where('main_category_id',$id_main)->get();
        // return $sub;
        return view('categorysub',compact('sub','id_main'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_copy(Request $request)
    {
        // return $request;
        //
        $dataquest =Question::where('sub_id',$request->sub_id_copy)->get();
        foreach($dataquest as $v){
            $answer_key= Answer::where('id',$v->answer_key)->first();
            $v->answerkey = $answer_key->answer;

        }

        // return $dataquest;
        $s  =SubCategory::create(["sub" => $request->sub,"main_category_id" => $request->main_id,'waktu_pengerjaan'=>$request->waktu_pengerjaan]);
        foreach($dataquest as $d){

            $newQuestion = Question::create([
                'sub_id' => $s->id, 
                'quest' => $d->quest, 
                'audio' => $d->audio, 
                'image' => $d->image, 
                'answer_key' => $d->answer_key, 
   
            ]);

            $answer =Answer::where('question_id',$d->id)->get();
            $newAnswerKeyId = null;
        
            foreach ($answer as $answere) {
           
               $newAnswer= Answer::create([
                    'question_id' => $newQuestion->id, 
                    'answer' => $answere->answer, 
                
                ]);

                if ($answere->answer == $d->answerkey) {
                    $newAnswerKeyId = $newAnswer->id;
                }
                

                // $a = Answer::where('answer',$d->answerkey)->orderBy('id','desc')->get();

                // foreach($a as $v){
                //     Question::where('id',$newQuestion->id)->first()->update([
                //         'answer_key'=>$v->id
                //     ]);
                // }

               
           

        }
        if ($newAnswerKeyId !== null) {
            $newQuestion->update(['answer_key' => $newAnswerKeyId]);
        }
 
        }
      

        return redirect()->back()->with('message', 'Quiz Category Berhasil Ditambahkan');
    }


    
    public function store(Request $request)
    {
        //
        SubCategory::create(["sub" => $request->sub,"main_category_id" => $request->main_id,'waktu_pengerjaan'=>$request->waktu_pengerjaan]);
        return redirect()->back()->with('message', 'Sub Category Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        SubCategory::where('id', '=', $id)->update(["sub" => $request->sub,'waktu_pengerjaan'=>$request->waktu_pengerjaan]);
        return redirect()->back()->with('message', 'Sub Category Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $s=SubCategory::where('id',$id)->first();
        if($s){

            $q=Question::where('sub_id',$s->id)->get();
            foreach ($q as $v){
            Answer::whereIn('question_id',[$v->id])->delete();
            $v->delete();

            }

            // PoinStudent::whereIn('question_id',[$q->id] )->delete();
         
            $s->delete();

        }

     

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
