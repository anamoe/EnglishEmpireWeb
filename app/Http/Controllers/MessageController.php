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
        
        return view('message',compact('m'));
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
        Message::create($request->all());
        $notif = new Notif;
        $id_user=User::all();
        $token=['c_RYGF1nR1u9uCNW1F1wl4:APA91bHPj4t_O1QtO1TrrE8VsDGNkFSwzSporty_KGKUgzuIWU3aZTrsZDb0GvL_QejQIDMIQvl7AFI9UV95vtp8Af0LxCpRyRxAQqKjRWw8XZSfVdGLqfMN7J1TVlAP5dZejErEXxyg'];
        $tokenList = Arr::pluck($id_user, 'token');
        $notif->sendNotifAll($tokenList,"pesan1.",$request->message,
         "Notifikasi " );

        
        return redirect()->back()->with('message', ' Berhasil Ditambahkan');
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
    public function destroy(string $id)
    {
        //
        Message::where('id',$id)->delete();

        return redirect()->back()->with("message"," berhasil dihapus");
    }
}
