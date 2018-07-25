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
      $data['bahan']->prepend('','');
      $data['pola']->prepend('','');
      $data['warna']->prepend('','');
      $data['model']->prepend('','');
      return view('master_produksi.tambah',$data);
    }

    public function simpan(Request $request){
      $this->validate($request,[
        'kode'=>'required|unique:produksi,kode',
        'nama_produk'=>'required',
        'bahan.0'=>'required',
        'keperluan.0'=>'required|numeric',
        'satuan.0'=>'required',
        'model'=>'required',
        'pola'=>'required',
        'warna'=>'required',
        'ukuran'=>'required',
        'hasil'=>'required|numeric',
        'satuan_biaya'=>'required|numeric',
        'satuan_hasil'=>'required'
      ],[
        'kode.required'=>'Kode produksi harus diisi!',
        'kode.unique'=>'Kode produksi sudah pernah dipakai!',
        'nama_produk.required'=>'Nama produk harus diisi!',
        'bahan.0.required'=>'Bahan harus dipilih!',
        'satuan.0.required'=>'Satuan harus dipilih!',
        'keperluan.0.required'=>'Keperluan harus diisi!',
        'keperluan.0.numeric'=>'Keperluan hanya boleh diisi angka!',
        'model.required'=>'Model harus dipilih!',
        'pola.required'=>'Pola harus dipilih!',
        'warna.required'=>'Warna harus dipilih!',
        'ukuran.required'=>'Ukuran harus dipilih!',
        'hasil.required'=>'Hasil harus diisi!',
        'hasil.numeric'=>'Hasil hanya boleh diisi angka!',
        'satuan_biaya.required'=>'Satuan biaya harus diisi!',
        'satuan_biaya.numeric'=>'Satuan biaya hanya boleh diisi angka!',
        'satuan_hasil'=>'Satuan hasil harus diisi!'
      ]);
      //menyimpan data produksi di tabel produksi
      $data = new Produksi();
      $data->kode = $request->kode;
      $data->nama_produk = $request->nama_produk;
      $data->model = $request->model;
      $data->pola = $request->pola;
      $data->warna = $request->warna;
      $data->ukuran = $request->ukuran;
      $data->hasil = $request->hasil;
      $data->satuan_biaya = $request->satuan_biaya;
      $data->satuan_hasil = $request->satuan_hasil;
      $data->save();

      //mengambil id produksi
      $id_produksi = Produksi::where('kode',$request->kode)->value('id');
      $jml_bahan = count($request->bahan); //ambil jumlah bahan yg dimasukkan di form
      //perulangan sesuai jumlah bahan yg dimauskkan di form (dikurangi 1 karena ada form tersembunyi untuk duplikasi)
      for($i=0;$i<$jml_bahan-1;$i++){
        $detail = new DetailProduksiBahan();
        $detail->id_detail_prod_bahan = $id_produksi;
        $detail->id_bahan = $request->bahan[$i];
        $detail->keperluan = $request->keperluan[$i];
        $detail->satuan = $request->satuan[$i];
        $detail->save();
      }
      return redirect('produksi')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

    public function edit($id){
      $data['user'] = Auth::user();
      $data['produksi'] = Produksi::findOrFail($id);
      //mengambil data untuk select option
      $data['bahan'] = Bahan::orderBy('nama','asc')->pluck('nama','id');
      $data['pola'] = Pola::orderBy('nama','asc')->pluck('nama','nama');
      $data['warna'] = Warna::orderBy('warna','asc')->pluck('warna','warna');
      $data['model'] = Models::orderBy('nama','asc')->pluck('nama','nama');
      $data['satuan'] = ['Meter'=>'Meter','Yard'=>'Yard','cm'=>'cm'];
      $data['satuan_hasil'] = ['Potong'=>'Potong'];
      //menyimpan data awal untuk select option kosong
      $data['bahan']->prepend('','');
      $data['pola']->prepend('','');
      $data['warna']->prepend('','');
      $data['model']->prepend('','');
      return view('master_produksi.edit',$data);
    }

    public function update(Request $request,$id){
      $this->validate($request,[
        'kode'=>'required|exists:produksi,kode',
        'nama_produk'=>'required',
        'bahan.0'=>'required',
        'keperluan.0'=>'required|numeric',
        'satuan.0'=>'required',
        'model'=>'required',
        'pola'=>'required',
        'warna'=>'required',
        'ukuran'=>'required',
        'hasil'=>'required|numeric',
        'satuan_biaya'=>'required|numeric',
        'satuan_hasil'=>'required'
      ],[
        'kode.required'=>'Kode produksi harus diisi!',
        'kode.unique'=>'Kode produksi sudah pernah dipakai!',
        'nama_produk.required'=>'Nama produk harus diisi!',
        'bahan.0.required'=>'Bahan harus dipilih!',
        'satuan.0.required'=>'Satuan harus dipilih!',
        'keperluan.0.required'=>'Keperluan harus diisi!',
        'keperluan.0.numeric'=>'Keperluan hanya boleh diisi angka!',
        'model.required'=>'Model harus dipilih!',
        'pola.required'=>'Pola harus dipilih!',
        'warna.required'=>'Warna harus dipilih!',
        'ukuran.required'=>'Ukuran harus dipilih!',
        'hasil.required'=>'Hasil harus diisi!',
        'hasil.numeric'=>'Hasil hanya boleh diisi angka!',
        'satuan_biaya.required'=>'Satuan biaya harus diisi!',
        'satuan_biaya.numeric'=>'Satuan biaya hanya boleh diisi angka!',
        'satuan_hasil'=>'Satuan hasil harus diisi!'
      ]);
      //menyimpan data yg di-update
      $data = Produksi::findOrFail($id);
      $data->kode = $request->kode;
      $data->nama_produk = $request->nama_produk;
      $data->model = $request->model;
      $data->pola = $request->pola;
      $data->warna = $request->warna;
      $data->ukuran = $request->ukuran;
      $data->hasil = $request->hasil;
      $data->satuan_biaya = $request->satuan_biaya;
      $data->satuan_hasil = $request->satuan_hasil;
      $data->save();

      //mengambil jumlah bahan di tabel detail prod bahan yang akan diedit
      $jml_bahan = DetailProduksiBahan::where('id_detail_prod_bahan',$id)->count();
      $bahan_detail = DetailProduksiBahan::where('id_detail_prod_bahan',$id)->get();

      for($i=0;$i<$jml_bahan;$i++){
        //mengambil detail prod bahan yg akan diedit
        $detail = DetailProduksiBahan::where('id_detail_prod_bahan',$id)->where('id_bahan',$bahan_detail[$i]->id_bahan)->where('keperluan',$bahan_detail[$i]->keperluan)->where('satuan',$bahan_detail[$i]->satuan)->first();
        $detail->id_bahan = $request->bahan[$i];
        $detail->keperluan = $request->keperluan[$i];
        $detail->satuan = $request->satuan[$i];
        $detail->save();
      }
      //jika ada penambahan bahan di produksi maka ambil indeks selanjutnya (dengan mengurangi 1 karena ada form tersembunyi)
      $jml_input_bahan = count($request->bahan); //jumlah total input
      //perulangan dimulai dari indeks setelah perulangan sebelumnya. untuk hanya mengambil inputan bahan yg baru
      for($j=$i;$j<$jml_input_bahan-1;$j++){
        $detail = new DetailProduksiBahan();
        $detail->id_detail_prod_bahan = $id;
        $detail->id_bahan = $request->bahan[$j];
        $detail->keperluan = $request->keperluan[$j];
        $detail->satuan = $request->satuan[$j];
        $detail->save();
      }
      return redirect('produksi')->with('message','Data berhasil disimpan!')->with('panel','success');
    }

}
