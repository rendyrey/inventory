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
use App\DetailLabel;
use App\DetailBordir;
use App\DetailSablon;
use App\DetailKancing;
use App\DetailBahan;
use App\DetailPola;

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
      $data['bahan'] = Bahan::orderBy('nama','asc')->pluck('nama','id');
      $data['produksi'] = Produksi::all();
      return view('order.order',$data);
    }

    public function tambah(Request $request){
      $this->validate($request,[
        'nomor_order'=>'required',
        'pemberi_order'=>'required',
        'id_pemotong_pola'=>'required',
        'tanggal_order'=>'required',
        'tanggal_selesai'=>'required|after_or_equal:tanggal_order',
        'id_gudang_penerima'=>'required',
        'biaya_produksi'=>'required',
        // 'produk.0'=>'required'
      ],[
        // 'produk.0.required'=>'Mohon isi produk minimal 1'
        'nomor_order.required'=>'Nomor order harus diisi!',
        'pemberi_order.required'=>'Pemberi order harus diisi!',
        'id_pemotong_pola.required'=>'Pemotong Pola harus diisi!',
        'tanggal_order.required'=>'Tanggal order harus diisi!',
        'tanggal_selesai.after_or_equal'=>'Tanggal selesai harus di atas atau sama dengan tanggal order!',
        'id_gudang_penerima'=>'Gudang penerima harus diisi!',
        'biaya_produksi.required'=>'Biaya produksi harus diisi!'
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
      // $jml_produk = count($request->produk);
      // for($i=0;$i<$jml_produk;$i++){
      //   $detail_order = new DetailOrder();
      //   $detail_order->id_order = $order_id;
      //   $detail_order->id_produksi = $request->produk[$i];
      //   $detail_order->pesan = 0;
      //   $detail_order->terima = 0;
      //   $detail_order->dibayar = 0;
      //   $detail_order->retur = 0;
      //   //status order belum beres sampai terima dibuat (-)
      //   $detail_order->status = "-";
      //   $detail_order->save();
      // }
      $jml_bahan = count($request->id_bahan);
      $jml_label = count($request->label_ukuran);
      $jml_bordir = count($request->bordir_desain);
      $jml_sablon = count($request->sablon_desain);
      $jml_kancing = count($request->kancing_ukuran);
      $jml_pola = count($request->pola_nama);


      for($i=0;$i<$jml_bahan;$i++){
        $detail_bahan = new DetailBahan();
        $detail_bahan->id_order = $order_id;
        $detail_bahan->id_bahan = $request->id_bahan[$i];
        $detail_bahan->jumlah = $request->bahan_jumlah[$i];
        $detail_bahan->harga = str_replace(",","",$request->bahan_harga[$i]);
        if($detail_bahan->id_order && $detail_bahan->id_bahan && $detail_bahan->jumlah && $detail_bahan->harga){
          $detail_bahan->save();
        }
      }

      for($i=0;$i<$jml_label;$i++){
        $detail_label = new DetailLabel();
        $detail_label->id_order = $order_id;
        $detail_label->ukuran = $request->label_ukuran[$i];
        $detail_label->jumlah = $request->label_jumlah[$i];
        $detail_label->harga = str_replace(".","",$request->label_harga[$i]);
        if($detail_label->id_order && $detail_label->ukuran && $detail_label->jumlah && $detail_label->harga){
          $detail_label->save();
        }
      }

      for($i=0;$i<$jml_bordir;$i++){
        $detail_bordir = new DetailBordir();
        $detail_bordir->id_order = $order_id;
        $detail_bordir->desain = $request->bordir_desain[$i];
        $detail_bordir->jumlah = $request->bordir_jumlah[$i];
        $detail_bordir->harga = str_replace(".","",$request->bordir_harga[$i]);
        if($detail_bordir->id_order && $detail_bordir->desain && $detail_bordir->jumlah && $detail_bordir->harga){
          $detail_bordir->save();
        }
      }

      for($i=0;$i<$jml_pola;$i++){
        $detail_pola = new DetailPola();
        $detail_pola->id_order = $order_id;
        $detail_pola->nama = $request->pola_nama[$i];
        $detail_pola->qty_potong = $request->pola_qty_potong[$i];
        $detail_pola->qty_bahan = $request->pola_qty_bahan[$i];
        $detail_pola->jml_dikirim = $request->pola_jml_dikirim[$i];
        $detail_pola->ukuran = $request->pola_ukuran[$i];
        if($detail_pola->id_order && $detail_pola->nama && $detail_pola->qty_potong && $detail_pola->qty_bahan && $detail_pola->jml_dikirim && $detail_pola->ukuran){
          $detail_pola->save();
        }
      }
      for($i=0; $i<$jml_sablon; $i++){
        $detail_sablon = new DetailSablon();
        $detail_sablon->id_order = $order_id;
        $detail_sablon->desain = $request->sablon_desain[$i];
        $detail_sablon->jumlah = $request->sablon_jumlah[$i];
        $detail_sablon->harga = str_replace(".","",$request->sablon_harga[$i]);
        if($detail_sablon->id_order && $detail_sablon->desain && $detail_sablon->jumlah && $detail_sablon->harga){
          $detail_sablon->save();
        }
      }

      for($i=0;$i<$jml_kancing;$i++){
        $detail_kancing = new DetailKancing();
        $detail_kancing->id_order = $order_id;
        $detail_kancing->ukuran = $request->kancing_ukuran[$i];
        $detail_kancing->tipe = $request->kancing_tipe[$i];
        $detail_kancing->jumlah = $request->kancing_jumlah[$i];
        $detail_kancing->harga = str_replace(".","",$request->kancing_harga[$i]);
        $detail_kancing->warna = $request->kancing_warna[$i];
        if($detail_kancing->id_order && $detail_kancing->ukuran && $detail_kancing->tipe && $detail_kancing->jumlah && $detail_kancing->harga && $detail_kancing->warna){
          $detail_kancing->save();
        }
      }


      return redirect('order')->with('message','Data berhasil disimpan!')->with('panel','success');

    }


}
