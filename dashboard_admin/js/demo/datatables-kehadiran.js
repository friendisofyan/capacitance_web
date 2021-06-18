// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  //bagian presensi
  // var str = $("#filterTanggal").val();
  var tableHadir = $('#tabelKehadiran').dataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
      "url" : "includes/fetch_datatable.php",
      "type": "POST",
      "data": function(d) {
        return $.extend( {}, d, {
          "tgl" : $("#filterTanggal").val()
        })
      }
    },
    "columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "40%", "targets": 1 },
      { "width": "10%", "targets": 2 },
      { "width": "15%", "targets": 3 },
      { "width": "15%", "targets": 4 },
      { "width": "15%", "targets": 5 },
    ],
    "autoWidth": false
  });

  $('#filterTanggal').change(function(){
    tableHadir.dataTable().api().ajax.reload();
  });

  //bagian absen
  var tableAbsen = $('#tabelAbsen').dataTable({
    "ajax" : {
      "url" : "includes/fetch_datatable-absn.inc.php",
      "type": "POST",
      "data": function(d) {
        return $.extend( {}, d, { 
          "tglAwal" : $("#tglAwalAbsn").val(),
          "tglAkhir" : $("#tglAkhirAbsn").val()
        })
      }
    },
    "columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "25%", "targets": 1 },
      { "width": "20%", "targets": 2 },
      { "width": "10%", "targets": 3 }
    ]
  });

  $('#tglAwalAbsn, #tglAkhirAbsn').change(function(){
    tableAbsen.dataTable().api().ajax.reload();
  });

});