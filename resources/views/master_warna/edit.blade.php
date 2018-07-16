@extends('layout.index')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Gudang
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('gudang')}}">Gudang</a></li>
        <li class="active"><a>Edit</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Edit Data Gudang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {{Form::open(['url'=>'warna/update/'.$warna->id,'method'=>'post'])}}

          <div class="row">
            <div class="col-md-12">
              <div class="form-group {{$errors->first('warna') ? 'has-error':''}}">
                <label>Kode Gudang</label>
                {{Form::text('warna',$warna->warna,['class'=>'form-control'])}}
                <span>{{$errors->first('warna')}}</span>
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
