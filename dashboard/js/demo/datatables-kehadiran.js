// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  
  var tableHadir = $('#tabelKehadiran').dataTable({
    "ajax" : {
      "url" : "includes/fetch_datatable-prsn.inc.php",
      "type": "POST",
      "data": function(d) {
        return $.extend( {}, d, {
          "pgwId" : pgwId,
          "tglAwal" : $("#tglAwalPrsn").val(),
          "tglAkhir" : $("#tglAkhirPrsn").val()
        })
      }
    },
    "columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "25%", "targets": 1 },
      { "width": "10%", "targets": 2 },
      { "width": "15%", "targets": 3 },
      { "width": "15%", "targets": 4 },
      { "width": "15%", "targets": 5 },
    ]
  });

  $('#tglAwalPrsn, #tglAkhirPrsn').change(function(){
    tableHadir.dataTable().api().ajax.reload();
  });


  var tableAbsen = $('#tabelAbsen').dataTable({
    "ajax" : {
      "url" : "includes/fetch_datatable-absn.inc.php",
      "type": "POST",
      "data": function(d) {
        return $.extend( {}, d, {
          "pgwId" : pgwId,
          "tglAwal" : $("#tglAwalAbsn").val(),
          "tglAkhir" : $("#tglAkhirAbsn").val()
        })
      }
    },
    "columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "30%", "targets": 1 },
      { "width": "10%", "targets": 2 },
    ]
  });

  $('#tglAwalAbsn, #tglAkhirAbsn').change(function(){
    tableAbsen.dataTable().api().ajax.reload();
  });

});