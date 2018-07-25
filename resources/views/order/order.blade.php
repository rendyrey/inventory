@extends('layout.index')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Buat Order
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('order')}}">Order</a></li>
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
        {{Form::open(['url'=>'order','method'=>'post','id'=>'order'])}}
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
                <label>Pemberi Order (admin)</label>
                {{Form::text('pemberi_order',$user->name,['class'=>'form-control','readonly','id'=>'pemberi_order'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_pemotong_pola') ? 'has-error':''}}">
                <label>Penerima Order (pemotong pola)</label>
                {{Form::select('id_pemotong_pola',$pemotong_pola,null,['class'=>'form-control select2','id'=>'id_pemotong_pola','data-placeholder'=>'Pilih Penerima Order...'])}}
                <label for="id_pemotong_pola" class="error"></label>
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
                <label for="tanggal_order" class="error"></label>
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
                <label for="tanggal_selesai" class="error"></label>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_gudang_penerima') ? 'has-error':''}}">
                <label>Lokasi Penerimaan (gudang)</label>
                {{Form::select('id_gudang_penerima',$gudang,null,['class'=>'form-control select2','id'=>'id_gudang_penerima','data-placeholder'=>'Pilih Lokasi Penerima...'])}}
                <label for="id_gudang_penerima" class="error"></label>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('biaya_produksi') ? 'has-error':''}}">
                <label>Biaya Produksi</label>
                {{Form::text('biaya_produksi',null,['class'=>'form-control auto_currency','id'=>'biaya_produksi'])}}
                <label for="biaya_produksi" class="error"></label>
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

      </div>
      <!-- /.box -->
      <div class="box box-primary" id="" hidden>
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
            @foreach ($produksi as $keyproduk => $value)

              <tr>
                <td><input type="checkbox" name="produk[]" value={{$value->id}}></td>
                <td>{{$value->kode}}</td>
                <td>
                  @foreach ($value->detail_prod_bahan as $key => $bahan)
                    <li>{{$bahan->bahan->nama}}</li>
                  @endforeach
                </td>
                <td>
                  @foreach ($value->detail_prod_bahan as $key => $bahan)
                    <li>{{$bahan->bahan->persediaan}}</li>
                  @endforeach
                </td>
                <td>
                  @foreach ($value->detail_prod_bahan as $key => $bahan)
                    <li>{{$bahan->keperluan}} {{$bahan->satuan}}</li>
                  @endforeach
                </td>
                <td>{{$value->model}}</td>
                <td>{{$value->pola}}</td>
                <td>{{$value->warna}}</td>
                <td>{{$value->ukuran}}</td>
                <td>{{$value->hasil}}</td>
                <td>{{$value->satuan_hasil}}</td>
              </tr>
            @endforeach
          </table>
          {{Form::submit('Submit',['id'=>'submit_order','class'=>'btn btn-primary','style'=>'float:right;position:relative;bottom:10px;right:40px;'])}}
          {{Form::close()}}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary" id="material">
            <div class="box-header">
              <div class="box-title">Label</div>
              &nbsp;<button id="tambah_label" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_label" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="label">
                <div class="col-md-12">
                  <div class="form-group {{$errors->first('label') ? 'has-error':''}}">
                    <div class='col-md-6'>
                      <label>Ukuran</label>
                      {{Form::text('label_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Label'])}}
                      <label>Jumlah</label>
                      {{Form::text('label_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah label'])}}
                    </div>
                    <div class='col-md-6'>
                      <label>Harga</label>
                      {{Form::text('label_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga label'])}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-primary" id="material">
            <div class="box-header">
              <div class="box-title">Bordir</div>
              &nbsp;<button id="tambah_bordir" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_bordir" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="bordir">
                <div class="col-md-12">
                  <div class="form-group {{$errors->first('bordir') ? 'has-error':''}}">
                    <div class='col-md-6'>
                      <label>Desain</label>
                      {{Form::text('bordir_desain[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Desain Bordir'])}}
                      <label>Jumlah</label>
                      {{Form::text('bordir_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Bordir'])}}
                    </div>
                    <div class='col-md-6'>
                      <label>Harga</label>
                      {{Form::text('bordir_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Bordir'])}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-warning" id="material">
            <div class="box-header">
              <div class="box-title">Sablon</div>
              &nbsp;<button id="tambah_sablon" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_sablon" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="sablon">
                <div class="col-md-12">
                <div class="form-group {{$errors->first('sablon') ? 'has-error':''}}">
                  <div class='col-md-6'>
                    <label>Desain</label>
                    {{Form::text('sablon_desain[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Desain Sablon'])}}
                  </div>
                  <div class='col-md-6'>
                    <label>Jumlah</label>
                    {{Form::text('sablon_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Sablon'])}}
                  </div>
                  <div class='col-md-6'>
                    <label>Harga</label>
                    {{Form::text('sablon_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Sablon'])}}
                  </div>
                </div>
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-warning" id="material">
            <div class="box-header">
              <div class="box-title">Kancing</div>
              &nbsp;<button id="tambah_kancing" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_kancing" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="kancing">
                <div class="col-md-12">
                  <div class="form-group {{$errors->first('kancing') ? 'has-error':''}}">
                    <div class='col-md-6'>
                      <label>Ukuran</label>
                      {{Form::text('kancing_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Kancing'])}}
                      <label>Jumlah</label>
                      {{Form::text('kancing_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Kancing'])}}
                      <label>Warna</label>
                      {{Form::text('kancing_warna[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Warna Kancing'])}}
                    </div>
                    <div class='col-md-6'>
                      <label>Tipe</label>
                      {{Form::text('kancing_tipe[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Tipe Kancing'])}}
                      <label>Harga</label>
                      {{Form::text('kancing_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Kancing'])}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div id="template_kancing" style="display:none;">
    <div class="col-md-12 form_kancing">
      <hr>
      <div class="form-group {{$errors->first('kancing') ? 'has-error':''}}">
        <div class='col-md-6'>
          <label>Ukuran</label>
          {{Form::text('kancing_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Kancing'])}}
          <label>Jumlah</label>
          {{Form::text('kancing_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Kancing'])}}
          <label>Warna</label>
          {{Form::text('kancing_warna[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Warna Kancing'])}}
        </div>
        <div class='col-md-6'>
          <label>Tipe</label>
          {{Form::text('kancing_tipe[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Tipe Kancing'])}}
          <label>Harga</label>
          {{Form::text('kancing_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Kancing'])}}
        </div>
      </div>
    </div>
  </div>
  <div id="template_label" style="display:none;">
    <div class="col-md-12 form_label">
      <hr>
      <div class="form-group {{$errors->first('label') ? 'has-error':''}}">
        <div class='col-md-6'>
          <label>Ukuran</label>
          {{Form::text('label_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Label'])}}
          <label>Jumlah</label>
          {{Form::text('label_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah label'])}}
        </div>
        <div class='col-md-6'>
          <label>Harga</label>
          {{Form::text('label_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga label'])}}
        </div>
      </div>
    </div>
  </div>
  <div id="template_bordir" style="display:none;">
    <div class="col-md-12 form_bordir">
      <hr>
      <div class="form-group {{$errors->first('bordir') ? 'has-error':''}}">
        <div class='col-md-6'>
          <label>Desain</label>
          {{Form::text('bordir_desain[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Desain Bordir'])}}
          <label>Jumlah</label>
          {{Form::text('bordir_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Bordir'])}}
        </div>
        <div class='col-md-6'>
          <label>Harga</label>
          {{Form::text('bordir_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Bordir'])}}
        </div>
      </div>
    </div>
  </div>
  <div id="template_sablon" style="display:none;">
    <div class="col-md-12 form_sablon">
      <hr>
    <div class="form-group {{$errors->first('sablon') ? 'has-error':''}}">
      <div class='col-md-6'>
        <label>Desain</label>
        {{Form::text('sablon_desain[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Desain Sablon'])}}
      </div>
      <div class='col-md-6'>
        <label>Jumlah</label>
        {{Form::text('sablon_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Sablon'])}}
      </div>
      <div class='col-md-6'>
        <label>Harga</label>
        {{Form::text('sablon_harga[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Harga Sablon'])}}
      </div>
    </div>
  </div>
  </div>

@endsection
