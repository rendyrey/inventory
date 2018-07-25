
// // just for the demos, avoids form submit
// jQuery.validator.setDefaults({
//   debug: true,
//   success: "valid"
// });

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

  $("#produksi").validate({
    ignore:[],
    rules:{
      'bahan[]':{
        required:true
      },
      'keperluan[]':{
        required:true,
        number:true
      },
      'satuan[]':{
        required:true
      },
      model:{
        required:true
      },
      pola:{
        required:true
      },
      warna:{
        required:true
      },
      ukuran:{
        required:true
      },
      hasil:{
        required:true,
        number:true
      }
    }
  });


$("#lanjut_order").click(function(){
  $("#order").valid();
  if($("#order").valid()){
    $("#material").fadeIn(400);
  }
});
