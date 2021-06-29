// Call the dataTables jQuery plugin
// "use strict";
$(document).ready(function() {
  //bagian presensi
  // var str = $("#filterTanggal").val();
  var tableHadir = $('#tabelKehadiran').dataTable({
    serverSide : true,
    processing : true,
    "ajax" : {
      "url" : "includes/fetch_datatable.inc.php",
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
    tableHadir.DataTable().ajax.reload();
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
    tableAbsen.DataTable().ajax.reload();
  });

  $('#tabelKehadiran').on('draw.dt', function(){
    $('#tabelKehadiran').Tabledit({
      url : 'includes/action_presensi.inc.php',
      dataType : 'json',
      hideIdentifier : true,
      columns:{
        identifier : [6, 'identifier'],
        editable : [
          [1, 'nama']
        ]
      },
      restoreButton : false,
      editButton : false,
      onSuccess : function(data, textStatus, jqXHR){
        if(data.action == 'delete'){
          $('#' + data.id).remove;
          $('#tabelKehadiran').DataTable().ajax.reload();
        }
      }
    });
  })

  setInterval(function () {
    $('#tabelKehadiran').DataTable().ajax.reload(null, false);
    $('#tabelAbsen').DataTable().ajax.reload(null, false);
  }, 30000);

});