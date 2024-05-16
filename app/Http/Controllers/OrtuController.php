<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrtuController extends Controller
{
    public function index()
    {
        //
 
        $users = User::where('role','parent')->get();
        // return $users;
        return view('ortu',compact('users'));
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
        if (User::where('id_number', '=', $request->id_number)->first() == false) {
            $request->merge([
                'password' => bcrypt($request->password),
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'status_account' => 'active',
                'role' => 'parent',
                'foto_profil' => 'profil.jpg',
            ]);
       User::create($request->except(['_token']));


            return redirect()->back()->with('message', 'Berhasil Menambah Orangtua');
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

        $user = User::
        where('id',$id)
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
      
        // return $request;

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
                'foto_profil'=>$namaFiles,
            ]);


        }else{
            
            User::where('id', '=', $id)->update([
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number,
                'foto_profil'=>$namaFiles,
            ]);


        }

           
        }else{
            
        if($request->password){

            User::where('id', '=', $id)->update([
                'password' => bcrypt($request->password),
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number,

            ]);

  

        }else{
            
            User::where('id', '=', $id)->update([
                'full_name' => $request->full_name,
                'nick_name' => $request->nick_name,
                'id_number'=>$request->id_number,
            ]);


        }

          
        }

        // return $u;
      

        return redirect()->back()->with('message', 'User Orangtua Berhasil Diperbaharui');
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
        $tujuan_upload = public_path('profil');
        $s = User::where('id', $id)->first();

        if ($s) {

            File::delete($tujuan_upload . '/' . $s->foto_profil);
            User::destroy($id);
        }
        return redirect()->back()->with('message', 'User Berhasil Dihapus');
    }
}
