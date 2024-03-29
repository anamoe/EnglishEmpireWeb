<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthApiController extends Controller
{
    //

    public function login(Request $request){

        $user = User::where('id_number', $request->id_number)->where('role','student')->first();
      
        
        if ($user) {
    
            if (password_verify($request->password, $user->password)) {

                $users = DB::table('students')
                ->leftjoin('users','students.user_id','users.id')
                ->leftjoin('course_programs','students.course_program_id','course_programs.id')
                ->leftjoin('class_courses','students.class_id','class_courses.id')
                ->select('students.*','class_courses.class','course_programs.program','users.full_name','users.nick_name','users.foto_profil as profil_picture','users.id_number','users.role')->where('users.id',$user->id)->first();
                $users->profil_picture = asset('public/profil/'.$user->foto_profil);

                return response()->json([
                    'code' => '200',
                    'message' => "Berhasil",
                    'user'=>$users
                   
                ]);

            }
            
            return response()->json([
                        'code' => '401',
                        'message' => "Password Salah",
                    ]);
        }
        return response()->json([
                    'code' => '402',
                    'message' => "ID NUMBER Tidak Terdaftar, Silahkan Hubungi Admin",
                ]);
    }


    public function profile_update(){
        
    }

   
}
