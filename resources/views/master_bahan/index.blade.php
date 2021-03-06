@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bahan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a>Bahan</a></li>
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
        <div class="box-body" style="overflow:auto;">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kode Bahan</th>
                <th>Warna</th>
                <th>Persediaan</th>
                <th>Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($bahan as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->nama}}</td>
                <td>{{$value->kode}}</td>
                <td>{{$value->warna}}</td>
                <td>{{$value->persediaan}}</td>
                <td>{{$value->satuan}}</td>
                <td>
                  <a href="{{url('bahan/edit/'.$value->id)}}"><i class="fa fa-edit"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Tambah Data
          </button>
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
            <h4 class="modal-title">Default Modal</h4>
          </div>
          <div class="modal-body">
            {{Form::open(['url'=>'bahan','method'=>'post'])}}

            <div class="row">
              <div class="col-md-12">
                <div class="form-group {{$errors->first('nama') ? 'has-error':''}}">
                  <label>Nama</label>
                  {{Form::text('nama',old('nama'),['class'=>'form-control'])}}
                  <span class='text-red'>{{$errors->first('nama')}}</span>
                </div>
                <div class="form-group {{$errors->first('kode') ? 'has-error':''}}">
                  <label>Kode Bahan</label>
                  {{Form::text('kode',old('kode'),['class'=>'form-control'])}}
                  <span class='text-red'>{{$errors->first('kode')}}</span>
                </div>
                <div class="form-group {{$errors->first('warna') ? 'has-error':''}}">
                  <label>Warna</label>
                  {{Form::text('warna',old('warna'),['class'=>'form-control'])}}
                  <span class='text-red'>{{$errors->first('warna')}}</span>
                </div>
                <div class="form-group {{$errors->first('persediaan') ? 'has-error':''}}">
                  <label>Persediaan</label>
                  {{Form::text('persediaan',old('persediaan'),['class'=>'form-control'])}}
                  <span class='text-red'>{{$errors->first('persediaan')}}</span>
                </div>
                <div class="form-group {{$errors->first('satuan') ? 'has-error':''}}">
                  <label>Satuan</label>
                  {{Form::select('satuan',['meter'=>'meter','cm'=>'cm','yard'=>'yard'],old('satuan'),['class'=>'form-control','placeholder'=>'Pilih Satuan'])}}
                  <span class='text-red'>{{$errors->first('satuan')}}</span>
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
