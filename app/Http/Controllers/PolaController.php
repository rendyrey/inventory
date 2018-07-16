<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pola;
class PolaController extends Controller
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
      $data['pola'] = Pola::all();
      return view('master_pola.index',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['pola'] = Pola::findOrFail($id);
      return view('master_pola.edit',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'nama'=>'required'
      ]);
      $data = new Pola();
      $data->nama = $request->nama;
      $data->save();
      return redirect('pola')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'nama'=>'required'
      ]);
      $data = Pola::findOrFail($id);
      $data->nama = $request->nama;
      $data->save();
      return redirect('pola')->with('message','Data berhasil disimpan!')->with('panel','success');
    }
}
