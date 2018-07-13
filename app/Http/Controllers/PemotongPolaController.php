<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PemotongPola;

class PemotongPolaController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data['user'] = Auth::user();
      $data['pemotong_pola'] = PemotongPola::all();
      return view('master_pemotong.index',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['pemotong_pola'] = PemotongPola::findOrFail($id);
      return view('master_pemotong.edit',$data);
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'nama'=>'required',
        'kontak'=>'required|numeric',
        'alamat'=>'required'
      ],[
        'nama.required'=>'Nama harus diisi!',
        'kontak.required'=>'Kontak harus diisi!',
        'kontak.numeric'=>'Kontak harus diisi angka saja!',
        'alamat.required'=>'Alamat harus diisi!'
      ]);
      $data = PemotongPola::findOrFail($id);
      $data->nama = $request->nama;
      $data->kontak = $request->kontak;
      $data->alamat = $request->alamat;
      $data->save();
      return redirect('pemotong_pola')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'nama'=>'required',
        'kontak'=>'required|numeric',
        'alamat'=>'required',
      ],[
        'nama.required'=>'Nama harus diisi!',
        'kontak.required'=>'Kontak harus diisi!',
        'kontak.numeric'=>'Kontak harus diisi angka saja!',
        'alamat.required'=>'Alamat harus diisi!',
      ]);
      $data = new PemotongPola();
      $data->nama = $request->nama;
      $data->kontak = $request->kontak;
      $data->alamat = $request->alamat;
      $data->save();
      return redirect('pemotong_pola')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

}
