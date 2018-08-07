@extends('layout.index')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grafik Harga
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik Harga</li>
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
      <div class="row">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              {{Form::open(['url'=>'grafik/harga','method'=>'post'])}}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Data yang ingin ditampilkan</label>
                    {{Form::select('data_grafik',$data_grafik,null,['class'=>'form-control'])}}
                  </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Dari</label>
                      {{Form::select('bulan_awal',$bulan,null,['class'=>'form-control'])}}
                    </div>
                    <div class="col-md-6">
                      <label>Sampai</label>
                      {{Form::select('bulan_akhir',$bulan,'12',['class'=>'form-control'])}}
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>&nbsp;</label>
                    {{Form::submit('Submit',['class'=>'form-control btn btn-primary btn-sm'])}}
                  </div>
                </div>
                {{Form::close()}}
              </div>
              <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



            	<script type="text/javascript">

            	Highcharts.chart('container', {
            		chart: {
            			type: 'spline'
            		},
            		title: {
            			text: 'Grafik Harga Keseluruhan'
            		},

            		xAxis: {
            			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            			'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            		},
            		yAxis: {
            			title: {
            				text: 'Harga'
            			},
            			labels: {
            				formatter: function () {
            					return 'Rp'+this.value;
            				}
            			}
            		},
            		tooltip: {
            			crosshairs: true,
            			shared: true
            		},
            		plotOptions: {
            			spline: {
            				marker: {
            					radius: 4,
            					lineColor: '#666666',
            					lineWidth: 1
            				}
            			}
            		},
            		series: [{
            			name: 'Bahan',
            			marker: {
            				symbol: 'square'
            			},
            			data: [
                    @foreach ($data_bahan as $key => $value)
                      {{round($value)}},
                    @endforeach
                  ]

            		},{
            			name: 'Label',
            			marker: {
            				symbol: 'circle'
            			},
            			data: [
                    @foreach ($data_label as $key => $value)
                      {{round($value)}},
                    @endforeach
                  ]

            		},{
            			name: 'Bordir',
            			marker: {
            				symbol: 'triangle'
            			},
            			data: [
                    @foreach ($data_bordir as $key => $value)
                      {{round($value)}},
                    @endforeach
                  ]

            		},{
            			name: 'Sablon',
            			marker: {
            				symbol: 'diamond'
            			},
            			data: [
                    @foreach ($data_sablon as $key => $value)
                      {{round($value)}},
                    @endforeach
                  ]

            		},{
            			name: 'Kancing',
            			marker: {
            				symbol: 'square'
            			},
            			data: [
                    @foreach ($data_kancing as $key => $value)
                      {{round($value)}},
                    @endforeach
                  ]

            		}]
            	});
            	</script>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
