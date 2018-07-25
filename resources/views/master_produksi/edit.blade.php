@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Produksi
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('produksi')}}">Produksi</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      @if(Session::has('message'))
      <div class="alert alert-{{Session::get('panel')}} alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i>{{Session::get('message')}}</h4>
        {{-- Success alert preview. This alert is dismissable. --}}
      </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <ul>
            @foreach ($errors->all() as $error )
              <li class='text-white'>{{$error}} </li></font>
            @endforeach
          </ul>
        </div>
      @endif
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Order Pekerjaan ke Pemotong-Pola</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        {{Form::open(['url'=>'produksi/update/'.$produksi->id,'method'=>'post','id'=>''])}}
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group {{$errors->first('kode') ? 'has-error':''}}">
                <label>Kode Produksi</label>
                {{Form::text('kode',$produksi->kode,['class'=>'form-control','id'=>'kode','placeholder'=>'Isi kode produksi'])}}
                <span><p class="text-red">{{$errors->first('kode')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('nama_produk') ? 'has-error':''}}">
                <label>Nama Produk</label>
                {{Form::text('nama_produk',$produksi->nama_produk,['class'=>'form-control','placeholder'=>'Isi nama produk'])}}
                <span><p class="text-red">{{$errors->first('nama_produk')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="id_bahan_diperlukan">
                @foreach ($produksi->detail_prod_bahan as $key => $value)
                  <div class="form-group {{$errors->first('bahan[]') ? 'has-error':''}} form_bahan">
                    <label>Bahan diperlukan &nbsp;</label>
                    {{Form::select('bahan[]',$bahan,$value->id_bahan,['class'=>'form-control bahan_diperlukan','id'=>'bahan','data-placeholder'=>'Pilih Bahan...'])}}
                    <span for="bahan" class="error">{{$errors->first('bahan.0')}}</span>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-6">
                    <div class="form-group {{$errors->first('keperluan[]') ? 'has-error':''}} form_perlu">
                      <label>Keperluan</label>
                      {{Form::text("keperluan[]",$value->keperluan,['class'=>'form-control keperluan','placeholder'=>'Isi jumlah keperluan'])}}
                      <span for="bahan" class="error">{{$errors->first('keperluan.0')}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group {{$errors->first('satuan[]') ? 'has-error':''}} form_satuan">
                      <label>Satuan</label>
                      {{Form::select("satuan[]",$satuan,$value->satuan,['class'=>'form-control satuan'])}}
                      <span for="bahan" class="error">{{$errors->first('satuan.0')}}</span>
                    </div>
                  </div>
                @endforeach
            </div>
              <div class="form-grup">
                <button id="tambah_bahan" class="btn btn-xs btn-success" data-toggle="tooltip" title="Tambah Bahan" type="button"><i class="fa fa-plus"></i></button>
                <button id="kurangi_bahan" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Kurangi Bahan" type="button"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group {{$errors->first('model') ? 'has-error':''}}">
                <label>Model</label>
                {{Form::select('model',$model,$produksi->model,['class'=>'form-control select2','data-placeholder'=>'Pilih Model...'])}}
                <span><p class="text-red">{{$errors->first('model')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('pola') ? 'has-error':''}}">
                <label>Pola</label>
                {{Form::select('pola',$pola,$produksi->pola,['class'=>'form-control select2','data-placeholder'=>'Pilih Pola...'])}}
                <span><p class="text-red">{{$errors->first('pola')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('warna') ? 'has-error':''}}">
                <label>Warna</label>
                {{Form::select('warna',$warna,$produksi->warna,['class'=>'form-control select2','data-placeholder'=>'Pilih Warna...'])}}
                <span><p class="text-red">{{$errors->first('warna')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('ukuran') ? 'has-error':''}}">
                <label>Ukuran</label><br>
                {{Form::radio('ukuran','Small',$produksi->ukuran=='Small' ? 'checked':'',['class'=>'flat-red'])}}Small &nbsp;
                {{Form::radio('ukuran','Medium',$produksi->ukuran=='Medium' ? 'checked':'',['class'=>'flat-red'])}}Medium &nbsp;
                {{Form::radio('ukuran','Large',$produksi->ukuran=='Large' ? 'checked':'',['class'=>'flat-red'])}}Large &nbsp;
                <span><p class="text-red">{{$errors->first('ukuran')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Hasil</label>
                {{Form::text('hasil',$produksi->hasil,['class'=>'form-control','placeholder'=>'Isi jumlah hasil'])}}
                <span><p class="text-red">{{$errors->first('hasil')}}</p></span>
              </div>
              <div class="form-group">
                <label>Satuan Biaya</label>
                {{Form::text('satuan_biaya',$produksi->satuan_biaya,['class'=>'form-control','placeholder'=>'Isi biaya produksi satuan'])}}
                <span><p class="text-red">{{$errors->first('satuan_biaya')}}</p></span>
              </div>
              <div class="form-group">
                <label>Satuan Hasil</label>
                {{Form::select('satuan_hasil',$satuan_hasil,$produksi->satuan_hasil,['class'=>'form-control','data-placeholder'=>'Isi jumlah hasil'])}}
              </div>
              <div class="form-grup">
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
              </div>
            </div>
            <!-- /.col -->


          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="id_keperluan" style="display:none;">
  <div class="form-group {{$errors->first('bahan') ? 'has-error':''}} form_bahan">
    <label>Bahan diperlukan </label>
    {{Form::select('bahan[]',$bahan,null,['class'=>'form-control bahan_diperlukan','id'=>'bahan','data-placeholder'=>'Pilih Bahan...'])}}
    <label for="bahan" class="error"></label>
  </div>
  <!-- /.form-group -->
  <div class="col-md-6">
    <div class="form-group {{$errors->first('keperluan') ? 'has-error':''}} form_perlu">
      <label>Keperluan</label>
      {{Form::text("keperluan[]",null,['class'=>'form-control keperluan','placeholder'=>'Isi jumlah keperluan'])}}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group {{$errors->first('satuan') ? 'has-error':''}} form_satuan">
      <label>Satuan</label>
      {{Form::select("satuan[]",$satuan,'',['class'=>'form-control satuan'])}}
    </div>
  </div>
</div>

  @endsection
