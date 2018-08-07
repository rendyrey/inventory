@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Order
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('list_order/edit/'.$order->id)}}">Edit Order</a></li>
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
      {{Form::open(['url'=>'list_order/update/'.$order->id,'method'=>'post','id'=>'order'])}}
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Order Pekerjaan ke Pemotong-Pola</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group {{$errors->first('nomor_order') ? 'has-error':''}}">
                <label>Nomor Order</label>
                {{Form::text('nomor_order',$order->nomor_order,['class'=>'form-control','readonly','id'=>'nomor_order'])}}
                <span><p class="text-red">{{$errors->first('nomor_order')}}</p></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('pemberi_order') ? 'has-error':''}}">
                <label>Pemberi Order (admin)</label>
                {{Form::text('pemberi_order',$order->pemberi_order,['class'=>'form-control','readonly','id'=>'pemberi_order'])}}
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_pemotong_pola') ? 'has-error':''}}">
                <label>Penerima Order (pemotong pola)</label>
                {{Form::select('id_pemotong_pola',$pemotong_pola,$order->id_pemotong_pola,['class'=>'form-control select2','id'=>'id_pemotong_pola','data-placeholder'=>'Pilih Penerima Order...'])}}
                <label for="id_pemotong_pola" class="error"></label>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('tanggal_order') ? 'has-error':''}}">
                <label>Tanggal Order</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {{Form::text('tanggal_order',$order->tanggal_order,['class'=>'form-control tanggal','id'=>'tanggal_order'])}}
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
                  {{Form::text('tanggal_selesai',$order->tanggal_selesai,['class'=>'form-control tanggal','id'=>'tanggal_selesai'])}}
                </div>
                <label for="tanggal_selesai" class="error"></label>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('id_gudang_penerima') ? 'has-error':''}}">
                <label>Lokasi Penerimaan (gudang)</label>
                {{Form::select('id_gudang_penerima',$gudang,$order->id_gudang_penerima,['class'=>'form-control select2','id'=>'id_gudang_penerima','data-placeholder'=>'Pilih Lokasi Penerima...'])}}
                <label for="id_gudang_penerima" class="error"></label>
              </div>
              <!-- /.form-group -->
              <div class="form-group {{$errors->first('biaya_produksi') ? 'has-error':''}}">
                <label>Biaya Produksi</label>
                {{Form::text('biaya_produksi',$order->biaya_produksi,['class'=>'form-control auto_currency','id'=>'biaya_produksi'])}}
                <label for="biaya_produksi" class="error"></label>
              </div>
              <!-- /.form-group -->


            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary" id="">
            <div class="box-header">
              <div class="box-title">Bahan</div>
              &nbsp;<button id="tambah_bahan" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_bahan" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="bahan">
                @foreach ($order->detail_bahan as $key => $value)
                  <?php $i=$key+1; ?>
                  <div class="col-md-12 edit_bahan">
                    <div class="form-group {{$errors->first('bahan') ? 'has-error':''}}">
                      <div class='col-md-6'>
                        <label>Nama Bahan</label>
                        {{Form::select('id_bahan[]',$bahan,$value->id_bahan,['class'=>'form-control','placeholder'=>'Pilih Bahan','id'=>'bahan_select'.$i])}}
                        <label>Jumlah</label>
                        {{Form::text('bahan_jumlah[]',$value->jumlah,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Bahan'])}}
                      </div>
                      <div class='col-md-6'>
                        <label>Harga</label>
                        {{Form::text('bahan_harga[]',$value->harga,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Bahan'])}}
                        <label>Satuan</label>
                        {{Form::text('bahan_satuan[]',$value->bahan->satuan,['class'=>'form-control bahan_satuan'.$i,'readonly'])}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-primary" id="material">
            <div class="box-header">
              <div class="box-title">Label</div>
              &nbsp;<button id="tambah_label" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_label" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="label">
                @foreach($order->detail_label as $key=>$value)
                <div class="col-md-12">
                  <div class="form-group {{$errors->first('label') ? 'has-error':''}}">
                    <div class='col-md-6'>
                      <label>Ukuran Baju</label>
                      {{Form::text('label_ukuran[]',$value->ukuran,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Baju'])}}
                      <label>Jumlah</label>
                      {{Form::text('label_jumlah[]',$value->jumlah,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah label'])}}
                    </div>
                    <div class='col-md-6'>
                      <label>Harga</label>
                      {{Form::text('label_harga[]',$value->harga,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga label'])}}
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-primary" id="material">
            <div class="box-header">
              <div class="box-title">Bordir</div>
              &nbsp;<button id="tambah_bordir" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_bordir" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="bordir">
                @foreach ($order->detail_bordir as $key => $value)
                  <div class="col-md-12">
                    <div class="form-group {{$errors->first('bordir') ? 'has-error':''}}">
                      <div class='col-md-6'>
                        <label>Desain</label>
                        {{Form::text('bordir_desain[]',$value->desain,['class'=>'form-control','id'=>'','placeholder'=>'Desain Bordir'])}}
                        <label>Jumlah</label>
                        {{Form::text('bordir_jumlah[]',$value->jumlah,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Bordir'])}}
                      </div>
                      <div class='col-md-6'>
                        <label>Harga</label>
                        {{Form::text('bordir_harga[]',$value->harga,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Bordir'])}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-warning" id="material">
            <div class="box-header">
              <div class="box-title">Pola</div>
              &nbsp;<button id="tambah_pola" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_pola" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="pola">
                @foreach ($order->detail_pola as $key => $value)
                  <div class="col-md-12">
                    <div class="form-group {{$errors->first('pola') ? 'has-error':''}}">
                      <div class='col-md-6'>
                        <label>Nama Pola</label>
                        {{Form::text('pola_nama[]',$value->nama,['class'=>'form-control','id'=>'','placeholder'=>'Nama Pola'])}}
                        <label>Quantity Bahan</label>
                        {{Form::text('pola_qty_bahan[]',$value->qty_bahan,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Qty Bahan'])}}
                        <label>Quantity Potong</label>
                        {{Form::text('pola_qty_potong[]',$value->qty_potong,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Qty Potong'])}}
                      </div>
                      <div class='col-md-6'>
                        <label>Jumlah dikirim</label>
                        {{Form::text('pola_jml_dikirim[]',$value->jml_dikirim,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Jml dikirim'])}}
                        <label>Ukuran</label>
                        {{Form::text('pola_ukuran[]',$value->ukuran,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran'])}}
                      </div>

                    </div>
                  </div>

                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-warning" id="material">
            <div class="box-header">
              <div class="box-title">Sablon</div>
              &nbsp;<button id="tambah_sablon" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_sablon" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="sablon">
                @foreach ($order->detail_sablon as $key => $value)
                  <div class="col-md-12">
                    <div class="form-group {{$errors->first('sablon') ? 'has-error':''}}">
                      <div class='col-md-6'>
                        <label>Desain</label>
                        {{Form::text('sablon_desain[]',$value->desain,['class'=>'form-control','id'=>'','placeholder'=>'Desain Sablon'])}}
                        <label>Jumlah</label>
                        {{Form::text('sablon_jumlah[]',$value->jumlah,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Sablon'])}}
                      </div>
                      <div class='col-md-6'>
                        <label>Harga</label>
                        {{Form::text('sablon_harga[]',$value->harga,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Sablon'])}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-warning" id="material">
            <div class="box-header">
              <div class="box-title">Kancing</div>
              &nbsp;<button id="tambah_kancing" class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
              &nbsp;<button id="kurang_kancing" class="btn btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div id="kancing">
                @foreach ($order->detail_kancing as $key => $value)
                  <div class="col-md-12">
                    <div class="form-group {{$errors->first('kancing') ? 'has-error':''}}">
                      <div class='col-md-6'>
                        <label>Ukuran Kancing</label>
                        {{Form::text('kancing_ukuran[]',$value->ukuran,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Kancing'])}}
                        <label>Jumlah</label>
                        {{Form::text('kancing_jumlah[]',$value->jumlah,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Kancing'])}}
                        <label>Warna</label>
                        {{Form::text('kancing_warna[]',$value->warna,['class'=>'form-control','id'=>'','placeholder'=>'Warna Kancing'])}}
                      </div>
                      <div class='col-md-6'>
                        <label>Tipe</label>
                        {{Form::text('kancing_tipe[]',$value->tipe,['class'=>'form-control','id'=>'','placeholder'=>'Tipe Kancing'])}}
                        <label>Harga</label>
                        {{Form::text('kancing_harga[]',$value->harga,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Kancing'])}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col -->
        {{Form::submit('Simpan Perubahan',['id'=>'submit_order','class'=>'btn btn-primary','style'=>'float:right;position:relative;bottom:10px;right:40px;'])}}
      </div>
      <!-- row -->

    </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
{{Form::close()}}

<div id="template_kancing" style="display:none;">
  <div class="col-md-12 form_kancing">
    <hr>
    <div class="form-group {{$errors->first('kancing') ? 'has-error':''}}">
      <div class='col-md-6'>
        <label>Ukuran Kancing</label>
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
        {{Form::text('kancing_harga[]',null,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Kancing'])}}
      </div>
    </div>
  </div>
</div>
<div id="template_label" style="display:none;">
  <div class="col-md-12 form_label">
    <hr>
    <div class="form-group {{$errors->first('label') ? 'has-error':''}}">
      <div class='col-md-6'>
        <label>Ukuran Baju</label>
        {{Form::text('label_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran Baju'])}}
        <label>Jumlah</label>
        {{Form::text('label_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah label'])}}
      </div>
      <div class='col-md-6'>
        <label>Harga</label>
        {{Form::text('label_harga[]',null,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga label'])}}
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
        {{Form::text('bordir_harga[]',null,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Bordir'])}}
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
        <label>Jumlah</label>
        {{Form::text('sablon_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Sablon'])}}
      </div>
      <div class='col-md-6'>
        <label>Harga</label>
        {{Form::text('sablon_harga[]',null,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Sablon'])}}
      </div>
    </div>
  </div>
</div>
<div id="template_bahan" style="display:none;">
  <div class="col-md-12 form_bahan">
    <hr>
    <div class="form-group {{$errors->first('bahan') ? 'has-error':''}}">
      <div class='col-md-6'>
        <label>Nama Bahan</label>
        {{Form::select('id_bahan[]',$bahan,null,['class'=>'form-control','placeholder'=>'Pilih Bahan','id'=>'bahan_select'])}}
        <label>Jumlah</label>
        {{Form::text('bahan_jumlah[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jumlah Bahan'])}}
      </div>
      <div class='col-md-6'>
        <label>Harga</label>
        {{Form::text('bahan_harga[]',null,['class'=>'form-control auto_currency','id'=>'','placeholder'=>'Harga Bahan'])}}
        <label>Satuan</label>
        {{Form::text('bahan_satuan[]','',['class'=>'form-control bahan_satuan1','readonly'])}}
      </div>
    </div>
  </div>
</div>
<div id="template_pola" style="display:none;">
  <div class="col-md-12 form_pola" >
    <hr>
    <div class="form-group {{$errors->first('pola') ? 'has-error':''}}">
      <div class='col-md-6'>
        <label>Nama Pola</label>
        {{Form::text('pola_nama[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Nama Pola'])}}
        <label>Quantity Bahan</label>
        {{Form::text('pola_qty_bahan[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Qty Bahan'])}}
        <label>Quantity Potong</label>
        {{Form::text('pola_qty_potong[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Qty Potong'])}}
      </div>
      <div class='col-md-6'>
        <label>Jumlah dikirim</label>
        {{Form::text('pola_jml_dikirim[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Jml dikirim'])}}
        <label>Ukuran</label>
        {{Form::text('pola_ukuran[]',null,['class'=>'form-control','id'=>'','placeholder'=>'Ukuran'])}}
      </div>

    </div>
  </div>
</div>

@endsection
