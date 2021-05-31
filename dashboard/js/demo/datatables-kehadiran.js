// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  var awalPrsn = $("#tglAwalPrsn").val();
  var akhirPrsn = $("#tglAkhirPrsn").val();
  $('#tabelKehadiran').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_datatable-prsn.php",
      "type": "POST",
      "data": {
        "pgwId" : pgwId,
        "tglAwal" : awalPrsn,
        "tglAkhir" : akhirPrsn
      }
    }
  });

  $('#tglAwalPrsn, #tglAkhirPrsn').change(function(){
    var tglAwal = $('#tglAwalPrsn').val();
    var tglAkhir = $('#tglAkhirPrsn').val();
    $('#tabelKehadiran').dataTable({
      "destroy" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "includes/fetch_datatable-prsn.php",
        "type": "POST",
        "data": {
          "pgwId" : pgwId,
          "tglAwal" : tglAwal,
          "tglAkhir" : tglAkhir
        }
      }
    });
  });


  var awalAbsn = $("#tglAwalAbsn").val();
  var akhirAbsn = $("#tglAkhirAbsn").val();
  $('#tabelAbsen').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_datatable-absn.php",
      "type": "POST",
      "data": {
        "pgwId" : pgwId,
        "tglAwal" : awalAbsn,
        "tglAkhir" : akhirAbsn
      }
    }
  });

  $('#tglAwalAbsn, #tglAkhirAbsn').change(function(){
    var tglAwal = $('#tglAwalAbsn').val();
    var tglAkhir = $('#tglAkhirAbsn').val();
    $('#tabelKehadiran').dataTable({
      "destroy" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "includes/fetch_datatable-absn.php",
        "type": "POST",
        "data": {
          "pgwId" : pgwId,
          "tglAwal" : tglAwal,
          "tglAkhir" : tglAkhir
        }
      }
    });
  });

});