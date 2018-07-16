@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Produksi
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a>Produksi</a></li>
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
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Produksi</th>
                <th>Nama Produk</th>
                <th>Bahan Diperlukan</th>
                <th>Persediaan</th>
                <th>Perlu</th>
                <th>Model</th>
                <th>Pola</th>
                <th>Warna</th>
                <th>Ukuran</th>
                <th>Hasil</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($produksi as $key=>$value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->kode}}</td>
                  <td>{{$value->nama_produk}}</td>
                  <td>
                    <ul>
                    @foreach ($value->detail_prod_bahan as $key => $bahan)
                      <li>{{$bahan->bahan->nama}}</li>
                    @endforeach
                  </ul>
                  </td>
                  <td><ul>
                    @foreach ($value->detail_prod_bahan as $key => $bahan)
                      <li>{{$bahan->bahan->persediaan}}</li>
                    @endforeach
                  </ul>
                  </td>
                  <td><ul>
                    @foreach ($value->detail_prod_bahan as $key => $bahan)
                      <li>{{$bahan->keperluan}} {{$bahan->satuan}}</li>
                    @endforeach
                  </ul></td>
                  <td>{{$value->model}}</td>
                  <td>{{$value->pola}}</td>
                  <td>{{$value->warna}}</td>
                  <td>{{$value->ukuran}}</td>
                  <td>{{$value->hasil}}</td>
                  <td></td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <a href="{{url('produksi/tambah')}}"><button type="button" class="btn btn-primary">
            Tambah Data
          </button></a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade large" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Data Pola</h4>
          </div>
          <div class="modal-body">
            {{Form::open(['url'=>'pola','method'=>'post'])}}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group {{$errors->first('nama') ? 'has-error':''}}">
                  <label>Nama Pola</label>
                  {{Form::text('nama',old('nama'),['class'=>'form-control'])}}
                  <span class="text-red">{{$errors->first('nama')}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
            {{Form::close()}}
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endsection
