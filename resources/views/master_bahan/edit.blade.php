@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Bahan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="{{url('bahan')}}">Bahan</a></li>
        <li class="active"><a>Edit</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Edit Data Bahan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {{Form::open(['url'=>'bahan/update/'.$bahan->id,'method'=>'post'])}}

          <div class="row">
            <div class="col-md-12">
              <div class="form-group {{$errors->first('nama') ? 'has-error':''}}">
                <label>Nama Bahan</label>
                {{Form::text('nama',$bahan->nama,['class'=>'form-control'])}}
                <span class='text-red'>{{$errors->first('nama')}}</span>
              </div>
              <div class="form-group {{$errors->first('kode') ? 'has-error':''}}">
                <label>Kode Bahan</label>
                {{Form::text('kode',$bahan->kode,['class'=>'form-control'])}}
                <span class='text-red'>{{$errors->first('kode')}}</span>
              </div>
              <div class="form-group {{$errors->first('persediaan') ? 'has-error':''}}">
                <label>Persediaan</label>
                {{Form::text('persediaan',$bahan->persediaan,['class'=>'form-control'])}}
                <span class='text-red'>{{$errors->first('persediaan')}}</span>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                {{Form::close()}}
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection
