<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function tambahsoal(){
        return view('soal.tambahsoal');
    }

    public function soal($sub_id){
        $soal = Question::where('sub_id',$sub_id)->get();
     
  

        // return $mapel;

        return view('soal.kelolasoal',compact('soal','sub_id'));
    }

    public function viewsoal($id){
        // $materi = Materi::where('id',$id)->first();
        
        // return 's';
        $s = Question::where('id', '=', $id)->with(['ganda' => function($q){
            $q->inRandomOrder();
        }])->first();
       
    
    //    return $s;
        return view('soal.viewsoal',compact('s'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('admin.soal.kelolasoal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    

        $soal_id = Question::create([
            "quest"=>$request->soal,
            // "label"=>$request->label,
            "answer_key"=>$request->jawbenar, 
            "sub_id"=>$request->mapel_id
        ])->id;

          
        $kunci_jawaban = Answer::create([
            "answer"=>$request->jawbenar,
            "question_id"=>$soal_id
        ])->id;

        foreach ($request->jaw as $key => $ganda) {
            Answer::create([
                "answer"=>$ganda,
                "question_id"=>$soal_id
            ]);
        }

        Question::where("id","=",$soal_id)->update([
            "answer_key"=>$kunci_jawaban
        ]);

        return redirect()->back()->with('message', 'Soal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $s = Question::where('id', '=', $id)->with('ganda')->first();

        return view('soal.editsoal',compact('s'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        Question::where('id', '=', $id)
        ->update([
            "quest"=>$req->soal,
        ]);
        $p=Question::where('id', '=', $id)->first();
        // return $p;
        $benar = Answer::where("question_id",$id)->first();
        $benar->update([
            "answer"=>$req->jawbenar
        ]);
        foreach ($req->jaw as $key => $value) {
            Answer::where("id",$key)->update([
                "answer"=> $value
            ]);  
        }

        return redirect("quizcategory/maincategory/subcategory/quiz/".$p->sub_id)->with("message","Soal berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         Answer::where('question_id',$id)->delete();
        Question::where('id',$id)->delete();

        return redirect()->back()->with("message","Soal berhasil dihapus");

        
    }

    public function hapus_select(Request $request){
        // return $request->ceklist;
        if($request->ceklist){
            //melakukan update ceklist yg dipilih/all
            
            Answer::whereIn('question_id',$request->ceklist)->delete();
        Question::whereIn('id',$request->ceklist)->delete();
            return redirect()->back()->with('message','Data Berhasil di Update');
        }else{
            //jika tidak ada hanya redirect kosongan
            return redirect()->back();
        }
    }
}
