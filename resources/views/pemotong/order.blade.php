@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemotong-Pola (Pattern-Cutter)
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('order_pola')}}">Order Pola</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
        {{Form::open(['url'=>'order_pola','method'=>'post','id'=>'order'])}}
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group {{$errors->first('nomor_order') ? 'has-error':''}}">
                <label>Nomor Order</label>
                {{Form::text('nomor_order',date('Ymd').strtoupper(str_random(6)),['class'=>'form-control','readonly','id'=>'nomor_order'])}}
                <span><p class="text-red">{{$errors->first('nomor_order')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('pemberi_order') ? 'has-error':''}}">
                <label>Pemberi Order</label>
                {{Form::text('pemberi_order',$user->name,['class'=>'form-control','readonly','id'=>'pemberi_order'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_pemotong_pola') ? 'has-error':''}}">
                <label>Penerima Order</label>
                {{Form::select('id_pemotong_pola',$pemotong_pola,null,['class'=>'form-control','id'=>'id_pemotong_pola'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('tanggal_order') ? 'has-error':''}}">
                <label>Tanggal Order</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {{Form::text('tanggal_order',null,['class'=>'form-control tanggal','id'=>'tanggal_order'])}}
                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group {{$errors->first('tanggal_selesai') ? 'has-error':''}}">
                <label>Tanggal Selesai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {{Form::text('tanggal_selesai',null,['class'=>'form-control tanggal','id'=>'tanggal_selesai'])}}
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_gudang_penerima') ? 'has-error':''}}">
                <label>Lokasi Penerimaan</label>
                {{Form::select('id_gudang_penerima',$pemotong_pola,null,['class'=>'form-control'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('biaya_produksi') ? 'has-error':''}}">
                <label>Biaya Produksi</label>
                {{Form::text('biaya_produksi',null,['class'=>'form-control auto_currency','id'=>'biaya_produksi'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <button class="btn btn-primary" id="lanjut_order" type="button">Lanjutkan</button>

              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.
        </div>
      </div>
      <!-- /.box -->
      <div class="box box-primary" id="material" hidden>
        <div class="box-header">
          <h3 class="box-title">Daftar Material Produksi (Bill of Material - BOM)</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>ID</th>
              <th>Kode</th>
              <th>Bahan Diperlukan</th>
              <th>Persediaan</th>
              <th>Perlu</th>
              <th>Model</th>
              <th>Pola</th>
              <th>Warna</th>
              <th>Ukuran</th>
              <th>Hasil</th>
              <th>Satuan</th>
            </tr>
            <tr>
              <td><input class="checkBoxClass flat-red" type="checkbox" name="material[]" value=""></td>
              <td>20180709</td>
              <td>Kain drill katun polos warna dan bermotif</td>
              <td>93</td>
              <td>5 yard</td>
              <td>Bolero</td>
              <td>Fresh and Energic</td>
              <td>Red</td>
              <td>Medium</td>
              <td>60</td>
              <td>Potong</td>
            </tr>
          </table>
          {{Form::close()}}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection
