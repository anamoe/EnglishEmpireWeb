<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $namaFiles = '';
        $namaFiles_suara = '';
        //
        if($request->hasFile('gambar')){


            $tujuan_upload = public_path('question/image');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();

            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles = $namaFile;
        }

        if($request->hasFile('suara')){


            $tujuan_upload = public_path('question/audio');
            $file = $request->file('suara');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();

            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles_suara = $namaFile;
        }
    

        $soal_id = Question::create([
            "quest"=>$request->soal,
            "image"=>$namaFiles,
            "audio"=>$namaFiles_suara,
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
        $s->image =asset('public/question/image/'.$s->image);
        $s->audio =asset('public/question/audio/'.$s->audio);

        // return $s;


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


        if ($req->hasFile('gambar') && $req->hasFile('suara')) {
            // Jika kedua jenis file diunggah
            $tujuan_upload_image = public_path('question/image');
            $file_image = $req->file('gambar');
            $namaFile_image = Carbon::now()->format('Ymd') . $file_image->getClientOriginalName();
            File::delete($tujuan_upload_image . '/' . Question::find($id)->image);
            $file_image->move($tujuan_upload_image, $namaFile_image);
        
            $tujuan_upload_audio = public_path('question/audio');
            $file_audio = $req->file('suara');
            $namaFile_audio = Carbon::now()->format('Ymd') . $file_audio->getClientOriginalName();
            File::delete($tujuan_upload_audio . '/' . Question::find($id)->audio);
            $file_audio->move($tujuan_upload_audio, $namaFile_audio);
        
        

            Question::where('id', '=', $id)
            ->update([
                "quest"=>$req->soal,
                "image" => $namaFile_image,
                "audio" => $namaFile_audio
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
        } elseif ($req->hasFile('gambar')) {
            // Jika hanya file gambar yang diunggah
            $tujuan_upload_image = public_path('question/image');
            $file_image = $req->file('gambar');
            $namaFile_image = Carbon::now()->format('Ymd') . $file_image->getClientOriginalName();
            File::delete($tujuan_upload_image . '/' . Question::find($id)->image);
            $file_image->move($tujuan_upload_image, $namaFile_image);
        
         
            Question::where('id', '=', $id)
            ->update([
                "quest"=>$req->soal,
                "image" => $namaFile_image,
             
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
        } elseif ($req->hasFile('suara')) {
            // Jika hanya file suara yang diunggah
            $tujuan_upload_audio = public_path('question/audio');
            $file_audio = $req->file('suara');
            $namaFile_audio = Carbon::now()->format('Ymd') . $file_audio->getClientOriginalName();
            File::delete($tujuan_upload_audio . '/' . Question::find($id)->audio);
            $file_audio->move($tujuan_upload_audio, $namaFile_audio);
        
            // Perbarui kolom 'audio' saja
          
            Question::where('id', '=', $id)
            ->update([
                "quest"=>$req->soal,
                "audio" => $namaFile_audio
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
        } else {
           
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
        }
        
        // if($req->hasFile('gambar')){


        //     $tujuan_upload = public_path('question/image');
        //     $file = $req->file('gambar');
        //     $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
        //     File::delete($tujuan_upload . '/' . Question::find($id)->image);
        //     $file->move($tujuan_upload, $namaFile);
        //     // $req['gambar_layanan']=$namaFile;
        //     $namaFiles = $namaFile;
        // }

        // else($req->hasFile('suara')){


        //     $tujuan_upload = public_path('question/audio');
        //     $file = $req->file('suara');
        //     $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
        //     File::delete($tujuan_upload . '/' . Question::find($id)->audio);
        //     $file->move($tujuan_upload, $namaFile);
        //     // $req['gambar_layanan']=$namaFile;
        //     $namaFiles_suara = $namaFile;
        // }
    
        //
      

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
        $q= Question::where('id',$id)->first();
        $tujuan_upload_audio = public_path('question/audio');
        $tujuan_upload_audio = public_path('question/image');
        if($q){

           
            File::delete($tujuan_upload_audio . '/' . Question::find($id)->audio);
    
           
            File::delete($tujuan_upload_audio . '/' . Question::find($id)->image);
            foreach($q as $v){
                Answer::where('question_id',$v->question_id)->delete();
            }
            Question::where('id',$id)->delete();
        }

     
            
        
     

        return redirect()->back()->with("message","Soal berhasil dihapus");

        
    }

    public function hapus_select(Request $request){
        // return $request->ceklist;
        if($request->ceklist){
            $ceklist = $request->ceklist;
            //melakukan update ceklist yg dipilih/all
            foreach ($ceklist as $questionId) {
                $question = Question::find($questionId);
        
                // Hapus file audio jika ada
                if ($question->audio) {
                    $tujuan_upload_audio = public_path('question/audio');
                    File::delete($tujuan_upload_audio . '/' . $question->audio);
                }
        
                // Hapus file gambar jika ada
                if ($question->image) {
                    $tujuan_upload_image = public_path('question/image');
                    File::delete($tujuan_upload_image . '/' . $question->image);
                }
            }
            Answer::whereIn('question_id',$request->ceklist)->delete();
        Question::whereIn('id',$request->ceklist)->delete();
            return redirect()->back()->with('message','Data Berhasil di Update');
        }else{
            //jika tidak ada hanya redirect kosongan
            return redirect()->back();
        }
    }
}
