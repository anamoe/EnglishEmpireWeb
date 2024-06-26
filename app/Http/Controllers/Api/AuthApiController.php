<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuthApiController extends Controller
{
    //

    public function login(Request $request){

        $user = User::where('id_number', $request->id_number)->whereIn('role',['student','parent'])->first();
      
        
        if ($user) {
    
            if (password_verify($request->password, $user->password)) {
                if($request->token_fcm){
                    $user->update([
                        'token_fcm'=>$request->token_fcm
                    ]);
                 }

                 if($user->role=='student'){
                    $users = DB::table('students')
                    ->leftjoin('users','students.user_id','users.id')
                    ->leftjoin('course_programs','students.course_program_id','course_programs.id')
                    ->leftjoin('class_courses','students.class_id','class_courses.id')
                    ->select('students.*','class_courses.class','course_programs.program',
                    'users.full_name','users.nick_name','users.foto_profil as profil_picture','users.token_fcm',
                    'users.activate_date','users.status_account',
                    'users.id_number','users.role')->where('users.id',$user->id)->first();
                    $users->profil_picture = asset('public/profil/'.$user->foto_profil);

                 }else{
                    $user_parent = DB::table('users')
                    ->select(
                    'users.full_name as full_name_parent','users.nick_name as nick_name_parent','users.foto_profil as profil_picture','users.token_fcm',
                    'users.id as id_parent',
                    'users.id_number as id_number_parent','users.role as role_parent')->where('users.id',$user->id)->first();
                    $user_parent->profil_picture = asset('public/profil/'.$user_parent->profil_picture);
// return $user_parent;
                    $users = DB::table('students')
                    ->leftjoin('users','students.user_id','users.id')
                    ->leftjoin('course_programs','students.course_program_id','course_programs.id')
                    ->leftjoin('class_courses','students.class_id','class_courses.id')
                    ->select('students.*','class_courses.class','course_programs.program',
                    'users.full_name','users.nick_name','users.foto_profil as profil_picture',
                    'users.activate_date','users.status_account',
                    'users.id_number','users.role')->where('users.id_number',$request->id_number_student)->first();

                    $users->full_name_parent =$user_parent->full_name_parent;
                    $users->nick_name_parent =$user_parent->nick_name_parent;
                    $users->id_number_parent =$user_parent->id_number_parent;
                    $users->role_parent =$user_parent->role_parent;
                    $users->role =$user_parent->role_parent;
                    $users->profil_picture =$user_parent->profil_picture;
                    
                    // $users->profil_picture = asset('public/profil/'.$user->foto_profil);

                 }

        

            

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

    
public function updateUserProfile(Request $request)
{
    
    $user = User::where('id', $request->id_user)->first();
  
    if ($request->hasFile('profil_picture')) {

        // return $user;

        $oldPhoto = $user->foto;

    //     if($oldPhoto!='default.jpg'){

      
    //     if (!empty($oldPhoto)) {
    //         $oldPhotoPath = public_path('profil') . '/' . $oldPhoto;
    //         if (file_exists($oldPhotoPath)) {
    //             unlink($oldPhotoPath);
    //         }
    //     }
    // }
    $tujuan_upload = public_path('profil');
        $image = $request->file('profil_picture');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        File::delete($tujuan_upload . '/' . User::find($request->id_user)->foto_profil);
        // return $imageName;

        $image->move(public_path('profil'), $imageName);

        
        User::where('id',$request->id_user)->update([
            'foto_profil'=>$imageName,
            'full_name'=>$request->full_name,
            'nick_name'=>$request->nick_name,
        ]);

        Student::where('user_id',$user->id)->update([
            'no_hp'=>$request->no_hp,
            'date_birth'=>$request->date_birth,
            'school'=>$request->school,



        ]);

        $users = DB::table('students')
        ->leftjoin('users','students.user_id','users.id')
        ->leftjoin('course_programs','students.course_program_id','course_programs.id')
        ->leftjoin('class_courses','students.class_id','class_courses.id')
        ->select('students.*','class_courses.class','course_programs.program','users.full_name','users.nick_name','users.foto_profil','users.id_number','users.role')
        ->where('users.id',$user->id)->first();

        // return $users;
        $users->profil_picture = asset('public/profil/'.$user->foto_profil);

        return response()->json([
            'code' => '200',
            'data'=>$users,
            'message' => 'Profil pengguna dan Foto berhasil diperbarui'
        ]);


    }else{
                
   
        
        $user->update([
            'full_name'=>$request->full_name,
            'nick_name'=>$request->nick_name,
            // 'phone_number'=>$request->phone_number,
        ]);
        Student::where('user_id',$user->id)->update([
            'no_hp'=>$request->no_hp,
            'date_birth'=>$request->date_birth,
            'school'=>$request->school,



        ]);

        $users = DB::table('students')
        ->leftjoin('users','students.user_id','users.id')
        ->leftjoin('course_programs','students.course_program_id','course_programs.id')
        ->leftjoin('class_courses','students.class_id','class_courses.id')
        ->select('students.*','class_courses.class','course_programs.program','users.full_name','users.nick_name','users.foto_profil as profil_picture','users.id_number','users.role')
        ->where('users.id',$user->id)->first();
        // return $users;
        $users->profil_picture = asset('public/profil/'.$users->profil_picture);

        return response()->json([
            'code' => '200',
            'data'=>$users,
            'message' => 'Profil pengguna berhasil diperbarui'
        ]);



      
    }

       

 
}
        
    }

   

