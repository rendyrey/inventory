$(function () {

  //aktif page
  var path = window.location.pathname;
  var str = path.split('/');
  var url = document.location.protocol + "//" + document.location.hostname + ":8018/" + str[1] + "/" + str[2];
  var link = $("li a[href='"+url+"']");
  $(link).closest('li').addClass('active');
  $(link).closest('.treeview').addClass('active menu-open');

  //untuk alert yg hilang otomatis
  setTimeout('$(".alert").fadeOut()',3000);



  //Initialize Select2 Elements
  $('.select2').select2();
  $('#datatable').DataTable()
  $('#datatable2').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : true
  })

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  $('.tanggal').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  });

  $('.auto_currency').keyup(function(event) {

    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;

    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      ;
    });
  });

  $('.selectAll').change(function() {
    // alert('hi');
    $('.checkBoxClass').prop('checked', this.checked).change();
  });


  //bahan diperlukan
  var bahan = 1;
  $("#tambah_bahan").click(function(){
    var select_bahan = $("#id_keperluan").clone();
    $(".id_bahan_diperlukan").append(select_bahan.html());
  });

  $("#kurangi_bahan").click(function(){
    $(".id_bahan_diperlukan .form_bahan:last").remove();
    $(".id_bahan_diperlukan .form_perlu:last").remove();
    $(".id_bahan_diperlukan .form_satuan:last").remove();
  });

  //order
  var label = 1;
  var bordir = 1;
  var sablon = 1;
  var kancing = 1;
  //tambah label
  $("#tambah_label").click(function(){
    var get = $("#template_label").clone();
    $(get.html()).appendTo("#label").hide().fadeIn(500);
    label++;
  });
  //kurang label
  $("#kurang_label").click(function(){
    if(label>1){
      $(".form_label:first").fadeOut(500,function(){
        $(this).remove();
      })
      label--;
    }
  });
  //tambah bordir
  $("#tambah_bordir").click(function(){
    var get = $("#template_bordir").clone();
    $(get.html()).appendTo("#bordir").hide().fadeIn(500);
    bordir++;
  });
  //kurang bordir
  $("#kurang_bordir").click(function(){
    if(bordir>1){
      $(".form_bordir:first").fadeOut(500,function(){
        $(this).remove();
      });
      bordir--;
    }
  });
  //tambah sablon
  $("#tambah_sablon").click(function(){
    var get = $("#template_sablon").clone();
    $(get.html()).appendTo("#sablon").hide().fadeIn(500);
    sablon++;
  });
  //kurang sablon
  $("#kurang_sablon").click(function(){
    if(sablon>1){
      $(".form_sablon:first").fadeOut(500,function(){
        $(this).remove();
      });
      sablon--;
    }
  });
  //tambah kancing
  $("#tambah_kancing").click(function(){
    var get = $("#template_kancing").clone();
    $(get.html()).appendTo("#kancing").hide().fadeIn(500);
    kancing++;
  });
  //kurang sablon
  $("#kurang_kancing").click(function(){
    if(kancing>1){
      $(".form_kancing:first").fadeOut(500,function(){
        $(this).remove();
      });
      kancing--;
    }
  });




});
