@extends('layout.index')
@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Label
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a>Label</a></li>
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
                <th>Ukuran</th>
                <th>Persediaan</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($label as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->ukuran}}</td>
                <td>{{$value->persediaan}}</td>
                <td>Rp{{number_format($value->harga,0,',','.')}}</td>
                <td>
                  <a href="{{url('label/edit/'.$value->id)}}"><i class="fa fa-edit"></i></a>
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
            <h4 class="modal-title">Tambah Data Label</h4>
          </div>
          <div class="modal-body">
            {{Form::open(['url'=>'label','method'=>'post'])}}

            <div class="row">
              <div class="col-md-12">
                <div class="form-group {{$errors->first('ukuran') ? 'has-error':''}}">
                  <label>Ukuran</label>
                  {{Form::text('ukuran',old('ukuran'),['class'=>'form-control'])}}
                  <span class="text-red">{{$errors->first('ukuran')}}</span>
                </div>
                <div class="form-group {{$errors->first('persediaan') ? 'has-error':''}}">
                  <label>Persediaan</label>
                  {{Form::text('persediaan',old('persediaan'),['class'=>'form-control'])}}
                  <span class="text-red">{{$errors->first('persediaan')}}</span>
                </div>
                <div class="form-group {{$errors->first('harga') ? 'has-error':''}}">
                  <label>Harga</label>
                  {{Form::text('harga',old('harga'),['class'=>'form-control auto_currency'])}}
                  <span class="text-red">{{$errors->first('harga')}}</span>
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
