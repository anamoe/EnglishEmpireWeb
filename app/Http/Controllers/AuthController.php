<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {

        $input = $request->all();



        if (User::where('id_number', '=', $input['id_number'])->first() == true) {
            if (auth()->attempt(array('id_number' => $input['id_number'], 'password' => $input['password']))) {
            
                        return redirect('/user');
                
            } else {
                return redirect()->back()
                    ->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()
                ->with('error', 'id_number tidak ada atau belum terdaftar');
        }
    }

    public function loginview()
    {
        if(auth()->check()){
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect('/user');
                    break;
                default:
                    return redirect('/login');
                    break;
            }
        }
        return view('login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function notifikasi(){
        $notif = new Notif();
        $token=['fJnul3fmRRuXAGSe7SJidw:APA91bHkkoFAVsF0Jme-fWS5wO0QaRl_JuciGwjS4MnB7oXKBdr1tJSixuufdoNFMQfH4CTa3FC9_Qk8t4-44CoZRGZWudfw5N-dROCPc5giAfAtjKiH8cflhqhHj7Pn5W1wvj-QyvnG'];
       
        $notif->sendNotifAll($token,"pesan1.","mas dul nub",
         "Notifikasi " );

         return 'kenek';
         
    }

}
