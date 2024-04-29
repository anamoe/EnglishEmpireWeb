<?php

namespace App\Http\Controllers;

use App\Models\AnswerExam;
use App\Models\QuestionExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class QuestionExamController extends Controller
{
    
        public function tambahsoal(){
            return view('soal.tambahsoal');
        }
    
        public function soal($exam_id){
            $soal = QuestionExam::where('exam_id',$exam_id)->get();
         
      
    
            // return $mapel;
    
            return view('exam.kelolasoal_exam',compact('soal','exam_id'));
        }
    
        public function viewsoal($id){
            // $materi = Materi::where('id',$id)->first();
            
            // return 's';
            $s = QuestionExam::where('id', '=', $id)->with(['ganda' => function($q){
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
    
    
                $tujuan_upload = public_path('question_exam/image');
                $file = $request->file('gambar');
                $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
    
                $file->move($tujuan_upload, $namaFile);
                // $req['gambar_layanan']=$namaFile;
                $namaFiles = $namaFile;
            }
    
            if($request->hasFile('suara')){
    
    
                $tujuan_upload = public_path('question_exam/audio');
                $file = $request->file('suara');
                $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
    
                $file->move($tujuan_upload, $namaFile);
                // $req['gambar_layanan']=$namaFile;
                $namaFiles_suara = $namaFile;
            }
        
    
            $soal_id = QuestionExam::create([
                "quest_exam"=>$request->soal,
                "image"=>$namaFiles,
                "audio"=>$namaFiles_suara,
                "answer_key"=>$request->jawbenar, 
                "exam_id"=>$request->mapel_id
            ])->id;
    
              
            $kunci_jawaban = AnswerExam::create([
                "answer"=>$request->jawbenar,
                "quest_exam_id"=>$soal_id
            ])->id;
    
            foreach ($request->jaw as $key => $ganda) {
                AnswerExam::create([
                    "answer"=>$ganda,
                    "quest_exam_id"=>$soal_id
                ]);
            }
    
            QuestionExam::where("id","=",$soal_id)->update([
                "answer_key"=>$kunci_jawaban
            ]);
    
            return redirect()->back()->with('message', 'Exam Berhasil Ditambahkan');
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
            $s = QuestionExam::where('id', '=', $id)->with('ganda')->first();
            $s->image =asset('public/question_exam/image/'.$s->image);
            $s->audio =asset('public/question_exam/audio/'.$s->audio);
    
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
                $tujuan_upload_image = public_path('question_exam/image');
                $file_image = $req->file('gambar');
                $namaFile_image = Carbon::now()->format('Ymd') . $file_image->getClientOriginalName();
                File::delete($tujuan_upload_image . '/' . QuestionExam::find($id)->image);
                $file_image->move($tujuan_upload_image, $namaFile_image);
            
                $tujuan_upload_audio = public_path('question_exam/audio');
                $file_audio = $req->file('suara');
                $namaFile_audio = Carbon::now()->format('Ymd') . $file_audio->getClientOriginalName();
                File::delete($tujuan_upload_audio . '/' . QuestionExam::find($id)->audio);
                $file_audio->move($tujuan_upload_audio, $namaFile_audio);
            
            
    
                QuestionExam::where('id', '=', $id)
                ->update([
                    "quest_exam"=>$req->soal,
                    "image" => $namaFile_image,
                    "audio" => $namaFile_audio
                ]);
                $p=QuestionExam::where('id', '=', $id)->first();
                // return $p;
                $benar = AnswerExam::where("quest_exam_id",$id)->first();
                $benar->update([
                    "answer"=>$req->jawbenar
                ]);
                foreach ($req->jaw as $key => $value) {
                    AnswerExam::where("id",$key)->update([
                        "answer"=> $value
                    ]);  
                }
            } elseif ($req->hasFile('gambar')) {
                // Jika hanya file gambar yang diunggah
                $tujuan_upload_image = public_path('question_exam/image');
                $file_image = $req->file('gambar');
                $namaFile_image = Carbon::now()->format('Ymd') . $file_image->getClientOriginalName();
                File::delete($tujuan_upload_image . '/' . QuestionExam::find($id)->image);
                $file_image->move($tujuan_upload_image, $namaFile_image);
            
             
                QuestionExam::where('id', '=', $id)
                ->update([
                    "quest_exam"=>$req->soal,
                    "image" => $namaFile_image,
                 
                ]);
                $p=QuestionExam::where('id', '=', $id)->first();
                // return $p;
                $benar = AnswerExam::where("quest_exam_id",$id)->first();
                $benar->update([
                    "answer"=>$req->jawbenar
                ]);
                foreach ($req->jaw as $key => $value) {
                    AnswerExam::where("id",$key)->update([
                        "answer"=> $value
                    ]);  
                }
            } elseif ($req->hasFile('suara')) {
                // Jika hanya file suara yang diunggah
                $tujuan_upload_audio = public_path('question_exam/audio');
                $file_audio = $req->file('suara');
                $namaFile_audio = Carbon::now()->format('Ymd') . $file_audio->getClientOriginalName();
                File::delete($tujuan_upload_audio . '/' . QuestionExam::find($id)->audio);
                $file_audio->move($tujuan_upload_audio, $namaFile_audio);
            
                // Perbarui kolom 'audio' saja
              
                QuestionExam::where('id', '=', $id)
                ->update([
                    "quest_exam"=>$req->soal,
                    "audio" => $namaFile_audio
                ]);
                $p=QuestionExam::where('id', '=', $id)->first();
                // return $p;
                $benar = AnswerExam::where("quest_exam_id",$id)->first();
                $benar->update([
                    "answer"=>$req->jawbenar
                ]);
                foreach ($req->jaw as $key => $value) {
                    AnswerExam::where("id",$key)->update([
                        "answer"=> $value
                    ]);  
                }
            } else {
               
                QuestionExam::where('id', '=', $id)
                ->update([
                    "quest_exam"=>$req->soal,
                ]);
                $p=QuestionExam::where('id', '=', $id)->first();
                // return $p;
                $benar = AnswerExam::where("quest_exam_id",$id)->first();
                $benar->update([
                    "answer"=>$req->jawbenar
                ]);
                foreach ($req->jaw as $key => $value) {
                    AnswerExam::where("id",$key)->update([
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
            $tujuan_upload_audio = public_path('question_exam/audio');
            File::delete($tujuan_upload_audio . '/' . QuestionExam::find($id)->audio);
    
            $tujuan_upload_audio = public_path('question_exam/image');
            File::delete($tujuan_upload_audio . '/' . QuestionExam::find($id)->image);
    
             AnswerExam::where('quest_exam_id',$id)->delete();
            QuestionExam::where('id',$id)->delete();
    
            return redirect()->back()->with("message","Soal berhasil dihapus");
    
            
        }
    
        public function hapus_select(Request $request){
            // return $request->ceklist;
            if($request->ceklist){
                $ceklist = $request->ceklist;
                //melakukan update ceklist yg dipilih/all
                foreach ($ceklist as $questionId) {
                    $question = QuestionExam::find($questionId);

                    // return $question;
            
                    // Hapus file audio jika ada
                    if ($question->audio) {
                        $tujuan_upload_audio = public_path('question_exam/audio');
                        File::delete($tujuan_upload_audio . '/' . $question->audio);
                    }
            
                    // Hapus file gambar jika ada
                    if ($question->image) {
                        $tujuan_upload_image = public_path('question_exam/image');
                        File::delete($tujuan_upload_image . '/' . $question->image);
                    }
                }
                AnswerExam::whereIn('quest_exam_id',$request->ceklist)->delete();
            QuestionExam::whereIn('id',$request->ceklist)->delete();
                return redirect()->back()->with('message','Data Berhasil di Update');
            }else{
                //jika tidak ada hanya redirect kosongan
                return redirect()->back();
            }
        }
}
