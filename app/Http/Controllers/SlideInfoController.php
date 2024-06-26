<?php

namespace App\Http\Controllers;

use App\Models\SlideInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlideInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $slideinfo =SlideInfo::all();
        return view('slide-info.slideinfo',compact('slideinfo'));
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


            $tujuan_upload = public_path('slide-info');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles = $namaFile;
      

         SlideInfo::create([
            'image' => $namaFiles

        ]);
        return redirect()->back()->with('message', 'Slide Info Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $informasi = SlideInfo::find($id);
        $informasi->image =url('public/slide-info/'.$informasi->image);
        return view('slide-info.edit',compact('informasi'));
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


            $tujuan_upload = public_path('slide-info');
            $file = $request->file('gambar');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            File::delete($tujuan_upload . '/' . SlideInfo::find($id)->image);
            $file->move($tujuan_upload, $namaFile);
            // $req['gambar_layanan']=$namaFile;
            $namaFiles = $namaFile;
            SlideInfo::where('id',$id)->update([
                'image' => $namaFiles
    
            ]);
        }
      

        
        return redirect('slideinfo')->with('message', 'Slide Info Berhasil Diupdate');
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
        $tujuan_upload = public_path('slide-info');
        $s = SlideInfo::where('id', $id)->first();

        if ($s) {

            File::delete($tujuan_upload . '/' . $s->image);
            SlideInfo::destroy($id);
        }
        return redirect()->back()->with('message', 'Slide Info Berhasil Dihapus');
    }
}


