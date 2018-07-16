<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models;
class ModelController extends Controller
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
      $data['model'] = Models::all();
      return view('master_model.index',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['model'] = Models::findOrFail($id);
      return view('master_model.edit',$data);
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'nama'=>'required'
      ]);
      $data = Models::findOrFail($id);
      $data->nama = $request->nama;
      $data->save();
      return redirect('model')->with('message','Data berhasil disimpan!')->with('panel','success');
    }


    public function tambah(Request $request){
      $this->validate($request,[
        'nama'=>'required'
      ]);
      $data = new Models();
      $data->nama = $request->nama;
      $data->save();
      return redirect('model')->with('message','Data berhasil disimpan!')->with('panel','success');
    }
}
