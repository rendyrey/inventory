<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderPekerjaanController extends Controller
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
      // echo str_random(8);
      $data['user'] = Auth::user();
      $data['pemotong_pola'] = ['1'=>'Rima','2'=>'Kospiah','3'=>'Handayani'];
      return view('pemotong.order',$data);
    }

    public function tambah(Request $request){

      echo $request->i;
    }

    public function validate_order(Request $request){
      $this->validate($request,[
        'nomor_order'=>'required',
        'pemberi_order'=>'required',
        'id_pemotong_pola'=>'required',
        'tanggal_order'=>'required|date',
        'tanggal_selesai'=>'required|date',
        'id_gudang_penerima'=>'required',
        'biaya_produksi'=>'required|numeric',
      ]);
      echo "success";
    }
}
