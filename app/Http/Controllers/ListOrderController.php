<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\DetailOrder;
use App\TerimaOrderPola;
use App\DetailTerima;
use App\PemotongPola;
use App\Gudang;
use App\Produksi;
class ListOrderController extends Controller
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
      $data['order'] = Order::all();
      $data['status'] = "-";

      return view('order.list_order',$data);
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['id'] = $id;
      $data['order'] = Order::findOrFail($id);
      $data['order_detail'] = DetailOrder::where('id_order',$id)->get();
      $data['pemotong_pola'] = PemotongPola::pluck('nama','id');
      $data['gudang'] = Gudang::pluck('nama','id');
      $data['produksi'] = Produksi::all();
      return view('order.edit',$data);
    }

    public function terima_proses(Request $request){
      //jml produk yg diterima
      $jml_produk = count($request->id_produksi);
      for($i=0;$i<$jml_produk;$i++){
        //mengambil detail order
        $order_detail = DetailOrder::where('id_order',$request->id_order)->where('id_produksi',$request->id_produksi[$i])->first();
        $terima = $order_detail->terima+$request->dikirim[$i]; //akumulasi detail terima dan inputan dikirim
        if($terima>$order_detail->produksi->hasil){ //apabila total melebihi hasil produksi maka ambil hasil produksi saja
          $order_detail->terima = $order_detail->produksi->hasil;
        }else{ //jika tidak maka ambil akumulasi detail terima dan inputan dikirim
          $order_detail->terima = $terima;
        }
        //jika detail terima sama dengan produksi hasil, maka status order detail jadi 'done'
        if($order_detail->terima == $order_detail->produksi->hasil){
          $order_detail->status = "done";
        }
        $order_detail->save();
      }


      $status_order = "done";

      $order = Order::where('id',$request->id_order)->first();
      //mengecek apa semua detail order done?, kalau iya, status di tabel order jadi 'done'
      foreach ($order->detail_order as $key => $value) {
        if($value->status != "done"){ //mengecek, kalau ada yg tidak done maka keluar dari perulangan dan status order tetap (-)
          $status_order = "-";
          break;
        }
      }
      //update status order di tabel order
      if($status_order=='done'){
        $update_order = Order::where('id',$request->id_order)->first();
        $update_order->status = $status_order;
        $update_order->save();
      }
      return redirect('list_order')->with('message','Data berhasil disimpan!')->with('panel','success');
    }
}
