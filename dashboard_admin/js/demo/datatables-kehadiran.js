// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  //bagian presensi
  var str = $("#filterTanggal").val();
  $('#tabelKehadiran').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_datatable.php",
      "type": "POST",
      "data": {
        "tgl" : str
      }
    }
  });

  $('#filterTanggal').change(function(){
    var tanggal = $(this).val();
    // tabelKehadiran.destroy();
    $('#tabelKehadiran').dataTable({
      "destroy" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "includes/fetch_datatable.php",
        "type": "POST",
        "data": {
          "tgl" : tanggal
        }
      }
    });
  });

  //bagian absen
  var awalAbsn = $("#tglAwalAbsn").val();
  var akhirAbsn = $("#tglAkhirAbsn").val();
  $('#tabelAbsen').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_datatable-absn.inc.php",
      "type": "POST",
      "data": {
        "tglAwal" : awalAbsn,
        "tglAkhir" : akhirAbsn
      }
    }
  });

  $('#tglAwalAbsn, #tglAkhirAbsn').change(function(){
    var tglAwal = $('#tglAwalAbsn').val();
    var tglAkhir = $('#tglAkhirAbsn').val();
    $('#tabelAbsen').dataTable({
      "destroy" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "includes/fetch_datatable-absn.inc.php",
        "type": "POST",
        "data": {
          "tglAwal" : tglAwal,
          "tglAkhir" : tglAkhir
        }
      }
    });
  });

});