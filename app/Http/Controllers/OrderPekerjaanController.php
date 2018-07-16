<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bahan;
use App\PemotongPola;
use App\Gudang;
use App\Produksi;
use App\Order;
use App\DetailOrder;
use App\DetailProduksiBahan;

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
      $this->validate($request,[
        'nomor_order'=>'required',
        'pemberi_order'=>'required',
        'id_pemotong_pola'=>'required',
        'tanggal_order'=>'required',
        'tanggal_selesai'=>'required',
        'id_gudang_penerima'=>'required',
        'biaya_produksi'=>'required'
      ]);
      $order = new Order();
      $order->nomor_order = $request->nomor_order;
      $order->pemberi_order = $request->pemberi_order;
      $order->id_pemotong_pola = $request->id_pemotong_pola;
      $order->tanggal_order = $request->tanggal_order;
      $order->tanggal_selesai = $request->tanggal_selesai;
      $order->id_gudang_penerima = $request->id_gudang_penerima;
      $order->biaya_produksi = str_replace(".","",$request->biaya_produksi);
      $order->save();

      $id_order = Order::orderBy('id','desc')->first();
      $order_id = $id_order->id;
      $jml_produk = count($request->produk);
      // for($i=0;$i<$jml_produk;$i++){
      //   $det_produksi = DetailProduksiBahan::where('id_detail_prod_bahan',$request->produk[$i])->get();
      //   foreach($det_produksi as $key=>$value){
      //     $detail_order = new DetailOrder();
      //     $detail_order->id_order = $order_id;
      //     $detail_order->id_bahan = $request->bahan.$i[$key];
      //     $detail_order->keperluan = $request->keperluan.$i[$key];
      //     $detail_order->hasil = $request->hasil[$i];
      //     $detail_order->id_produksi = $request->produk[$i];
      //     $detail_order->save();
      //   }
      // }
      echo "berhasil";

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
