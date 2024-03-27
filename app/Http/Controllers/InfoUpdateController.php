<?php

namespace App\Http\Controllers;

use App\Models\InfoUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InfoUpdateController extends Controller
{
    public function index()
    {
        //
        $info =InfoUpdate::all();
        return view('info-update.infoupdate',compact('info'));
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
        $namaFiles = '';
        //
        $this->validate($request, [
            // check validtion for image or file
                  'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              ]);


            $tujuan_upload = public_path('info-update');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles = $namaFile;
      

         InfoUpdate::create([
            'image' => $namaFiles,
            'link'=>$request->link

        ]);
        return redirect()->back()->with('message', 'Info Update Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $informasi = InfoUpdate::find($id);
        $informasi->image =url('public/info-update/'.$informasi->image);
        return view('info-update.edit',compact('informasi'));
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
    public function update(Request $request, $id)
    {
        //
        $namaFiles = '';
        //
        if($request->hasFile('gambar')){


            $tujuan_upload = public_path('info-update');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            File::delete($tujuan_upload . '/' . InfoUpdate::find($id)->image);
            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles = $namaFile;

            InfoUpdate::where('id',$id)->update([
                'image' => $namaFiles,
                'link'=>$request->link
    
            ]);
        }else{

            InfoUpdate::where('id',$id)->update([
                'link'=>$request->link
    
            ]);
        }
      

      
        return redirect('infoupdate')->with('message', 'Info Update Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // Informasi::destroy($id);
        $tujuan_upload = public_path('info-update');
        $s = InfoUpdate::where('id', $id)->first();

        if ($s) {

            File::delete($tujuan_upload . '/' . $s->image);
            InfoUpdate::destroy($id);
        }
        return redirect()->back()->with('message', 'Info Update Berhasil Dihapus');
    }


}
