<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bahan;
use App\PemotongPola;
use App\Gudang;
use App\Produksi;

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

    public function order_pola(){
      // echo str_random(8);
      $data['user'] = Auth::user();

      $data['pemotong_pola'] = PemotongPola::all()->pluck('nama','id');
      $data['pemotong_pola']->prepend('',''); //untuk value kosong buat select
      $data['gudang'] = Gudang::all()->pluck('nama','id');
      $data['gudang']->prepend('',''); //untuk value kosong buat select
      $data['bahan'] = Bahan::all();
      $data['produksi'] = Produksi::all();
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
