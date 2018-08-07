<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Bahan;
use App\DetailOrder;
use App\TerimaOrderPola;
use App\DetailTerima;
use App\PemotongPola;
use App\Gudang;
use App\Produksi;
use App\DetailLabel;
use App\DetailSablon;
use App\DetailBordir;
use App\DetailKancing;
use App\DetailBahan;
use App\DetailPola;
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
      $data['order'] = Order::find($id);
      $data['bahan'] = Bahan::orderBy('nama','asc')->pluck('nama','id');
      $data['order_detail'] = DetailOrder::where('id_order',$id)->get();
      $data['pemotong_pola'] = PemotongPola::pluck('nama','id');
      $data['gudang'] = Gudang::pluck('nama','id');
      $data['produksi'] = Produksi::all();
      return view('order.edit',$data);
    }

    public function update(Request $request,$id){
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
        'nomor_order.required'=>'Nomor order harus diisi!',
        'pemberi_order.required'=>'Pemberi order harus diisi!',
        'id_pemotong_pola.required'=>'Pemotong pola harus diisi!',
        'tanggal_order.required'=>'Tanggal order harus diisi!',
        'tanggal_selesai.required'=>'Tanggal selesai harus diisi!',
        'tanggal_selesai.after_or_equal'=>'Tanggal selesai harus lebih atau sama dengan tanggal order!',
        'id_gudang_penerima.required'=>'Gudang penerima harus diisi!',
        'biaya_produksi.required'=>'Biaya produksi harus diisi!'
      ]);
      $order = Order::findOrFail($id);
      $order->id_pemotong_pola = $request->id_pemotong_pola;
      $order->tanggal_order = $request->tanggal_order;
      $order->tanggal_selesai = $request->tanggal_selesai;
      $order->id_gudang_penerima = $request->id_gudang_penerima;
      $order->biaya_produksi = str_replace(".","",$request->biaya_produksi);

      $jml_label = count($request->label_ukuran);
      $jml_bordir = count($request->bordir_desain);
      $jml_sablon = count($request->sablon_desain);
      $jml_kancing = count($request->kancing_ukuran);
      $jml_bahan = count($request->id_bahan);
      $jml_pola = count($request->pola_nama);

      $label = DetailLabel::where('id_order',$id)->get();
      $bordir = DetailBordir::where('id_order',$id)->get();
      $sablon = DetailSablon::where('id_order',$id)->get();
      $kancing = DetailKancing::where('id_order',$id)->get();
      $bahan = DetailBahan::where('id_order',$id)->get();
      $pola = DetailPola::where('id_order',$id)->get();

      for($i=0;$i<$bahan->count();$i++){
        $bahan_new = DetailBahan::where('id_order',$id)->where('id_bahan',$bahan[$i]->id_bahan)->first();
        $bahan_new->id_bahan = $request->id_bahan[$i];
        $bahan_new->harga = str_replace(".","",$request->bahan_harga[$i]);
        $bahan_new->jumlah = $request->bahan_jumlah[$i];
        $bahan_new->save();
      }
      //jika ada tambahan bahan
      for($j=$i;$j<$jml_bahan;$j++){
        $bahan_insert = new DetailBahan();
        $bahan_insert->id_order = $id;
        $bahan_insert->id_bahan = $request->id_bahan[$j];
        $bahan_insert->harga = str_replace(".","",$request->bahan_harga[$j]);
        $bahan_insert->jumlah = $request->bahan_jumlah[$j];
        if($bahan_insert->id_order && $bahan_insert->id_bahan && $bahan_insert->jumlah && $bahan_insert->harga){
          $bahan_insert->save();
        }
      }
      for($i=0;$i<$label->count();$i++){
        $label_new = DetailLabel::where('id_order',$id)->where('ukuran',$label[$i]->ukuran)->first();
        $label_new->ukuran = $request->label_ukuran[$i];
        $label_new->jumlah = $request->label_jumlah[$i];
        $label_new->harga = str_replace(".","",$request->label_harga[$i]);
        $label_new->save();
      }
      //jika ada tambahan label
      for($j=$i;$j<$jml_label;$j++){
        $label_new = new DetailLabel();
        $label_new->id_order = $id;
        $label_new->ukuran = $request->label_ukuran[$j];
        $label_new->jumlah = $request->label_jumlah[$j];
        $label_new->harga = str_replace(".","",$request->label_harga[$j]);
        if($label_new->id_order && $label_new->ukuran && $label_new->jumlah && $label_new->harga){
          $label_new->save();
        }
      }

      for($i=0;$i<$bordir->count();$i++){
        $bordir_new = DetailBordir::where('id_order',$id)->where('desain',$bordir[$i]->desain)->first();
        $bordir_new->desain = $request->bordir_desain[$i];
        $bordir_new->jumlah = $request->bordir_jumlah[$i];
        $bordir_new->harga = str_replace(".","",$request->bordir_harga[$i]);
        $bordir_new->save();
      }
      //jika ada penambahan bordir
      for($j=$i;$j<$jml_bordir;$j++){
        $bordir_new = new DetailBordir();
        $bordir_new->id_order = $id;
        $bordir_new->desain = $request->bordir_desain[$j];
        $bordir_new->jumlah = $request->bordir_jumlah[$j];
        $bordir_new->harga = str_replace(".","",$request->bordir_harga[$j]);
        if($bordir_new->id_order && $bordir_new->desain && $bordir_new->jumlah && $bordir_new->harga){
          $bordir_new->save();
        }
      }
      for($i=0;$i<$sablon->count();$i++){
        $sablon_new = DetailSablon::where('id_order',$id)->where('desain',$sablon[$i]->desain)->first();
        $sablon_new->desain = $request->sablon_desain[$i];
        $sablon_new->jumlah = $request->sablon_jumlah[$i];
        $sablon_new->harga = str_replace(".","",$request->sablon_harga[$i]);
        $sablon_new->save();
      }
      //jika ada penambahan sablon
      for($j=$i;$j<$jml_sablon;$j++){
        $sablon_new = new DetailSablon();
        $sablon_new->id_order = $id;
        $sablon_new->desain = $request->sablon_desain[$j];
        $sablon_new->jumlah = $request->sablon_jumlah[$j];
        $sablon_new->harga = str_replace(".","",$request->sablon_harga[$j]);
        if($sablon_new->id_order && $sablon_new->desain && $sablon_new->jumlah && $sablon_new->harga){
          $sablon_new->save();
        }
      }

      for($i=0;$i<$kancing->count();$i++){
        $kancing_new = DetailKancing::where('id_order',$id)->where('ukuran',$kancing[$i]->ukuran)->where('tipe',$kancing[$i]->tipe)->where('warna',$kancing[$i]->warna)->first();
        $kancing_new->ukuran = $request->kancing_ukuran[$i];
        $kancing_new->tipe = $request->kancing_tipe[$i];
        $kancing_new->warna = $request->kancing_warna[$i];
        $kancing_new->jumlah = $request->kancing_jumlah[$i];
        $kancing_new->harga = str_replace(".","",$request->kancing_harga[$i]);
        $kancing_new->save();
      }
      //jika ada penambahan kancing
      for($j=$i;$j<$jml_kancing;$j++){
        $kancing_new = new DetailKancing();
        $kancing_new->id_order = $id;
        $kancing_new->ukuran = $request->kancing_ukuran[$j];
        $kancing_new->tipe = $request->kancing_tipe[$j];
        $kancing_new->warna = $request->kancing_warna[$j];
        $kancing_new->jumlah = $request->kancing_jumlah[$j];
        $kancing_new->harga = str_replace(".","",$request->kancing_harga[$j]);
        if($kancing_new->id_order && $kancing_new->ukuran && $kancing_new->tipe && $kancing_new->jumlah && $kancing_new->harga && $kancing_new->warna){
          $kancing_new->save();
        }
      }

      for($i=0;$i<$pola->count();$i++){
        $pola_new = DetailPola::where('id_order',$id)->where('nama',$pola[$i]->nama)->first();
        $pola_new->nama = $request->pola_nama[$i];
        $pola_new->qty_bahan = $request->pola_qty_bahan[$i];
        $pola_new->qty_potong = $request->pola_qty_potong[$i];
        $pola_new->jml_dikirim = $request->pola_jml_dikirim[$i];
        $pola_new->ukuran = $request->pola_ukuran[$i];
        $pola_new->save();
      }
      //jika ada penambahan pola
      for($j=$i;$j<$jml_pola;$j++){
        $pola_new = new DetailPola();
        $pola_new->id_order = $id;
        $pola_new->nama = $request->pola_nama[$j];
        $pola_new->qty_bahan = $request->pola_qty_bahan[$j];
        $pola_new->qty_potong = $request->pola_qty_potong[$j];
        $pola_new->jml_dikirim = $request->pola_jml_dikirim[$j];
        $pola_new->ukuran = $request->pola_ukuran[$j];
        if($pola_new->id_order && $pola_new->nama && $pola_new->qty_potong && $pola_new->qty_bahan && $pola_new->jml_dikirim && $pola_new->ukuran){
          $pola_new->save();
        }
      }

      $order->save();
      return redirect('list_order')->with('message','Data berhasil disimpan!')->with('panel','success');
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
