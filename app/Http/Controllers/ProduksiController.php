<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produksi;
use App\Bahan;
use App\Pola;
use App\Warna;
use App\Models;
use App\DetailProduksiBahan;

class ProduksiController extends Controller
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
      $data['produksi'] = Produksi::all();
      return view('master_produksi.index',$data);
    }

    public function tambah(){
      $data['user'] = Auth::user();
      $data['produksi'] = Produksi::all();
      $data['bahan'] = Bahan::orderBy('nama','asc')->pluck('nama','id');
      $data['pola'] = Pola::orderBy('nama','asc')->pluck('nama','nama');
      $data['warna'] = Warna::orderBy('warna','asc')->pluck('warna','warna');
      $data['model'] = Models::orderBy('nama','asc')->pluck('nama','nama');
      $data['satuan'] = ['Meter'=>'Meter','Yard'=>'Yard','cm'=>'cm'];
      $data['satuan_hasil'] = ['Potong'=>'Potong'];
      $data['bahan']->prepend('Pilih Bahan...','');
      $data['pola']->prepend('','');
      $data['warna']->prepend('','');
      $data['model']->prepend('','');
      return view('master_produksi.tambah',$data);
    }

    public function simpan(Request $request){
      $this->validate($request,[
        'kode'=>'required|unique:produksi,kode',
        'nama_produk'=>'required',
        // 'bahan[]'=>'required',
        // 'keperluan[]'=>'required',
        // 'satuan[]'=>'required',
        'model'=>'required',
        'pola'=>'required',
        'warna'=>'required',
        'ukuran'=>'required',
        'hasil'=>'required',
        'satuan_hasil'=>'required'
      ]);
      $data = new Produksi();
      $data->kode = $request->kode;
      $data->nama_produk = $request->nama_produk;
      $data->model = $request->model;
      $data->pola = $request->pola;
      $data->warna = $request->warna;
      $data->ukuran = $request->ukuran;
      $data->hasil = $request->hasil;
      $data->satuan_hasil = $request->satuan_hasil;
      $data->save();

      $id_produksi = Produksi::where('kode',$request->kode)->value('id');
      $jml_bahan = count($request->bahan);
      for($i=0;$i<$jml_bahan;$i++){
        $detail = new DetailProduksiBahan();
        $detail->id_detail_prod_bahan = $id_produksi;
        $detail->id_bahan = $request->bahan[$i];
        $detail->keperluan = $request->keperluan[$i];
        $detail->satuan = $request->satuan[$i];
        $detail->save();
      }
      return redirect('produksi')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

}
