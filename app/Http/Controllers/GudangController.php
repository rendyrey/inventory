<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gudang;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
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
      $data['gudang'] = Gudang::all();
      return view('master_gudang.index',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['gudang'] = Gudang::find($id);
      return view('master_gudang.edit',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'kode'=>'required',
        'nama'=>'required',
        'kontak'=>'required',
        'alamat'=>'required'
      ]);
      $gudang = new Gudang();
      $gudang->kode = $request->kode;
      $gudang->nama = $request->nama;
      $gudang->kontak = $request->kontak;
      $gudang->alamat = $request->alamat;
      $gudang->save();
      return redirect('gudang')->with('message','Data berhasil disimpan!')->with('panel','success');

    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'kode'=>'required',
        'nama'=>'required',
        'kontak'=>'required',
        'alamat'=>'required'
      ]);
      $gudang = Gudang::findOrFail($id);
      $gudang->kode = $request->kode;
      $gudang->nama = $request->nama;
      $gudang->kontak = $request->kontak;
      $gudang->alamat = $request->alamat;
      $gudang->save();
      return redirect('gudang')->with('message','Data berhasil disimpan!')->with('panel','success');
    }
}
