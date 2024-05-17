<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PoinStudent;
use Illuminate\Http\Request;

class AnswerStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_answer($sub_id)
    {
        //
        $answer =PoinStudent::
        join('questions','poin_students.question_id','questions.id')
        ->join('sub_categories','questions.sub_id','sub_categories.id')
        ->join('users','poin_students.user_id','users.id')
        ->select('questions.*','sub_categories.*','users.full_name','poin_students.*')
        ->where('questions.sub_id',$sub_id)
        ->get();
        // ->groupBy(function($item) {
        //     return $item->sub_id . '-' . $item->user_id;
        // });
        return view('answer_student',compact('answer'));
        return $answer;
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
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        PoinStudent::where('id',$id)->delete();
        return redirect()->back()->with("message","Jawaban Siswa berhasil dihapus");

    }


    public function hapus_select(Request $request){
        // return $request->ceklist;
        if($request->ceklist){
      
        PoinStudent::whereIn('id',$request->ceklist)->delete();
            return redirect()->back()->with('message','Data Jawaban Siswa Berhasil di Hapus');
        }else{
            //jika tidak ada hanya redirect kosongan
            return redirect()->back();
        }
    }
}
