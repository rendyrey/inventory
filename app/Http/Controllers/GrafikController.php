<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DetailLabel;
use App\DetailBahan;
use App\DetailBordir;
use App\DetailKancing;
use App\DetailSablon;
use App\Order;

class GrafikController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data['user'] = Auth::user();
      $data['bulan'] = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',
                      6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',
                      11=>'November',12=>'Desember'];
      $data['data_grafik'] = ['bahan'=>'Harga Bahan','label'=>'Harga Label','bordir'=>'Harga Bordir',
                            'sablon'=>'Harga Sablon','kancing'=>'Harga Kancing'];
      for($i=1;$i<12;$i++){
        $avg_label = DetailLabel::whereMonth('created_at',$i)->avg('harga');
        $avg_bahan = DetailBahan::whereMonth('created_at',$i)->avg('harga');
        $avg_bordir = DetailBordir::whereMonth('created_at',$i)->avg('harga');
        $avg_sablon = DetailSablon::whereMonth('created_at',$i)->avg('harga');
        $avg_kancing = DetailKancing::whereMonth('created_at',$i)->avg('harga');
        $data['data_label'][] = $avg_label ? $avg_label:0;
        $data['data_bahan'][] = $avg_bahan ? $avg_bahan:0;
        $data['data_bordir'][] = $avg_bordir ? $avg_bordir:0;
        $data['data_sablon'][] =  $avg_sablon ? $avg_sablon:0;
        $data['data_kancing'][] = $avg_kancing ? $avg_kancing:0;
      }
      return view('grafik.index',$data);
    }

    public function harga(Request $request){
      if($request->bulan_akhir<$request->bulan_awal){
        return redirect('grafik')->with('message','Mohon masukkan bulan dengan benar!')->with('panel','danger');
      }
      $data['user'] = Auth::user();
      $data['judul'] = "Grafik Harga";
      $data['bulan'] = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',
                      6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',
                      11=>'November',12=>'Desember'];
      $data['data_grafik'] = ['bahan'=>'Harga Bahan','label'=>'Harga Label','bordir'=>'Bordir',
                            'sablon'=>'Harga Sablon','kancing'=>'Harga Kancing'];
      //mendapatkan jumlah bulan yg dimasukkan
      $jml_bulan = $request->bulan_akhir - ($request->bulan_awal-1);

      //membuat nama-nama bulan yg muncul di grafik
      for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
        $data['categories'][] = date('M',mktime(0,0,0,$i,10));
      }

      //berdasarkan pilihan grafik
      //label
      if($request->data_grafik == "label"){
        $data['judul'] = 'Grafik Harga Label rata-rata';
        $data['series_name'] = "Label";
        for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
          $average = DetailLabel::whereMonth('created_at','=',$i)->avg('harga');
          if($average){
            $data['harga'][] = $average;
          }else{
            $data['harga'][] = 0;
          }
        }
      //bahan
      }else if($request->data_grafik == "bahan"){
        $data['judul'] = 'Grafik Harga Bahan rata-rata';
        $data['series_name'] = "Bahan";
        for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
          $average = DetailBahan::whereMonth('created_at','=',$i)->avg('harga');
          if($average){
            $data['harga'][] = $average;
          }else{
            $data['harga'][] = 0;
          }
        }
      //bordir
      }else if($request->data_grafik == "bordir"){
        $data['judul'] = 'Grafik Harga Bordir rata-rata';
        $data['series_name'] = "Bordir";
        for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
          $average = DetailBordir::whereMonth('created_at','=',$i)->avg('harga');
          if($average){
            $data['harga'][] = $average;
          }else{
            $data['harga'][] = 0;
          }
        }
      //sablon
      }else if($request->data_grafik == "sablon"){
        $data['judul'] = 'Grafik Harga Sablon rata-rata';
        $data['series_name'] = "Sablon";
        for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
          $average = DetailSablon::whereMonth('created_at','=',$i)->avg('harga');
          if($average){
            $data['harga'][] = $average;
          }else{
            $data['harga'][] = 0;
          }
        }
      //kancing
      }else if($request->data_grafik == "kancing"){
        $data['judul'] = 'Grafik Harga Kancing rata-rata';
        $data['series_name'] = "Kancing";
        for($i=$request->bulan_awal;$i<=$request->bulan_akhir;$i++){
          $average = DetailKancing::whereMonth('created_at','=',$i)->avg('harga');
          if($average){
            $data['harga'][] = $average;
          }else{
            $data['harga'][] = 0;
          }
        }
      }
      return view('grafik.harga',$data);
    }

    public function order(Request $request){
      $data['user'] = Auth::user();
      $data['bulan'] = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',
                      6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',
                      11=>'November',12=>'Desember'];
      $data['data_grafik'] = ['jml_order'=>'Jumlah Order','pemotong'=>'Pemotong Pola','bordir'=>'Harga Bordir',
                            'sablon'=>'Harga Sablon','kancing'=>'Harga Kancing'];
      return view('grafik.order',$data);
    }

}
