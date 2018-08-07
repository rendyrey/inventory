<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/dist/css/skins/_all-skins.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('assets/admin_lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- HighChart -->
  <script src="{{url('assets/admin_lte/js/highchart/highcharts.js')}}"></script>
  <script src="{{url('assets/admin_lte/js/highchart/exporting.js')}}"></script>
  <style>
  .error {
    color: red;
  }
  </style>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <span class="hidden-xs">{{$user->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    {{$user->name}} - Administrator
                    <small>Member since {{date('d M Y',strtotime($user->created_at))}}</small>
                  </p>

                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    @include('layout.menu')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kalender
        <small>Deadline Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelender Deadline</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
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
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a>Rendy Reynaldy</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
  <!-- calendar modal -->
  <div id="CalenderModalNew" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <td>No Order</td>
              <td id="nomor_order"></td>
            </tr>
            <tr>
              <td>Pemberi Order</td>
              <td id="pemberi_order"></td>
            </tr>
            <tr>
              <td>Tanggal Order</td>
              <td id="tanggal_order"></td>
            </tr>
            <tr>
              <td>Tanggal Selesai</td>
              <td id="tanggal_selesai"></td>
            </tr>
          </table>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="detail_order" val="">Details</button>
            <button type="button" class="btn btn-danger antoclose" data-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery 3 -->
  <script src="{{url('assets/admin_lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{url('assets/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
<script src="{{url('assets/admin_lte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{url('assets/admin_lte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{url('assets/admin_lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{url('assets/admin_lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{url('assets/admin_lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
  <!-- date-range-picker -->
  <script src="{{url('assets/admin_lte/bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{url('assets/admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{url('assets/admin_lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.j')}}s"></script>
  <!-- bootstrap color picker -->
  <script src="{{url('assets/admin_lte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
  <!-- bootstrap time picker -->
  <script src="{{url('assets/admin_lte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{url('assets/admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{url('assets/admin_lte/plugins/iCheck/icheck.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{url('assets/admin_lte/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{url('assets/admin_lte/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{url('assets/admin_lte/dist/js/demo.js')}}"></script>
  <!-- DataTables -->
  <script src="{{url('assets/admin_lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('assets/admin_lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- Page script -->
  <script src="{{url('assets/js/page_script.js')}}"></script>
  <!-- JQuery Validate -->
  <script src="{{url('assets/js/jquery.validate.js')}}"></script>
  <script src="{{url('assets/js/jquery.validate.min.js')}}"></script>
  <script src="{{url('assets/js/validation.js')}}"></script>
  <script src="{{url('assets/admin_lte/bower_components/moment/moment.js')}}"></script>
<script src="{{url('assets/admin_lte/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
  <!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    :{
        url:"{{url('kalender/get_order/')}}",
        type:"GET"
      },
     eventClick: function(calEvent, jsEvent, view) {
       // alert(calEvent.start);
       $('#fc_create').click();
       $("#nomor_order").html(calEvent.title);
       $("#detail_order").val(calEvent.id);
       $("#pemberi_order").html(calEvent.pemberi_order);
       $("#tanggal_order").html(calEvent.tanggal_order);
       $("#tanggal_selesai").html(calEvent.tanggal_selesai);
     },
      editable  : true,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val();
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event');
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      init_events(event);

      //Remove event from text input
      $('#new-event').val('');

    })
    $("#detail_order").click(function(){
      var id = $(this).val();

      window.location = "{{url('list_order/edit')}}/"+id;
    });
  })
</script>

  </body>
  </html>
