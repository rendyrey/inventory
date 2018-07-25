<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Label;

class LabelController extends Controller
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
      $data['label'] = Label::all();
      return view('master_label.index',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['label'] = Label::findOrFail($id);
      return view('master_label.edit',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'ukuran'=>'required',
        'persediaan'=>'required|numeric',
        'harga'=>'required|numeric'
      ],[
        'ukuran.required'=>'Ukuran harus diisi!',
        'persediaan.required'=>'Persediaan harus diisi!',
        'persediaan.numeric'=>'Persediaan hanya diisi angka saja!',
        'harga.required'=>'Harga harus diisi!',
        'harga.numeric'=>'Harga hanya diisi angka saja!'
      ]);
      $data = new Label();
      $data->ukuran = $request->ukuran;
      $data->persediaan = $request->persediaan;
      $data->harga = $request->harga;
      $data->save();
      return redirect('label')->with('message','Data berhasil disimpan!')->with('panel','success');
    }
}
