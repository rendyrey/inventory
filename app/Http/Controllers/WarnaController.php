<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Warna;

class WarnaController extends Controller
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
      $data['warna'] = Warna::all();
      return view('master_warna.index',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'warna'=>'required'
      ]);
      $data = new Warna();
      $data->warna = $request->warna;
      $data->save();
      return redirect('warna')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['warna'] = Warna::findOrFail($id);
      return view('master_warna.edit',$data);
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'warna'=>'required'
      ]);
      $data = Warna::findOrFail($id);
      $data->warna = $request->warna;
      $data->save();
      return redirect('warna')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

}
