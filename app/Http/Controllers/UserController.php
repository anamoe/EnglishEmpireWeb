<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\CourseProgram;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getclass($id_course){
        $class = ClassCourse::where('course_program_id',$id_course)->get();
        return $class;
     }
    public function index()
    {
        //
        $coursePrograms = CourseProgram::all();
        $class = ClassCourse::all();
        $users = DB::table('students')
        ->leftjoin('users','students.user_id','users.id')
        ->select('students.*','users.*')->get();
        return view('user',compact('users','coursePrograms','class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        // return $request;

        if (User::where('id_number', '=', $request->id_number)->first() == false) {
            $request->merge([
                'password' => bcrypt($request->password),
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'role' => 'student',
                'foto_profil' => 'profil.jpg',
            ]);
            $user = User::create($request->except(['_token']));

           $s= Student::create([
                'user_id'=>$user->id,
                'school' => $request->school,
                'date_birth' => $request->date_birth,
                'no_hp' => $request->no_hp,
                'course_program_id'=>$request->course_program_id,
                'class_id'=>$request->class_id
                

            ]);
            // return $s;


            return redirect()->back()->with('message', 'Berhasil Menambah User');
        } else {
            return redirect()->back()->with('error', 'ID Number sudah terdaftar');
        }
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

        $user = DB::table('students')
        ->leftjoin('users','students.user_id','users.id')
        ->select('students.*','users.*')
        ->where('users.id',$id)
        ->first();
        $user->foto_profil = asset('public/profil/'.$user->foto_profil);
        return response()->json($user);
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
    public function updated(Request $request, $id)
    {
        //
      
        $namaFiles = '';
        //
        if($request->hasFile('gambar')){


            $tujuan_upload = public_path('profil');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            // File::delete($tujuan_upload . '/' . User::find($id)->foto_profil);
            if ($request->file('gambar')->getClientOriginalName() == 'profil.jpg') {
                // Jika foto profil yang diupload adalah default, tidak perlu menghapus foto lama
                $namaFiles = $request->file('gambar')->getClientOriginalName();
            } else {
                // Jika foto profil yang diupload bukan default, hapus foto lama
                File::delete($tujuan_upload . '/' . User::find($id)->foto_profil);
                $file->move($tujuan_upload, $namaFile);
                $namaFiles = $namaFile;
            }
            // $file->move($tujuan_upload, $namaFile);
            // // $req['gambar_layanan']=$namaFile;
            // $namaFiles = $namaFile;

            
        if($request->password){

            User::where('id', '=', $id)->update([
                'password' => bcrypt($request->password),
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number,
                'foto_profil'=>$namaFiles
            ]);

            Student::where('user_id',$id)->update([
                'school' => $request->school,
                'date_birth' => $request->date_birth,
                'no_hp' => $request->no_hp,
                // 'course_program_id'=>$request->course_program_id,
                // 'class_id'=>$request->class_id
                

            ]);

        }else{
            
            User::where('id', '=', $id)->update([
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number,
                'foto_profil'=>$namaFiles
            ]);

            Student::where('user_id',$id)->update([
                'school' => $request->school,
                'date_birth' => $request->date_birth,
                'no_hp' => $request->no_hp,
                // 'course_program_id'=>$request->course_program_id,
                // 'class_id'=>$request->class_id
                

            ]);

        }

           
        }else{
            
        if($request->password){

            User::where('id', '=', $id)->update([
                'password' => bcrypt($request->password),
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number
            ]);

            Student::where('user_id',$id)->update([
                'school' => $request->school,
                'date_birth' => $request->date_birth,
                'no_hp' => $request->no_hp,
                // 'course_program_id'=>$request->course_program_id,
                // 'class_id'=>$request->class_id
                

            ]);

        }else{
            
            User::where('id', '=', $id)->update([
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number
            ]);

            Student::where('user_id',$id)->update([
                'school' => $request->school,
                'date_birth' => $request->date_birth,
                'no_hp' => $request->no_hp,
                // 'course_program_id'=>$request->course_program_id,
                // 'class_id'=>$request->class_id
                

            ]);

        }

          
        }
      

        return redirect()->back()->with('message', 'User Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroys($id)
    {
        //
        Student::where('user_id',$id)->delete();
        User::destroy($id);
        return redirect()->back()->with('message', 'User Berhasil Dihapus');
    }
}
