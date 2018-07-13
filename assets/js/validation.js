
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});

  $( "#order" ).validate({
    rules: {
      id_pemotong_pola:{
        required: true
      },
      id_gudang_penerima:{
        required: true,
      },
      tanggal_order: {
        required: true
      },
      tanggal_selesai: {
        required: true
      },
      biaya_produksi: {
        required: true,
      }
    }
  });
// if($("#order").valid()){
//   alert('hi');
// }

$("#lanjut_order").click(function(){
  $("#order").valid();
  if($("#order").valid()){
    $("#material").fadeIn(400);
  }
});
