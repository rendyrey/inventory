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
            @foreach ($produksi as $keyproduk => $value)

              <tr>
                <td><input type="checkbox" name="produk[]" value={{$value->id}}></td>
                <td>{{$value->kode}}</td>
                <td>
                  <ul>
                    @foreach ($value->detail_prod_bahan as $key => $bahan)
                      <li>{{$bahan->bahan->nama}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>

                  @foreach ($value->detail_prod_bahan as $key => $bahan)
                    <input type="hidden" name="{{'bahan'.$keyproduk.'[]'}}" value="{{$bahan->bahan->id}}">
                    {{Form::text('',$bahan->bahan->persediaan,['style'=>'width:70%;display:inline','disabled'])}}
                  @endforeach

                </td>
                <td>


                  @foreach ($value->detail_prod_bahan as $key => $bahan)
                    {{Form::text("keperluan".$keyproduk."[]",$bahan->keperluan,['class'=>'','style'=>'width:70%;display:inline'])}}{{$bahan->satuan}}<br>
                  @endforeach

                </td>
                <td>{{$value->model}}</td>
                <td>{{$value->pola}}</td>
                <td>{{$value->warna}}</td>
                <td>{{$value->ukuran}}</td>
                <td>{{Form::text('hasil[]',$value->hasil,['class'=>'','style'=>'width:70%;display:inline'])}}</td>
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

    </section>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
