<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gudang;

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
      $data['gudang'] = Gudang::all();
      return view('master_gudang.index',$data);
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
      return redirect('gudang')->with('message','Berhasil simpan data!')->with('panel','success');

    }
}
