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
        $token=['c_RYGF1nR1u9uCNW1F1wl4:APA91bHPj4t_O1QtO1TrrE8VsDGNkFSwzSporty_KGKUgzuIWU3aZTrsZDb0GvL_QejQIDMIQvl7AFI9UV95vtp8Af0LxCpRyRxAQqKjRWw8XZSfVdGLqfMN7J1TVlAP5dZejErEXxyg'];
        $notif->sendNotifAll($token,"pesan1.","mas dul nub",
         "Notifikasi " );

         return 'kenek';
         
    }

}
