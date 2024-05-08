<?php

namespace App\Http\Controllers;

use App\Models\StudentSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        //
        $schedule = StudentSchedule::orderBy('date','asc')->where('user_id',$user_id)->get();
        $user = User::where('id',$user_id)->first();

        return view('schedule',compact('schedule','user','user_id'));
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
        StudentSchedule::create(["user_id" => $request->user_id,"date" => $request->date,
        "homework" => 'None',"session" => $request->session,"note" => 'None']);
        return redirect()->back()->with('message', 'Schedule Student Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user =StudentSchedule::
        where('id',$id)
        ->first();
       
        return response()->json($user);
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
    public function updated(Request $request, string $id)
    {
        //
        StudentSchedule::where('id',$id)->update([
            'note' => $request->note,
            'skor' => $request->skor,
            'homework' => $request->homework,
   
        ]);
        return redirect()->back()->with('message', 'Note Schedule Student Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroys(string $id)
    {
        //

        StudentSchedule::destroy($id);
        return redirect()->back()->with('message', ' Berhasil Dihapus');
    }
}
