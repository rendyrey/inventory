<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahan;
use Illuminate\Support\Facades\Auth;

class BahanController extends Controller
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
      $data['bahan'] = Bahan::all();
      return view('master_bahan.index',$data);
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'nama'=>'required',
        'persediaan'=>'required',
        'kode'=>'required',
        'warna'=>'required',
        'satuan'=>'required'
      ],[
        'nama.required'=>'Nama harus diisi!',
        'persediaan.required'=>'Persediaan harus diisi!',
        'kode.required'=>'Kode Bahan harus diisi!',
        'warna.required'=>'Warna harus diisi!',
        'satuan.required'=>'Satuan harus diisi!'
      ]);
      $data = Bahan::findOrFail($id);
      $data->nama = $request->nama;
      $data->kode = $request->kode;
      $data->warna = $request->warna;
      $data->persediaan = $request->persediaan;
      $data->satuan = $request->satuan;
      $data->save();
      return redirect('bahan')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function edit($id){

      $data['user'] = Auth::user();
      $data['bahan'] = Bahan::findOrFail($id);
      return view('master_bahan.edit',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'nama'=>'required',
        'persediaan'=>'required|numeric',
        'kode'=>'required',
        'warna'=>'required',
        'satuan'=>'required'
      ],[
        'nama.required'=>'Nama harus diisi!',
        'persediaan.required'=>'Persediaan harus diisi!',
        'persediaan.numeric'=>'Persediaan harus diisi angka!',
        'kode.required'=>'Kode Bahan harus diisi!',
        'warna.required'=>'Warna harus diisi!',
        'satuan.required'=>'Satuan harus diisi!'
      ]);
      $data = new Bahan();
      $data->nama = $request->nama;
      $data->kode = $request->kode;
      $data->warna = $request->warna;
      $data->persediaan = $request->persediaan;
      $data->satuan = $request->satuan;
      $data->save();
      return redirect('bahan')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function get_satuan($id){
      $bahan = Bahan::findOrFail($id);
      echo $bahan->satuan;
    }
}
