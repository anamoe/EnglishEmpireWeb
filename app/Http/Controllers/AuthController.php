<?php

namespace App\Http\Controllers;

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

}
