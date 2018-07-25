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
use App\Label;

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

    public function order(){
      // echo str_random(8);
      $data['user'] = Auth::user();
      $data['pemotong_pola'] = PemotongPola::all()->pluck('nama','id');
      $data['pemotong_pola']->prepend('',''); //untuk value kosong buat select
      $data['gudang'] = Gudang::all()->pluck('nama','id');
      $data['gudang']->prepend('',''); //untuk value kosong buat select
      $data['label'] = Label::pluck('ukuran','id');
      $data['bahan'] = Bahan::all();
      $data['produksi'] = Produksi::all();
      return view('order.order',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'nomor_order'=>'required',
        'pemberi_order'=>'required',
        'id_pemotong_pola'=>'required',
        'tanggal_order'=>'required',
        'tanggal_selesai'=>'required',
        'id_gudang_penerima'=>'required',
        'biaya_produksi'=>'required',
        'produk.0'=>'required'
      ],[
        'produk.0.required'=>'Mohon isi produk minimal 1'
      ]);
      //memasukkan data ke tabel order
      $order = new Order();
      $order->nomor_order = $request->nomor_order;
      $order->pemberi_order = $request->pemberi_order;
      $order->id_pemotong_pola = $request->id_pemotong_pola;
      $order->tanggal_order = $request->tanggal_order;
      $order->tanggal_selesai = $request->tanggal_selesai;
      $order->id_gudang_penerima = $request->id_gudang_penerima;
      $order->biaya_produksi = str_replace(".","",$request->biaya_produksi);
      $order->status = "-";
      $order->save();

      //mengambil data id terakhir order yg baru saja dimasukkan
      $id_order = Order::orderBy('id','desc')->first();
      $order_id = $id_order->id;
      //ambil jumlah produk yg dimasukkan saat order
      $jml_produk = count($request->produk);
      for($i=0;$i<$jml_produk;$i++){
        $detail_order = new DetailOrder();
        $detail_order->id_order = $order_id;
        $detail_order->id_produksi = $request->produk[$i];
        $detail_order->pesan = 0;
        $detail_order->terima = 0;
        $detail_order->dibayar = 0;
        $detail_order->retur = 0;
        //status order belum beres sampai terima dibuat (-)
        $detail_order->status = "-";
        $detail_order->save();
      }
      return redirect('order')->with('message','Data berhasil disimpan!')->with('panel','success');

    }


}
