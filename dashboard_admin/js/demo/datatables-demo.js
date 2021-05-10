// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  var str = $("#filterTanggal").val();
  var tabelKehadiran = $('#tabelKehadiran').dataTable({
    "serverside" : true,
    "ajax" : {
      "url" : "includes/fetch_datatable.php",
      "type": "POST",
      "data": function ( d ) {
        d.tgl = str;
      }
    }
  });


  $('#filterTanggal').change(function(){
    var tanggal = $("#filterTanggal").val();
    // tabelKehadiran.destroy();
    $('#tabelKehadiran').dataTable({
      "destroy" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "includes/fetch_datatable.php",
        "type": "POST",
        "data": function ( d ) {
          d.tgl = tanggal;
        }
      }
    });
  });

});