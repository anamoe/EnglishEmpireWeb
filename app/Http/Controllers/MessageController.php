<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MessageController extends Controller
{
    public function index()
    {
        //
        $m = Message::all();
        $user = User::where('role','student')->get();
        
        return view('message',compact('m','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if($request->type_message=='One'){
            Message::create($request->all());
            $notif = new Notif;
            $id_user=User::where('id',$request->user_id)->first();
            $token=['c_RYGF1nR1u9uCNW1F1wl4:APA91bHPj4t_O1QtO1TrrE8VsDGNkFSwzSporty_KGKUgzuIWU3aZTrsZDb0GvL_QejQIDMIQvl7AFI9UV95vtp8Af0LxCpRyRxAQqKjRWw8XZSfVdGLqfMN7J1TVlAP5dZejErEXxyg'];

            $notif->sendNotifOne($id_user->token_fcm,"pesan1.",$request->message,
             "Notifikasi " );
           
             return redirect()->back()->with('message', ' Berhasil Ditambahkan pesan Ke : '.$id_user->full_name.' '.$id_user->token_fcm);
        }else{
            Message::create([
                'message'=>$request->message,
                'type_message'=>$request->type_message
            ]);
            $notif = new Notif;
            $id_user=User::all();
            $token=['c_RYGF1nR1u9uCNW1F1wl4:APA91bHPj4t_O1QtO1TrrE8VsDGNkFSwzSporty_KGKUgzuIWU3aZTrsZDb0GvL_QejQIDMIQvl7AFI9UV95vtp8Af0LxCpRyRxAQqKjRWw8XZSfVdGLqfMN7J1TVlAP5dZejErEXxyg'];
            $tokenList = Arr::pluck($id_user, 'token_fcm');
            $notif->sendNotifAll($tokenList,"pesan1.",$request->message,
             "Notifikasi " );
             return redirect()->back()->with('message', ' Berhasil Ditambahkan Ke Semua');
        }

        
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Message::where('id', '=', $id)->update(["message" => $request->message]);
        return redirect()->back()->with('message', ' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroys(string $id)
    {
        //
        Message::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
